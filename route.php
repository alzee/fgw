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

$path = explode("/", trim($_SERVER['PATH_INFO'], '/'));
$controller=$path[0];
$method=$path[1];
$parameter=$path[2];

require $inc . "header.php";

$login=Sign::check();

if($login){
	session_start(['name'=>'SID']);
	//var_dump($_SESSION);

	// we put some special case in switch
	switch($controller){
	case '':
		// the default page
		require $inc .  'project.php';
		break;
	case 'project':
		if(is_numeric($method)){
			$pid=$method;
			require $inc .  'progress.php';
		}
		else{
			require $inc .  'project.php';
		}
		break;
	case 'setting':
		require $inc .  'nav.php';
		if(empty($method) || $method == 'chpwd'){
			require $inc .  'chpwd.php';
		}
		else if(is_readable($inc . $method . '.php')){
			if($rid == 3){
				if($method == 'user'){
					if(empty($parameter)){
						require $inc .  'user.php';
					}
					else{
						require $inc .  'moduser.php';
					}
				}
				else{
					require $inc .  "$method.php";
				}
			}
			else{
				require $inc .  '404.php';
			}
		}
		else{
			require $inc .  '404.php';
		}
		break;
	default:
		if(is_readable($inc . $controller. '.php')){
			require $inc .  "$controller.php";
		}
		else{
			require $inc .  '404.php';
		}
	}
}
else{
	require $inc . 'login.php';
}

require $inc . 'footer.php';
