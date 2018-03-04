<?php
// prepare data
$month = date('Y-m');
$prev_month = date('Y-m', strtotime('first day of last month'));

$sql ="select j.pid,pname,property,intro,investment,invest_plan,start,finish,investby,p_incharge,o1.oname,o2.oname oname_serve,implementor,type,date,phase,fillby,phone,progress,problem,invest_mon,limit_start,limit_end from projects j left join ((select * from progress where date like '$prev_month%') g, organization o1, organization o2) on (j.pid=g.pid and j.oid=o1.oid and j.oid_serve=o2.oid) order by j.pid";
$rows=(new Db)->query($sql);

require 'e.php';
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
		  <div class="btn-group col">
<?php if($rid ==3): ?>
			<a role="button" class="btn btn-danger text-white" href="<?= "$root/$controller/$method/stat" ?>">统计汇总</a>
<?php endif ?>
		    <a role="button" class="btn btn-danger text-white active" href="<?= "$root/$controller/$method/allprog" ?>">进度月报</a>
		  </div>
		  <div class="col-auto">
			<div class="dropdown" id="dates">
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
		<form method="post" actio="<?= "$root/dl" ?>">
		  <div class="col-auto">
		    <button type="sumbit" class="btn btn-info" name="submit" value="1">导出报表</button>
		  </div>
		</form>
		  </div>
		  <main class="mt-2" id="stat">
			<table class="table table-responsive table-sm table-striped table-bordered">
				<thead class="thead-light">
					<tr>
						<th scope="col">项目编号</th>
						<th scope="col">项目名称</th>
						<th scope="col">建设性质</th>
						<th scope="col">建设内容</th>
						<th scope="col">总投资</th>
						<th scope="col">今年计划投资</th>
						<th scope="col">实际开工时间</th>
						<th scope="col">实际竣工时间</th>
						<th scope="col">投资主体</th>
						<th scope="col">包联领导</th>
						<th scope="col">责任单位</th>
						<th scope="col">服务单位</th>
						<th scope="col">施工单位</th>
						<th scope="col">项目类型</th>
						<th scope="col">更新时间</th>
						<th scope="col">建设阶段</th>
						<th scope="col">填报人</th>
						<th scope="col">联系电话</th>
						<th scope="col">本月进展</th>
						<th scope="col">问题和建议</th>
						<th scope="col">本月完成投资</th>
						<th scope="col">实际建设期限开始</th>
						<th scope="col">实际建设期限结束</th>
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
