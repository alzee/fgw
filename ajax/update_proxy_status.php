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
    $month = date('Y-m');
    $prev_month = date('Y-m', strtotime('first day of last month'));
	$proxy_status = $_POST['proxy_status'];
	$pid = $_POST['pid'];

	// try to obtain data of this month
	$sql = "select * from progress where pid='$pid' and date like '${month}%'";
	$prog = (new Db)->query($sql);
	// if NO data of this month yet, insert one
	if(!$prog){
		$sql = "select * from progress where pid='$pid' order by date desc limit 1";
		// if there is any previous month
		if($lastprev_row = (new Db)->query($sql)){
			// we use 'order by date desc limt 1' instead of 'and where date like date('Y-m', strtotime('first day of last month'))%', because you don't know whether last month has data
			$sql="insert into progress (pid,fill_state,phase,fillby,phone,progress,problem,invest_mon,actual_start,actual_finish) select pid,fill_state,phase,fillby,phone,progress,problem,invest_mon,actual_start,actual_finish from progress where pid='$pid' order by date desc limit 1";
			// make a copy of previous month
			(new Db)->query($sql);
		}
		// if there is NO previous month
		else{
			$sql="insert into progress (pid) values('$pid')";
			(new Db)->query($sql);
		}
    }

    if($proxy_status){
        $sql="update progress set proxy_status = '$proxy_status' where pid='$pid' and date like '${month}%'";
        (new Db)->query($sql);
    }
    echo $sql;
}
