<?php
/**
 * vim:ft=php
 * @author Dotcra <dotcra@gmail.com>
 * @version
 * @todo
 */
require 'vendor/autoload.php';
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

$spreadsheet = new Spreadsheet();
$writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
$writer0 = new Xlsx($spreadsheet);
$writer->save('test.xlsx');
// if($writer == $writer0){ echo 1;}
var_dump($writer);
