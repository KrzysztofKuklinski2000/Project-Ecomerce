<?php 
declare(strict_types=1);
namespace App\Views;

class view {
    function renderView(string $page) {
        require_once("resources/templates/layout.php");
    }
}