<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Purchase;
use Stripe;
use Stripe\Checkout\Session;
use Illuminate\Support\Facades\Route;
use App\Jobs\SecondChargeJob;

// use Illuminate\Support\Facades\Session;

class StripeController extends Controller
{
    public function checkout(Request $request, $id)
    {
        $product =   Product::findOrFail($id);

        return view('checkout', compact('product'));


    }






    public function stripePost(Request $request)

    {


        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));



      $customer = Stripe\Customer::create(array(
        "email" => $request->email,
        "name" => $request->name,
        "source" => $request->stripeToken
     ));
     $initialAmount = $request->price / 2; // Half of the price in cents
   

      $string =   Stripe\Charge::create([
                "amount" => $request->price * 100 / 2,
                "currency" => "usd",
                "customer" =>$customer->id,
                "description" => "first charge TEST "
        ]);



         SecondChargeJob::dispatch($customer->id, $initialAmount)->delay(now()->addSeconds(15));

    // dd($customer->id);
      $thanksUrl = route('thanks', ['id' => $request->id,'cus_id'=>$customer->id]);

      return redirect($thanksUrl);




        // Session::flash('success', 'Payment successful!');

        // return back();
    }
}
