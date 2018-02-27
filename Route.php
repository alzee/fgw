<?php
/**
 * vim:ft=php
 * @author Dotcra <dotcra@gmail.com>
 * @version
 * @todo
 */

$root="/fgw";
$inc="./";
$static="./";
$sessionname='SID';

date_default_timezone_set('Asia/Shanghai');

$path = explode("/", $_SERVER['PATH_INFO']);
$controller=$path[1];
$method=$path[2];
$parameter=$path[3];

require $inc . "header.php";

$login=Sign::check();

if($login){
	session_start(['name'=>'SID']);
	//var_dump($_SESSION);
	// $controller ? : $controller='home';
	if(!isset($controller)){
		$sql = "select value from setting where s_key='index'";
		$row = (new Db)->query($sql);
		$controller = $row['value'];
	}

	if($controller=='project' && is_numeric($method)){
		$pid=$method;
		require $inc . "progress.php";
	}
	else if($controller=='setting') {
		require $inc . "nav.php";

		if(empty($method) || $method == 'chpwd'){
			require $inc . "chpwd.php";
		}
		else if($method == 'user' && !empty($parameter)){
			require $inc . "moduser.php";
		}
		else if(is_readable($inc . $method. '.php')){
			if($rid==3){
				require $inc . $method. ".php";
			}
			else{
				require $inc . '404.php';
			}
		}
		else{
			require $inc . '404.php';
		}
	}
	else{
		if(is_readable($inc . $controller . '.php')){
			require $inc . $controller . '.php';
		}
		else{
			require $inc . "404.php";
		}
	}
}
else{
	require $inc . 'login.php';
}

require $inc . 'footer.php';
