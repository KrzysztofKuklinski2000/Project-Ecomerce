<?php
declare(strict_types=1);
require __DIR__ . '/vendor/autoload.php';



session_start();

$strips_secret_key = "sk_test_51Qhz5PKjqg8M9H3wK1yIiYjeDm8STwKh4UobgAehvS1GACXNRTGiPvm2eeWXm1JTbr4hXiXaUi5m03D9WWkKE5jM00CtyXdIVp";
\Stripe\Stripe::setApiKey($strips_secret_key);

use App\Controllers\StoreController;
use App\Controllers\UserController;
use App\Controllers\AbstractController;
use App\Request;

// Uruchomienie kontrolera
$config  = require_once('config/config.php');

try {
    AbstractController::initConfiguration($config);
    $request = new Request($_GET, $_POST, $_SERVER, $_SESSION);
    (new StoreController($request))->run();
}catch(Exception $e) {
    echo $e->getMessage();
}catch(\Throwable $e) {
    echo $e->getMessage();
}