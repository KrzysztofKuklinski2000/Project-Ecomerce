<?php 
declare(strict_types=1);
namespace App\Controllers;


class OrderController extends AbstractDashboardController {
    public function startAction(): void {
        $this->dashboardView->renderView([
            'page' => 'orders/index.php',
            'data' => $this->dashboardModel->getData("orders"),
        ]);
    }

    public function showAction(): void {
        $id = (int) $this->request->get('id');
        $this->dashboardView->renderView([
            'page' => 'orders/show.php',
            'data' => $this->dashboardModel->getOrder($id),
        ]);
    }

    public function editAction(): void {
        $id = (int) $this->request->get('id');
        $this->dashboardView->renderView([
            'page' => 'orders/edit.php',
            'data' => $this->dashboardModel->getOrder($id),
        ]);
    }

    public function updateAction(): void {
        if($this->request->isPost()) {
            $this->dashboardModel->updateOrder( $this->takeDataToUpadteOrder());
            header('location: /?module=order');
        }
    }

    public function deleteAction():void {
        $id = (int) $this->request->get('id');

        if($this->request->isPost()) {
            $id = (int) $this->request->post('id');
            $this->dashboardModel->deleteOrder($id);
            header("location: /?module=order");
            exit;
        }

        $this->dashboardView->renderView([
            'page' => "orders/delete.php",
            'data' => $this->dashboardModel->getOrder($id),
        ]);
    }

    public function deleteProductFromOrderAction():void {
        $orderProductId = (int) $this->request->get('orderProduct');
        $this->dashboardModel->deleteProductFromOrder($orderProductId);
        header("Location: /?module=order");
    }

    private function takeDataToUpadteOrder(): array {
        return [
            'order' => [
                'id' => $this->request->post['id'],
                'status' => $this->request->post['status'],
                'payment_status' => $this->request->post['payment_status'],
            ],
            'address' => [
                'id' => $this->request->post['addressId'],
                'firstname' => $this->request->post['firstname'],
                'lastname' => $this->request->post['lastname'],
                'street' => $this->request->post['street'],
                'city' => $this->request->post['city'],
                'building_number' => $this->request->post['building_number'],
                'postal_code' => $this->request->post['postal_code'],
            ],
            'order_items' => [
                'quantity' => $this->request->post['quantity']
            ]
        ];
    }
}