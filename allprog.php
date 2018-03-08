<?php
use App\Db;
// prepare data
$month = date('Y-m');
$prev_month = date('Y-m', strtotime('first day of last month'));

$thead= ['项目编号','项目名称','建设性质','建设内容','总投资','今年计划投资','今年累计完成投资','本月完成投资','计划开工时间','计划竣工时间','包联领导','责任单位','服务单位','项目类型','建设阶段','本月进展','问题和建议'];

$sql ="select j.pid,pname,property,intro,investment,invest_plan,invest_mon,sum_year,start,finish,p_incharge,o1.oname,o2.oname oname_serve,type,phase,progress,problem from projects j left join ((select * from progress where date like '$month%') g, organization o1, organization o2) on (j.pid=g.pid and j.oid=o1.oid and j.oid_serve=o2.oid) order by j.pid";
$rows=(new Db)->query($sql);

require 'xlsx.php';
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
		  <div class="btn-group col-auto">
<?php if($rid ==3): ?>
			<a role="button" class="btn btn-danger text-white" href="<?= "$root/$controller/$method/stat" ?>">统计汇总</a>
<?php endif ?>
		    <a role="button" class="btn btn-danger text-white active" href="<?= "$root/$controller/$method/allprog" ?>">进度月报</a>
		  </div>
		  <div class="col align-self-center">
			<span class="badge badge-warning">单位：万元</span>
		  </div>
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
		<form method="post" action="<?= "$root/dl" ?>">
		  <div class="col-auto">
<!--
		    <button type="sumbit" class="btn btn-info" name="submit" value="1">导出报表</button>
-->
			<a class="btn btn-info" href="<?= "$root/xlsx/allprog.xlsx" ?>">导出报表</a>
		  </div>
		</form>
		  </div>
		  <main class="mt-2" id="stat">
			<table class="table table-responsive table-sm table-striped table-bordered">
				<thead class="thead-light">
					<tr>
<?php foreach($thead as $v): ?>
						<th scope="col"><?= $v ?></th>
<?php endforeach ?>
					</tr>
				</thead>
				<tbody>
<?php foreach($rows as $v): ?>
					<tr>
<?php foreach($v as $vv): ?>
						<td><?= $vv ?></td>
<?php endforeach ?>
					</tr>
<?php endforeach ?>
				</tbody>
			</table>
		  </main>
		</div>
