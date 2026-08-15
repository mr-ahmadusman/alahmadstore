<?php

namespace App\Mail;

use App\Models\Order;
use App\Models\Logo;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\URL;

class OrderConfirmationMail extends Mailable
{
    use Queueable, SerializesModels;

    public Order $order;
    public string $viewOrderUrl;

    public function __construct(Order $order)
    {
        // Order items aur unke products load kar lo (agar pehle se loaded na hon)
        $this->order = $order->loadMissing('items.product');

        if ($order->user_id) {
            // Login user ke liye direct my-orders page
            $this->viewOrderUrl = route('my.orders');
        } else {
            // Guest ke liye secure signed link (7 din valid)
            $this->viewOrderUrl = URL::temporarySignedRoute(
                'order.guest.view',
                now()->addDays(7),
                [
                    'order' => $order->id,
                    'token' => $order->guest_token,
                ]
            );
        }
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Order #' . $this->order->id . ' Confirmed | Al Ahmad Store',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.order-confirmation',
            with: [
                // Same query jo AppServiceProvider ke View::composer('web.*') mein hai,
                // kyunki mail views us composer se automatically data nahi lete.
                'logo' => Logo::query()->latest('id')->first(),
            ],
        );
    }
}
