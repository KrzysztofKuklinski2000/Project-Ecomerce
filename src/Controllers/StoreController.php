<?php
declare(strict_types=1);
namespace App\Controllers;

use App\Views\view;
use App\Request;
use App\Models\Model;
use App\Models\UserModel;

class StoreController extends AbstractController {
    
    public function startAction(): void {
        $this->view->renderView(['page' => 'start']);
    }

    public function productsAction():void {
        if($this->request->isPost()) {
            $this->AddProductToCart();
        }

        $category = $this->request->get('category');
        $this->view->renderView([
            'page' => 'products', 
            'content' => $this->model->GetProducts($category)
        ]);
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

        $this->view->renderView([
            'page' => 'product_details', 
            'content' => $this->model->GetProductDetails($id)
        ]);
    }
    public function shopping_cartAction(): void {
        if(empty($this->request->session('user'))) header("Location:/?page=start");
        $userId = $this->request->session('user')['id'];
        if($this->request->isPost()) {
            $cartId = (int) $this->request->post("cartId");
            $this->userModel->DeleteProductFromCart($cartId);
        }

        $content = $this->userModel->GetUserCart($userId);
        $total_amount = $this->GetTotalAmount($content);

        $this->view->renderView(['page' => 'shopping_cart', 'content' => $content, 'total_amount' => $total_amount]);
    }

    public function GetTotalAmount(array $content): float {
        if(empty($this->request->session('user'))) header("Location: /?page=start");
        $total_amount = 0;
        foreach($content as $el) {
            $total_amount += $el['total_amount'];
        }
        return $total_amount;
    }

    public function AddProductToCart(int $quantity = 1) {
            if(empty($this->request->session('user'))) header("Location: /?page=products");
            $productId = $this->request->post("product_id");
            if($quantity == 0) $quantity = 1; 
            $data = [
                'userId' => $this->request->session('user')['id'],
                'productId' => $productId,
                'quantity' => $quantity
            ];
            $this->userModel->AddProductToCart($data);
    }

    public function orderAction():void{
        if(empty($this->request->session('user'))) header("Location: /?page=start");
        $userId = $this->request->session('user')['id'];

        $orderProducts = $this->userModel->GetUserCart($userId);
        $total_amount = $this->GetTotalAmount($orderProducts);
        
        if($this->request->isPost()) {
            $data = [
                "city" => $this->request->post("city"),
                "street" => $this->request->post("street"),
                "postal_code" => $this->request->post("postal_code"),
                "building_number" => $this->request->post("building_number"),
                'firstname' => $this->request->post("firstname"),
                'lastname' => $this->request->post("lastname"),
                'userId' => $userId
            ];

            $addressId = $this->userModel->AddAddress($data);

            $orderId = (int) $this->userModel->CreateOrder([
                "total_amount" => $total_amount,
                "addressId" => $addressId,
                "userId" => $userId
            ]);
            
            $this->userModel->AddProductsToOrder($orderProducts, $orderId);
            $this->StripeAction($orderId, $orderProducts);
        }

        $this->view->renderView([
            'page' => 'order', 
            'content' => $orderProducts, 
            'total_amount' => $total_amount]
        );
    }
    
    public function StripeAction(int $orderId, array $orderProducts): void {
        if(empty($this->request->session('user'))) header("Location: /?page=start");
        
        $StripsProductList = [];
        foreach($orderProducts as $orderProduct) {
            array_push($StripsProductList ,
            ["quantity" => (int) $orderProduct['quantity'], 
            "price_data"=>["currency"=>"pln", 
            "unit_amount" => (int) $orderProduct['productPrice'] * 100, 
            "product_data" => ["name" => $orderProduct['productName']
            ]]]);
        }

        $checkout_session = \Stripe\Checkout\Session::create([
            "mode" => "payment",
            "success_url" => "http://localhost/?page=success&orderId=$orderId&session_id={CHECKOUT_SESSION_ID}",
            "cancel_url" => "http://localhost/?page=fail&orderId=$orderId&session_id={CHECKOUT_SESSION_ID}",
            "locale" => "pl",
            "line_items" => [
                $StripsProductList
            ]
        ]);


        http_response_code(303);
        header("Location: " . $checkout_session->url);
    }

    public function successAction(): void {
        if(empty($this->request->session('user'))) header("Location: /?page=start");

        $sessionId = $this->request->get("session_id");
        $session = \Stripe\Checkout\Session::retrieve($sessionId);
        
        if($session->payment_status === 'paid'){
            $orderId = (int) $this->request->get('orderId');
            $this->userModel->updatePaymentStatus($orderId, "completed");
            
            $this->view->renderView(['page' => 'start'], ["messageTop" => "Twoje zamówienie zostało opłacone"]);
        }      
    }

    public function failAction(): void {
        if(empty($this->request->session('user'))) header("Location: /?page=start");
        $sessionId = $this->request->get("session_id");
        $session = \Stripe\Checkout\Session::retrieve($sessionId);

        if($session->payment_status !== 'paid'){
            $orderId = (int) $this->request->get('orderId');
            $this->userModel->updatePaymentStatus($orderId, "cancelled");
            $this->view->renderView(['page' => 'start'], ["messageTop" => "Transakcja nie powiodła się"]);
        }
    }
}