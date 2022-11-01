<?php
require $inc . 'header.php';
/*
 *  统计报表->进度月报
 */
use App\Db;

$oid = $_SESSION['oid'];
// prepare data
if (empty($pp)){
	$month = date('Y-m');
}
else {
	$month = $pp;
}
$prev_month = date('Y-m', strtotime('first day of last month'));

$thead= ['项目编号','项目名称','建设性质','建设内容','总投资','今年计划投资','本月完成投资','今年累计完成投资','计划开工时间','计划竣工时间','包联领导','责任单位','服务单位','项目类型','建设阶段','本月进展','1月至本月进展','下月计划','困难和问题'];

// $sql ="select j.pid,pname,property,intro,investment,invest_plan,invest_mon,invest_accum,start,finish,p_incharge,o1.oname,o2.oname oname_serve,type,g.phase,progress,problem,j.oid from projects j left join ((select * from progress where date like '$month%') g, organization o1, organization o2) on (j.pid=g.pid and j.oid=o1.oid and j.oid_serve=o2.oid) order by j.pid";

$sql = "select j.pid,pname,property,intro,investment,invest_plan,g.invest_mon,invest_accum,start,finish,p_incharge,oname,oname_serve,type,g.phase,g.progress,g.progress_from_jan,g.next_step,g.problem,j.oid
   	from 
	(select j.*,o1.oname,o2.oname oname_serve from projects j left join (organization o1, organization o2) on (j.oid=o1.oid and j.oid_serve=o2.oid)) j 
	left join 
	(select * from progress where date like '$month%') g on j.pid=g.pid where online = 1 order by j.pid";
$rows=(new Db)->query($sql);

$sql = "select type,count(*) as count from projects group by type;";
$types = (new Db)->query($sql);

$a_allp = 'active';
require $inc . 'nav_stat.php';
?>
		  <div class="col-6 col-sm align-self-center">
			<span class="badge badge-info">单位：万元</span>
		  </div>

		  <div class="col-auto">
			<div class="dropdown" id="dates_report">
					  <button class="btn btn-info btn-sm dropdown-toggle dropdown-link" id="month" type="button">
						  <?= $month ?>
					  </button>
					  <div class="dropdown-menu">
<?php for($i=date('n'); date('n') - $i < 12; $i--): ?>
						<a class="dropdown-item <?php if(date('Y-m', mktime(0,0,0,$i,1)) == $month) echo 'active' ?>" href="<?= "/$controller/$method/" . date('Y-m', mktime(0,0,0,$i,1)) ?>"><?= date('Y-m', mktime(0,0,0,$i,1)) ?></a>
<?php endfor ?>
					  </div>
			</div>
		  </div>

			  <div class="col-auto col-sm-auto pr-0 mt-1 mt-sm-0">
				  <button id="myproject" type="button" class="btn btn-sm btn-outline-info" data-oid="<?= $oid ?>">
					我的项目 <span class="badge badge-danger" id="count_my"></span>
				  </button>
			  </div>

			<div class="col-auto pr-0 dropdown mt-1 mt-sm-0">
			  <button class="btn btn-info btn-sm dropdown-toggle" id="type_btn" type="button">所有类型 <span class="badge badge-danger count_all">0</span>
			  </button>
			  <div class="dropdown-menu" id="type_menu">
				<a class="dropdown-item active" href="#">所有类型 <span class="badge badge-danger count_all">0</span></a>
<?php foreach ($types as $type): ?>
                <a class="dropdown-item" href="#"><?= $type['type'] ?> <span class="badge badge-danger count">0</span></a>
<?php endforeach; ?>
			  </div>
			</div>

		  <div class="col-auto mt-1 mt-sm-0">
			<button class="btn btn-sm btn-info" id="exportbtn">导出报表</button>
		  </div>
		  </div>
		  <main class="mt-2" id="stat">
			<table class="table table-responsive table-sm table-striped table-bordered" id="stat_table">
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
<?php foreach($row as $k => $v): ?>
<?php
$class = "";
if ($k == 'intro') $class = "intro";
if (($k == 'progress' || $k == 'next_step' || $k == 'problem') && is_null($v)) $class = "bg-danger";
?>
						<td class="<?= $class ?>"><?= $v ?></td>
<?php endforeach ?>
					</tr>
<?php endforeach ?>
				</tbody>
			</table>
		  </main>
		</div>
		<script src="/js/xlsx.full.min.js"></script>
<?php
require $inc . 'footer.php';
