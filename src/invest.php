<?php
require $inc . "header.php";
?>
<!-- 固定资产投资 -->
	  <div class="container" id="invest">
		  <nav aria-label="breadcrumb" class="position-relative">
				  <ol class="breadcrumb">
				  <li class="breadcrumb-item"><a href="<?= "$root/home" ?>">首 页</a></li>
				  <li class="breadcrumb-item active">固定资产投资</li>
				  </ol>
		  </nav>
		<section class="row">
			<aside class="col-md-auto">
				<div class="list-group">
				  <a href="#" class="list-group-item list-group-item-action">公告通知</a>
				  <a href="<?= "$root/invest" ?>" class="list-group-item list-group-item-action active">固定资产投资</a>
				  <a href="<?= "$root/project" ?>" class="list-group-item list-group-item-action">重点项目进展</a>
				  <a href="<?= "$root/admin/chpwd" ?>" class="list-group-item list-group-item-action">设置</a>
				</div>
			</aside>

		  <main class="col-md mt-2">
	<table class="table table-bordered table-responsive-sm">
		<thead>
			<th colspan="10">
				茅箭区2018年1-3月固定资产投资完成情况
			</th>
			<tr>
				<th scope="col" colspan="2">指标</th>
				<th scope="col">全区</th>
				<th scope="col">武当</th>
				<th scope="col">二堰</th>
				<th scope="col">五堰</th>
				<th scope="col">开发区</th>
				<th scope="col">大川镇</th>
				<th scope="col">塞武当</th>
				<th scope="col">茅塔</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<th scope="row" rowspan="2">固定资产投资(万元)</th>
				<td>总量</td>
				<td>374921</td>
				<td>57030</td>
				<td>98910</td>
				<td>82561</td>
				<td>123520</td>
				<td>7300</td>
				<td>2700</td>
				<td>2900</td>
			</tr>
			<tr>
				<td>增幅%</td>
				<td>18.4</td>
				<td>17.8</td>
				<td>18.1</td>
				<td>18.4</td>
				<td>18.2</td>
				<td>32.7</td>
				<td>31.7</td>
				<td>9.4</td>
			</tr>
			<tr>
				<th scope="row" rowspan="3">施工项目个数</th>
				<td>本月</td>
				<td>6</td>
				<td>2</td>
				<td>−</td>
				<td>2</td>
				<td>2</td>
				<td>−</td>
				<td>−</td>
				<td>−</td>
			</tr>
			<tr>
				<td>累计</td>
				<td>78</td>
				<td>12</td>
				<td>15</td>
				<td>17</td>
				<td>25</td>
				<td>2</td>
				<td>2</td>
				<td>5</td>
			</tr>
			<tr>
				<td>增减</td>
				<td>17</td>
				<td>4</td>
				<td>-12</td>
				<td>5</td>
				<td>15</td>
				<td>1</td>
				<td>1</td>
				<td>3</td>
			</tr>
		</tbody>
	</table>
	</main>
</section>
<?php
require $inc . 'footer.php';
?>
