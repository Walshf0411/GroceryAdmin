<?php

namespace App\Mail\Vendor;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class OrderReceivedMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(int $orderId, $productsList, $vendor)
    {
        $this->orderId = $orderId;
        $this->productsList = $productsList;
        $this->vendor = $vendor;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject("Order placed successfully #$this->orderId!")
                    ->view('mail.order_received')->with([
                        "vendor" => $this->vendor,
                        "productsList" => $this->productsList,
                        "order_id" => $this->orderId,
                    ]);
    }
}
