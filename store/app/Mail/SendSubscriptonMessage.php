<?php

namespace App\Mail;

use App\Models\Product;
use App\Models\Sku;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class SendSubscriptonMessage extends Mailable
{
    use Queueable, SerializesModels;

    protected Sku $sku;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Sku $sku)
    {
        $this->sku = $sku;
    }

    public function build()
    {
        return $this->view('mail.subscription', [
            'sku' => $this->sku,
        ]);
    }
}
