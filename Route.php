<?php
/**
 * vim:ft=php
 * @author Dotcra <dotcra@gmail.com>
 * @version
 * @todo
 */
namespace App;

use App\Db;
use App\Sign;

class Route
{
	static function go(){
		$root="/fgw";
		$inc="./";
		$static="./";
		$sessionname='SID';

		date_default_timezone_set('Asia/Shanghai');

		if (isset($_SERVER['PATH_INFO'])){
			$path = explode("/", trim($_SERVER['PATH_INFO'], '/'));
		}
		$controller=$path[0] ?? 'project';	// the default page
		$method=$path[1] ?? '';
		$parameter=$path[2] ?? '';

		require $inc . "header.php";

		$login=Sign::check();

		if($login){
			session_start(['name'=>'SID']);
			$rid=$_SESSION['rid'];
			// var_dump($_SESSION);

			// we put some special case in switch
			switch($controller){
			case 'project':
				if(is_numeric($method)){
					$pid=$method;
					require $inc .  'progress.php';
				}
				else if($method == 'report'){
					if(empty($parameter)){
						if($rid == 3){
							require $inc . 'stat.php';
						}
						else{
							require $inc . 'allprog.php';
						}
					}
					else if($parameter == 'stat'){
						if($rid == 3){
							require $inc . 'stat.php';
						}
						else{
							require $inc . '404.php';
						}
					}
					else if(is_readable($inc . "$parameter.php")){
						require $inc .  "$parameter.php";
					}
					else{
						require $inc .  '404.php';
					}
				}
				else{
					require $inc .  'project.php';
				}
				break;
			case 'admin':
				require $inc .  'nav.php';
				if(empty($method) || $method == 'chpwd'){
					require $inc .  'chpwd.php';
				}
				else if($rid == 3){
					switch($method){
					case 'user':
						if(empty($parameter)){
							require $inc .  'user.php';
						}
						else{
							require $inc .  'moduser.php';
						}
						break;
					default:
						if(is_readable($inc . "$method.php")){
							require $inc .  "$method.php";
						}
						else{
							require $inc .  '404.php';
						}
					}
				}
				else{
					require $inc .  '404.php';
				}
				break;
			default:
				if(is_readable($inc . "$controller.php")){
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
	}
}
