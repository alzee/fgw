<?php
require $inc . 'header.php';
use App\Db;
if(!empty($_POST)){
	$uname=$_POST['uname'];
	$passwd=md5($_POST['passwd']);
	($_POST['remember']==='on') ? $cookielife = 3600 * 24 * 365 : $cookielife = 0;
	// so this is the authentication
	$sql="select uid,uname,passwd,oid,rid from users where uname='$uname' and passwd='$passwd'";
	$user_row = (new Db)->query($sql);
	if($user_row){
		// session 
		#session_id(session_create_id());
		session_start(['name' => 'SID', 'cookie_lifetime' => $cookielife, 'cookie_path' => '']);
		// register to $_SESSION elements;
		foreach($user_row as $k => $v){
			$_SESSION[$k] = $v;
		}

		// cookies
		setcookie('user',$_SESSION['uname'], time()+3600*24*365);

		//require 'home.php';
		//require 'footer.php';
		header("Location: /project");
		exit;
	}
	else{
		$wrong=1;
	}
}

if (isset($_COOKIE['user'])) {
    $user = $_COOKIE['user'];
} else {
    $user = '';
}
?>
    <div class="container">
      <form class="form-signin" method="post">
	  	<h4 class="form-signin-heading text-muted"><?= $sitename ?></h4>
<?php if (isset($wrong)) : ?>
		<div class="alert alert-danger alert-dismissible fade show">
			用户名或密码错误！
			  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
				  <span aria-hidden="true">&times;</span>
			  </button>
		</div>
<?php endif ?>
        <label for="inputUsername" class="sr-only">uname</label>
		<input type="text" id="inputUsername" class="form-control mb-3" placeholder="用户名" name="uname" value="<?= $user ?>" required autofocus>
        <label for="inputPassword" class="sr-only">passwd</label>
        <input type="password" id="inputPassword" class="form-control mb-3" placeholder="密  码" name="passwd" required>
		<button class="btn btn-lg btn-primary btn-block" type="submit">登 录</button>
	  </form>
	</div>
<!--
  <script src="md5.js"></script>
-->
<?php
require $inc . 'footer.php';
