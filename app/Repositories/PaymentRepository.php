<?php
namespace App\Repositories;



use App\Mail\AccountActivationRequest;
use App\Models\User;
use App\Models\VisaPayment;
use App\Requests\ActivateRequest;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Unicodeveloper\Paystack\Facades\Paystack;
use GuzzleHttp\Client;
use Illuminate\Support\Str;


class PaymentRepository 
{



    public function initializePayment($request)
    {
        $user = Auth::user();
        $email = $user->email;

        // dd($request['amount']);

        $reference = Str::random(60);

        $client = new Client();

        $response = $client->post('https://api.paystack.co/transaction/initialize', [
            'headers' => [
                'Authorization' => 'Bearer ' . config('paystack.secretKey'),
                'Content-Type' => 'application/json',
            ],
            'json' => [
                'amount' => $request['amount'], // Replace with the amount you want to charge in kobo (e.g., 10000 for ₦100.00)
                'email' => $email, // Replace with the customer's email
                'reference'=>$reference,
            ],
        ]);

        $data = json_decode($response->getBody(), true);
        $authorizationUrl = $data['data']['authorization_url'];

        return response()->json(['authorization_url' => $authorizationUrl]);


    }




    public function verifyPayment($request)
    {

        // dd($request);
        $user = Auth::user();

        // Sample code to check the payment status (you'll need to implement your own logic here)
        $reference = $request['reference'];
        
        $client = new Client();
        $response = $client->get('https://api.paystack.co/transaction/verify/' . $reference, [
            'headers' => [
                'Authorization' => 'Bearer ' . config('paystack.secretKey'),
            ],
        ]);

        $data = json_decode($response->getBody(), true);

        // dd($data);


        if ($data['data']['status'] === 'success') {
            // Payment was successful, update your database or perform other actions
            // return response()->json($data['data']['customer']);

            $visaPayment = new VisaPayment();
            $visaPayment['amount'] = $data['data']['amount'];
            $visaPayment["reference"] = $data['data']['reference'];
            $visaPayment["user_email"] = $data['data']['customer']['email'];
            $visaPayment["customer_code"] = $data['data']['customer']['customer_code'];
            $visaPayment["status"] = $request['status'];


            $user->payments()->save($visaPayment);

            return response()->json([
                "message" => "Success",
                "data" => $visaPayment,
            ], 201);
            
        } else {
            // Payment was not successful, handle accordingly
        }



    }


}