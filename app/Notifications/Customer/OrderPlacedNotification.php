<?php

namespace App\Notifications\Customer;

use App\Mail\Customer\OrderPlacedMail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

use App\Model\Orders;
use App\Model\OrderDescription;
use App\Broadcasting\SmsChannel;


class OrderPlacedNotification extends Notification
{
    use Queueable;

    private $order;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($order)
    {
        $this->order = $order;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database', 'mail', SmsChannel::class];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new OrderPlacedMail($this->order))
                    ->to($notifiable->email_id);
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        $orderId = $this->order->id;
        return [
            "message" => "Order Placed Successfully! Order #$orderId",
            "details"=> [
                "order" => $this->order,
                "products"=> $this->order->products
            ]
        ];
    }

    public function toSms($notifiable) {
        $orderId = $this->order->id;

        return "Order Placed Successfully! Order #$orderId";
    }
}
