<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

session_start();
error_reporting(-1);
ini_set('display_errors', 1);
require_once( "config.php" );



Users\Users::init();

$user = Users\Users::getUser();

if (is_user_logged_in()){
	$title= "Prayer Buddy";
	require_once( VIEW_PATH . DIRECTORY_SEPARATOR . 'header.php');
	$pb = new \Views\PrayerBuddy();
	
	if (user_is_ubermaster())
	{
		$reset = new \Views\Reset();
	}
	
	require_once( VIEW_PATH . DIRECTORY_SEPARATOR . 'footer.php');
}