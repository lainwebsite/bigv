<?php

namespace App\Http\Controllers\User\PaymentGateway;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

class PaynowController extends Controller
{
    public function pay($total_price, $transaction_id = 0)
    {
        try {
            $response = Http::withHeaders([
                'X-BUSINESS-API-KEY' => '7cf06a78a52b715c117bca86fe326e3fffdc1288b9b6c5ed2fdaf102983477b7',
                'X-Requested-With' => 'XMLHttpRequest',
                'accept' => 'application/json',
                'content-type' => 'application/json'
            ])->post('https://api.sandbox.hit-pay.com/v1/payment-requests', [
                'reference_number' => $transaction_id,
                'phone' => auth()->user()->phone,
                'amount' => $total_price,
                'payment_methods' => ['paynow_online'],
                'currency' => 'SGD',
                'redirect_url' => 'https://bigvsg.com/public/user/transaction',
                'webhook' => 'https://bigvsg.com/public/api/h/p/y/webhook'
            ]);

            // $client = new Client();
            // $response = $client->request('POST', 'https://api.sandbox.hit-pay.com/v1/payment-requests', [
            //     'body' => '{
            //         "phone":
            //         "amount":0.5,
            //         "payment_methods":{"":"paynow_online"},
            //         "currency":"SGD",
            //         "redirect_url":"http://bigvsg.com/test-4-3-4-bigv/coba3/public/transaction",
            //         "webhook":"http://bigvsg.com/test-4-3-4-bigv/coba3/public/api/webhook"
            //     }',
            //     'headers' => [
            //         'X-BUSINESS-API-KEY' => '7cf06a78a52b715c117bca86fe326e3fffdc1288b9b6c5ed2fdaf102983477b7',
            //         'X-Requested-With' => 'XMLHttpRequest',
            //         'accept' => 'application/json',
            //         'content-type' => 'application/json',
            //     ]
            // ]);

            $responseJSON = json_decode($response->getBody()->getContents());
            return redirect()->away($responseJSON->url);
        } catch (\GuzzleHttp\Exception\RequestException $ex) {
            dd($ex->getResponse()->getBody()->getContents());
        }
    }

    public function webhook(Request $request)
    {
        // $output = json_encode($request->all()) . "\r\n";
        // foreach ($request->all() as $key => $data) {
        //     $output .= $key . " : " . ($data == null ? "null" : $data) . "\r\n";
        // }
        $data = $request->all();
        unset($data["hmac"]);

        $responseSignature = $request->hmac;
        $generatedSignature = $this->generateSignatureArray("Uh09WlzhFDWFUYUZWWvO0gwvzebEwfpFRc1fs9aul60zbjX79fP0K9bAfFqMQAEU", $data);

        $status = "FAIL";
        if ($responseSignature == $generatedSignature) {
            $status = "SUCCESS";

            Transaction::where('id', $request->reference_number)->update(['status_id', 2]);
        }

        $status .= "(response hitpay: " . $responseSignature . ", generated: " . $generatedSignature . ")";
        Storage::disk('local')->put('status.txt', $status);
    }

    public function generateSignatureArray($secret, array $args)
    {
        $hmacSource = [];

        foreach ($args as $key => $val) {
            $hmacSource[$key] = "{$key}{$val}";
        }

        ksort($hmacSource);

        $sig            = implode("", array_values($hmacSource));
        $calculatedHmac = hash_hmac('sha256', $sig, $secret);

        return $calculatedHmac;
    }
}
