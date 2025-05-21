<?php 
declare(strict_types=1);
namespace App\Controllers;

class OrderController extends AbstractDashboardController {
    public function startAction(): void {
        $this->dashboardView->renderView([
            'page' => 'orders/index.php',
            'data' => $this->dashboardModel->getData("orders"),
        ]);
    }

    public function showAction(): void {
        $id = (int) $this->request->get('id');
        $this->dashboardView->renderView([
            'page' => 'orders/show.php',
            'data' => $this->dashboardModel->getOrder($id),
        ]);
    }
}