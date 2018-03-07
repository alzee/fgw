<?php
/**
 * vim:ft=php
 * @author Dotcra <dotcra@gmail.com>
 * @version
 * @todo
 */
//require 'vendor/autoload.php';
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

$spreadsheet = new Spreadsheet();

$sheet=$spreadsheet->getActiveSheet();
$sheet->setTitle('项目类型');
$sheet->fromArray(['项目类型','项目个数','占 比'], NULL);
$sheet->fromArray($t_rows, NULL ,'A2');

$spreadsheet->createSheet();
$sheet=$spreadsheet->getSheet(1);
$sheet->setTitle('建设性质');
$sheet->fromArray(['建设性质','项目个数','占12 比'], NULL);
$sheet->fromArray($p_rows, NULL ,'A2');

$spreadsheet->createSheet();
$sheet=$spreadsheet->getSheet(2);
$sheet->setTitle('责任单位');
$sheet->fromArray(['责任单位','项目个数','占12 比'], NULL);
$sheet->fromArray($o_rows, NULL ,'A2');

$spreadsheet->createSheet();
$sheet=$spreadsheet->getSheet(3);
$sheet->setTitle('投资主体');
$sheet->fromArray(['投资主体','项目个数','占12 比'], NULL);
$sheet->fromArray($ib_rows, NULL ,'A2');

$spreadsheet->createSheet();
$sheet=$spreadsheet->getSheet(3);
$sheet->setTitle('总投资');
$sheet->fromArray(['总投资','项目个数','占12 比'], NULL);
$sheet->fromArray($a, NULL ,'A2');
$sheet->fromArray($b, NULL ,'A3');
$sheet->fromArray($c, NULL ,'A4');
$sheet->fromArray($d, NULL ,'A5');
$sheet->fromArray($e, NULL ,'A6');
$sheet->fromArray($f, NULL ,'A7');

// $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
$writer = new Xlsx($spreadsheet);
$writer->save('xlsx/stat.xlsx');
