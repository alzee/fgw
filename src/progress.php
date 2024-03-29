<?php
require $inc . 'header.php';
use App\Db;
$month = date('Y-m');
$prev_month = date('Y-m', strtotime('first day of last month'));
$year = date('Y');

$sql="select value from setting where s_key='lockday' or s_key='remind_days'";
$s_row=(new Db)->query($sql);
$lockday=$s_row[0]['value'];
$openday = 20;
$remind_days=$s_row[1]['value'];
$dayleft=$lockday - date('d');
$date = date('d');

// handle form submission
if($_POST && $date >= $openday){
	foreach($_POST as $k => $v){
		if(!empty($_POST[$k] || $_POST[$k] == '0' || $k == 'actual_start' || $k == 'actual_finish')){
			$cols .= "$k='$v',";
		}
	}
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
			
			// if the latest prev month is NOT last month, set alert to 2, render red color on projects page;
			if(substr($lastprev_row['date'],0,7)!=$prev_month){
				$sql="update projects set alert='2' where pid='$pid'";
				(new Db)->query($sql);
			}
		}
		// if there is NO previous month
		else{
			$sql="insert into progress (pid) values('$pid')";
			(new Db)->query($sql);
		}
	}

	// if any value is submitted
	if($cols){
		$cols = rtrim($cols, ',');
		$sql="update progress set $cols where pid='$pid' and date like '${month}%'";
		(new Db)->query($sql);
		
		// update invest_accum anyway
		$sql = "update projects j,(select sum(invest_mon) sum from progress where pid='$pid' and date like '$year%') g set invest_accum=sum where pid='$pid'";
		(new Db)->query($sql);
		
		// update projects.phase anyway
		$sql = "update projects set phase='{$_POST['phase']}' where pid='$pid'";
		(new Db)->query($sql);
		
		// clear alert;
		$sql="update projects set alert='0' where pid='$pid'";
		(new Db)->query($sql);
		
		header("Location: /$controller/$method");
		exit;
	}
	
}

// prepare data
$sql = "select j.*,o1.oname,o2.oname oname_serve from projects j left join (organization o1, organization o2) on (o1.oid=j.oid and o2.oid=j.oid_serve) where pid='$pid'";
$pj_row=(new Db)->query($sql);
// var_dump($pj_row);

// we need data of last two months for rendering yellow td background purpose
$sql = "select * from progress where pid='$pid' order by date DESC LIMIT 2";
// $sql = "select * from progress where pid='$pid' and date like '2020-07%'";
$pg_rows=(new Db)->query($sql, 1);
// print_r($pg_rows);

// don't show last month data anymore
// if the newest date is not this month
if (strpos($pg_rows[0]['date'], $month) === false) {
    $pg_rows[0]['fillby'] = '';
    $pg_rows[0]['phone'] = '';
    $pg_rows[0]['progress'] = '';
    $pg_rows[0]['next_step'] = '';
    $pg_rows[0]['problem'] = '';
    $pg_rows[0]['invest_mon'] = '';
    $pg_rows[0]['proxy_status'] = '';
}
$oid=$_SESSION['oid'];

$who_can_write_progress = [
    $pj_row['oid'],
    $pj_row['oid_1'],
    $pj_row['oid_2'],
    $pj_row['oid_10'],
    $pj_row['oid_11']
];

if(in_array($oid, $who_can_write_progress) && $date >= $openday && $date <= $lockday && $rid != 2){
	$disabled = '';
	$readonly = '';
	$class='writable';
    $ICanSubmitProgress = true;
}
else{
	$disabled ='disabled';
	$readonly = 'readonly';
	$class='';
    $ICanSubmitProgress = false;
}
?>

	  <div class="container" id="proj_detail">
		  <nav aria-label="breadcrumb" class="position-relative">
				  <ol class="breadcrumb">
				  <li class="breadcrumb-item"><a href="/home">首 页</a></li>
				  <li class="breadcrumb-item"><a href="/project">重点项目</a></li>
					  <li class="breadcrumb-item active" aria-current="page"><?= $pj_row['pname'] ?></li>
				  </ol>
		  </nav>
		<section class="row">
			<aside class="col-md-auto">
				<div class="list-group">
				  <a href="#" class="list-group-item list-group-item-action">公告通知</a>
				  <a href="/invest" class="list-group-item list-group-item-action">固定资产投资</a>
				  <a href="/project" class="list-group-item list-group-item-action active">重点项目进展</a>
				  <a href="/admin/chpwd" class="list-group-item list-group-item-action">设置</a>
				</div>
			</aside>

		  <main class="col-md">

		<!-- tab -->
			<nav>
			  <div class="nav nav-tabs mb-3" id="" role="tablist">
				<a class="nav-item nav-link active" id="progress-tab" href="#progress" role="tab">项目实施情况</a>
				<a class="nav-item nav-link" id="procedure-tab" href="#procedure" role="tab">手续办理情况</a>
				<a class="nav-item nav-link" id="path-tab" href="#path" role="tab">项目路线图</a>
			  </div>
			</nav>

		<!-- tab 项目实施情况 -->
		<div class="tab-content" id="nav-tabContent">
		 <div class="tab-pane fade" id="progress-pane" data-name="progress" role="tabpanel">
		  <div class="alert alert-warning alert-dismissible fade show d-none" role="alert">
			  默认显示前一次提交的数据，以供参考。内容与上月相同的单元格以黄色背景提醒。
		 </div>
<?php if($dayleft < $remind_days && $date >= $openday && $date <= $lockday): ?>
		  <div class="alert alert-danger alert-dismissible fade show" role="alert">
		  <strong>即将锁定！</strong> 请及时完善本月数据！每月月底锁定，数据将无法再修改。
			  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
				  <span aria-hidden="true">&times;</span>
			  </button>
		  </div>
<?php endif ?>
<?php if($pj_row['alert']==2): ?>
		  <div class="alert bg-danger alert-dismissible fade show" role="alert">
			  <strong>您本月数据尚未提交！</strong> 
			  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
				  <span aria-hidden="true">&times;</span>
			  </button>
		  </div>
<?php endif ?>

<!-- data from table projects start-->
<div id="fileupload">
			  <table class="table table-bordered table-responsive-sm">
				  <thead>
					<tr>
					  <th scope="col" colspan="6">项目信息</th>
					</tr>
				  </thead>
				  <tbody>
					  <tr>
						  <th scope="row">建设内容</th>
						  <td colspan="6">
							  <textarea class="form-control" rows="5" placeholder="<?= $pj_row['intro'] ?>" disabled></textarea>
						  </td>
					  </tr>
					  <tr>
						  <th scope="row">编 号</th>
						  <td>
							  <input id="pid" placeholder="<?= $pj_row['pid'] ?>" type="text" class="form-control" disabled>
						  </td>
						  <th scope="row">项目名称</th>
						  <td>
							  <input placeholder="<?= $pj_row['pname'] ?>" type="text" class="form-control" disabled>
						  </td>
						  <th scope="row">建设性质</th>
						  <td>
							  <input placeholder="<?= $pj_row['property'] ?>" type="text" class="form-control" disabled>
						  </td>
					  </tr>
					  <tr>
						  <th scope="row">计划开工时间</th>
						  <td>
							  <input placeholder="<?= $pj_row['start'] ?>" type="text" class="form-control" disabled>
						  </td>
						  <th scope="row">计划竣工时间</th>
						  <td>
							  <input placeholder="<?= $pj_row['finish'] ?>" type="text" class="form-control" disabled>
						  </td>
						  <th scope="row">总投资</th>
						  <td>
							  <div class="input-group position-relative">
								  <input placeholder="<?= $pj_row['investment'] ?>" type="text" class="form-control rounded-right" disabled>
								  <div class="input-group-append position-absolute">
									  <span class="input-group-text text-muted">万元</span>
								  </div>
							  </div>
						  </td>
					  </tr>
					  <tr>
						  <th scope="row">投资主体</th>
						  <td>
							  <input placeholder="<?= $pj_row['investby'] ?>" type="text" class="form-control" disabled>
						  </td>
						  <th scope="row">今年计划投资</th>
						  <td>
							  <div class="input-group position-relative">
								  <input placeholder="<?= $pj_row['invest_plan'] ?>" type="text" class="form-control rounded-right" disabled>
								  <div class="input-group-append position-absolute">
									  <span class="input-group-text text-muted">万元</span>
								  </div>
							  </div>
						  </td>
						  <th scope="row">今年累计完成投资</th>
						  <td>
							  <div class="input-group position-relative">
								  <input placeholder="<?= $pj_row['invest_accum'] ?>" type="text" class="form-control rounded-right" disabled>
								  <div class="input-group-append position-absolute">
									  <span class="input-group-text text-muted">万元</span>
								  </div>
							  </div>
						  </td>
					  </tr>
					  <tr>
						  <th scope="row">责任单位</th>
						  <td>
							  <input placeholder="<?= $pj_row['oname'] ?>" type="text" class="form-control" disabled>
						  </td>
						  <th scope="row">服务单位</th>
						  <td>
							  <input placeholder="<?= $pj_row['oname_serve'] ?>" type="text" class="form-control" disabled>
						  </td>
						  <th scope="row">包联领导</th>
						  <td>
							  <input placeholder="<?= $pj_row['p_incharge'] ?>" type="text" class="form-control" disabled>
						  </td>
					  </tr> 
					  <tr>
						  <th scope="row">项目类型</th>
						  <td>
							  <input placeholder="<?= $pj_row['type'] ?>" type="text" class="form-control" disabled>
						  </td>
						  <th scope="row">项目分类</th>
						  <td>
							  <input placeholder="<?= $pj_row['level'] ?>" type="text" class="form-control" disabled>
						  </td>
						  <th scope="row">施工照片</th>
						  <td class="files" colspan="3">
<?php
//$imgdir="pic/thumb/$pid";
$imgdir="pic/$pid";
if (is_dir($imgdir)){
	$imgs=scandir($imgdir);
	unset($imgs[0], $imgs[1]); // remove . and ..
	foreach($imgs as $img){
?>
							<img src="<?= "$imgdir/$img" ?>" class="img-fluid rounded float-left mr-1" alt="...">
<?php
	}
}
?>
<!--
							<span class="btn btn-sm btn-success fileinput-button">
								<i class="fa fa-plus"></i>
								<span>添 加</span>
								<input type="file" name="files[]" multiple="">
							</span>
-->
						  </td>
					  </tr> 
				  </tbody>
			  </table>
</div>
<!-- data from table projects end-->

		  <div id="nodata" class="alert alert-danger alert-dismissible fade show d-none" role="alert">
			  没有数据！
			  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
				  <span aria-hidden="true">&times;</span>
			  </button>
		  </div>

<!-- data from table progress start-->
		  <form method="post" class="position-relative" id="">
			<div class="dropdown position-absolute" id="dates">
					  <button class="btn btn-danger btn-sm dropdown-toggle" type="button">
						  <?= date('Y-m') ?>
					  </button>
					  <div class="dropdown-menu">
<?php for($i=date('n'); date('n') - $i < 12; $i--): ?>
						<a class="dropdown-item <?php if(date('n') == $i) echo 'active' ?>" href="#"><?= date('Y-m', mktime(0,0,0,$i,1)) ?></a>
<?php endfor ?>
					  </div>
			</div>
			  <table class="table table-bordered table-responsive-sm">
				  <thead>
					<tr>
					  <th scope="col" colspan="6">项目进度</th>
					</tr>
				  </thead>
				  <tbody>
					  <tr>
						  <th scope="row">建设阶段</th>
						  <td>
						  <select class="custom-select <?= $class ?>" name="phase" <?= $disabled ?>>
								<option value="开工" <?php if($pg_rows[0]['phase']=='开工') echo 'selected' ?>>开工</option>
								<option value="前期准备" <?php if($pg_rows[0]['phase']=='前期准备') echo 'selected' ?>>前期准备</option>
								<option value="完工" <?php if($pg_rows[0]['phase']=='完工') echo 'selected' ?>>完工</option>
							</select>
						  </td>
						  <th scope="row">填报人</th>
						  <td>
							  <input id="fillby" name="fillby" placeholder="<?= $pg_rows[0]['fillby'] ?>" type="text" class="form-control <?= $class ?>" <?= $disabled ?>>
						  </td>
						  <th scope="row">联系电话</th>
						  <td>
							  <input id="phone" name="phone" placeholder="<?= $pg_rows[0]['phone'] ?>" type="text" class="form-control <?= $class ?>" <?= $disabled ?>>
						  </td>
					  </tr> 
					  <tr>
						  <th scope="row">实际开工时间</th>
						  <td>
						  <input name="actual_start" placeholder="<?= $pg_rows[0]['actual_start'] ?>" type="date" class="form-control <?= $class ?>" <?= $disabled ?> value="<?= $pg_rows[0]['actual_start'] ?>">
						  </td>
						  <th scope="row">实际竣工时间</th>
						  <td>
							  <input name="actual_finish" placeholder="<?= $pg_rows[0]['actual_finish'] ?>" type="date" class="form-control <?= $class ?>" <?= $disabled ?> value="<?= $pg_rows[0]['actual_finish'] ?>">
						  </td>
						  <th scope="row">本月完成投资</th>
						  <td>
							  <div class="input-group position-relative">
								  <input id="invest_mon" name="invest_mon" placeholder="<?= $pg_rows[0]['invest_mon'] ?>" type="number" class="form-control rounded-right <?= $class ?>" <?= $disabled ?>>
								  <div class="input-group-append position-absolute">
									  <span class="input-group-text text-muted">万元</span>
								  </div>
							  </div>
						  </td>
					  </tr> 
<?php
if(isset($pg_rows[1]) && $pg_rows[0]['progress'] == $pg_rows[1]['progress'] && $pj_row['notes'] != 'noyellow'){
	$tdclass='table-warning dup';
	$alert1=1;
}
else{
	$tdclass='';
}
?>
					  <tr class="<?= $tdclass ?>">
						  <th scope="row">本月进展</th>
						  <td colspan="6">
						  <textarea id="prog" class="form-control <?= $class ?>" name="progress" rows="3" placeholder="<?= $pg_rows[0]['progress'] ?>" <?= $readonly ?>><?= $pg_rows[0]['progress'] ?></textarea>
						  </td>
					  </tr>
<?php
if(isset($pg_rows[1]) && $pg_rows[0]['problem'] == $pg_rows[1]['problem'] && $pj_row['notes'] != 'noyellow'){
	$tdclass='table-warning dup';
	$alert1=1;
}
else{
	$tdclass='';
}

// set alert to 1, render yellow color on projects page;
if(isset($alert1)){
	$sql="update projects set alert='1' where pid='$pid'";
	(new Db)->query($sql);
}
?>
					  <tr class="<?= $tdclass ?>">
						  <th scope="row">1月至本月进展</th>
						  <td colspan="6">
						  <textarea id="progress_from_jan" class="form-control <?= $class ?>" name="progress_from_jan" rows="6" placeholder="<?= $pg_rows[0]['progress_from_jan'] ?>" <?= $readonly ?>><?= $pg_rows[0]['progress_from_jan'] ?></textarea>
						  </td>
					  </tr>
					  <tr class="<?= $tdclass ?>">
						  <th scope="row">下月计划</th>
						  <td colspan="6">
						  <textarea id="next_step" class="form-control <?= $class ?>" name="next_step" rows="6" placeholder="<?= $pg_rows[0]['next_step'] ?>" <?= $readonly ?>><?= $pg_rows[0]['next_step'] ?></textarea>
						  </td>
					  </tr>
					  <tr class="<?= $tdclass ?>">
						  <th scope="row">存在的困难和问题</th>
						  <td colspan="6">
						  <textarea id="problem" class="form-control <?= $class ?>" name="problem" rows="6" placeholder="<?= $pg_rows[0]['problem'] ?>" <?= $readonly ?>><?= $pg_rows[0]['problem'] ?></textarea>
						  </td>
					  </tr>
<!-- data from table progress end-->
				  </tbody>
			  </table>
<?php if($ICanSubmitProgress): ?>
			  <button type="submit" class="btn btn-success" name="submit">提 交</button>
<?php endif ?>
		  </form>
		</div>

		<!-- tab 手续办理情况 -->
		<div class="tab-pane fade" id="procedure-pane" data-name="procedure" role="tabpanel">
<?php
include('procedure.php');
?>
		</div>

		<!-- tab 项目路线图 -->
		<div class="tab-pane fade" id="path-pane" data-name="path" role="tabpanel">
<?php include('path.php') ?>
		</div>

		</div>
		</main>
		</section>

		  </div>
<?php
require $inc . 'footer.php';
