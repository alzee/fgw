<?php
// $sql = "select code,name from proc where parent='0'";
// $r = (new Db)->query($sql);

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
// var_dump($pra);
// echo count($pra);
?>

<table class="table table-bordered">
	<tbody>
<?php foreach ($son as $v): ?>
		<tr>
<?php if ($v['num'] == 1): ?>
<?php
$itemc = count($pra[$v['parent']]['son']);
?>
			<th scope="col" rowspan="<?= $itemc ?>">
<?= $pra[$v['parent']]['name'] ?>
			</th>
<?php endif ?>
			<td class="procname2">
<?= $v['name'] ?>
			</td>
			<td>
				<div class="custom-control custom-radio custom-control-inline">
					<input type="radio" id="<?= $v['code'] . '-3' ?>" name="<?= $v['code'] ?>" class="custom-control-input">
					<label class="custom-control-label" for="<?= $v['code'] . '-3' ?>">已办结</label>
				</div>
				<div class="custom-control custom-radio custom-control-inline">
					<input type="radio" id="<?= $v['code'] . '-2' ?>" name="<?= $v['code'] ?>" class="custom-control-input">
					<label class="custom-control-label" for="<?= $v['code'] . '-2' ?>">办理中</label>
				</div>
				<div class="custom-control custom-radio custom-control-inline">
					<input type="radio" id="<?= $v['code'] . '-1' ?>" name="<?= $v['code'] ?>" class="custom-control-input">
					<label class="custom-control-label" for="<?= $v['code'] . '-1' ?>">未办理</label>
				</div>
				<div class="custom-control custom-radio custom-control-inline">
					<input type="radio" id="<?= $v['code'] . '-0' ?>" name="<?= $v['code'] ?>" class="custom-control-input">
					<label class="custom-control-label" for="<?= $v['code'] . '-0' ?>">无办理项</label>
				</div>
			</td>
		</tr>
<?php endforeach ?>
	</tbody>
</table>
