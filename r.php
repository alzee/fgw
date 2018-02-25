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
$sheetname='商贸';
$sheetname='基建';
$sheetname='美丽乡村';

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

for($i=5;$i<=21;$i++){
	//echo $sheetData[$i]['D'];
	$sql="insert into projects (pid,pname,property,intro,investment,invest_plan,start,finish,investby,o_incharge,p_incharge,o_serve,oid,oid_serve) values(
		" . "\"" .  trim($sheetData[$i]['A']) ."\""  . ",
		" . "\"" .  trim($sheetData[$i]['B']) ."\""  . ",
		" . "\"" .  trim($sheetData[$i]['C']) ."\""  . ",
		" . "\"" .  trim($sheetData[$i]['D']) ."\""  . ",
		" . "\"" .  trim($sheetData[$i]['E']) ."\""  . ",
		" . "\"" .  trim($sheetData[$i]['F']) ."\""  . ",
		" . "\"" .  trim($sheetData[$i]['G']) ."\""  . ",
		" . "\"" .  trim($sheetData[$i]['H']) ."\""  . ",
		" . "\"" .  trim($sheetData[$i]['I']) ."\""  . ",
		" . "\"" .  trim($sheetData[$i]['J']) ."\""  . ",
		" . "\"" .  trim($sheetData[$i]['K']) ."\""  . ",
		" . "\"" .  trim($sheetData[$i]['L']) ."\""  . ")";

	//echo $sql;

	if(! $mysqli->query($sql)){
		echo $mysqli->errno;
		echo $mysqli->error;
	};
}
//
