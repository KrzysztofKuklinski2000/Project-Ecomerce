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
        if(!empty($this->request->session('user'))) header("Location:/?page=start");
        $error = [];
        if($this->request->hasPost()) {
            $email = $this->request->post('email');
            $password = $this->request->post('password');
            if($this->userModel->getByEmail($email) !== 0) {
                $user = $this->userModel->getUser($email);
                if(password_verify($password, $user['password'])) {
                    $_SESSION['user'] = $user;
                    $this->view->renderView(['page' => 'start'],
                     ["messageTop" => "Udało się zalogować"]);
                }else {
                    $error['loginError'] = "Nie poprawne hasło";
                }

            }else $error['loginError'] = "Nie poprawny E-mail";
        }
        $this->view->renderView(['page' => 'sign_in'], $error);
    }
    //Register
    public function sign_upAction(): void {
        if(!empty($this->request->session('user'))) header("Location:/?page=start");
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
                $this->view->renderView(['page' => 'sign_in'],
                 ['messageTop' => "Udało się załozyć konto !!!"]);
            }else {
                $this->view->renderView(
                    ['page' => 'sign_up'], 
                    [
                        'username' => $this->validator->username($data['username']),
                        'email' => $this->validator->email($data['email']),
                        'password' => $this->validator->checkPassword($password),
                        'confirm_password' => $this->validator->confirmPassword($password, 
                        $data['confirm_password']),
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
}   