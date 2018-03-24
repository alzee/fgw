<?php
use App\Db;
/*
 * prepare data
 */
$level="'一类'";
// $level="'一类','二类','三类'";
$thead = ['','项目个数','开工项目个数','开工率','今年计划投资','今年累计完成投资','投资进度'];
$tables =[
	['type','项目类型'],
	['property','建设性质'],
	['oname','责任单位'],
	['investby','投资主体'],
];

foreach($tables as &$table){
	// get count, sum_invest_plan, accumulate group by $table[0]
	$sql = "select $table[0],count(pid) count,sum(invest_plan) sum_plan, sum(invest_accum) sum_accum from projects j left join organization o on o.oid=j.oid where level in($level) group by $table[0]";
	$table[2]=(new Db)->query($sql);
	foreach($table[2] as &$v){
		// count for WIP projs and assign to the array
		$sql = "select count(j.pid) count_wip from projects j left join organization o on j.oid=o.oid where level in($level) and $table[0]='{$v["$table[0]"]}' and phase='开工'";
		$a = (new Db)->query($sql);
		$v['count_wip'] = $a['count_wip'];
		// calaculate wip ratio and assign to the array
		$v['r_wip'] = round($v['count_wip'] / $v['count'] * 100) . '%';
		// calaculate invest ratio and assign to the array
		$v['r_invest'] = round($v['sum_accum'] / $v['sum_plan'] * 100) . '%';
	}
	unset($v);
}
unset($table);

// now for investment group;
$tables[4]=['invest', '总投资',[
	['invest' => '1亿以下', '0 and 9999'],
	['invest' => '1亿至5亿', '10000 and 49999'],
	['invest' => '5亿至10亿', '50000 and 99999'],
	['invest' => '10亿至20亿', '100000 and 199999'],
	['invest' => '20亿至50亿', '200000 and 499999'],
	['invest' => '50亿以上', '500000 and 999999999']
]
];
foreach($tables[4][2] as &$v){
	$sql = "select count(investment) count,sum(invest_plan) sum_plan,sum(invest_accum) sum_accum from projects where investment between $v[0] and level in($level)";
	$a = (new Db)->query($sql);
	$v = array_merge($v, $a);
	// count for WIP projs and assign to the array
	$sql = "select count(pid) count_wip from projects where investment between $v[0] and level in($level) and phase='开工'";
	$a = (new Db)->query($sql);
	$v['count_wip'] = $a['count_wip'];
	// calaculate wip ratio and assign to the array
	$v['r_wip'] = round($v['count_wip'] / $v['count'] * 100) . '%';
	// calaculate invest ratio and assign to the array
	$v['r_invest'] = round($v['sum_accum'] / $v['sum_plan'] * 100) . '%';
	// clear talbe[4][2][i][0] since they are not useful after 'where investment between' clause;
	unset($v[0]);
}
unset($v);

/*
 * generate xls files if they're not exist
 */
if(!file_exists('xls/t.xls')){
}

require 'xlsx1.php';
?>
	  <div class="container" id="">
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
		<div class="btn-group btn-group-sm col-12 col-sm-auto">
			<a role="button" class="btn btn-info text-white active" href="<?= "$root/$controller/$method/stat" ?>">统计汇总</a>
		    <a role="button" class="btn btn-info text-white" href="<?= "$root/$controller/$method/allprog" ?>">进度月报</a>
		</div>
		  <div class="col-auto align-self-center pr-0">
			<span class="badge badge-info">仅一类</span>
		  </div>
		  <div class="col align-self-center">
			<span class="badge badge-info">单位：万元</span>
		  </div>
		<form method="post" actio="<?= "$root/dl" ?>">
		  <div class="col-auto">
<!--
		    <button type="sumbit" class="btn btn-info" name="submit" value="1">导出报表</button>
-->
			<a class="btn btn-sm btn-info" href="<?= "$root/xlsx/统计汇总.xlsx" ?>">导出报表</a>
		  </div>
		</form>
	  </div>
		  <main class="mt-2" id="stat1">
<?php foreach($tables as $table): ?>
			<table class="table table-sm table-striped table-bordered">
				<thead class="thead-light">
					<tr>
<?php $thead[0] = $table[1]; foreach($thead as $v): ?>
						<th scope="col"><?= $v ?></th>
<?php endforeach ?>
					</tr>
				</thead>
				<tbody>
<?php $count=['合计',0,0,'',0,0,''];foreach($table[2] as $v): ?>
<?php $count[1]+=$v['count']; ?>
<?php $count[2]+=$v['count_wip']; ?>
<?php $count[4]+=$v['sum_plan']; ?>
<?php $count[5]+=$v['sum_accum']; ?>
					<tr>
						<td><?= $v["$table[0]"] ?></td>
						<td><?= $v['count'] ?></td>
						<td><?= $v['count_wip'] ?></td>
						<td><?= $v['r_wip'] ?></td>
						<td><?= $v['sum_plan'] ?></td>
						<td><?= $v['sum_accum'] ?></td>
						<td><?= $v['r_invest'] ?></td>
					</tr>
<?php endforeach ?>
<?php $count[3] = round($count[2] / $count[1] * 100) . '%' ?>
<?php $count[6] = round($count[5] / $count[4] * 100) . '%' ?>
					<tr class="font-weight-bold">
<?php foreach($count as $v): ?>
						<td><?= $v ?></td>
<?php endforeach ?>
					</tr>
				</tbody>
			</table>
<?php endforeach ?>

		  </main>
		</div>
