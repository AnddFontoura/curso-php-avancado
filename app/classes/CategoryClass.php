<?php

namespace App\classes;

use App\classes\model\CategoryModel;
use PDO;

class CategoryClass extends ControllerClass {
    protected $table = "categories";
    protected $viewDirectory = 'category';
    protected $model;
    protected $uploadFolder = 'upload/category';
    protected $uploadParameter = 'image';
    protected $uploadColumnName = 'image';
    protected $allowedFileType = [
        'image/jpeg',
        'image/png',
        'image/bmp',
    ];
    protected $allowedFileExtension = [
        'jpg',
        'png',
        'jpeg',
        'bmp',
    ];

    function __construct()
    {
        parent::__construct();

        $this->model = new CategoryModel();
    }

    /***
     * Levantar requisitos para 
     * portar essa classe de delete para 
     * outras (abstrair o conceito)
     */
}