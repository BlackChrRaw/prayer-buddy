<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Views;

/**
 * Description of View
 *
 * @author Hendrik
 */
class Auth {
	
	public function reset_password_form($values = [], $errors = []){
		$title = "Create a new password";
		foreach ($values as $key => $value)
		{
			$$key = $value;
		}
		require_once VIEW_PATH . DIRECTORY_SEPARATOR . "reset_password.php";
	}
	
	public function login_form($values = [], $errors = [] ) {
		
		$title = "Once the greatest, now the future";
		foreach ($values as $key => $value)
		{
			$$key = $value;
		}
		require_once VIEW_PATH.DIRECTORY_SEPARATOR. "login.php";
	}
	
}
