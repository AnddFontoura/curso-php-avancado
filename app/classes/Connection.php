<?php

namespace App\classes;

use Exception;
use PDO;

class Connection {

    /**
     * Classe de conexão ao banco de dados inspirada
     * em PDO
     * 
     * Referência documental: 
     * https://www.php.net/manual/pt_BR/book.pdo.php
     * 
     * Constantes do PDO:
     * https://www.php.net/manual/pt_BR/pdo.constants.php
     */
    private $host = 'localhost';
    private $user = 'root';
    private $pass = 'root';
    private $port = 3306;
    private $database = 'periodico';
    protected $dbConnection;
    protected $table;
    
    private $error;
    private $query;

    public function __construct()
    {
        $dbConn = 'mysql:host=' . $this->host . ';dbname=' . $this->database . ';port=' . $this->port;

        $pdoOptions = [
            PDO::ATTR_PERSISTENT => TRUE,
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, 
        ];

        try {
            /**
             * new PDO é a maneira de invocar a classe nativa do PHP
             * devido a arquitetura do PHP não é necessário referenciar
             * essa classe durante o nosso arquivo, e a classe PDO já
             * contempla algumas variaveis e funções, conforme você pode ler
             * aqui: 
             * 
             * https://www.php.net/manual/pt_BR/class.pdo
             */
            $this->dbConnection = new PDO($dbConn, $this->user, $this->pass, $pdoOptions);
        } catch (Exception $e) {
            $this->error = $e->getMessage();
        }
    }

    protected function sqlListAll(array $parameters = null)
    {
        $sql = "
            SELECT
                *
            FROM
                {$this->table}
        ";

        if ($parameters) {
            $sql .= "WHERE ";

            foreach($parameters as $key => $value) {
                $sql .= " $key = :$key and ";
            }

            $sql .= " 1 = 1";
        }

        return $sql;
    }

    public function getAllFromTable(array $parameters = null)
    {
        $sql = $this->sqlListAll($parameters);

        $query = $this->dbConnection->prepare($sql);
        if($parameters) {
            foreach ($parameters as $key => $value) {
                if (is_string($value)) {
                    $pdoParam = PDO::PARAM_STR;
                } elseif (is_numeric($value)) {
                    $pdoParam = PDO::PARAM_INT;
                } elseif (is_bool($value)) {
                    $pdoParam = PDO::PARAM_BOOL;
                } else {
                    $pdoParam = PDO::PARAM_NULL;
                }

                $query->bindValue(':'.$key, $value, $pdoParam);
            }
        }

        $query->execute();
        $result = $query->fetch(PDO::FETCH_ASSOC);
        
        return $result;
    }
}
