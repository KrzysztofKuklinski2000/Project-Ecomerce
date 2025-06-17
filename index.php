<?php
declare(strict_types=1);
error_reporting(E_ALL);
ini_set('display_errors', '1');
require __DIR__ . '/vendor/autoload.php';

session_start();

$strips_secret_key = "sk_test_51Qhz5PKjqg8M9H3wK1yIiYjeDm8STwKh4UobgAehvS1GACXNRTGiPvm2eeWXm1JTbr4hXiXaUi5m03D9WWkKE5jM00CtyXdIVp";
\Stripe\Stripe::setApiKey($strips_secret_key);

use App\Controllers\DashboardController;
use App\Controllers\StoreController;
use App\Controllers\UserController;
use App\Controllers\ProductController;
use App\Controllers\AbstractController;
use App\Controllers\OrderController;
use App\Controllers\CategoryController;
use App\Controllers\UserDashboardController;
use App\Request;


$config  = require_once('config/config.php');
// Uruchomienie kontrolera
try {
    AbstractController::initConfiguration($config);
    $request = new Request($_GET, $_POST, $_SERVER, $_SESSION);
    if($request->get('module')){
        switch($request->get('module')){
            case "dashboard":
                (new DashboardController($request))->run();
            break;
            case "product": 
                (new ProductController($request))->run();
            break;
            case "order": 
                (new OrderController($request))->run();
            break;
            case "category": 
                (new CategoryController($request))->run();
            break;
            case "user":
                (new UserDashboardController($request))->run();
            break;
            default:
                (new StoreController($request))->run();
            break;
        }
    }else {
        switch($request->get('page')) {
            case 'sign_up':
            case 'sign_in':
            case 'logout':
                (new UserController($request))->run();
            break;
            default: 
                (new StoreController($request))->run();
            break;
        }
    } 

}catch(Exception $e) {
    echo $e->getMessage();
}catch(\Throwable $e) {
    echo $e->getMessage();
}