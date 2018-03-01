<?php
/*
 * prepare data
 */
$sql = "select count(pid) a from projects";
$count = (new Db)->query($sql)['a'];

// group by type
// $sql = "select type,count(pid) count,count(pid)/(select count(pid) from projects) ratio from projects group by type";
$sql = "select type,count(pid) count from projects group by type";
$t_rows=(new Db)->query($sql);

// group by property
$sql = "select property,count(pid) count from projects group by property";
$p_rows=(new Db)->query($sql);

// group by oname
$sql = "select oname,count(pid) count from projects p join organization o on o.oid=p.oid group by p.oid";
$o_rows=(new Db)->query($sql);

// group by oname_serve
$sql = "select oname,count(pid) count from projects p join organization o on o.oid=p.oid_serve group by p.oid_serve";
$s_rows=(new Db)->query($sql);

// group by investby
$sql = "select investby,count(pid) count from projects group by investby";
$ib_rows=(new Db)->query($sql);

// group by investment
$sql = "select count(investment) count from projects where investment < 10000";
$a=(new Db)->query($sql);
$sql = "select count(investment) count from projects where investment between 10000 and 49999";
$b=(new Db)->query($sql);
$sql = "select count(investment) count from projects where investment between 50000 and 99999";
$c=(new Db)->query($sql);
$sql = "select count(investment) count from projects where investment between 100000 and 199999";
$d=(new Db)->query($sql);
$sql = "select count(investment) count from projects where investment between 200000 and 499999";
$e=(new Db)->query($sql);
$sql = "select count(investment) count from projects where investment >= 500000";
$f=(new Db)->query($sql);

/*
 * generate xls files if they're not exist
 */
if(!file_exists('xls/t.xls')){
}
if(!file_exists('xls/p.xls')){
}
if(!file_exists('xls/o.xls')){
}
if(!file_exists('xls/s.xls')){
}
if(!file_exists('xls/ib.xls')){
}
if(!file_exists('xls/i.xls')){
}
?>
		  <div class="row">
		  <div class="btn-group col">
			<a role="button" class="btn btn-danger text-white active" href="<?= "$root/$controller/$method/stat" ?>">统计汇总</a>
		    <a role="button" class="btn btn-danger text-white" href="<?= "$root/$controller/$method/allprog" ?>">进度月报</a>
		  </div>
		<form method="post" actio="<?= "$root/dl" ?>">
		  <div class="col-auto">
		    <button type="sumbit" class="btn btn-info" name="submit" value="1">导出报表</button>
		  </div>
		</form>
		  </div>
		  <main class="mt-2" id="stat1">
			<table class="table table-sm table-striped table-bordered">
				<thead class="thead-light">
					<tr>
						<th class="w-25" scope="col">项目类型</th>
						<th class="w-25" scope="col">项目个数</th>
						<th class="w-25" scope="col">占 比</th>
					</tr>
				</thead>
				<tbody>
<?php $count1=0;foreach($t_rows as $v): ?>
<?php $count1+=$v['count']; ?>
					<tr>
						<td><?= $v['type'] ?></td>
						<td><?= $v['count'] ?></td>
						<td><?= $v['count']/$count*100 . '%' ?></td>
					</tr>
<?php endforeach ?>
					<tr class="font-weight-bold">
						<td>合 计</td>
						<td><?= $count1 ?></td>
						<td></td>
					</tr>
				</tbody>
			</table>

			<table class="table table-sm table-striped table-bordered">
				<thead class="thead-light">
					<tr>
						<th class="w-25" scope="col">建设性质</th>
						<th class="w-25" scope="col">项目个数</th>
						<th class="w-25" scope="col">占 比</th>
					</tr>
				</thead>
				<tbody>
<?php $count1=0;foreach($p_rows as $v): ?>
<?php $count1+=$v['count']; ?>
					<tr>
						<td><?= $v['property'] ?></td>
						<td><?= $v['count'] ?></td>
						<td><?= $v['count']/$count*100 . '%' ?></td>
					</tr>
<?php endforeach ?>
					<tr class="font-weight-bold">
						<td>合 计</td>
						<td><?= $count1 ?></td>
						<td></td>
					</tr>
				</tbody>
			</table>

			<table class="table table-sm table-striped table-bordered">
				<thead class="thead-light">
					<tr>
						<th class="w-25" scope="col">责任单位</th>
						<th class="w-25" scope="col">项目个数</th>
						<th class="w-25" scope="col">占 比</th>
					</tr>
				</thead>
				<tbody>
<?php $count1=0;foreach($o_rows as $v): ?>
<?php $count1+=$v['count']; ?>
					<tr>
						<td><?= $v['oname'] ?></td>
						<td><?= $v['count'] ?></td>
						<td><?= $v['count']/$count*100 . '%' ?></td>
					</tr>
<?php endforeach ?>
					<tr class="font-weight-bold">
						<td>合 计</td>
						<td><?= $count1 ?></td>
						<td></td>
					</tr>
				</tbody>
			</table>

			<table class="table table-sm table-striped table-bordered">
				<thead class="thead-light">
					<tr>
						<th class="w-25" scope="col">服务单位</th>
						<th class="w-25" scope="col">项目个数</th>
						<th class="w-25" scope="col">占 比</th>
					</tr>
				</thead>
				<tbody>
<?php $count1=0;foreach($s_rows as $v): ?>
<?php $count1+=$v['count']; ?>
					<tr>
						<td><?= $v['oname'] ?></td>
						<td><?= $v['count'] ?></td>
						<td><?= $v['count']/$count*100 . '%' ?></td>
					</tr>
<?php endforeach ?>
					<tr class="font-weight-bold">
						<td>合 计</td>
						<td><?= $count1 ?></td>
						<td></td>
					</tr>
				</tbody>
			</table>

			<table class="table table-sm table-striped table-bordered">
				<thead class="thead-light">
					<tr>
						<th class="w-25" scope="col">投资主体</th>
						<th class="w-25" scope="col">项目个数</th>
						<th class="w-25" scope="col">占 比</th>
					</tr>
				</thead>
				<tbody>
<?php $count1=0;foreach($ib_rows as $v): ?>
<?php $count1+=$v['count']; ?>
					<tr>
						<td><?= $v['investby'] ?></td>
						<td><?= $v['count'] ?></td>
						<td><?= $v['count']/$count*100 . '%' ?></td>
					</tr>
<?php endforeach ?>
					<tr class="font-weight-bold">
						<td>合 计</td>
						<td><?= $count1 ?></td>
						<td></td>
					</tr>
				</tbody>
			</table>

			<table class="table table-sm table-striped table-bordered">
				<thead class="thead-light">
					<tr>
						<th class="w-25" scope="col">总投资</th>
						<th class="w-25" scope="col">项目个数</th>
						<th class="w-25" scope="col">占 比</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td>1万以下</td>
						<td><?= $a['count'] ?></td>
						<td><?= $a['count']/$count*100 . '%' ?></td>
					</tr>
					<tr>
						<td>1万至5万</td>
						<td><?= $b['count'] ?></td>
						<td><?= $b['count']/$count*100 . '%' ?></td>
					</tr>
					<tr>
						<td>5万至10万</td>
						<td><?= $c['count'] ?></td>
						<td><?= $c['count']/$count*100 . '%' ?></td>
					</tr>
					<tr>
						<td>10万至20万</td>
						<td><?= $d['count'] ?></td>
						<td><?= $d['count']/$count*100 . '%' ?></td>
					</tr>
					<tr>
						<td>20万至50万</td>
						<td><?= $e['count'] ?></td>
						<td><?= $e['count']/$count*100 . '%' ?></td>
					</tr>
					<tr>
						<td>50万以上</td>
						<td><?= $f['count'] ?></td>
						<td><?= $f['count']/$count*100 . '%' ?></td>
					</tr>
					<tr class="font-weight-bold">
						<td>合 计</td>
						<td><?= $a['count'] + $b['count'] + $c['count'] + $d['count'] + $e['count'] + $f['count'] ?></td>
						<td></td>
					</tr>
				</tbody>
			</table>
		  </main>
		</div>
