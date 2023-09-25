<?php

namespace App\Http\Controllers;

use App\Models\product;
use Exception;
use GuzzleHttp\Promise\Create;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Stripe\Customer;

class ProductController extends Controller
{
    public function dashboard()
    {
        $productlist = product::all();
        return view("pages.dashboard", compact("productlist"));
    }
    public function product_details(Request $request)
    {
        $productid = $request->id;
        $productdetails = product::find($productid);
        return view('pages.stripe', compact("productdetails"));
    }
    public function stripePost(Request $request)
    {
        // \Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));



        // \Stripe\PaymentIntent::create ([
        //     "amount" => $price,
        //     "currency" => "INR",
        //     "source" => $request->stripeToken,
        //     "description" => "Test payment from LaravelTus.com." 
        // ]);
        // Session::flash('success', 'Payment successful!');
        // return back();
        try {
            $stripe = new \Stripe\StripeClient(env('STRIPE_SECRET'));
            $price = $request->price;
            $customer = $stripe->customers->create([
                // 'email' => 'email@example.com',
                'email' => "test@gmail.com",
                'name' => 'test'
            ]);
            $payemntid = $stripe->paymentIntents->create([
                'amount' => $price * 100,
                'currency' => 'INR',
                'payment_method_types' => ['card'],
                'customer' => $customer->id,
                'payment_method_data' => [
                    'type' => 'card',
                    'card' => [
                        'token' => $request->stripeToken
                    ]
                ]
            ]);
        } catch (Exception $e) {
            return $e->getMessage();
        }

        Session::flash('success', 'Payment successful!');
        return redirect("/");
    }
}
