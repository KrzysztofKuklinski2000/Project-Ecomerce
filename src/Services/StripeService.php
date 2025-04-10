<?php 
declare(strict_types=1);
namespace App\Services;

class StripeService {
    public function __construct(string $apiKey) {
        \Stripe\Stripe::setApiKey($apiKey);
    }

    public function createPayment(array $StripsProductList, int $orderId):string{
        $checkout_session = \Stripe\Checkout\Session::create([
            "mode" => "payment",
            "success_url" => "http://localhost/?page=success&orderId=$orderId&session_id={CHECKOUT_SESSION_ID}",
            "cancel_url" => "http://localhost/?page=fail&orderId=$orderId&session_id={CHECKOUT_SESSION_ID}",
            "locale" => "pl",
            "line_items" => [
                $StripsProductList
            ]
        ]);

        return $checkout_session->url;
    }

    public function paymentStatus(?string $sessionId):string {
        return \Stripe\Checkout\Session::retrieve($sessionId)->payment_status;
    }
}