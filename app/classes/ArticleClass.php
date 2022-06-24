<?php

namespace App\classes;

use App\classes\Connection;
use App\classes\model\ArticleModel;
use PDO;

class ArticleClass extends Connection {

    protected $table = "articles";
    protected $viewDirectory = 'article';
    protected $model;

    function __construct()
    {
        parent::__construct();

        $this->model = new ArticleModel();
    }
}