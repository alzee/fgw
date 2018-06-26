<?php
use App\Db;

$oid = $_SESSION['oid'];
// prepare data

$sql = "select parent,num,code,name from `procedure`";
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
$sql = "select pproc.*, pname from pproc join projects on pproc.pid=projects.pid";
$proc = (new Db)->query($sql);
// var_dump($proc);

$desc = ['无办理项', '未办理', '办理中', '已办结'];

$a_ppro = 'active';
require $inc . 'report_header.php';
?>

		  <div class="col mt-1 mt-sm-0">
		  </div>

		  <div class="col-auto mt-1 mt-sm-0">
			<button class="btn btn-sm btn-info" id="exportbtn">导出报表</button>
		  </div>
		  </div>
		  <main class="mt-2" id="stat">

		<table class="table table-bordered table-responsive" id="report_table">
			<tbody>
<!-- -->
				<tr>
						<th scope="col" rowspan="2">项目编号</th>
						<th scope="col" rowspan="2">项目名称</th>
		<?php foreach ($pra as $v): ?>
		<th scope="col" colspan="<?= $itemc ?>"><?= $v['name'] ?></th>
		<?php endforeach ?>
				</tr>

<!-- -->
				<tr>
		<?php foreach ($son as $v): ?>
		<th scope="col"><?= $v['name'] ?></th>
		<?php endforeach ?>
				</tr>

<!-- -->
<?php foreach ($proc as $v): ?>
				<tr>
<td><?= $v['pid'] ?></td>
<td><?= $v['pname'] ?></td>
<?php array_shift($v) ?>
<?php array_pop($v) ?>
<?php foreach ($v as $vv): ?>
<td><?= $desc[$vv] ?></td>
<?php endforeach ?>
				</tr>
<?php endforeach ?>
			</tbody>
		</table>

		  </main>
		</div>
		<script src="<?= $root ?>/js/xlsx.full.min.js"></script>
