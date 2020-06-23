<?php
/* 
 * 项目路线图
 */
use App\Db;

// prepare data
$sql = "select q2_p,q2_i,q3_p,q3_i,q4_p,q4_i from path where pid=$pid";
$rows = (new Db)->query($sql);
// unset($rows['pid']);
// unset($rows['location']);
// var_dump($rows);

$theads = '';
?>

<table class="table table-bordered table-responsive-sm" id="rows_table">
<thead>
<tr>
<!--
<th rowspan="2">年度建设任务</th>
-->
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
</tr>
</thead>
<tbody>

<tr>
<?php foreach ($rows as $v): ?>
<td><?= $v ?></td>
<?php endforeach ?>
</tr>
</tbody>
</table>
