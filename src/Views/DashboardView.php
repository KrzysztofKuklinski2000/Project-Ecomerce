<?php 
declare(strict_types=1);
namespace App\Views;

class DashboardView{
    function renderView(array $params, array $message = null) {
        require_once("resources/templates/dashboard/layout.php");
    }
}