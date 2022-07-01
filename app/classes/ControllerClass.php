<?php

namespace App\classes;

use Exception;

class ControllerClass extends Connection {
    protected $table;
    protected $viewDirectory;
    protected $model;
    protected $uploadFolder;
    protected $uploadParameter;
    protected $uploadColumnName;
    protected $allowedFileType;
    protected $allowedFileExtension;

    /**
     * @var array
     */
    protected $parametersForDelete;

    public function list() {
        $params = $this->model->setParams();

        $listResults = $this->getAllFromTable($params);
        
        require_once("view/{$this->viewDirectory}/list.php");
    }

    public function save()
    {
        $params = $this->model->setPostParams();

        if(isset($_FILES[$this->uploadParameter]) && $_FILES[$this->uploadParameter] !== null) {
            $params[$this->uploadColumnName] = $this->uploadArquivo($_FILES[$this->uploadParameter]);
        }
        
        $this->insertOnTable($params);
        header("Location: ../{$this->viewDirectory}/list");
    }
    
    public function create()
    {
        require_once("view/{$this->viewDirectory}/form.php");
    }

    public function delete()
    {
        if (!isset($_POST['id'])) {
            $return = [
                'message' => 'Informação enviada não está de acordo com o esperado. Requisição POST'
            ];

            header('Content-Type: application/json');
            header ('HTTP/1.1 405 Method Not Allowed');
            echo json_encode($return);
            die();
        }

        $dataForDelete = $_POST['id'] ?? 0;
        $params = [
            'id' => $dataForDelete
        ];

        $result = $this->getFromTable($params);

        if (!is_null($result)) {
            $resultDelete = $this->deleteOnTable($params);
            $resultDelete ? $return = ['message' => 'Registro Deletado'] : $return = ['message' => 'Nenhum registro deletado'];
            
            echo json_encode($return);
            die();
        }

        echo json_encode(['message' => 'Dado já foi deletado anteriormente']);
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