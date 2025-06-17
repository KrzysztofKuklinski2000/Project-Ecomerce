<?php 
declare(strict_types=1);
namespace App\Views;

use App\Models\DashboardModel;

class DashboardView{
    private DashboardModel $dashboardModel;

    public function __construct(DashboardModel $dashboardModel) {
        $this->dashboardModel = $dashboardModel;

    }
    function renderView(array $params, array $message = null) {
        $numberOfUsers = $this->dashboardModel->countElements('users');
        $numberOfProducts = $this->dashboardModel->countElements('products');
        $numberOfOrders = $this->dashboardModel->countElements('orders');
        
        require_once("resources/templates/dashboard/layout.php");
    }
}