<?php
/**
 * vim:ft=php
 * @author Dotcra <dotcra@gmail.com>
 * @version
 * @todo
 */

require 'Db.php';
// $sql = "select o_incharge from projects";
$sql = "select o_serve from projects";
$rows = (new Db)->query($sql);

foreach ($rows as $k => $v){
	// echo trim($v['o_incharge']);
	echo trim($v['o_serve']);
	echo PHP_EOL;
}
