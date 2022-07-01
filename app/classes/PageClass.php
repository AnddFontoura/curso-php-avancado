<?php

namespace App\classes;

use PDO;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx;
use PhpOffice\PhpSpreadsheet\Spreadsheet;

class PageClass extends ControllerClass {
    protected $table = 'pages';
    protected $viewDirectory = 'page';
    protected $model = 'page';

    public function reportJs()
    {
        $sql = "
        SELECT
            count(id) as count_id,
            DATE_FORMAT(created_at, '%d/%m/%Y') as date
        FROM 
            {$this->table}
        group by
            DATE_FORMAT(created_at, '%d/%m/%Y')
        ";
        $query = $this->dbConnection->prepare($sql);
        $query->execute();
        $results = $query->fetchAll(PDO::FETCH_OBJ);

        require_once("view/{$this->viewDirectory}/report.php");
    }

    public function extractDataExcel() {
        //https://github.com/PHPOffice/PhpSpreadsheet/blob/master/samples/Basic/01_Simple.php
        $spreadsheet = new Spreadsheet;

        $spreadsheet->getProperties()
            ->setCreator('Correios Corp')
            ->setTitle('Extração de Table')
            ->setDescription('Extração do pages por excel')
            ->setKeywords('office PhpSpreadsheet php');

        $excelContent = $spreadsheet->setActiveSheetIndex(0);
        
        $result = $this->getAllFromTable();
        
        for($l = 0; $l < count($result); $l++) {
            $excelContent->setCellValue([$l, 1], $result[$l]['id']);
            $excelContent->setCellValue([$l, 2], $result[$l]['name']);
            $excelContent->setCellValue([$l, 4], $result[$l]['created_at']);
            $excelContent->setCellValue([$l, 5], $result[$l]['updated_at']);
            $excelContent->setCellValue([$l, 6], $result[$l]['deleted_at']);
        }

        $spreadsheet->getActiveSheet()->setTitle('Page folder');
        $fileName = "extracaoDadosPage_". date('Y-m-d-h-i-s') . ".xlsx";

        // Redirect output to a client’s web browser (Xlsx)
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header("Content-Disposition: attachment;filename={$fileName}");
        header('Cache-Control: max-age=0');
        // If you're serving to IE 9, then the following may be needed
        header('Cache-Control: max-age=1');

        // If you're serving to IE over SSL, then the following may be needed
        header('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
        header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT'); // always modified
        header('Cache-Control: cache, must-revalidate'); // HTTP/1.1
        header('Pragma: public'); // HTTP/1.0

        $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
        $writer->save('php://output');
        exit;
    }

    /*public function extractDataExcel()
    {
        $result = $this->getAllFromTable();

        $fileName = "extracaoDadosPage_". date('Y-m-d-h-i-s') . ".xlsx";

        header('Content-Encoding: UTF-8');
        header("Content-Type: application/vnd.ms-excel; charset=UTF-8");
        //header("Content-Type: text/csv"); 
        header("Content-Disposition: attachment; filename=\"$fileName\""); 
        
        echo "
            <table>
                <tr>
                    <td> ID </td>
                    <td> NOME </td>
                    <td> DESCRIÇÃO </td>
                    <td> CRIADO EM </td>
                    <td> ATUALIZADO EM </td>
                    <td> DELETADO EM </td>
                </tr>
        ";

        foreach($result as $value) {
            echo "
                <tr>
                    <td> {$value['id']}  </td>
                    <td> <b>  {$value['name']} </b> </td>
                    <td>  </td>
                    <td> <p style=\"color: red;\" fontcolor=\"red\"> {$value['created_at']} </p> </td>
                    <td> <i> {$value['updated_at']} </i> </td>
                    <td> <i> {$value['deleted_at']} </i> </td>
                </tr>
            ";
        }
        echo "</table>";

    }*/

    public function extractDataCsv()
    {
        $result = $this->getAllFromTable();

        $fileName = "extracaoDadosPage_". date('Y-m-d-h-i-s') . ".csv";
        
        header('Content-Encoding: UTF-8');
        header("Content-Type: text/csv; charset=UTF-8"); 
        header("Content-Disposition: attachment; filename=\"$fileName\""); 

        foreach($result as $value) {
            echo "
                {$value['id']},
                {$value['name']},
                {$value['created_at']},
                {$value['updated_at']},
                {$value['deleted_at']},
            ";
        }
    }
}

