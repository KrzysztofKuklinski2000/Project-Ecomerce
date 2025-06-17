<?php
declare(strict_types=1);
namespace App\Controllers;

class UserDashboardController extends AbstractDashboardController {
    public function startAction(): void {
        $this->dashboardView->renderView([
            "page" => "users/index.php",
            "data" => $this->dashboardModel->getData("users"),
        ]);
    }

    public function showAction():void {
        $userId = (int) $this->request->get("id");

        $this->dashboardView->renderView([
            "page" => "users/show.php",
            "data" => $this->dashboardModel->getUserOrders($userId),
            "user" => $this->dashboardModel->getSingleElement("users", $userId),
        ]);
    }
}