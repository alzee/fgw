<?php

require 'vendor/autoload.php';
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Reader\Xls;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx;

$type='Xlsx';
//$inputFileName = __DIR__ . '/fgw.xls';
$file = 'path.xlsx';
$inputFileName = $file;
//$sheetname='工业 ';
//$sheetname='商贸';
//$sheetname='基建';
//$sheetname='美丽乡村';
$sheetname = 'path';

$reader = IOFactory::createReader($type);
$reader->setLoadSheetsOnly($sheetname);
$spreadsheet = $reader->load($inputFileName);

//$sheetData = $spreadsheet->getActiveSheet()->toArray(null, true, true, true);
$sheetData = $spreadsheet->getActiveSheet()->rangeToArray('A3:K102', null, true, true, true);
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

foreach ($sheetData as $k=>$v){
	$sql="insert into path values(
		'" .  trim($sheetData[$k]['A']) ."',
		'" .  trim($sheetData[$k]['B']) ."',
		'" .  trim($sheetData[$k]['C']) ."',
		'" .  trim($sheetData[$k]['D']) ."',
		'" .  trim($sheetData[$k]['E']) ."',
		'" .  trim($sheetData[$k]['F']) ."',
		'" .  trim($sheetData[$k]['G']) ."',
		'" .  trim($sheetData[$k]['H']) ."',
		'" .  trim($sheetData[$k]['I']) ."',
		'" .  trim($sheetData[$k]['J']) ."',
		'" .  trim($sheetData[$k]['K']) ."')";
	echo $sql;
	if(! $mysqli->query($sql)){
		echo $mysqli->errno;
		echo $mysqli->error;
	};
}
