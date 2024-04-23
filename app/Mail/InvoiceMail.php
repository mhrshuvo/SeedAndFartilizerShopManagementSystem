<?php

namespace App\Mail;

use App\Models\v1\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class InvoiceMail extends Mailable
{
    use Queueable, SerializesModels;
    public $order;

    /**
     * Create a new message instance.
     */
    public function __construct(Order $order)
    {
        $this->order = $order;
    }

    public function build(): self
    {
        return $this->subject('Invoice for order #' . $this->order->tracking_id)
            ->view('pdf')
            ->with([
                'order' => $this->order->load('order_products'),
            ]);
    }
}
