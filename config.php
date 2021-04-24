<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


//try {
//$db = new PDO("mysql:host=localhost;dbname=prayer;", "prayer", "xkKB{6k*h!8>");
//  // set the PDO error mode to exception
//  $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//  
//} catch(PDOException $e) {
//  
//}

require_once 'lib/debug.php';

class DB extends PDO{
	
	public static $instance;
	
	/**
	 * 
	 * @return PDO
	 */
	public static function getInstance(){
		if(!DB::$instance instanceof self){
			$dsn = "mysql:host=localhost;dbname=;";
			$username = '';
			$pass = '';
//			$pdo = new PDO ($dsn, $username, $pass);
			
			try{
				DB::$instance = new self($dsn, $username, $pass);
			} catch (PDOException $e) {
				echo 'Connection failed: ' . $e->getMessage();
			}

			
		}
		return DB::$instance;
	}
	
}



define("SERVER_PATH", $_SERVER['DOCUMENT_ROOT']);
define("LIB_PATH", SERVER_PATH . DIRECTORY_SEPARATOR. "lib");
define("VIEW_PATH", SERVER_PATH. DIRECTORY_SEPARATOR. "views");


function hhamming_autoload ($var )
{
	$obj = explode("\\", $var);
	
	$dir = $obj;
	array_pop($dir);
	$file = LIB_PATH . DIRECTORY_SEPARATOR. join(DIRECTORY_SEPARATOR, $dir) . DIRECTORY_SEPARATOR . end($obj). ".php";
	if (file_exists($file))
	{
		require_once $file;
	} else {
		if (WP_DEBUG)
		{
		$bt = debug_backtrace()[0];
		
		echo '<pre>Class ' . $var . ' does not exist, called at ' . $bt['file'] . ' at line ' . $bt['line'] . '</pre>';
		}
	}
}

spl_autoload_register("hhamming_autoload");

function is_user_logged_in()
{
	return \Users\Users::getUser() != null && \Users\Users::getUser()->password != null;
}

function user_is_ubermaster()
{
	if (!is_user_logged_in())
		return false;
	return \Users\Users::getUser()->ubermaster; 
}