<?php
// hanlde form submission
if($_POST){
	echo 'you send some data';
	var_dump($_POST);
}

// prepare data
if($parameter){
	$uname=$parameter;
}
else {
	$uname=$_SESSION['uname'];
}
?>
		<section class="row">
			<aside class="col-md-2">
				<div class="list-group">
				  <a href="#" class="list-group-item list-group-item-action">公告通知</a>
				  <a href="#" class="list-group-item list-group-item-action">固定资产投资</a>
				  <a href="<?= "$root/project" ?>" class="list-group-item list-group-item-action">重点项目进展</a>
				  <a href="<?= "$root/setting/chpwd" ?>" class="list-group-item list-group-item-action active">设置</a>
				</div>
			</aside>

		  <main class="col-md">
		  <form method="post">
		  <div class="input-group mb-3 col-sm-5 mx-auto">
			  <div class="input-group-prepend">
				  <span class="input-group-text">用户名</span>
			  </div>
			  <input class="form-control" type="text" placeholder="<?= $uname ?>" disabled name="uname">
		  </div>
		  <div class="input-group mb-3 col-sm-5 mx-auto">
			  <div class="input-group-prepend">
				  <span class="input-group-text">原密码</span>
			  </div>
			  <input type="password" class="form-control" name="oldpw">
		  </div>
		  <div class="input-group mb-3 col-sm-5 mx-auto">
			  <div class="input-group-prepend">
				  <span class="input-group-text">新密码</span>
			  </div>
			  <input type="password" class="form-control" name="newpw1">
		  </div>
		  <div class="input-group mb-3 col-sm-5 mx-auto">
			  <div class="input-group-prepend">
				  <span class="input-group-text">密码确认</span>
			  </div>
			  <input type="password" class="form-control" name="newpw2">
		  </div>
		  <button type="submit" class="btn btn-success d-block mx-auto">提 交</button>
		  </form>

		  </main>
		</section>
		</div>
