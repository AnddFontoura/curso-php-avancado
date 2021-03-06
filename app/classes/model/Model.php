<?php

namespace App\classes\model;

class Model {
    
    protected $tableColumn;
    
    public function setParams()
    {
        $params = [];
        
        foreach($this->fillable as $tableColumn) {
            if(isset($_GET[$tableColumn]) && $_GET[$tableColumn] != null){
                $params[$tableColumn] = $_GET[$tableColumn];
            }
        }

        return $params;
    }

    public function setPostParams()
    {
        $params = [];
        
        foreach($this->fillable as $tableColumn) {
            if(isset($_POST[$tableColumn]) && $_POST[$tableColumn] != null){
                $params[$tableColumn] = $_POST[$tableColumn];
            }
        }

        return $params;
    }
}