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
// $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
// if($writer == $writer0){ echo 1;}
$sheet=$spreadsheet->getActiveSheet();
// var_dump($sheet);
//foreach($t_rows as $v){
//	$i=1;
//	$sheet->setCellValue('A1',$v['']);
//	$sheet->setCellValue('A1','fuck you');
//}
$sheet->fromArray($rows, NULL ,'A2');

$writer = new Xlsx($spreadsheet);
$writer->save('xls/test.xlsx');
