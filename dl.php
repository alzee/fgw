<?php
/**
 * vim:ft=php
 * @author Dotcra <dotcra@gmail.com>
 * @version
 * @todo
 */
// var_dump($_POST);
if(1){
	//echo 1;
	$file = 'xls/test.xlsx';
	if(file_exists($file)){
		//echo 2;
		 header("Content-Description: File Transfer");
		  header("Content-Type: application/octet-stream");
		 header("Content-Transfer-Encoding: Binary");
		header("Content-Disposition: attachment; filename='haha.xls'");
		//header('Content-Length: ' . filesize($file));
		 readfile($file);
		// exit;
	}
}
