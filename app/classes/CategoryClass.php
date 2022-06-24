<?php

namespace App\classes;

use App\classes\model\CategoryModel;

class CategoryClass extends ControllerClass {
    protected $table = "categories";
    protected $viewDirectory = 'category';
    protected $model;

    function __construct()
    {
        parent::__construct();

        $this->model = new CategoryModel();
    }
}