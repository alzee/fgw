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
use App\Xlsx2db;
use App\Controller\Hi;

class Route
{
	static function go(){
		$root = "/fgw";
		$inc = "../src/";
		$sessionname = 'SID';

		date_default_timezone_set('Asia/Shanghai');

		if (isset($_SERVER['PATH_INFO'])) {
			$path = explode("/", trim($_SERVER['PATH_INFO'], '/'));
		}
		$controller = $path[0] ?? 'project';	// the default page
		$method = $path[1] ?? '';
		$parameter = $path[2] ?? '';
		$pp = $path[3] ?? '';

		$login = Sign::check();

		if ($login) {
			session_start(['name'=>'SID']);
			$rid = $_SESSION['rid'];
			// var_dump($_SESSION);

			// we put some special case in switch
			switch ($controller) {
			case 'project':
                if (empty($method)) {
                    require $inc .  'project.php';
                }
                else if (is_numeric($method)) {
					$pid = $method;
					require $inc .  'progress.php';
				}
				else {
                    require $inc .  '404.php';
				}
				break;
            case 'stat':
					if (empty($method)) {
						if ($rid == 3){
                            $method = 'stat';
						}
						else {
                            $method = 'allprog';
						}
					}
					else if ($method == 'stat') {
						if ($rid == 3) {
                            $method = 'stat';
						}
						else {
                            $method = '404';
						}
					}
					else if (!is_readable($inc . "${method}.php")) {
                        $method = '404';
					}
                    require $inc .  "${method}.php";
                break;
			case 'admin':
				if (empty($method) || $method == 'chpwd') {
					require $inc .  'chpwd.php';
				}
				else if ($rid == 3) {
					switch ($method) {
					case 'user':
						if (empty($parameter)) {
							require $inc .  'user.php';
						}
						else {
							require $inc .  'moduser.php';
						}
						break;
					default:
						if (is_readable($inc . "$method.php")) {
							require $inc .  "$method.php";
						}
						else {
							require $inc .  '404.php';
						}
					}
				}
				else {
					require $inc .  '404.php';
				}
				break;
      case 'xlsx2db':
        Xlsx2db::showTables();
        break;
      case 'fields':
        Xlsx2db::descTable();
        break;
      case 'updatedb':
        Xlsx2db::updateDb();
        break;
      case 'hi':
          Hi::index();
          break;
			default:
				if (is_readable($inc . "$controller.php")) {
					require $inc .  "$controller.php";
				}
				else {
					require $inc .  '404.php';
				}
			}
		}
		else {
			require $inc . 'login.php';
		}
	}
}
