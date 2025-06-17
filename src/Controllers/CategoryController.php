<?php 
declare(strict_types=1);
namespace App\Controllers;
use App\Request;
use Exception;

class CategoryController extends AbstractDashboardController {
    public function startAction():void {
        $this->dashboardView->renderView([
            "page" => "category/index.php",
            "data" => $this->dashboardModel->getData("categories"),
        ]);
    }

    public function createAction(): void {
        $this->dashboardView->renderView([
            "page" => "category/create.php",
        ]);
    }

    public function storeAction():void {
        if($this->request->isPost()){
            $this->dashboardModel->createCategory($this->request->post['name']);
            header("Location: /?module=category");
        }
    }

    public function deleteAction(): void {
        $id = (int) $this->request->get("id");
        $hasProducts = $this->dashboardModel->hasProductsInCategory($id);
        $message = "";

        if($hasProducts) {
            $message = "Istnieją produkty z taką kategorią!!!";
        }

        if($this->request->isPost()){ 
            $id = (int) $this->request->post('id');
            $hasProducts = $this->dashboardModel->hasProductsInCategory($id);
            
            if(!$hasProducts) {
                $this->dashboardModel->deleteCategory($id);
                header("Location: /?module=category");
                exit;
            }else {
                throw new Exception("Kategoria ma produkty");
            }
        }

        $this->dashboardView->renderView([
            "page" => "category/delete.php",
            "category" =>  $this->dashboardModel->getSingleElement("categories", $id),
            "message" => $message,
        ]);
    }
}