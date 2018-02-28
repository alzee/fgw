<?php
// prepare data
$sql ="select * from projects j join progress g on j.pid=g.pid where date like '2018-02%' order by j.pid";
$rows=(new Db)->query($sql);
?>
		  <div class="row">
		  <div class="btn-group col">
		    <a role="button" class="btn btn-danger text-white active" href="">统计汇总</a>
		    <a role="button" class="btn btn-danger text-white" href="">进度月报</a>
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
		  <main class="mt-2" id="stat1">
			<table class="table table-sm table-striped table-bordered">
				<thead class="thead-light">
					<tr>
						<th scope="col">项目类型</th>
						<th scope="col">项目个数</th>
						<th scope="col">占比</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td>111</td>
						<td>111</td>
						<td>111</td>
					</tr>
					<tr>
						<td>111</td>
						<td>111</td>
						<td>111</td>
					</tr>
					<tr>
						<td>111</td>
						<td>111</td>
						<td>111</td>
					</tr>
					<tr>
						<td>111</td>
						<td>111</td>
						<td>111</td>
					</tr>
					<tr>
						<td>111</td>
						<td>111</td>
						<td>111</td>
					</tr>
					<tr>
						<td>111</td>
						<td>111</td>
						<td>111</td>
					</tr>
				</tbody>
			</table>
			<table class="table table-sm table-striped table-bordered">
				<thead class="thead-light">
					<tr>
						<th scope="col">投资规模</th>
						<th scope="col">项目个数</th>
						<th scope="col">占比</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td>111</td>
						<td>111</td>
						<td>111</td>
					</tr>
					<tr>
						<td>111</td>
						<td>111</td>
						<td>111</td>
					</tr>
					<tr>
						<td>111</td>
						<td>111</td>
						<td>111</td>
					</tr>
					<tr>
						<td>111</td>
						<td>111</td>
						<td>111</td>
					</tr>
					<tr>
						<td>111</td>
						<td>111</td>
						<td>111</td>
					</tr>
					<tr>
						<td>111</td>
						<td>111</td>
						<td>111</td>
					</tr>
				</tbody>
			</table>
			<table class="table table-sm table-striped table-bordered">
				<thead class="thead-light">
					<tr>
						<th scope="col">责任单位</th>
						<th scope="col">项目个数</th>
						<th scope="col">占比</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td>111</td>
						<td>111</td>
						<td>111</td>
					</tr>
					<tr>
						<td>111</td>
						<td>111</td>
						<td>111</td>
					</tr>
					<tr>
						<td>111</td>
						<td>111</td>
						<td>111</td>
					</tr>
					<tr>
						<td>111</td>
						<td>111</td>
						<td>111</td>
					</tr>
					<tr>
						<td>111</td>
						<td>111</td>
						<td>111</td>
					</tr>
					<tr>
						<td>111</td>
						<td>111</td>
						<td>111</td>
					</tr>
				</tbody>
			</table>
		  </main>
		</div>
