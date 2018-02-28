<?php
// hanlde form submission
$uid = $_SESSION['uid'];
$uname=$_SESSION['uname'];
$uname1=$parameter;
if($uname == $uname1){
	$disabled = 'disabled';
}

if($_POST){
	if(!isset($disabled)){
		$cols='';
		if(isset($_POST['oid']) && $_POST['oid'] != 0){
			$cols .= "oid={$_POST['oid']},";
		}
		if(isset($_POST['rid']) && $_POST['rid'] != 0){
			$cols .= "rid={$_POST['rid']},";
		}
		if(!empty($_POST['newpw1'])){
			$newpw = md5($_POST['newpw1']);
			$cols .= "passwd='$newpw',";
		}
		if(!empty($cols)){
			$cols = rtrim($cols, ',');
			$sql = "update users set $cols where uname='$uname1'";
			(new Db)->query($sql);
		}

		header("Location: $root/$controller/$method/$parameter");
		exit;
	}
	else{
		$err = '你不能改自己的哦!';
	}
}

/*
 * prepare date
 * 
 */
// user organization and role
$sql = "select uname,oname,rname from users u,organization o,role r where uname='$uname1' and o.oid=u.oid and u.rid=r.rid";
$u_row = (new Db)->query($sql);

// if is myself, we don't need to query sql for the lists since we never use it
if(!isset($disabled)){
	// organization list for select options;
	$sql = "select * from organization";
	$o_rows = (new Db)->query($sql);

	// role list for select options;
	$sql = "select rid,rname from role";
	$r_rows = (new Db)->query($sql);
}
?>
		<section class="row">
			<aside class="col-md-2">
				<div class="list-group">
				  <a href="#" class="list-group-item list-group-item-action">公告通知</a>
				  <a href="#" class="list-group-item list-group-item-action">固定资产投资</a>
				  <a href="<?= "$root/project" ?>" class="list-group-item list-group-item-action">重点项目进展</a>
				  <a href="<?= "$root/admin/chpwd" ?>" class="list-group-item list-group-item-action active">设置</a>
				</div>
			</aside>

		  <main class="col-md mt-2">
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
			  <input class="form-control" type="text" placeholder="<?= $uname1 ?>" disabled name="uname">
		  </div>
		  <div class="input-group mb-3 col-sm-5 mx-auto">
			  <div class="input-group-prepend">
				  <span class="input-group-text">机 构</span>
			  </div>
			  <select class="custom-select" name="oid" <?= $disabled ?>>
				<option value="0"><?= $u_row['oname'] ?></option>
<?php if(!isset($disabled)): ?>
<?php foreach($o_rows as $v): ?>
				<option value="<?= $v['oid'] ?>"><?= $v['oname'] ?></option>
<?php endforeach ?>
<?php endif ?>
			  </select>
		  </div>
		  <div class="input-group mb-3 col-sm-5 mx-auto">
			  <div class="input-group-prepend">
				  <span class="input-group-text">角 色</span>
			  </div>
			  <select class="custom-select" name="rid" <?= $disabled ?>>
				<option value="0"><?= $u_row['rname'] ?></option>
<?php if(!isset($disabled)): ?>
<?php foreach($r_rows as $v): ?>
				<option value="<?= $v['rid'] ?>"><?= $v['rname'] ?></option>
<?php endforeach ?>
<?php endif ?>
			  </select>
		  </div>
		  <div class="input-group mb-3 col-sm-5 mx-auto">
			  <div class="input-group-prepend">
				  <span class="input-group-text">新密码</span>
			  </div>
			  <input type="password" class="form-control" name="newpw1" <?= $disabled ?>>
		  </div>
		  <button type="submit" class="btn btn-success d-block mx-auto" <?= $disabled ?>>提 交</button>
		  </form>

		  </main>
		</section>
		</div>
