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
		  <main>
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
						<td><?= $v['pid'] ?></td>
						<td><?= $v['pid'] ?></td>
						<td><?= $v['pid'] ?></td>
						<td><?= $v['pid'] ?></td>
						<td><?= $v['pid'] ?></td>
						<td><?= $v['pid'] ?></td>
						<td><?= $v['pid'] ?></td>
						<td><?= $v['pid'] ?></td>
						<td><?= $v['pid'] ?></td>
						<td><?= $v['pid'] ?></td>
						<td><?= $v['pid'] ?></td>
						<td><?= $v['pid'] ?></td>
						<td><?= $v['pid'] ?></td>
						<td><?= $v['pid'] ?></td>
						<td><?= $v['pid'] ?></td>
						<td><?= $v['pid'] ?></td>
						<td><?= $v['pid'] ?></td>
						<td><?= $v['pid'] ?></td>
						<td><?= $v['pid'] ?></td>
						<td><?= $v['pid'] ?></td>
						<td><?= $v['pid'] ?></td>
						<td><?= $v['pid'] ?></td>
					</tr>
<?php endforeach ?>
				</tbody>
			</table>
		  </main>
		</div>
