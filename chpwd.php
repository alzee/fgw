<?php
// hanlde form submission
// var_dump($_SESSION);
$uid = $_SESSION['uid'];
$rid = $_SESSION['rid'];
if($parameter){
	$uname=$parameter;
}
else {
	$uname=$_SESSION['uname'];
}
if($_POST){
	// var_dump($_POST);
	// if pass1 and pass2 match
	if($rid == 3 && $uname == $parameter){
		if($_POST['newpw1'] == $_POST['newpw2']){
			$sql = "select passwd from users where uid=$uid";
			$oldpw = (new Db)->query($sql);
			// if oldpw is correct
			if (md5($_POST['oldpw']) == $oldpw['passwd']){
				$sql = "update users set passwd='" . md5($_POST['newpw1']) . "' where uid=$uid";
				(new Db)->query($sql);

				header("Location: $root/$controller/$method");
				exit;
			}
			else{
				$err='原密码错误';
			}
		}
		else{
			$err='新密码两次输入不一致';
		}
	}
}

// prepare data
?>
		<section class="row">
			<aside class="col-md-2">
				<div class="list-group">
				  <a href="#" class="list-group-item list-group-item-action">公告通知</a>
				  <a href="#" class="list-group-item list-group-item-action">固定资产投资</a>
				  <a href="<?= "$root/project" ?>" class="list-group-item list-group-item-action">重点项目进展</a>
				  <a href="<?= "$root/setting/chpwd" ?>" class="list-group-item list-group-item-action active">设置</a>
<!--
					<div class="list-group list-group-flush ml-3">
					  <a href="#" class="list-group-item list-group-item-action my-1 active rounded">修改密码</a>
					  <a href="#" class="list-group-item list-group-item-action my-1 border-0 rounded">用户管理</a>
					  <a href="<?= "$root/project" ?>" class="list-group-item list-group-item-action my-1 border-0 rounded">统计报表</a>
					  <a href="<?= "$root/setting/chpwd" ?>" class="list-group-item list-group-item-action my-1 border-0 rounded">上传报表</a>
					  <a href="<?= "$root/setting/chpwd" ?>" class="list-group-item list-group-item-action my-1 border-0 rounded">更多设置</a>
					</div>
-->
				</div>
			</aside>

		  <main class="col-md">
<?php if(isset($err)): ?>
			<div class="alert alert-danger fade show col-sm-5 mx-auto">
			<?= $err ?>
			  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
				  <span aria-hidden="true">&times;</span>
			  </button>
			</div>
<?php endif ?>
		  <form method="post">
		  <div class="input-group mb-3 col-sm-5 mx-auto">
			  <div class="input-group-prepend">
				  <span class="input-group-text">用户名</span>
			  </div>
			  <input class="form-control" type="text" placeholder="<?= $uname ?>" disabled name="uname">
		  </div>
<?php if($rid != 3 || $uname != $parameter): ?>
		  <div class="input-group mb-3 col-sm-5 mx-auto">
			  <div class="input-group-prepend">
				  <span class="input-group-text">原密码</span>
			  </div>
			  <input type="password" class="form-control" name="oldpw" required>
		  </div>
<?php endif ?>
		  <div class="input-group mb-3 col-sm-5 mx-auto">
			  <div class="input-group-prepend">
				  <span class="input-group-text">新密码</span>
			  </div>
			  <input type="password" class="form-control" name="newpw1" required>
		  </div>
<?php if($rid != 3 || $uname != $parameter): ?>
		  <div class="input-group mb-3 col-sm-5 mx-auto">
			  <div class="input-group-prepend">
				  <span class="input-group-text">密码确认</span>
			  </div>
			  <input type="password" class="form-control" name="newpw2" required>
		  </div>
<?php endif ?>
		  <button type="submit" class="btn btn-success d-block mx-auto">提 交</button>
		  </form>

		  </main>
		</section>
		</div>
