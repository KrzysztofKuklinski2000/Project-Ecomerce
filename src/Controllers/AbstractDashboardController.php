<?php
declare(strict_types=1);
namespace App\Controllers;

use App\Views\DashboardView;
use App\Request;
use App\Models\DashboardModel;
use Exception;

abstract class AbstractDashboardController extends AbstractController {
    public Request $request;
    public DashboardView $dashboardView;
    public DashboardModel $dashboardModel;

    public function __construct(Request $request) {
        if(empty(self::$configuration['db'])){
            throw new Exception("Błąd Konfiguracji");
        }
        
        $this->dashboardView = new DashboardView();
        $this->request = $request;
        $this->dashboardModel = new DashboardModel(self::$configuration['db']);
    }
}