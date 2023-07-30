<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Safaricom\Mpesa\Mpesa;

class MpesaController extends Controller
{
    public function stkpush()
    {
        $mpesa= new \Safaricom\Mpesa\Mpesa();
        $BusinessShortCode=174379;
        $LipaNaMpesaPasskey="bfb279f9aa9bdbcf158e97dd71a467cd2e0c893059b10f78e6b72ada1ed2c919";
        $TransactionType="CustomerPayBillOnline";
        $Amount="1";
        $PartyA="254705168091";
        $PartyB=174379;
        $PhoneNumber="254705168091";
        $CallBackURL="https://simon.com";
        $AccountReference="Simon's Tech School Payment";
        $TransactionDesc="lipa Na M-PESA web development";
        $Remarks="Thank for paying!";

        $stkPushSimulation = $mpesa->STKPushSimulation(
            $BusinessShortCode,
            $LipaNaMpesaPasskey,
            $TransactionType,
            $Amount,
            $PartyA,
            $PartyB,
            $PhoneNumber,
            $CallBackURL,
            $AccountReference,
            $TransactionDesc,
            $Remarks
        );

        dd($stkPushSimulation);
    }

    public function test(){
        $ch = curl_init('https://sandbox.safaricom.co.ke/mpesa/stkpush/v1/processrequest');
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Authorization: Bearer VkBDoLDZVYPwpDzwgLbXMTZVGnj8',
            'Content-Type: application/json'
        ]);

        $postData = array(
            "BusinessShortCode"=> 174379,
            "Password"=> "MTc0Mzc5YmZiMjc5ZjlhYTliZGJjZjE1OGU5N2RkNzFhNDY3Y2QyZTBjODkzMDU5YjEwZjc4ZTZiNzJhZGExZWQyYzkxOTIwMjMwNzMwMTIyMTM3",
            "Timestamp"=> "20230730122139",
            "TransactionType"=> "CustomerPayBillOnline",
            "Amount"=> 1,
            "PartyA"=> 254705168091,
            "PartyB"=> 174379,
            "PhoneNumber"=> 254705168091,
            "CallBackURL"=> "https://mydomain.com/path",
            "AccountReference"=> "CompanyXLTD",
            "TransactionDesc"=> "Payment of X"
        );
        curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $response     = curl_exec($ch);
        curl_close($ch);
        echo $response;
    }
}
