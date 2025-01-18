<?php
declare(strict_types=1);
namespace App\Controllers;

use App\Views\view;
use App\Request;
use App\Models\StoreModel;
use App\Models\UserModel;
use App\Validator;

class UserController extends AbstractController {

    private function checkValidation(array $data): bool{
        return empty($this->validator->username($data['username'])) && empty($this->validator->email($data['email'])) && empty($this->validator->checkPassword($data['password'])) && empty($this->validator->confirmPassword($data['password'], $data['confirm_password'])) && empty($this->validator->userExist($data['numberOfUsers']));
    }

    //Login
    public function sign_inAction():void {
        $error = [];
        if($this->request->hasPost()) {
            $email = $this->request->post('email');
            $password = $this->request->post('password');
            if($this->userModel->getByEmail($email) !== 0) {
                $user = $this->userModel->getUser($email);
                if(password_verify($password, $user['password'])) {
                    $_SESSION['user'] = $user;
                    header("Location: /?page=start");
                }else {
                    $error['loginError'] = "Nie poprawne hasło";
                }

            }else $error['loginError'] = "Nie poprawny E-mail";
        }
        $this->view->renderView(['page' => 'sign_in'], $error);
    }
    //Register
    public function sign_upAction(): void {
        if($this->request->hasPost()) {
            $password = $this->request->post('password');
            $data = [
                'username' => $this->request->post('username'),
                'email' => $this->request->post('email'),
                'password' => $password,
                'confirm_password' => $this->request->post('confirm_password'),
                'numberOfUsers' => $this->userModel->getByEmail($this->request->post('email'))
            ];                
            
            if($this->checkValidation($data)) {
                $data['password']  = password_hash($password, PASSWORD_DEFAULT);
                $this->userModel->create($data);
                $this->view->renderView(['page' => 'sign_in']);
            }else {
                $this->view->renderView(
                    ['page' => 'sign_up'], 
                    [
                        'username' => $this->validator->username($data['username']),
                        'email' => $this->validator->email($data['email']),
                        'password' => $this->validator->checkPassword($password),
                        'confirm_password' => $this->validator->confirmPassword($password, $data['confirm_password']),
                        'userExist' => $this->validator->userExist($data['numberOfUsers'])
                    ]
                );
            }
        }

        $this->view->renderView(['page' => 'sign_up']);
    }

    public function logoutAction(): void {
        session_destroy();
        header("Location: /?page=start");
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

        $this->view->renderView(['page' => 'order', 'content' => $orderProducts, 'total_amount' => $total_amount]);
    }
    
    public function StripeAction(int $orderId, array $orderProducts): void {
        $strips_secret_key = "sk_test_51Qhz5PKjqg8M9H3wK1yIiYjeDm8STwKh4UobgAehvS1GACXNRTGiPvm2eeWXm1JTbr4hXiXaUi5m03D9WWkKE5jM00CtyXdIVp";
        \Stripe\Stripe::setApiKey($strips_secret_key);
        
        $StripsProductList = [];
        foreach($orderProducts as $orderProduct) {
            array_push($StripsProductList ,["quantity" => (int) $orderProduct['quantity'], "price_data"=>["currency"=>"pln", "unit_amount" => (int) $orderProduct['productPrice'] * 100, "product_data" => ["name" => $orderProduct['productName']]]]);
        }

        $checkout_session = \Stripe\Checkout\Session::create([
            "mode" => "payment",
            "success_url" => "http://localhost/?page=success&orderId=$orderId",
            "cancel_url" => "http://localhost/?page=fail&orderId=$orderId",
            "locale" => "pl",
            "line_items" => [
                $StripsProductList
            ]
        ]);


        http_response_code(303);
        header("Location: " . $checkout_session->url);
    }

    public function successAction(): void {
        $orderId = (int) $this->request->get('orderId');
        $this->userModel->updatePaymentStatus($orderId, "completed");
        $this->view->renderView(['page' => 'success']);
    }

    public function failAction(): void {
        $orderId = (int) $this->request->get('orderId');
        $this->userModel->updatePaymentStatus($orderId, "cancelled");
        $this->view->renderView(['page' => 'fail']);
    }
}   