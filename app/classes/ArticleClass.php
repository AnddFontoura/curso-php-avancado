<?php

namespace App\classes;

use App\classes\Connection;
use PDO;

class ArticleClass extends Connection {

    public function listArticles() {
        $query = $this->dbConnection->query("select * from periodico.articles");
        $query->execute();
        $result = $query->fetch(PDO::FETCH_ASSOC);
        
        return $result;
    }
}