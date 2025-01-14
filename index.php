<?php
declare(strict_types=1);
require __DIR__ . '/vendor/autoload.php';

use App\Controllers\controller;
use App\Request;

// Uruchomienie kontrolera
$config  = require_once('config/config.php');

controller::initConfiguration($config);
$request = new Request($_GET, $_POST, $_SERVER);
$controller = new controller($request);
$controller->run();