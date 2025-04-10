<?php
declare(strict_types=1);
namespace App\Controllers;

use App\Request;
use App\Views\DashboardView;

class DashboardController extends AbstractController{
    public DashboardView $dashboardView;

    public function __construct(Request $request) {
        parent::__construct($request);
        $this->dashboardView = new DashboardView();
    }
    public function startAction() {
        $this->dashboardView->renderView([
            'page' => 'dashboard/start',
        ]);
    }
    public function ordersAction() {
        $this->dashboardView->renderView([
            'page' => 'dashboard/orders',
        ]);
    }
}