<?php

namespace App\Mail;

use App\Models\Currency;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Store;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class OrderConfirmed extends Mailable
{
    use Queueable, SerializesModels;

    public $order;
    public $order_items;
    public $user;
    public $currency;
    public $store;
    public $forAdmin;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Order $order, User $user, $isForAdmin)
    {
        $this->order       = $order;
        $this->order_items = OrderItem::where('order_id', $order->id)->get();
        $this->user        = $user;
        $this->currency    = Currency::find($order->currency_id);
        $this->store       = Store::find($order->store_id);
        $this->forAdmin    = $isForAdmin;

    }


    /**
     * Get the message envelope.
     *
     * @return \Illuminate\Mail\Mailables\Envelope
     */
    public function envelope()
    {
        return new Envelope(
            subject: 'Order Confirmed',
        );
    }

    /**
     * Get the message content definition.
     *
     * @return \Illuminate\Mail\Mailables\Content
     */
    public function content()
    {
        return new Content(
            markdown: 'emails.orders.confirmed',
            with: [
                'url_home' => url('/'),
                'url_logo' => url('/assets/images/logo-icon.png'),
            ],
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array
     */
    public function attachments()
    {
        return [];
    }
}
