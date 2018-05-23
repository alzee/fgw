<?php
/**
 * vim:ft=php
 * @author Dotcra <dotcra@gmail.com>
 * @version
 * @todo
 */
require '../Db.php';
use App\Db;

if ($_POST){
	$code = $_POST['code'];
	$v = $_POST['v'];
	$pid = $_POST['pid'];
	$sql = "update pproc set `" . $code . "` = '" . $v . "' where pid = '" . $pid ."'";
	// echo $sql;
	(new Db)->query($sql);
}
