<?php
declare(strict_types=1);
namespace App\Controllers;

class DashboardController extends AbstractController{
    public function dashboardAction() {
        $this->view->renderView([
            'page' => 'dashboard/start',
        ]);
    }
}