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
        if($this->request->isPost()) {
            $this->AddProductToCart();
        }

        $category = $this->request->get('category');
        $this->view->renderView(['page' => 'products', 'content' => $this->model->GetProducts($category)]);
    }
    
    public function product_detailsAction(): void {
        $id = (int) $this->request->get('id');
        if(!$id) {
            $this->startAction();
        }

        if($this->request->isPost()) {
            $quantity = (int) $this->request->post("quantity");
            $this->AddProductToCart($quantity);
        }

        $this->view->renderView(['page' => 'product_details', 'content' => $this->model->GetProductDetails($id)]);
    }

    public function shopping_cartAction(): void {
        $userId = 1;
        if($this->request->isPost()) {
            $cartId = (int) $this->request->post("cartId");
            $this->model->DeleteProductFromCart($cartId);
        }

        $content = $this->model->GetUserCart($userId);
        $total_amount = $this->GetTotalAmount($content);

        $this->view->renderView(['page' => 'shopping_cart', 'content' => $content, 'total_amount' => $total_amount]);
    }

    public function sign_inAction():void {
        $this->view->renderView(['page' => 'sign_in']);
    }

    public function sign_upAction(): void {
        $this->view->renderView(['page' => 'sign_up']);
    }

    public function GetTotalAmount(array $content): float {
        $total_amount = 0;
        foreach($content as $el) {
            $total_amount += $el['total_amount'];
        }
        return $total_amount;
    }

    public function AddProductToCart(int $quantity = 1) {
            $productId = $this->request->post("product_id");
            if($quantity == 0) $quantity = 1; 
            $data = [
                'userId' => 1, 
                'productId' => $productId,
                'quantity' => $quantity
            ];
            $this->model->AddProductToCart($data);
    }
}