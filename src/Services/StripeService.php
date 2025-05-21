<?php 
declare(strict_types=1);
namespace App\Services;

class StripeService {
    public function __construct(string $apiKey) {
        \Stripe\Stripe::setApiKey($apiKey);
    }

    public function createPayment(array $StripsProductList, int $orderId):array{
        $checkout_session = \Stripe\Checkout\Session::create([
            "mode" => "payment",
            "success_url" => "http://localhost/?page=success&orderId=$orderId&session_id={CHECKOUT_SESSION_ID}",
            "cancel_url" => "http://localhost/?page=fail&orderId=$orderId&session_id={CHECKOUT_SESSION_ID}",
            "locale" => "pl",
            "line_items" => [
                $StripsProductList
            ]
        ]);

        return [
            'url' => $checkout_session->url,
            'session_id' => $checkout_session->id
        ];
    }

    public function paymentStatus(?string $sessionId):string {
        return \Stripe\Checkout\Session::retrieve($sessionId)->payment_status;
    }
}