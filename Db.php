<?php
/**
 * vim:ft=php
 * @author Dotcra <dotcra@gmail.com>
 * @version
 * @todo
 */

class Db{
	private $host="localhost";
	private $user="root";
	private $pass="dot";
	private $db="fgw";
	private $mysqli;

	function __construct(){
		$this->mysqli=new mysqli($this->host,$this->user, $this->pass, $this->db);
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
				return;
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
