<?php

require 'vendor/autoload.php';
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Reader\Xls;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx;

$type='Xlsx';
//$inputFileName = __DIR__ . '/fgw.xls';
$file = 'proj_2019.xlsx';
$inputFileName = $file;
$sheetname='工业项目';
// $sheetname='商贸项目';
// $sheetname='基础设施';
// $sheetname='乡村振兴';
// $sheetname='招商项目';

$reader = IOFactory::createReader($type);
$reader->setLoadSheetsOnly($sheetname);
$spreadsheet = $reader->load($inputFileName);

//$sheetData = $spreadsheet->getActiveSheet()->toArray(null, true, true, true);
$sheetData = $spreadsheet->getActiveSheet()->rangeToArray('A5:M50', null, true, true, true);
//echo $spreadsheet->getSheetCount();
$loadedSheetNames = $spreadsheet->getSheetNames();
// var_dump($loadedSheetNames);
// var_dump($sheetData);


// database;
$mysqli=new mysqli('localhost','root','dot','fgw');
//echo $mysqli->character_set_name();
//$mysqli->query("set names utf8");
//echo $mysqli->character_set_name();
$mysqli->set_charset('utf8');
//echo $mysqli->character_set_name();

$table = 'projects';
foreach ($sheetData as $k=>$v){
	$sql="insert into $table (pid,pname,property,intro,investment,invest_plan,start,finish,investby,type,level,p_incharge,oid,oid_serve) values(
		'" .  trim($sheetData[$k]['A']) ."',
		'" .  trim($sheetData[$k]['B']) ."',
		'" .  trim($sheetData[$k]['C']) ."',
		'" .  trim($sheetData[$k]['D']) ."',
		'" .  trim($sheetData[$k]['E']) ."',
		'" .  trim($sheetData[$k]['F']) ."',
		'" .  trim($sheetData[$k]['G']) ."',
		'" .  trim($sheetData[$k]['H']) ."',
		'',
		'" .  $sheetname ."',
		'一类',
		'" .  trim($sheetData[$k]['J']) ."',
		'" .  trim($sheetData[$k]['L']) ."',
		'" .  trim($sheetData[$k]['M']) ."')";
	echo $sql;
	if(! $mysqli->query($sql)){
		echo $mysqli->errno;
		echo $mysqli->error;
	};
}
