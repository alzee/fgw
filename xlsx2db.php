<?php

require 'vendor/autoload.php';
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Reader\Xls;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx;
use App\Db;

$type='Xls';
$inputFileName = 'xlsx/projects_2020.xls';
// $sheetname='工业制造业';
// $sheetname='商贸服务业';
$sheetname='基础设施';
// $sheetname='乡村振兴';
// $sheetname='招商项目';

$reader = IOFactory::createReader($type);
$reader->setLoadSheetsOnly($sheetname);
$spreadsheet = $reader->load($inputFileName);

switch ($sheetname) {
    case '工业制造业':
        $range = 'A6:K28';
        break;
    case '商贸服务业':
        $range = 'A5:K33';
        break;
    case '基础设施':
        $range = 'A5:K49';
        break;
    case '乡村振兴':
        $range = 'A5:K15';
        break;
    case '招商项目':
        $range = 'A4:K13';
        break;
}
//$sheetData = $spreadsheet->getActiveSheet()->toArray(null, true, true, true);
$sheetData = $spreadsheet->getActiveSheet()->rangeToArray($range, null, true, true, true);
//echo $spreadsheet->getSheetCount();
$loadedSheetNames = $spreadsheet->getSheetNames();
// var_dump($loadedSheetNames);
// var_dump($sheetData);


$sql = 'select * from organization';
$rows = (new Db)->query($sql);

$table = 'projects';
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
	 echo $sql;
	if(! (new Db)->query($sql)){
		echo $mysqli->errno;
		echo $mysqli->error;
	};
}
