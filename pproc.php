<?php
use App\Db;

$oid = $_SESSION['oid'];
// prepare data
$sql = "select name from `procedure` where level=2";
$procedures = (new Db)->query($sql);

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
		  <div class="btn-group btn-group-sm col-6 col-sm-auto">
<?php if($rid ==3): ?>
			<a role="button" class="btn btn-info text-white" href="<?= "$root/$controller/$method/stat" ?>">统计汇总</a>
<?php endif ?>
		    <a role="button" class="btn btn-info text-white" href="<?= "$root/$controller/$method/allprog" ?>">进度月报</a>
		    <a role="button" class="btn btn-info text-white active" href="<?= "$root/$controller/$method/pproc" ?>">手续代办</a>
		  </div>

		  <div class="col-auto mt-1 mt-sm-0">
			<button class="btn btn-sm btn-info" id="exportbtn">导出报表</button>
		  </div>
		  </div>
		  <main class="mt-2" id="stat">
<!--
			<table class="table table-responsive table-sm table-striped table-bordered">
				<thead class="thead-light">
					<tr>
						<th scope="col">项目编号</th>
						<th scope="col">项目名称</th>
<?php foreach($procedures as $v): ?>
						<th scope="col"><?= $v['name'] ?></th>
<?php endforeach ?>
					</tr>
				</thead>
				<tbody>
				</tbody>
			</table>
-->

		<table class="table table-bordered table-responsive">
			<tbody>
				<tr>
						<th scope="col" rowspan="2">项目编号</th>
						<th scope="col" rowspan="2">项目名称</th>
		<?php foreach ($pra as $v): ?>
		<th scope="col" colspan="<?= $itemc ?>"><?= $v['name'] ?></th>
		<?php endforeach ?>
				</tr>
				<tr>
		<?php foreach ($son as $v): ?>
		<th scope="col"><?= $v['name'] ?></th>
		<?php endforeach ?>
				</tr>
			</tbody>
		</table>

		  </main>
		</div>
		<script src="<?= $root ?>/js/xlsx.full.min.js"></script>
