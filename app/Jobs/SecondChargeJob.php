<?php

namespace App\Jobs;

// use App\Models\Customer;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Stripe;
use Illuminate\Support\Facades\Log;

class SecondChargeJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $customerId;
    protected $amount;
    protected $customer;


    /**
     * Create a new job instance.
     *
     * @return void
     */
   
    public function __construct($customerId,$amount)
    {
        $this->customerId = $customerId;
        $this->amount = $amount;




    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
        $this->customer = Stripe\Customer::retrieve($this->customerId);
        Stripe\Charge::create([
            "amount" => $this->amount,
            "currency" => "usd",
            "customer" => $this->customer->id,
            "description" => "second charge TEST"
        ]);





        // return redirect($thanksUrl);
    }
}
