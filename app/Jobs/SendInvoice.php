<?php

namespace App\Jobs;

use App\Mail\InvoiceMail;
use App\Models\v1\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Mail\Message;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendInvoice implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    protected $email;
    protected $order;
   
    /**
     * Create a new job instance.
     */
    public function __construct(string $email , Order $order)
    {
        $this->email = $email;
        $this->order = $order;
       
    }

    public function handle(): void
    {
        Mail::to($this->email)->send(new InvoiceMail( $this->order));
    }
}
