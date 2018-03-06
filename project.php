<?php
$sql="select pid,p.oid,pname,investment,o1.oname,p_incharge,o2.oname oname_serve,alert from projects p join (organization o1, organization o2) on (p.oid=o1.oid and p.oid_serve=o2.oid)";
$p_rows=(new Db)->query($sql);

$oid=$_SESSION['oid'];
if($rid == 3 || $rid == 2){
	$myproj_btn = 'btn-outline-secondary';
}
else{
	$myproj_btn = 'btn-primary';
}
// $rid == 3 ? $myproj_btn = 'btn-outline-secondary' : $myproj_btn = 'btn-primary';
?>

	  <div class="container" id="projects">
		  <nav aria-label="breadcrumb" class="">
			  <div class="">
				  <ol class="breadcrumb">
				  <li class="breadcrumb-item"><a href="<?= "$root/home" ?>">首 页</a></li>
					  <li class="breadcrumb-item active" aria-current="page">重点项目</li>
				  </ol>
			  </div>
		  </nav>
		<section class="row">
			<aside class="col-md-auto">
				<div class="list-group">
				  <a href="#" class="list-group-item list-group-item-action">公告通知</a>
				  <a href="#" class="list-group-item list-group-item-action">固定资产投资</a>
				  <a href="<?= "$root/project" ?>" class="list-group-item list-group-item-action active">重点项目进展</a>
				  <a href="<?= "$root/admin/chpwd" ?>" class="list-group-item list-group-item-action">设置</a>
				</div>
			</aside>

		  <main class="col-md mt-2">
		  <div class="row mb-2">
			  <div class="col-sm">
				  <!--
				  <span class="badge badge-success">已完成</span>
				  -->
				  <span class="badge badge-warning">数据与上月雷同</span>
				  <span class="badge badge-danger">本月尚未提交</span>
			  </div>
<?php if($rid == 3): ?>
			  <div class="col-auto col-sm-auto pr-0">
				  <a id="newproject" role="button" class="btn btn-success" href="<?= $root ?>/newproject">新增项目</a>
			  </div>
<?php endif ?>
			  <div class="col-auto col-sm-auto pr-0">
				  <a role="button" class="btn btn-info text-white" href="<?= "$root/project/report" ?>">统计报表</a>
			  </div>
			  <div class="col-auto col-sm-auto pr-0">
				  <button id="myproject" type="button" class="btn <?= $myproj_btn ?>" data-oid="<?= $oid ?>">我的项目</button>
			  </div>
			  <div class="col-sm-3 mt-1 mt-sm-0">
				  <input class="form-control" id="search" type="text" placeholder="搜索项目" aria-label="Search">
				  <span class="position-absolute d-none" id="clearsearch">×</span>
			  </div>
		  </div>
		  <table class="table table-hover table-responsive-sm">
			  <thead>
				  <tr>
					  <th scope="col">#</th>
					  <th scope="col">项目名称</th>
					  <th scope="col">总投资</th>
					  <th scope="col">责任单位</th>
					  <th scope="col">包联领导</th>
					  <th scope="col">代办单位</th>
				  </tr>
			  </thead>
			  <tbody>

<?php foreach($p_rows as $row): ?>
<?php
if($row['oid'] == $oid || $rid == 3 || $rid == 2){
	$class="searchable";
}
else{
	$class="d-none";
}

switch($row['alert']){
case 1:
	$class .=' bg-warning';
	break;
case 2:
	$class .=' bg-danger';
	break;
}
?>
	<tr class="<?= $class ?>" data-oid="<?= $row['oid'] ?>">
				  <th scope="row"><?= $row['pid'] ?></th>
					  <td><?= $row['pname'] ?></td>
					  <td><?= $row['investment'] ?></td>
					  <td><?= $row['oname'] ?></td>
					  <td><?= $row['p_incharge'] ?></td>
					  <td><?= $row['oname_serve'] ?></td>
				  </tr>
<?php endforeach; ?>
			  </tbody>
		  </table>
		  </main>
		</section>
		</div>
