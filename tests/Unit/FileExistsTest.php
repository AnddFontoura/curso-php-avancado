<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;

class FileExistsTest extends TestCase {

    protected $filePath;

    function setUp()
    {
        $this->filePath = [
            'upload',
            'app',
            'public',
            'public/css',
            'public/js'
        ];
    }

    function testIfFoldersExists()
    {
        foreach($this->filePath as $folderToCheck)
            $this->assertDirectoryExists($folderToCheck);
    }
}