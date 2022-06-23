<?php

namespace App\classes;

use App\classes\Connection;
use PDO;

class ArticleClass extends Connection {

    protected $table = "articles";
    
    public function listArticles() {
        $query = $this->dbConnection->query("select * from articles");
        $query->execute();
        $result = $query->fetch(PDO::FETCH_ASSOC);
        
        return $result;
    }
}