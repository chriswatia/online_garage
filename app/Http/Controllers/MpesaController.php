<?php

namespace App\Http\Controllers;

use Safaricom\Mpesa\Mpesa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class MpesaController extends Controller
{
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

    public function stkpush()
    {
        $data = [
            "BusinessShortCode" => 174379,
            "Password" => "MTc0Mzc5YmZiMjc5ZjlhYTliZGJjZjE1OGU5N2RkNzFhNDY3Y2QyZTBjODkzMDU5YjEwZjc4ZTZiNzJhZGExZWQyYzkxOTIwMjMwNzMwMTI1MTQ4",
            "Timestamp" => "20230730125148",
            "TransactionType" => "CustomerPayBillOnline",
            "Amount" => 1,
            "PartyA" => 254705168091,
            "PartyB" => 174379,
            "PhoneNumber" => 254705168091,
            "CallBackURL" => "https://mydomain.com/path",
            "AccountReference" => "CompanyXLTD",
            "TransactionDesc" => "Payment of X"
        ];

        $authCode = $this->generateAuthCode();

        // Headers for authentication
        $headers = [
            'Authorization'=>'Bearer '.$authCode,
            'Content-Type'=>'application/json'
        ];

        $response = Http::withHeaders($headers)->post('https://sandbox.safaricom.co.ke/mpesa/stkpush/v1/processrequest', $data);
        if ($response->successful()) {

            return redirect('invoices')->with('message', "Payment successfully!");
            return $response->json();

        } else {
            return $response->json();
        }

    }

    public function query()
    {
        $data = [
            "BusinessShortCode" => 174379,
            "Password" => "MTc0Mzc5YmZiMjc5ZjlhYTliZGJjZjE1OGU5N2RkNzFhNDY3Y2QyZTBjODkzMDU5YjEwZjc4ZTZiNzJhZGExZWQyYzkxOTIwMjMwNzMwMTI1MTQ4",
            "Timestamp" => "20230730125148",
            "CheckoutRequestID" => "ws_CO_260520211133524545",
        ];

        $authCode = $this->generateAuthCode();
        // Headers for authentication
        $headers = [
            'Authorization'=>'Bearer '.$authCode ,
            'Content-Type'=>'application/json'
        ];

        $response = Http::withHeaders($headers)->post('https://sandbox.safaricom.co.ke/mpesa/stkpushquery/v1/query', $data);
        if ($response->successful()) {
            return $response->json();

        } else {
            return $response->json();
        }

    }
}
