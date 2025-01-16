<?php
declare(strict_types=1);
namespace App\Controllers;

use App\Views\view;
use App\Request;
use App\Models\Model;
use App\Models\UserModel;

class StoreController extends UserController {
    
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
}