<?php

namespace App\Mail;

use App\Classes\Basket;
use App\Models\Order;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class OrderCreated extends Mailable
{
    use Queueable, SerializesModels;

    protected Basket $basket;
    protected Order $order;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Basket $basket, Order $order)
    {
        $this->basket = $basket;
        $this->order  = $order;
    }

    public function build()
    {
        $fullSum = $this->order->calculateFullSum();

        return $this->view('mail.order_created',[
            'basket'   => $this->basket,
            'order'    => $this->order,
            'fullSum'  => $fullSum,
        ]);
    }
}
