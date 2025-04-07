<?php 
declare(strict_types=1);
namespace Src\Services;

class StripeService {
    public function __construct(string $apiKey) {
        \Stripe\Stripe::setApiKey($apiKey);
    }
}