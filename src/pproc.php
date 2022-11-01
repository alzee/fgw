<?php
require $inc . 'header.php';
/*
 * 导出报表 -- 手续代办
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

$sql = "select parent,num,code,name from procedure_name";
$allprocs = (new Db)->query($sql);

$son = $allprocs;
// $pra = $allprocs;
foreach ($allprocs as $k => $v){
	if ($v['num'] == 0){
		$pra[$v['parent']]=$v;
		// unset($pra[$k]);
		unset($son[$k]);
	}
	else {
		// $pra[$v['parent']]['son'] = [];
		$pra[$v['parent']]['son'][$v['num']] = $v;
		// unset($pra[$k]);
	}
}
// var_dump($son);
// var_dump($allprocs);
// var_dump($pra);

// prepare data
$sql = "select p1.pid, pname, proxy_status, p1.* from (select pname, procedures.*  from projects left join procedures on (procedures.pid = projects.pid)) p1 left join (select pid,proxy_status from progress where date like '${month}%') p3  on (p3.pid = p1.pid) order by p1.pid";
$proc = (new Db)->query($sql);
// var_dump($proc);

$desc = ['无办理项', '未办理', '办理中', '已办结'];

$a_ppro = 'active';
require $inc . 'nav_stat.php';
?>

		  <div class="col mt-1 mt-sm-0">
		  </div>

		  <div class="col-auto">
			<div class="dropdown" id="dates_stat">
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

		  <div class="col-auto mt-1 mt-sm-0">
			<button class="btn btn-sm btn-info" id="exportbtn">导出报表</button>
		  </div>
		  </div>
		  <main class="mt-2" id="stat">

		<table class="table table-bordered table-responsive" id="stat_table">
			<tbody>
<!-- thead row 1 -->
				<tr>
						<th scope="col" rowspan="2">项目编号</th>
						<th scope="col" rowspan="2">项目名称</th>
						<th scope="col" rowspan="2">本月手续代办及服务情况</th>
		<?php foreach ($pra as $v): ?>
		<th scope="col" colspan="<?= count($v['son']) ?>"><?= $v['name'] ?></th>
		<?php endforeach ?>
				</tr>

<!-- thead row 2 -->
				<tr>
		<?php foreach ($son as $v): ?>
		<th scope="col"><?= $v['name'] ?></th>
		<?php endforeach ?>
				</tr>

<!-- td -->
<?php foreach ($proc as $v): ?>
				<tr>
<td><?= $v['pid'] ?></td>
<?php array_shift($v) ?>
<td><?= $v['pname'] ?></td>
<?php array_shift($v) ?>
<?php
$class = "";
if (is_null($v['proxy_status'])) {
    $class = "bg-warning";
}
?>
<td class="<?= $class ?>"><?= $v['proxy_status'] ?></td>
<?php array_shift($v) ?>
<?php foreach ($v as $vv): ?>
<td><?= $desc[$vv] ?></td>
<?php endforeach ?>
				</tr>
<?php endforeach ?>
			</tbody>
		</table>

		  </main>
		</div>
		<script src="js/xlsx.full.min.js"></script>
<?php
require $inc . 'footer.php';
