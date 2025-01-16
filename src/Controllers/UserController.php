<?php
declare(strict_types=1);
namespace App\Controllers;

use App\Views\view;
use App\Request;
use App\Models\Model;
use App\Models\UserModel;

class UserController extends AbstractController {
    //Login
    public function sign_inAction():void {
        $this->view->renderView(['page' => 'sign_in']);
    }
    //Register
    public function sign_upAction(): void {
        if($this->request->isPost()) {
            $data = [
                'userName' => $this->request->post('user_name'),
                'email' => $this->request->post('email'),
                'password' => password_hash($this->request->post('password'), PASSWORD_DEFAULT)
            ];

            $this->userModel->create($data);
            
        }

        $this->view->renderView(['page' => 'sign_up']);
    }
}