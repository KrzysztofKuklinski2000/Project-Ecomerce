<?php
declare(strict_types=1);
namespace App\Controllers;

use App\Views\DashboardView;
use App\Models\DashboardModel;
use App\Request;
use Exception;

abstract class AbstractDashboardController extends AbstractBaseController {
    public DashboardView $dashboardView;
    public DashboardModel $dashboardModel;

    public function __construct(Request $request) {
        parent::__construct($request);
        if(empty(self::$configuration['db'])){
            throw new Exception("Błąd Konfiguracji");
        }
        
        $this->dashboardView = new DashboardView();
        $this->dashboardModel = new DashboardModel(self::$configuration['db']);
    }
}