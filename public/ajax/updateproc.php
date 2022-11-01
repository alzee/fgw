<?php
/**
 * vim:ft=php
 * @author Dotcra <dotcra@gmail.com>
 * @version
 * @todo
 */
use App\Db;

// TODO This file not start from index.php
require '../vendor/autoload.php';

if ($_POST){
	$code = $_POST['code'];
	$v = $_POST['v'];
	$pid = $_POST['pid'];
	$sql = "update procedures set `" . $code . "` = '" . $v . "' where pid = '" . $pid ."'";
	// echo $sql;
	(new Db)->query($sql);
}
