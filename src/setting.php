<?php
require $inc . "header.php";
require $inc .  'nav.php';
use App\Db;
if(!empty($_POST)){
	//var_dump($_POST);
	foreach($_POST as $k=>$v){
		if(!empty($v)){
			$sql="update setting set value=";
			$sql.="'". $v . "'" . " where s_key='" . $k . "'";
			//echo $sql . "\n";
			(new Db)->query($sql);
			//header('Location: /fgw/admin/misc');
			header("Location: $controller/$method");
			exit;
		}
	}
}

$sql='select * from setting';
$s_rows=(new Db)->query($sql);
?>


		  <main>
			<form method="post" action="">
<?php foreach($s_rows as $row): ?>
		  <div class="input-group mb-3 col-sm-6 mx-auto">
			  <div class="input-group-prepend">
			  <span class="input-group-text"><?= $row['sname'] ?></span>
			  </div>
			  <input type="text" placeholder="<?= $row['value'] ?>" class="form-control" name="<?= $row['s_key'] ?>">
<!--
				<div class="input-group-append">
					<span class="input-group-text">天</span>
				</div>
-->
		  </div>
<?php endforeach ?>
		  <button type="submit" class="btn btn-success d-block mx-auto">提 交</button>
			</form>
		  </main>
		</div>
<?php
require $inc . 'footer.php';
