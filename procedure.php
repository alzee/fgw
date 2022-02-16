<?php
/*
 *  手续办理情况
 */

use App\Db;

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
// var_dump($pra);
// echo count($pra);


// prepare data
$sql = "select * from procedures where pid=$pid";
$proc = (new Db)->query($sql);
// var_dump($proc);

// if i'm not o_serve, disable all radios
if ($oid != $pj_row['oid_serve'] && $oid != $pj_row['oid_serve_1']) {
	$dis = 'disabled';
    $ICanSubmitPrecedure = false;
}
else {
    $dis = '';
    $ICanSubmitPrecedure = true;
}


?>

<table class="table table-bordered table-responsive-sm">
	<tbody>
<tr>
<th colspan="2">本月手续代办及服务情况</th>
<td id="proxy_status_wrapper">
<textarea id="proxy_status" class="form-control" name="proxy_status" placeholder="<?= $pg_rows[0]['proxy_status'] ?>" rows="6" <?= $dis ?>><?= $pg_rows[0]['proxy_status'] ?></textarea>
<?php if ($ICanSubmitPrecedure): ?>
<button id="proxy_status_btn" type="submit" class="btn btn-success" name="submit" disabled>
    <span id="proxy_status_btn_spin" class="" role="status" aria-hidden="true"></span>
    <span id="proxy_status_btn_text">提 交</span>
</button>
<?php endif ?>
</td>
</tr>
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
			<td class = "proc-options" >
<?php
$check3='';
$check2='';
$check1='';
$check0='';

switch ($proc[$v['code']]){
case NULL:
	break;
case 3:
	$check3='checked';
	break;
case 2:
	$check2='checked';
	break;
case 1:
	$check1='checked';
	break;
case 0:
	$check0='checked';
	break;
}
?>
				<div class="custom-control custom-radio custom-control-inline procradio">
					<input type="radio" id="<?= $v['code'] . '-3' ?>" name="<?= $v['code'] ?>" class="custom-control-input" <?= $check3 . ' ' . $dis ?>>
					<label class="custom-control-label" for="<?= $v['code'] . '-3' ?>">已办结</label>
				</div>
				<div class="custom-control custom-radio custom-control-inline procradio">
					<input type="radio" id="<?= $v['code'] . '-2' ?>" name="<?= $v['code'] ?>" class="custom-control-input" <?= $check2 . ' ' . $dis ?>>
					<label class="custom-control-label" for="<?= $v['code'] . '-2' ?>">办理中</label>
				</div>
				<div class="custom-control custom-radio custom-control-inline procradio">
					<input type="radio" id="<?= $v['code'] . '-1' ?>" name="<?= $v['code'] ?>" class="custom-control-input" <?= $check1 . ' ' . $dis ?>>
					<label class="custom-control-label" for="<?= $v['code'] . '-1' ?>">未办理</label>
				</div>
				<div class="custom-control custom-radio custom-control-inline procradio">
					<input type="radio" id="<?= $v['code'] . '-0' ?>" name="<?= $v['code'] ?>" class="custom-control-input" <?= $check0 . ' ' . $dis ?>>
					<label class="custom-control-label" for="<?= $v['code'] . '-0' ?>">无办理项</label>
				</div>
                <span class="spinner text-primary" role="status" aria-hidden="true"></span>
			</td>
		</tr>
<?php endforeach ?>
	</tbody>
</table>
