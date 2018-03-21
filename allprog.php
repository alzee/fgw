<?php
use App\Db;

$oid = $_SESSION['oid'];
// prepare data
$month = date('Y-m');
$prev_month = date('Y-m', strtotime('first day of last month'));

$thead= ['项目编号','项目名称','建设性质','建设内容','总投资','今年计划投资','本月完成投资','今年累计完成投资','计划开工时间','计划竣工时间','包联领导','责任单位','服务单位','项目类型','建设阶段','本月进展','问题和建议'];

$sql ="select j.pid,pname,property,intro,investment,invest_plan,invest_mon,invest_accum,start,finish,p_incharge,o1.oname,o2.oname oname_serve,type,g.phase,progress,problem,j.oid from projects j left join ((select * from progress where date like '$month%') g, organization o1, organization o2) on (j.pid=g.pid and j.oid=o1.oid and j.oid_serve=o2.oid) order by j.pid";
$rows=(new Db)->query($sql);

//require 'xlsx.php';
?>
	  <div class="container">
		  <nav>
			  <div>
				  <ol class="breadcrumb">
				  <li class="breadcrumb-item"><a href="<?= "$root/home" ?>">首 页</a></li>
				  <li class="breadcrumb-item"><a href="<?= "$root/project" ?>">重点项目</a></li>
				  <li class="breadcrumb-item active">统计报表</li>
				  </ol>
			  </div>
		  </nav>

		  <div class="row">
		  <div class="btn-group btn-group-sm col-auto">
<?php if($rid ==3): ?>
			<a role="button" class="btn btn-danger text-white" href="<?= "$root/$controller/$method/stat" ?>">统计汇总</a>
<?php endif ?>
		    <a role="button" class="btn btn-danger text-white active" href="<?= "$root/$controller/$method/allprog" ?>">进度月报</a>
		  </div>
		  <div class="col align-self-center">
			<span class="badge badge-warning">单位：万元</span>
		  </div>
<!--
		  <div class="col-auto">
			<div class="dropdown" id="dates_report">
					  <button class="btn btn-info dropdown-toggle" type="button">
						  <?= date('Y-m') ?>
					  </button>
					  <div class="dropdown-menu">
<?php for($i=date('n'); date('n') - $i < 12; $i--): ?>
						<a class="dropdown-item <?php if(date('n') == $i) echo 'active' ?>" href="#"><?= date('Y-m', mktime(0,0,0,$i,1)) ?></a>
<?php endfor ?>
					  </div>
			</div>
		  </div>
-->
			  <div class="col-auto col-sm-auto pr-0 mt-1 mt-sm-0">
				  <button id="myproject" type="button" class="btn btn-sm btn-outline-secondary" data-oid="<?= $oid ?>">
					我的项目 <span class="badge badge-danger" id="count_my"></span>
				  </button>
			  </div>

			<div class="col-auto pr-0 dropdown mt-1 mt-sm-0">
			  <button class="btn btn-dark btn-sm dropdown-toggle" id="type_btn" type="button">所有类型 <span class="badge badge-danger count_all">0</span>
			  </button>
			  <div class="dropdown-menu" id="type_menu">
				<a class="dropdown-item active" href="#">所有类型 <span class="badge badge-danger count_all">0</span></a>
				<a class="dropdown-item" href="#">工 业 <span class="badge badge-danger count">0</span></a>
				<a class="dropdown-item" href="#">商 贸 <span class="badge badge-danger count">0</span></a>
				<a class="dropdown-item" href="#">基 建 <span class="badge badge-danger count">0</span></a>
				<a class="dropdown-item" href="#">乡村振兴 <span class="badge badge-danger count">0</span></a>
			  </div>
			</div>

		  <div class="col-auto">
			<button class="btn btn-sm btn-info" id="exportbtn">导出报表</button>
		  </div>
		  </div>
		  <main class="mt-2" id="stat">
			<table class="table table-responsive table-sm table-striped table-bordered" id="allprog">
				<thead class="thead-light">
					<tr>
<?php foreach($thead as $v): ?>
						<th scope="col"><?= $v ?></th>
<?php endforeach ?>
					</tr>
				</thead>
				<tbody>
<?php foreach($rows as $row): ?>
<?php if ($oid == $row['oid']) {
	$class = 'searchable myprog';
}
else {
	$class = 'searchable';
}
?>
					<tr class="<?= $class ?>" data-type="<?= $row['type'] ?>" data-oid="<?= $row['oid'] ?>">
<?php
// remove col oid so it won't be output as a td;
unset($row['oid']);
?>
<?php foreach($row as $v): ?>
						<td><?= $v ?></td>
<?php endforeach ?>
					</tr>
<?php endforeach ?>
				</tbody>
			</table>
		  </main>
		</div>
		<script src="<?= $root ?>/js/xlsx.full.min.js"></script>
