<?php
/**
 * vim:ft=php
 * @author Dotcra <dotcra@gmail.com>
 * @version
 * @todo
 */

namespace App;

use Symfony\Component\Dotenv\Dotenv;

// some file not start from index.php
require_once 'vendor/autoload.php';

$dotenv = new Dotenv();
$dotenv->load(__DIR__.'/.env');

class Db{
	private $host;
	private $user;
	private $pass;
	private $db;
	private $mysqli;

	function __construct(){
		$this->host=$_ENV['host'];
		$this->user=$_ENV['user'];
		$this->pass=$_ENV['pw'];
		$this->db=$_ENV['db'];
		$this->mysqli=new \mysqli($this->host,$this->user, $this->pass, $this->db);
		if($this->mysqli->connect_errno){
			echo $this->mysqli->connect_errno. "\n";
			echo $this->mysqli->connect_error. "\n";
			//exit;
		}
		else{
			//echo "success\n";
			$this->mysqli->set_charset('utf8');
		}
	}


	function query($sql, $multi=0){
		if($res=$this->mysqli->query($sql)){
			if(is_bool($res)){
				return $res;
			}
			else{
				$numrows=$res->num_rows;
				if($numrows>1 || $multi){
					$row=$res->fetch_all(MYSQLI_ASSOC);
				}
				else $row=$res->fetch_assoc();

				$res->free();

				//echo $numrows . "\n";

				return $row;
			}
		}
		else{
			echo $this->mysqli->errno . "\n";
			echo $this->mysqli->error. "\n";
		}

	}

	function __destruct(){
		$this->mysqli->close();
	}
}

//$a=new Db;
//var_dump($a->query('select * from users'));
