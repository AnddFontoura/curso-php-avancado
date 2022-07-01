<?php

namespace App\classes;

use App\classes\model\SubCategoryModel;

class SubCategoryClass extends ControllerClass {
    protected $table = 'sub_categories';
    protected $viewDirectory = 'subcategory';
    protected $model;
    protected $uploadFolder = 'upload/subcategory';
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

        $this->model = new SubCategoryModel();
    }

}