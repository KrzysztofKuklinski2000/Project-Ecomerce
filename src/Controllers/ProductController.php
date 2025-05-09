<?php
declare(strict_types=1);
namespace App\Controllers;

class ProductController extends AbstractDashboardController {
    public function startAction():void {
        $this->dashboardView->renderView([
            'page' => 'products/index.php',
            'data' => $this->dashboardModel->getData("products"),
        ]);
    }

    public function createAction():void {
        $this->dashboardView->renderView([
            'page' => 'products/create.php',
            'categories' => $this->dashboardModel->getData('categories'),
        ]);
    }

    public function storeAction():void {
        if($this->request->isPost()) {
            $data = $this->takeProductData();
            $this->dashboardModel->createProduct($data);
            header('location: /?module=product');
        }else {
            header('location: /?module=product');
        }
    }

    public function editAction():void {
        $id = (int) $this->request->get('id');
        $this->dashboardView->renderView([
            'page' => 'products/edit.php',
            'product' => $this->dashboardModel->getSingleElement('products', $id),
            'categories' => $this->dashboardModel->getData('categories'),
        ]);
    }

    public function updateAction():void {
        if($this->request->isPost()) {
            $data = $this->takeProductData();
            $this->dashboardModel->updateProduct($data);
            header('location: /?module=product');
        }else {
            header('location: /?module=product');
        }
    }

    public function showAction(): void {
        $id = (int) $this->request->get('id');
        $this->dashboardView->renderView([
            'page' => 'products/show.php',
            'product' => $this->dashboardModel->getSingleElement('products', $id),
            'categories' => $this->dashboardModel->getData('categories'),
        ]);
    }

    private function takeProductData(): array {
        return [
            'id' => $this->request->post('id') ?? null,
            'name' => $this->request->post('name'),
            'description' => $this->request->post('description'),
            'size' => $this->request->post('size'),
            'price' => $this->request->post('price'),
            'stock' => $this->request->post('stock'),
            'category' => $this->request->post('category'),
            'image' => $this->request->post('image'),
        ];
    }
}