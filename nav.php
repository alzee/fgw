<?php
$rid=$_SESSION['rid'];
?>
	  <div class="container" id="<?= $controller ?>">
		  <nav class="mx-0 mb-3 row justify-content-between" id="nav">
			  <ol class="breadcrumb mb-0">
			  <li class="breadcrumb-item"><a href="<?= "$root/home" ?>">首 页</a></li>
				  <li class="breadcrumb-item active" aria-current="page">设 置</li>
			  </ol>
			  <div class="mx-3">
			  <div class="btn-group btn-group-sm mb-2 my-2" role="group">
				  <a role="button" href="<?= $root ?>/admin/chpwd" class="btn btn-danger <?php if($method=='chpwd' || $method == "") echo 'active'; ?>">修改密码</a>
<?php if($rid==3): ?>
				  <a role="button" href="<?= $root ?>/admin/user" class="btn btn-danger <?php if($method=='user') echo 'active'; ?>">用户管理</a>
<!--
				  <a role="button" href="<?= $root ?>/admin/upload" class="btn btn-danger <?php if($method=='upload') echo 'active'; ?>">上传报表</a>
-->
				  <a role="button" href="<?= $root ?>/admin/setting" class="btn btn-danger <?php if($method=='setting') echo 'active'; ?>">更多设置</a>
<?php endif ?>
			  </div>
			  </div>
		  </nav>
