<?php
declare(strict_types=1);
require __DIR__ . '/vendor/autoload.php';

use App\Controllers\controller;

// Uruchomienie kontrolera
$controller = new controller();
$controller->run();