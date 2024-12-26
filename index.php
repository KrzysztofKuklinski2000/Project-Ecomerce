<?php
declare(strict_types=1);
require __DIR__ . '/vendor/autoload.php';

use App\Controllers\controller;
use App\Request;

// Uruchomienie kontrolera
$request = new Request($_GET);
$controller = new controller($request);
$controller->run();