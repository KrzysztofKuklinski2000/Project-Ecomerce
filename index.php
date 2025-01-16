<?php
declare(strict_types=1);
require __DIR__ . '/vendor/autoload.php';

session_start();

use App\Controllers\controller;
use App\Controllers\UserController;
use App\Controllers\AbstractController;
use App\Request;

// Uruchomienie kontrolera
$config  = require_once('config/config.php');

AbstractController::initConfiguration($config);
$request = new Request($_GET, $_POST, $_SERVER, $_SESSION);
(new controller($request))->run();