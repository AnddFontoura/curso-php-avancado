<?php

namespace Tests\Feature;

use App\classes\model\SubCategoryModel;
use App\classes\SubCategoryClass;
use PHPUnit\Framework\TestCase;

class SubCategoryClassFeatureTest extends TestCase {
    protected $controller;
    protected $model;

    function setUp()
    {
        $this->model = new SubCategoryModel();
        $this->controller = new SubCategoryClass();
    }

    public function testConstruct() {
        $controller = $this->controller;

        $this->assertTrue(true);
    }

    public function testSave() {

        $params = [
            'name' => 'André',
            'description' => 'Teste executado',
        ];

        $url = "http://localhost/curso-php-avancado/SubCategory/save";
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HEADER, TRUE);
        curl_setopt($ch, CURLOPT_NOBODY, TRUE); // remove body
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        $head = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        $this->assertEquals($httpCode, 200);
    }

    public function testList() {
        $test = $this->controller->list();

        $this->assertNotNull($test);
    }

    public function testCreate() {
        $this->controller->create();

        $this->assertTrue(true);
    }

    public function testDelete() {
        $params = [
            'id' => 1,
        ];

        $url = "http://localhost/curso-php-avancado/SubCategory/delete";
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        $head = curl_exec($ch);
        $body = curl_getinfo($ch, CURLINFO_HEADER_OUT);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        $this->assertEquals($httpCode, 200);
    }
}