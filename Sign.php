<?php
/**
 * vim:ft=php
 * @author Dotcra <dotcra@gmail.com>
 * @version
 * @todo
 */

class Sign{
	private $a;
	private $b;
	private $c;
	function __construct(){
	}

	function __destruct(){
	}

	static function check(){
		if(is_readable(session_save_path() . '/sess_' . $_COOKIE['SID'])){
			return 1;
		}
		else{
			return 0;
		}
	}
}
