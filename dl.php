<?php
/**
 * vim:ft=php
 * @author Dotcra <dotcra@gmail.com>
 * @version
 * @todo
 */
echo 'haha';
if($_POST){
	// echo 1;
	$file = 'fgw.xls';
	if(file_exists($file)){
		// header("Content-Description: File Transfer");
		// header("Content-Type: application/octet-stream");
		header("Content-Transfer-Encoding: Binary");
		header("Content-Disposition: attachment; filename='haha.xls'");
		header('Content-Length: ' . filesize($file));
		readfile($file);
		exit;
	}
}
