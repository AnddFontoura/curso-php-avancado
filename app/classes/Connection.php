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

    /**
     * @var string
     * Contém o nome da tabela a ser invocado
     */
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

    protected function sqlUpdate(array $parameters, array $filter) {
        $update = '';
        $filtro = '';

        $i = 1;
        foreach ($parameters as $key => $value) {
            $needColon = $i >= count($parameters) ? '': ', ';
            $update .= $key." = :".$key . $needColon;
            $i++;
        }

        if ($filter) {
            foreach ($filter as $key => $value) {
                $needAnd = $i >= count($filter) ? '': ' and ';
                $filtro .= $key." = :".$key . $needAnd;
                $i++;
            }
        }

        $sql = "
            UPDATE
                {$this->table}
            SET
                $update
            WHERE
                $filtro
        ";

        return $sql;
    }
    
    protected function sqlInsert(array $parameters) {
        $columns = '';
        $values = '';

        $i = 1;
        foreach ($parameters as $key => $value) {
            $needColon = $i >= count($parameters) ? '': ', ';
            $columns .= $key . $needColon ;
            $values .= ":".$key . $needColon;
            $i++;
        }

        $sql = "
            INSERT INTO
                {$this->table}
            ($columns) 
            VALUES
            ($values)
        ";

        return $sql;
    }

    protected function sqlDelete(array $parameters = null) {
        $filter = '';
        $i = 1;

        if ($parameters) {
            foreach ($parameters as $key => $value) {
                $needAnd = $i >= count($parameters) ? '': ' and ';
                $filter .= $key." = :".$key . $needAnd;
                $i++;
            }
        }

        $sql = "
            DELETE FROM
                {$this->table}
            WHERE
                {$filter}
        ";

        return $sql;
    }


    public function insertOnTable(array $parameters) {
        $sql = $this->sqlInsert($parameters);

        $query = $this->dbConnection->prepare($sql);
        $this->bindValuesPDO($parameters, $query);

        $result = $query->execute();

        if ($result) {
            echo "Deu certo a inclusão <hr>";
        } else {
            echo "Deu erro na inclusão <hr>";
        }
    }

    public function getAllFromTable(array $parameters = null)
    {
        //var_dump($parameters);

        $sql = $this->sqlListAll($parameters);

        $query = $this->dbConnection->prepare($sql);
        $this->bindValuesPDO($parameters, $query);

        //var_dump($query);
        //die();

        $query->execute();
        $result = $query->fetchAll(PDO::FETCH_ASSOC);
        
        return $result;
    }
    
    public function getFromTable(array $parameters = null)
    {
        $sql = $this->sqlListAll($parameters);

        $query = $this->dbConnection->prepare($sql);
        $this->bindValuesPDO($parameters, $query);

        $query->execute();
        $result = $query->fetch(PDO::FETCH_ASSOC);
        
        return $result;
    }

    public function updateOnTable(array $parameters, array $filter) {
        $sql = $this->sqlUpdate($parameters, $filter);

        $query = $this->dbConnection->prepare($sql);
        $this->bindValuesPDO($parameters, $query);
        $this->bindValuesPDO($filter, $query);

        $result = $query->execute();

        if ($result) {
            echo "Deu certo a alteração <hr>";
        } else {
            echo "Deu erro na alteração <hr>";
        }
    }

    public function deleteOnTable(array $parameters) {
        $sql = $this->sqlDelete($parameters);
        
        $query = $this->dbConnection->prepare($sql);
        $this->bindValuesPDO($parameters, $query);
        $result = $query->execute();
            
        return $result;
    }

    protected function bindValuesPDO(array $parameters = null, $query)
    {
        if ($parameters) {
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

                $query->bindValue(':' . $key, $value, $pdoParam);
            }
        }
    }


}
