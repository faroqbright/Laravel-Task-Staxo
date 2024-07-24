<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Stripe\Stripe;
use Stripe\Charge;
use Stripe\Customer;

class ChargeSecondPayment extends Command
{
    protected $signature = 'payment:charge-second';
    protected $description = 'Charge second half of the payment after 5 minutes';

    public function handle()
    {
        // dd( 'Hello');
        Stripe::setApiKey(env('STRIPE_SECRET'));

        // Retrieve customer ID from the command arguments or options
        $customerId = $this->argument('customerId'); // Adjust this to fetch customer ID

        // Retrieve remaining amount to charge (assuming $request->price holds the total price)
        $remainingAmount = $request->price * 100 / 2;

 
            $charge = Charge::create([
                "amount" => $remainingAmount,
                "currency" => "usd",
                "customer" => $customerId,
                "description" => "Second Payment"
            ]);

            // Log success or handle as needed
            $this->info('Second payment successful.');
  
    }
}
