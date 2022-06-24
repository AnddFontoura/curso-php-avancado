<?php

namespace App\classes;

class ControllerClass extends Connection {
    protected $model;
    protected $viewDirectory;

    public function list() {
        $params = $this->model->setParams();

        $listResults = $this->getAllFromTable($params);
        
        include("view/{$this->viewDirectory}/list.php");
    }
}