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

$type='Xlsx';
$inputFileName = 'xlsx/projects_2021a.xlsx';
$table = 'projects';
$sheets = [
    '先进制造业',
    '现代服务业',
    '基础设施暨社会民生',
    '乡村振兴',
];
$reader = IOFactory::createReader($type);

$sql = 'select * from organization';
$rows = (new Db)->query($sql);

foreach($sheets as $sheetname){
    $reader->setLoadSheetsOnly($sheetname);
    $spreadsheet = $reader->load($inputFileName);

    switch ($sheetname) {
    case '先进制造业':
        $range = 'A6:K30';
        break;
    case '现代服务业':
        $range = 'A5:K31';
        break;
    case '基础设施暨社会民生':
        $range = 'A5:K43';
        break;
    case '乡村振兴':
        $range = 'A5:K18';
        break;
    }
    //$sheetData = $spreadsheet->getActiveSheet()->toArray(null, true, true, true);
    $sheetData = $spreadsheet->getActiveSheet()->rangeToArray($range, null, true, true, true);
    //echo $spreadsheet->getSheetCount();
    $loadedSheetNames = $spreadsheet->getSheetNames();

    foreach ($sheetData as $k=>$v){
        $pid = $sheetData[$k]['A'];
        $pname = $sheetData[$k]['B'];
        $property = $sheetData[$k]['C'];
        $intro = $sheetData[$k]['D'];
        $investment = $sheetData[$k]['E'];
        $invest_plan = $sheetData[$k]['F'];
        $start = $sheetData[$k]['G'];
        $finish = $sheetData[$k]['H'];
        $investby = '';
        $type = $sheetname;
        $level = '一类';
        $p_incharge = str_replace("\n", ',', $sheetData[$k]['J']);
        $p_incharge = str_replace(" ", '', $p_incharge);
        $oname = preg_replace('/\s+/', '', $sheetData[$k]['I']);
        $oname_serve = preg_replace('/\s+/', '', $sheetData[$k]['K']);
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
            '" .  $sheetname ."',
            '" .  $level ."',
            '" .  $p_incharge ."',
            '" .  $oid ."',
            '" .  $oid_serve ."')";
        // echo $sql;
        if(! (new Db)->query($sql)){
            //echo $mysqli->errno;
            //echo $mysqli->error;
        };
    }
}
