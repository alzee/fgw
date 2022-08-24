<?php
/**
 * Import projects from xlsx.
 * oid/oid_serve will be set to 0 if organization name not found.
 * $sheets and $range need to be modified.
 */

require 'vendor/autoload.php';
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Reader\Xls;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx;
use App\Db;

// $sql = "truncate table `projects`";
// (new Db)->query($sql);
// $sql = "truncate table `path`";
// (new Db)->query($sql);
// $sql = "truncate table `progress`";
// (new Db)->query($sql);
// $sql = "truncate table `procedures`";
// (new Db)->query($sql);

$ext = 'Xlsx';
$inputFileName = 'xlsx/import.xlsx';
$table = 'projects';
$reader = IOFactory::createReader($ext);

$sql = 'select * from organization';
$rows = (new Db)->query($sql);

$sheetname = 'Sheet1';
$range = 'A5:L12';
$reader->setLoadSheetsOnly($sheetname);
$spreadsheet = $reader->load($inputFileName);

//$sheetData = $spreadsheet->getActiveSheet()->toArray(null, true, true, true);
$sheetData = $spreadsheet->getActiveSheet()->rangeToArray($range, null, true, true, true);
//echo $spreadsheet->getSheetCount();
$loadedSheetNames = $spreadsheet->getSheetNames();

foreach ($sheetData as $k => $v){
    $pid = $sheetData[$k]['A'];
    $pname = $sheetData[$k]['B'];
    $property = $sheetData[$k]['C'];
    $intro = $sheetData[$k]['D'];
    $investment = $sheetData[$k]['E'];
    $invest_plan = $sheetData[$k]['F'];
    $start = $sheetData[$k]['G'];
    $finish = $sheetData[$k]['H'];
    $investby = '';
    $level = '一类';
    $p_incharge = str_replace("\n", ',', $sheetData[$k]['J']);
    $p_incharge = str_replace(" ", '', $p_incharge);
    $oname = preg_replace('/\s+/', '', $sheetData[$k]['I']);
    $oname_serve = preg_replace('/\s+/', '', $sheetData[$k]['K']);
    $type = $sheetData[$k]['L'];
    $oid = 0;
    $oid_serve = 0;
    foreach ($rows as $vv) {
        // what if not found?
        if ($oname == $vv['oname']) {
            $oid = $vv['oid'];
        }
        if ($oname_serve == $vv['oname']) {
            $oid_serve = $vv['oid'];
        }
    }
    //echo $p_incharge;
    //echo ' | ';
    //echo $oname . ' ' . $oid;
    //echo ' | ';
    //echo $oname_serve . ' ' . $oid_serve;
    //echo PHP_EOL;
    $sql="insert into $table (pid,pname,property,intro,investment,invest_plan,start,finish,investby,type,level,p_incharge,oid,oid_serve) values(
        '" .  $pid ."',
        '" .  $pname ."',
        '" .  $property ."',
        '" .  $intro ."',
        '" .  $investment ."',
        '" .  $invest_plan ."',
        '" .  $start ."',
        '" .  $finish ."',
        '" .  $investby ."',
        '" .  $type ."',
        '" .  $level ."',
        '" .  $p_incharge ."',
        '" .  $oid ."',
        '" .  $oid_serve ."')";
    // echo $sql;
    if(! (new Db)->query($sql)){
        //echo $mysqli->errno;
        //echo $mysqli->error;
    };

    $sql = "insert into procedures values()";
    (new Db)->query($sql);
}
