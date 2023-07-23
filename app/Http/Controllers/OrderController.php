<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Order;
use Illuminate\Http\Request;
use App\Http\Requests\OrderRequest;
use Illuminate\Support\Facades\Auth;

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

        return view('admin.order.create', compact('order_number', 'customers', 'mechanics'));
    }

    public function store(OrderRequest $request)
    {
        $data = $request->validated();

        $order = new Order;
        $data['created_by'] = Auth::user()->id;
        $order->create($data);

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
}
