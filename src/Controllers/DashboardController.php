<?php
declare(strict_types=1);
namespace App\Controllers;

class DashboardController extends AbstractDashboardController{
    public function startAction(): void {
        $this->dashboardView->renderView([
            'page' => 'start/index.php',
        ]);
    }
}