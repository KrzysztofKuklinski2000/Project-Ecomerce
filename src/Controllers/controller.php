<?php
declare(strict_types=1);
namespace App\Controllers;

use App\Models\model;
use App\Views\view;

class controller {
    public view $view;
    public function __construct() {
        $this->view = new view();
    }

    public function run(): void {
        $this->view->renderView();
    }
}