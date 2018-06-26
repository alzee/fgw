<?php
use App\Db;

$oid = $_SESSION['oid'];
// prepare data
$sql = "select name from `procedure`";
$procedures = (new Db)->query($sql);
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
			<table class="table table-responsive table-sm table-striped table-bordered">
				<thead class="thead-light">
					<tr>
<?php foreach($procedures as $v): ?>
						<th scope="col"><?= $v['name'] ?></th>
<?php endforeach ?>
					</tr>
				</thead>
				<tbody>
				</tbody>
			</table>
		  </main>
		</div>
		<script src="<?= $root ?>/js/xlsx.full.min.js"></script>
