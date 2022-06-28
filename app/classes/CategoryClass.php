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

        $idCategory = $_POST['id'] ?? 0;

        $query = $this->dbConnection->prepare("
            SELECT
                *
            FROM
                categories
            WHERE
                id = :idCategory        
        ");
        $query->bindParam(':idCategory', $idCategory);
        $query->execute();
        $resultSelect = $query->fetch(PDO::FETCH_ASSOC);
        
        if (!is_null($resultSelect)) {
            $query = $this->dbConnection->prepare("
                DELETE FROM 
                    categories
                WHERE
                    id = :idCategory
            ");
            $query->bindParam(':idCategory', $idCategory);
            $resultDelete = $query->execute();

            $resultDelete ? $return = ['message' => 'Registro Deletado'] : $return = ['message' => 'Nenhum registro deletado'];
            
            echo json_encode($return);
            die();
        }

        echo json_encode(['message' => 'Dado já foi deletado anteriormente']);
    }

}