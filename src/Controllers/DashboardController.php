<?php
declare(strict_types=1);
namespace App\Controllers;

class DashboardController extends AbstractDashboardController{
    public function startAction(): void {
        $this->dashboardView->renderView([
            'page' => 'start',
        ]);
    }
    
    public function usersAction(): void {
        
        $this->dashboardView->renderView([
            'page' => 'users',
            'data' => $this->dashboardModel->getData("users"),
        ]);
    }

    // public function productsAction(): void {
    //     $this->dashboardView->renderView([
    //         'page' => 'products',
    //         'data' => $this->dashboardModel->getData("products"),

    //     ]);
    // }

    public function ordersAction(): void {
        $this->dashboardView->renderView([
            'page' => 'orders',
            'data' => $this->dashboardModel->getData("orders"),
        ]);
    }

    public function addressAction(): void {
        $this->dashboardView->renderView([
            'page' => 'address',
            'data' => $this->dashboardModel->getData("adress"),
        ]);
    }

    public function shoppingCartAction(): void {
        $this->dashboardView->renderView([
            'page' => 'shopping_cart',
            'data' => $this->dashboardModel->getData("cart"),
        ]);
    }

    public function categoryAction(): void {
        $this->dashboardView->renderView([
            'page' => 'category',
            'data' => $this->dashboardModel->getData("categories"),
        ]);
    }
}