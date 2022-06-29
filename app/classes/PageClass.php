<?php

namespace App\classes;

class PageClass extends ControllerClass {
    protected $table = 'pages';
    protected $viewDirectory = 'page';
    protected $model = 'page';
    protected $uploadFolder;
    protected $uploadParameter;
    protected $uploadColumnName;
    protected $allowedFileType;
    protected $allowedFileExtension;
}