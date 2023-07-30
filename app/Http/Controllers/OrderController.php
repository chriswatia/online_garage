<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Order;
use App\Models\Product;
use App\Models\Service;
use App\Models\Vehicle;
use App\Models\OrderItem;
use App\Models\ServiceItem;
use Illuminate\Http\Request;
use App\Http\Requests\OrderRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use App\Notifications\EmailNotification;

class OrderController extends Controller
{
    public function index(){
        $orders = Order::all();
        return view('admin.order.index', compact('orders'));
    }

    public function create(){
        $order_number = Order::max('order_number') + 1;
        // Convert $order_number to a 4-digit string with leading zeros
        $order_number = str_pad($order_number, 5, '0', STR_PAD_LEFT);

        $customers = User::where('role_id', 2)->get();
        $mechanics = User::where('role_id', 3)->get();
        $services = Service::all();
        $products = Product::all();

        return view('admin.order.create', compact('order_number', 'customers', 'mechanics', 'services', 'products'));
    }

    public function store(OrderRequest $request)
    {
        $data = $request->validated();


        $order = new Order;
        $data['created_by'] = Auth::user()->id;
        $order = $order->create($data);

        $selected_services = explode(',', $data['selected_services']);
        foreach($selected_services as $selected_service){
            $service = Service::findOrFail($selected_service);
            $service_item = new ServiceItem();
            $service_item->order_id = $order->id;
            $service_item->service_id = $service->id;
            $service_item->rate = $service->rate;
            $service_item->created_by = Auth::user()->id;
            $service_item->save();
        }

        $selected_products = json_decode($data['selected_products']);
        foreach($selected_products as $selected_product){
            $product = Product::findOrFail($selected_product->id);

            $order_item = new OrderItem();
            $order_item->order_id = $order->id;
            $order_item->product_id = $product->id;
            $order_item->quantity = $selected_product->quantity;
            $order_item->rate = $product->rate;
            $order_item->total = ($product->rate)*($selected_product->quantity);
            $order_item->created_by = Auth::user()->id;
            $order_item->save();

            $product->quantity = ($product->quantity) - ($selected_product->quantity);
            $product->save();
        }


        $admin_user = User::where('id', $order->user_id)->first();

        $project = [
            'greeting' => 'Hi '.$admin_user->firstname.',',
            'body' => 'A new invoice <b>'.$order->order_number.'</b> was created for your service',
            'thanks' => 'Thanks for choosing Jatinga Garage and AutoSpares',
            'actionText' => 'View Invoice',
            'actionURL' => url('invoices'),
            'id' => 57
        ];

        $admin_user->notify(new EmailNotification($project));

        return redirect('admin/orders')->with('message', "Order created successfully");
    }

    public function edit($id){
        $order = Order::findOrFail($id);
        return view('admin.order.edit', compact('order'));
    }

    public function update(Request $request, $id)
    {
        $data = $request->all();

        $order = Order::findOrFail($id);
        $order->update($data);

        return redirect('admin/orders')->with('message', "Order updated successfully");
    }

    public function destroy($id)
    {
        $order = Order::findOrFail($id);
        $order->delete();

        return redirect('admin/orders')->with('message', "Order deleted successfully");
    }

    public function invoices(){
        $orders = Order::where('user_id', Auth::user()->id)->get();
        return view('user.invoice.index', compact('orders'));
    }

    public function confirm($order_id){
        $order = Order::findOrFail($order_id);
        return view('user.invoice.confirm', compact('order'));
    }

    public function generateAuthCode(){
        $headers = [
            'Authorization' => 'Basic azJNUlNBWDUwVEE3emJEaGVKYXUweTE2M3FDbWs0OGg6bDdBT0FRQjBSR1poT2piNw',
        ];

        $response = Http::withHeaders($headers)->get('https://sandbox.safaricom.co.ke/oauth/v1/generate?grant_type=client_credentials');

        if ($response->successful()) {
            $responseData = json_decode($response->body());
            return $responseData->access_token;
        } else {
            // Handle the failed request
            $statusCode = $response->status();
            $errorMessage = $response->body();
            return $response->json();
        }
    }

    public function stkpush($order_id)
    {
        $order = Order::findOrFail($order_id);
        $user = User::findOrFail($order->user_id);

        if(!$user->phone){
            return redirect('invoice')->with('error', "Update your profile with your phone number");
        }

        $phone = $this->formatPhone($user->phone);

        $data = [
            "BusinessShortCode" => 174379,
            "Password" => "MTc0Mzc5YmZiMjc5ZjlhYTliZGJjZjE1OGU5N2RkNzFhNDY3Y2QyZTBjODkzMDU5YjEwZjc4ZTZiNzJhZGExZWQyYzkxOTIwMjMwNzMwMTI1MTQ4",
            "Timestamp" => "20230730125148",
            "TransactionType" => "CustomerPayBillOnline",
            "Amount" => 1,
            "PartyA" => $phone,
            "PartyB" => 174379,
            "PhoneNumber" => $phone,
            "CallBackURL" => "https://mydomain.com/path",
            "AccountReference" => "JATINGA GARAGE AND AUTOSPARES",
            "TransactionDesc" => "Payment of Service"
        ];

        $authCode = $this->generateAuthCode();

        // Headers for authentication
        $headers = [
            'Authorization'=>'Bearer '.$authCode,
            'Content-Type'=>'application/json'
        ];

        $response = Http::withHeaders($headers)->post('https://sandbox.safaricom.co.ke/mpesa/stkpush/v1/processrequest', $data);
        if ($response->successful()) {
            $responseData = json_decode($response->body());
            //Update Order
            $order->transaction_id = $responseData->CheckoutRequestID;
            $order->paid = 1;
            $order->due = $order->grand_total;
            $order->save();

            return redirect('confirm/'.$order->id)->with('message', "Payment initiated successfully!");
            return $response->json();

        } else {
            return $response->json();
        }

    }

    public function query($order_id)
    {
        $order = Order::findOrFail($order_id);

        $data = [
            "BusinessShortCode" => 174379,
            "Password" => "MTc0Mzc5YmZiMjc5ZjlhYTliZGJjZjE1OGU5N2RkNzFhNDY3Y2QyZTBjODkzMDU5YjEwZjc4ZTZiNzJhZGExZWQyYzkxOTIwMjMwNzMwMTI1MTQ4",
            "Timestamp" => "20230730125148",
            "CheckoutRequestID" => $order->transaction_id,
        ];

        $authCode = $this->generateAuthCode();
        // Headers for authentication
        $headers = [
            'Authorization'=>'Bearer '.$authCode ,
            'Content-Type'=>'application/json'
        ];

        $response = Http::withHeaders($headers)->post('https://sandbox.safaricom.co.ke/mpesa/stkpushquery/v1/query', $data);
        if ($response->successful()) {
            $responseData = json_decode($response->body());
            if($responseData->ResultCode != 0){
                return redirect('confirm/'.$order->id)->with('error', "Error Occured While Processing Your Payment!");
            }
            $order->order_status = 'Paid';
            $order->due = ($order->due) - ($order->paid);
            $order->save();

            $admin_user = User::where('role_id', 1)->first();

            $project = [
                'greeting' => 'Hi '.$admin_user->firstname.',',
                'body' => 'An order <b>'.$order->order_number.'</b> was paid',
                'thanks' => '',
                'actionText' => 'View Order',
                'actionURL' => url('admin/bookings'),
                'id' => 57
            ];

            $admin_user->notify(new EmailNotification($project));

            return redirect('invoices')->with('message', "Payment successful!");

        } else {
            $responseData = json_decode($response->body());
            if($responseData->ResultCode != 0){
                return redirect('confirm/'.$order->id)->with('error', "Error Occured While Processing Your Payment!");
            }

        }

    }

    public function formatPhone($phone)
    {
        $phone = 'hfhsgdgs' . $phone;
        $phone = str_replace('hfhsgdgs0', '', $phone);
        $phone = str_replace('hfhsgdgs', '', $phone);
        $phone = str_replace('+', '', $phone);
        if (strlen($phone) == 9) {
            $phone = '254' . $phone;
        }
        return $phone;
    }
}
