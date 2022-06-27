<?php

namespace App\classes;

use App\classes\model\ArticleModel;

class ArticleClass extends ControllerClass {

    protected $table = "articles";
    protected $viewDirectory = 'article';
    protected $model;
    protected $uploadFolder = 'upload/article';
    protected $uploadParameter = 'path';
    protected $uploadColumnName = 'path';
    protected $allowedFileType = [
        'application/pdf'
    ];
    protected $allowedFileExtension = [
        'pdf'
    ];

    function __construct()
    {
        parent::__construct();

        $this->model = new ArticleModel();
    }

    public function create()
    {
        $subCategoriesClass = new SubCategoryClass();
        $subCategories = $subCategoriesClass->getAllFromTable();

        parent::create();
    }

}