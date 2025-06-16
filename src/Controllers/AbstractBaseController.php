<?php 
declare(strict_types=1);
namespace App\Controllers;
use App\Request;
use Exception;

abstract class AbstractBaseController {
    protected const DEFAULT_PAGE = 'start';
    public Request $request;
    protected static array $configuration = [];

    public function __construct(Request $request) {
        $this->request = $request;
    }

    public static function initConfiguration(array $configuration) {
        self::$configuration = $configuration;
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
        // $this->view->renderView(['page' => 'start']);
        echo "Strona startowa";
    }
}