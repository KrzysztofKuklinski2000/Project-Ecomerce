<?php
declare(strict_types=1);
namespace App\Controllers;

use App\Views\view;
use App\Request;
use App\Models\Model;
use Exception;

class controller {
    protected const DEFAULT_PAGE = 'start';
    public view $view;
    public Request $request;
    public Model $model;
    private static array $configuration = [];

    public static function initConfiguration(array $configuration) {
        self::$configuration = $configuration;
    }

    public function __construct(Request $request) {
        if(empty(self::$configuration['db'])){
            throw new Exception("Błąd Konfiguracji");
        }
        $this->model = new Model(self::$configuration['db']);
        $this->view = new view();
        $this->request = $request;
    }

    public function run(): void {
        $page = $this->page()."Action";
        if(!method_exists($this, $page)){
            $page = self::DEFAULT_PAGE."Action";
        }
        $this->$page();
    }

    public function page(): string {
        return $this->request->get('page', self::DEFAULT_PAGE);
    }
    public function startAction(): void {
        $this->view->renderView(['page' => 'start']);
    }

    public function productsAction():void {
        $this->view->renderView(['page' => 'products', 'content' => $this->model->GetProducts()]);
    }
    
    public function product_detailsAction(): void {
        $this->view->renderView(['page' => 'product_details']);
    }

    public function shopping_cardAction(): void {
        $this->view->renderView(['page' => 'shopping_card']);
    }

    public function sign_inAction():void {
        $this->view->renderView(['page' => 'sign_in']);
    }

    public function sign_upAction(): void {
        $this->view->renderView(['page' => 'sign_up']);
    }
}