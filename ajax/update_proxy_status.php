<?php
/**
 * vim:ft=php et ts=4 sts=4
 * @author z14 <z@arcz.ee>
 * @version
 * @todo
 */

require '../Db.php';
use App\Db;

if ($_POST){
	$proxy_status = $_POST['proxy_status'];
	$pid = $_POST['pid'];
    if($proxy_status){
        $sql="update progress set proxy_status = '$proxy_status' where pid='$pid' and date like '${month}%'";
    }
	// echo $sql;
	(new Db)->query($sql);
}
