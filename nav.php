<?php
$rid=$_SESSION['rid'];
?>
	  <div class="container" id="admin">
		  <nav aria-label="breadcrumb" class="position-relative">
			  <ol class="breadcrumb">
			  <li class="breadcrumb-item"><a href="<?= "$root/home" ?>">首 页</a></li>
				  <li class="breadcrumb-item active" aria-current="page">设 置</li>
			  </ol>
			  <div id="adminbtn" class="btn-group btn-group-sm position-absolute" role="group" aria-label="">
				  <a role="button" href="<?= $root ?>/admin/chpwd" class="btn btn-danger <?php if($method=='chpwd' || $method == "") echo 'active'; ?>">修改密码</a>
<?php if($rid==3): ?>
				  <a role="button" href="<?= $root ?>/admin/user" class="btn btn-danger <?php if($method=='user') echo 'active'; ?>">用户管理</a>
				  <a role="button" href="<?= $root ?>/admin/report" class="btn btn-danger <?php if($method=='report') echo 'active'; ?>">统计报表</a>
<!--
				  <a role="button" href="<?= $root ?>/admin/upload" class="btn btn-danger <?php if($method=='upload') echo 'active'; ?>">上传报表</a>
-->
				  <a role="button" href="<?= $root ?>/admin/misc" class="btn btn-danger <?php if($method=='misc') echo 'active'; ?>">更多设置</a>
<?php endif ?>
			  </div>
		  </nav>
