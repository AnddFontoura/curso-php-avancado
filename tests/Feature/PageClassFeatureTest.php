<?php

namespace Tests\Feature;

use App\classes\PageClass;
use PHPUnit\Framework\TestCase;
use ReflectionClass;

class PageClassFeatureTest extends TestCase {

    // só instancia o pdo uma vez para limpeza de teste e carregamento de ambiente
    static private $pdo = null;

    // só instancia PHPUnit_Extensions_Database_DB_IDatabaseConnection uma vez por teste
    private $conn = null;
    
    protected $controller;

    function setUp()
    {
        $this->controller = new PageClass();
    }

    function tearDown()
    {
        
    }

    protected function reflectionInstance($methodName) 
    {
        $reflectionClass = new ReflectionClass($this->controller);
        $method = $reflectionClass->getMethod($methodName);
        $method->setAccessible(true);

        return $method;
    }

    public function testGetAllFromTable()
    {
        /**
         * Criar um registro, testar o registro
         * e apagar o registro
         */
        $results = $this->controller->getAllFromTable();

        $this->assertNotNull($results);
        $this->assertArrayHasKey('id', $results[0]);
        $this->assertArrayHasKey('name', $results[0]);
        $this->assertArrayHasKey('description', $results[0]);
        $this->assertArrayHasKey('created_at', $results[0]);
        $this->assertArrayHasKey('updated_at', $results[0]);
        $this->assertArrayHasKey('deleted_at', $results[0]);
    }

    public function testCreate()
    {
        $this->controller->create();

        $this->assertTrue(true);
    }
}