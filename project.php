<?php
$sql="select pid,projects.oid,pname,investment,oname,p_incharge,property,alert from projects join organization on projects.oid=organization.oid";
// $sql="select pid,oid,pname,investment,o_incharge,p_incharge,property,alert from projects";
$p_rows=(new Db)->query($sql);

$oid=$_SESSION['oid'];
$rid=$_SESSION['rid'];
$rid == 3 ? $myproj_btn = 'btn-outline-secondary' : $myproj_btn = 'btn-primary';
?>

	  <div class="container" id="projects">
		  <nav aria-label="breadcrumb" class="">
			  <div class="">
				  <ol class="breadcrumb">
				  <li class="breadcrumb-item"><a href="<?= $root ?>">首 页</a></li>
					  <li class="breadcrumb-item active" aria-current="page">重点项目</li>
				  </ol>
			  </div>
		  </nav>

		  <main>
		  <div class="row mb-3">
			  <div class="col-sm">
				  <!--
				  <span class="badge badge-success">已完成</span>
				  -->
				  <span class="badge badge-warning">数据与上月雷同</span>
				  <span class="badge badge-danger">上个月未提交</span>
			  </div>
<?php if($rid == 3): ?>
			  <div class="col-auto col-sm-2">
				  <a id="newproject" role="button" class="btn btn-success" href="<?= $root ?>/newproject">新增项目</a>
			  </div>
<?php endif ?>
			  <div class="col-auto col-sm-2">
				  <button id="myproject" type="button" class="btn <?= $myproj_btn ?>" data-oid="<?= $oid ?>">我的项目</button>
			  </div>
			  <div class="col col-sm-3">
				  <input class="form-control" id="search" type="text" placeholder="搜索项目" aria-label="Search">
			  </div>
		  </div>
		  <table class="table table-hover">
			  <thead>
				  <tr>
					  <th scope="col">#</th>
					  <th scope="col">项目名称</th>
					  <th scope="col">总投资</th>
					  <th scope="col">责任单位</th>
					  <th scope="col">包联领导</th>
					  <th scope="col">建设性质</th>
				  </tr>
			  </thead>
			  <tbody>

<?php foreach($p_rows as $row): ?>
<?php
if($row['oid'] == $oid || $rid == 3){
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
<!--
					  <td><?= $row['o_incharge'] ?></td>
-->
					  <td><?= $row['p_incharge'] ?></td>
					  <td><?= $row['property'] ?></td>
				  </tr>
<?php endforeach; ?>
			  </tbody>
		  </table>
		  </main>
		</div>
