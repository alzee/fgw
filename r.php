<?php

require 'vendor/autoload.php';
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Reader\Xls;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx;

$type='Xls';
//$inputFileName = __DIR__ . '/fgw.xls';
$inputFileName = $file;
$sheetname='工业 ';
$sheetname='美丽乡村';
$sheetname='基建';
$sheetname='商贸';

$reader = IOFactory::createReader($type);
$reader->setLoadSheetsOnly($sheetname);
$spreadsheet = $reader->load($inputFileName);

$sheetData = $spreadsheet->getActiveSheet()->toArray(null, true, true, true);
//echo $spreadsheet->getSheetCount();
$loadedSheetNames = $spreadsheet->getSheetNames();
//var_dump($loadedSheetNames);
//var_dump($sheetData);

// database;
$mysqli=new mysqli('localhost','root','dot','fgw');
//echo $mysqli->character_set_name();
//$mysqli->query("set names utf8");
//echo $mysqli->character_set_name();
$mysqli->set_charset('utf8');
//echo $mysqli->character_set_name();

for($i=5;$i<=17;$i++){
	//echo $sheetData[$i]['D'];
	$sql="insert into projects (pid,pname,property,intro,investment,invest_plan,start,finish,investby,o_incharge,p_incharge,o_serve) values(
		" . "\"" .  $sheetData[$i]['A'] ."\""  . ",
		" . "\"" .  $sheetData[$i]['B'] ."\""  . ",
		" . "\"" .  $sheetData[$i]['C'] ."\""  . ",
		" . "\"" .  $sheetData[$i]['D'] ."\""  . ",
		" . "\"" .  $sheetData[$i]['E'] ."\""  . ",
		" . "\"" .  $sheetData[$i]['F'] ."\""  . ",
		" . "\"" .  $sheetData[$i]['G'] ."\""  . ",
		" . "\"" .  $sheetData[$i]['H'] ."\""  . ",
		" . "\"" .  $sheetData[$i]['I'] ."\""  . ",
		" . "\"" .  $sheetData[$i]['J'] ."\""  . ",
		" . "\"" .  $sheetData[$i]['K'] ."\""  . ",
		" . "\"" .  $sheetData[$i]['L'] ."\""  . ")";

	//echo $sql;

	if(! $mysqli->query($sql)){
		echo $mysqli->errno;
		echo $mysqli->error;
	};
}
//
