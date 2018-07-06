<?php
use App\Db;

// prepare data
$sql = "select * from path where pid=$pid";
$path = (new Db)->query($sql);
// var_dump($path);
unset($path['pid']);
unset($path['location']);
// var_dump($path);

$theads = '';
?>

<table class="table table-bordered table-responsive-sm" id="path_table">
<thead>
<tr>
<th rowspan="2">年度建设任务</th>
<th colspan="2">一季度工作计划</th>
<th colspan="2">二季度工作计划</th>
<th colspan="2">三季度工作计划</th>
<th colspan="2">四季度工作计划</th>
</tr>
<tr>
<th>形象进度</th>
<th>投资</th>
<th>形象进度</th>
<th>投资</th>
<th>形象进度</th>
<th>投资</th>
<th>形象进度</th>
<th>投资</th>
</tr>
</thead>
<tbody>

<!--
<tr>
<td><?= $path['annual_task'] ?></td>
<td><?= $path['q1_p'] ?></td>
<td><?= $path['q1_i'] ?></td>
<td><?= $path['q2_p'] ?></td>
<td><?= $path['q2_i'] ?></td>
<td><?= $path['q3_p'] ?></td>
<td><?= $path['q3_i'] ?></td>
<td><?= $path['q4_p'] ?></td>
<td><?= $path['q4_i'] ?></td>
</tr>
-->

<tr>
<?php foreach ($path as $v): ?>
<td><?= $v ?></td>
<?php endforeach ?>
</tr>
</tbody>
</table>
