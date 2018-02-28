<?php
// hanlde form submission
$uid = $_SESSION['uid'];
$rid = $_SESSION['rid'];
$uname=$_SESSION['uname'];
if($_POST){
}

// prepare data
$sql ="select * from projects j join progress g on j.pid=g.pid where date like '2018-02%' order by j.pid";
$rows=(new Db)->query($sql);
?>
		  <div class="row">
		  <div class="btn-group col">
		    <a role="button" class="btn btn-danger text-white" href="">统计汇总</a>
		    <a role="button" class="btn btn-danger text-white active" href="">进度月报</a>
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
		  <div class="col-auto">
		    <button type="button" class="btn btn-info">导出报表</button>
		  </div>
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
						<th scope="col">更新日期</th>
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
						<td><?= $v['pid'] ?></td>
						<td><?= $v['pname'] ?></td>
						<td><?= $v['property'] ?></td>
						<td><?= $v['intro'] ?></td>
						<td><?= $v['investment'] ?></td>
						<td><?= $v['invest_plan'] ?></td>
						<td><?= $v['start'] ?></td>
						<td><?= $v['finish'] ?></td>
						<td><?= $v['investby'] ?></td>
						<td><?= $v['p_incharge]'] ?></td>
						<td><?= $v['oid'] ?></td>
						<td><?= $v['oid_serve'] ?></td>
						<td><?= $v['implementor'] ?></td>
						<td><?= $v['type'] ?></td>
						<td><?= $v['date'] ?></td>
						<td><?= $v['phase'] ?></td>
						<td><?= $v['fillby'] ?></td>
						<td><?= $v['phone'] ?></td>
						<td><?= $v['progress'] ?></td>
						<td><?= $v['problem'] ?></td>
						<td><?= $v['invest_mon'] ?></td>
						<td><?= $v['limit_start'] ?></td>
						<td><?= $v['limit_end'] ?></td>
					</tr>
<?php endforeach ?>
				</tbody>
			</table>
		  </main>
		</div>
