<?php

namespace Tests\Unit;

use App\classes\Connection;
use PHPUnit\Framework\TestCase;
use ReflectionClass;

class ConnectionClassUnitTest extends TestCase {

    protected $controller;

    function setUp()
    {
        $this->controller = new Connection();
    }

    protected function reflectionInstance($methodName) 
    {
        $reflectionClass = new ReflectionClass($this->controller);
        $method = $reflectionClass->getMethod($methodName);
        $method->setAccessible(true);

        return $method;
    }

    public function testSqlListAll()
    {
        $id = ':id';
        $name = ':name';
        $expectedStrings = [
            "SELECT",
            "FROM",
            "WHERE",
        ];

        $parameters = [
            'id' => $id,
            'name' => $name
        ];
        
        $method = $this->reflectionInstance('sqlListAll');
        $sqlToTest = $method->invokeArgs($this->controller, [$parameters]);

        $this->assertContains($id, $sqlToTest);
        $this->assertContains($name, $sqlToTest);
        foreach ($expectedStrings as $expectedString) {
            $this->assertContains($expectedString, $sqlToTest);
        }
    }

    public function testSqlUpdate()
    {
        $id = ':id';
        $name = ':name';
        $expectedStrings = [
            "UPDATE",
            "SET",
            "WHERE",
        ];

        $parameters = [
            'id' => $id,
            'name' => $name
        ];

        $filter = [
            'id' => $id,
        ];
        
        $method = $this->reflectionInstance('sqlUpdate');
        $sqlToTest = $method->invokeArgs($this->controller, [$parameters, $filter]);

        $this->assertContains($id, $sqlToTest);
        $this->assertContains($name, $sqlToTest);
        foreach ($expectedStrings as $expectedString) {
            $this->assertContains($expectedString, $sqlToTest);
        }
    }
}