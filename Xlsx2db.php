<?php
/**
 * vim:ft=php et ts=4 sts=4
 * @author z14 <z@arcz.ee>
 * @version
 * @todo
 */

namespace App;

use App\Db;
use App\Twig;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Reader\Xls;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx;

require 'vendor/autoload.php';

class Xlsx2db{
  /*
   * @Route("xlsx2db", name="xlsx2db")
   */
  function showTables(){
    $sql = 'show tables';
    $rows = (new Db)->query($sql);
    $tables = [];
    foreach ($rows as $v) {
      $tables[] = $v['Tables_in_fgw'];
    }

    echo Twig::render('xlsx2db.html.twig', 
      [
        'title' => 'xlsx2db',
        'tables' => $tables,
      ]
    );
  }

  /*
   * @Route("fields", name="getFields")
   */
  function descTable(){
    $table = $_GET['table'];
    $sql = "desc `$table`";
    $rows = (new Db)->query($sql);
    $cols = [];
    foreach($rows as $v){
      $cols[] = $v['Field'];
    }
    echo json_encode($cols, JSON_UNESCAPED_UNICODE);
  }

  /*
   * @Route("updateDb", name="updateDb")
   */
  function updateDb() {
    $fields = $_POST;
    $table = $fields['table'];
    unset($fields['table']);
    print_r($fields);
    $type='Xls';
    $inputFileName = 'xlsx/fuck.xls';
    if (file_exists($inputFileName)) {
      echo 'yes';
    }
    else {
      echo 'no';
    }
    $sheetname = 'fuck';
    $reader = IOFactory::createReader($type);
    $reader->setLoadSheetsOnly($sheetname);
    $spreadsheet = $reader->load($inputFileName);
    $range = "N1:O100";
    $sheetData = $spreadsheet->getActiveSheet()->rangeToArray($range, null, true, true, true);
    // print_r($sheetData);

    $cols = "";
    foreach ($fields as $k => $v) {
      if (! empty($v)) {
        $cols .= $k . ",";
      }
    }
    $cols = rtrim($cols, ',');

    foreach ($sheetData as $k=>$v){
      $values = "";
      foreach ($fields as $kk => $vv) {
        if (! empty($vv)) {
          echo $vv;
          $values .= '"' . $sheetData[$k]["$vv"] . '"' . ",";
        }
      }
      $values = rtrim($values, ',');
      $sql = "insert into $table ($cols) values ($values)";
      echo $sql . PHP_EOL;
    }
  }
}
