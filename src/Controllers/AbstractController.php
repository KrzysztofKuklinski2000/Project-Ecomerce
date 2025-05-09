<?php
declare(strict_types=1);
namespace App\Controllers;

use App\Views\view;
use App\Request;
use App\Models\StoreModel;
use App\Models\UserModel;
use Exception;
use App\Validator;

abstract class AbstractController {
    protected const DEFAULT_PAGE = 'start';
    public view $view;
    public Request $request;
    public StoreModel $model;
    public UserModel $userModel;
    public Validator $validator;
    protected static array $configuration = [];

    public static function initConfiguration(array $configuration) {
        self::$configuration = $configuration;
    }

    public function __construct(Request $request) {
        if(empty(self::$configuration['db'])){
            throw new Exception("Błąd Konfiguracji");
        }
        
        $this->model = new StoreModel(self::$configuration['db']);
        $this->userModel = new UserModel(self::$configuration['db']);
        $this->view = new view();
        $this->request = $request;
        $this->validator = new Validator();
    }

    public function run(): void {
        try {
            $page = $this->page()."Action";
            if(!method_exists($this, $page)){
                $page = self::DEFAULT_PAGE."Action";
            }
            $this->$page();
       }catch(Exception $e) {
            // $this->startAction();
            echo $e->getMessage();
       }
    }
    
    public function page(): string {
        return $this->request->get('page', self::DEFAULT_PAGE);
    }

    public function startAction():void {
        $this->view->renderView(['page' => 'start']);
    }
}