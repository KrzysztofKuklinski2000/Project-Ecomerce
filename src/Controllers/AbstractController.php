<?php
declare(strict_types=1);
namespace App\Controllers;

use App\Views\view;
use App\Request;
use App\Models\Model;
use App\Models\UserModel;
use Exception;

abstract class AbstractController {
    protected const DEFAULT_PAGE = 'start';
    public view $view;
    public Request $request;
    public Model $model;
    public UserModel $userModel;
    private static array $configuration = [];

    public static function initConfiguration(array $configuration) {
        self::$configuration = $configuration;
    }

    public function __construct(Request $request) {
        if(empty(self::$configuration['db'])){
            throw new Exception("Błąd Konfiguracji");
        }
        
        $this->model = new Model(self::$configuration['db']);
        $this->userModel = new UserModel(self::$configuration['db']);
        $this->view = new view();
        $this->request = $request;
    }

    public function run(): void {
        try {
            $page = $this->page()."Action";
            if(!method_exists($this, $page)){
                $page = self::DEFAULT_PAGE."Action";
            }
            $this->$page();
       }catch(Exception $e) {
            $this->startAction();
       }
    }
}