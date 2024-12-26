<?php
declare(strict_types=1);
namespace App\Controllers;

use App\Models\model;
use App\Views\view;
use App\Request;

class controller {
    protected const DEFAULT_PAGE = 'start';
    public view $view;
    public Request $request;

    public function __construct(Request $request) {
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
        $this->view->renderView('start');
    }

    public function productsAction():void {
        $this->view->renderView('products');
    }
    
    public function product_detailsAction(): void {
        $this->view->renderView('product_details');
    }

    public function shopping_cardAction(): void {
        $this->view->renderView('shopping_card');
    }

    public function sign_inAction():void {
        $this->view->renderView('sign_in');
    }

    public function sign_upAction(): void {
        $this->view->renderView('sign_up');
    }
}