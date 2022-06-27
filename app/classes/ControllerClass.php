<?php

namespace App\classes;

class ControllerClass extends Connection {
    protected $table;
    protected $viewDirectory;
    protected $model;
    protected $uploadFolder;
    protected $uploadParameter;
    protected $uploadColumnName;
    protected $allowedFileType;
    protected $allowedFileExtension;

    public function list() {
        $params = $this->model->setParams();

        $listResults = $this->getAllFromTable($params);
        
        include("view/{$this->viewDirectory}/list.php");
    }

    public function save()
    {
        $params = $this->model->setPostParams();
        $params[$this->uploadColumnName] = $this->uploadArquivo($_FILES[$this->uploadParameter]);
        $this->insertOnTable($params);
        $this->list();
    }
    
    public function create()
    {
        require_once("view/{$this->viewDirectory}/form.php");
    }

    protected function uploadArquivo(array $uploadedFile) {
        $fileName = '';

        if(isset($_FILES[$this->uploadParameter]) && !is_null($_FILES[$this->uploadParameter])) {
            $uploadedFile = $_FILES[$this->uploadParameter];

            $fileExplodedName = explode('.',$uploadedFile['name']);
            $fileExtension = $fileExplodedName[count($fileExplodedName) - 1];
            
            $allowedExtension = in_array($fileExtension, $this->allowedFileExtension);
            $allowedType = in_array($uploadedFile['type'], $this->allowedFileType);
            
            if($allowedExtension && $allowedType) {
                if(!is_dir($this->uploadFolder)) {
                    mkdir($this->uploadFolder, 0444, true);
                }

                do {
                    $fileName = date('U').'_'. md5($uploadedFile['name']). '.' . $fileExtension;
                } while(file_exists($this->uploadFolder . $fileName));

                move_uploaded_file($uploadedFile['tmp_name'], $this->uploadFolder . '/' . $fileName);
            }
        } 
        
        return $fileName;
    }
}