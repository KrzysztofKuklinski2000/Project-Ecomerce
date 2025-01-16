<?php
declare(strict_types=1);
namespace App\Controllers;

use App\Views\view;
use App\Request;
use App\Models\Model;
use App\Models\UserModel;
use App\Validator;

class UserController extends AbstractController {

    private function checkValidation(array $data): bool{
        return empty($this->validator->username($data['username'])) && empty($this->validator->email($data['email'])) && empty($this->validator->checkPassword($data['password'])) && empty($this->validator->confirmPassword($data['password'], $data['confirm_password'])) && empty($this->validator->userExist($data['numberOfUsers']));
    }

    //Login
    public function sign_inAction():void {
        
 
        $this->view->renderView(['page' => 'sign_in']);
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


    
}