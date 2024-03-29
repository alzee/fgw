<?php
require $inc . "header.php";
require $inc .  'nav.php';
use App\Db;
if($_POST){
	//var_dump($_POST);
	foreach($_POST as $v){
		if(empty($v)){
			$v=0;
			break;
		}
	}
	// if anyone in $_POST is empty, not do this
	if($v){
		// valiate uname
		$newuser = $_POST['uname'];
		$newpass = md5($_POST['passwd']);
		$o = ['options' => ['regexp' => '/^[[:alpha:]]\w{2,9}$/']];
		
		// if username is valid
		if(filter_var($newuser, FILTER_VALIDATE_REGEXP, $o)){
			// we only allow lower case
			$newuser = strtolower($newuser);
			
			// if username not duplicate
			$sql = "select uname from users where uname='$newuser'";
			if((new Db)->query($sql)==null){
				$sql="insert into users (uname, passwd, oid, rid) values('$newuser', '$newpass', '${_POST['oid']}', '${_POST['rid']}')";
				//echo $sql;
				(new Db)->query($sql);
				//header('Location: /fgw/admin/users');
				header("Location: /$controller/$method");
				exit;
			}
			else{
				$_SESSION['alert'] = 2;
				$_SESSION['newuser'] = $newuser;
				header("Location: /$controller/$method");
				exit;
			}
		}
		else{
			$_SESSION['alert'] = 1;
			header("Location: /$controller/$method");
			exit;
		}
	}
}

$sql="select rid,rname from role";
$r_rows=(new Db)->query($sql);

$sql="select oid,oname from organization";
$o_rows=(new Db)->query($sql);

$sql="select users.uid,uname,organization.oname,role.rname from users join (organization,role) on (organization.oid=users.oid and users.rid=role.rid) order by uid";
$u_rows=(new Db)->query($sql);

//var_dump($_SESSION);
?>
		  <main id="userlist">
<?php if (isset($_SESSION['alert'])): ?>
		  <div class="alert alert-danger alert-dismissible fade show" role="alert">
<?php if($_SESSION['alert'] == 1): ?>
		  用户名由字母和数字组成，不能包含特殊字符，长度3至10位。第一位不能是数字！
<?php endif ?>
<?php if($_SESSION['alert']== 2): ?>
		  用户名 <?= $_SESSION['newuser']?> 已存在，试试别的！
<?php unset($_SESSION['newuser']) ?>
<?php endif ?>
			  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
				  <span aria-hidden="true">&times;</span>
			  </button>
		  </div>
<?php unset($_SESSION['alert']) ?>
<?php endif ?>

		  <div class="row mb-3">
			  <form class="form-row col-sm" method="post">
				  <div class="col-sm pr-0 mb-1">
					  <input type="text" class="form-control" name="uname" placeholder="用户名" required>
				  </div>
				  <div class="col-sm pr-0 mb-1">
					  <input type="password" class="form-control" name="passwd" placeholder="密 码" required>
				  </div>
				  <div class="col-sm pr-0 mb-1">
					  <select class="form-control" name="oid">
<?php foreach($o_rows as $row): ?>
<option value="<?= $row['oid'] ?>"><?= $row['oname'] ?></option>
<?php endforeach ?>
					  </select>
				  </div>
				  <div class="col-sm pr-0 mb-1">
					  <select class="form-control" name="rid">
<?php foreach($r_rows as $row): ?>
<option value="<?= $row['rid'] ?>"><?= $row['rname'] ?></option>
<?php endforeach ?>
					  </select>
				  </div>
				  <div class="col-auto mb-1">
					  <button type="submit" class="btn btn-success">添加用户</button>
				  </div>
			  </form>

			  <div class="col-sm-3">
				  <input class="form-control" id="search" type="text" placeholder="搜索用户" aria-label="Search">
				  <span class="position-absolute d-none" id="clearsearch">×</span>
			  </div>
		  </div>
		  <table class="table table-hover">
			  <thead class="thead-light">
				  <tr>
					  <th scope="col">#</th>
					  <th scope="col">用户名</th>
					  <th scope="col">机 构</th>
					  <th scope="col">角 色</th>
				  </tr>
			  </thead>
			  <tbody>
<?php foreach($u_rows as $row): ?>
				  <tr class="searchable">
				  <th scope="row"><?= $row['uid'] ?></th>
					  <td><?= $row['uname'] ?></td>
					  <td><?= $row['oname'] ?></td>
					  <td><?= $row['rname'] ?></td>
				  </tr>
<?php endforeach; ?>
			  </tbody>
		  </table>
		  </main>
		</div>
<?php
require $inc . 'footer.php';
