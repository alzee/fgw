<?php
/**
 * vim:ft=php
 * @author Dotcra <dotcra@gmail.com>
 * @version
 * @todo
 */

require 'Db.php';

$month=$_POST['month'];
$pid=$_POST['pid'];
$sql = "select * from projects join progress on progress.pid=projects.pid where projects.pid='$pid' and date like '${month}%'";

$row=(new Db)->query($sql);

//var_dump($row);

echo json_encode($row, JSON_UNESCAPED_UNICODE);
