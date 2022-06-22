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

    public $dbConnection;
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
}