<?php 
declare(strict_types=1);
namespace App\Views;

class view {
    function renderView(array $params, array $message = null) {
        require_once("resources/templates/layout.php");
    }
}