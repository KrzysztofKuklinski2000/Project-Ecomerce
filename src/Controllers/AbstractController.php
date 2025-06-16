<?php
declare(strict_types=1);
namespace App\Controllers;

use App\Views\view;
use App\Request;
use App\Models\StoreModel;
use App\Models\UserModel;
use Exception;
use App\Validator;

abstract class AbstractController extends AbstractBaseController {
    public view $view;
    public StoreModel $model;
    public UserModel $userModel;
    public Validator $validator;

    public function __construct(Request $request) {
        parent::__construct($request);

        if(empty(self::$configuration['db'])){
            throw new Exception("Błąd Konfiguracji");
        }
        
        $this->model = new StoreModel(self::$configuration['db']);
        $this->userModel = new UserModel(self::$configuration['db']);
        $this->view = new view();
        $this->validator = new Validator();
    }
}