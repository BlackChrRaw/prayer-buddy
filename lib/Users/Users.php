<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Users;


class Users {
	
	private static $user;


	static function init( ){
		
		if (isset($_SESSION['user_id']))
		{
			self::log_user_in();
		} else {
			self::login_form();
		}
		$logout = filter_input(INPUT_POST, 'logout');
		if ($logout && $_SERVER['REQUEST_METHOD'] == 'POST')
		{
			unset($_SESSION['user_id']);
			header('Location: /');
			exit;
		}
	}
	
	private static function log_user_in(){
		$user_id = (int)$_SESSION['user_id'];
		if (is_int($user_id) && $user_id != 0)
		{
			$stmt = \DB::getInstance()->prepare("SELECT * FROM users WHERE id = ? ");
			$stmt->setFetchMode(\PDO::FETCH_CLASS, "\Users\User");
			$stmt->execute([$user_id]);

			$result = $stmt->fetch();
			if ($result)
			{
				self::$user = $result;
				if (is_null(self::$user->password))
					self::reset_password_form();
			} else {
				unset($_SESSION['user_id']);
				header("Location: /");
				exit;
			}

		}
	}
	
	private static function reset_password_form()
	{
		$errors = [];
		if ($_SERVER['REQUEST_METHOD'] == 'POST')
		{
//			$password = filter_input(INPUT_POST, 'password', FILTER_VALIDATE_REGEXP, ['options' => ['regexp' => '/^(?=.*[A-Z].*[A-Z])(?=.*[!@#$&*])(?=.*[0-9].*[0-9])(?=.*[a-z].*[a-z].*[a-z]).{8}$/']]);
			$password = filter_input(INPUT_POST, 'password');
			if ($password)
			{
				if (strlen($password) < 8)
				{
					$errors[] = "Please provide a safe password";
				} else {
					$password = password_hash($password, PASSWORD_DEFAULT);
					
					$stmt = \DB::getInstance()->prepare("UPDATE users SET password = ? WHERE id = ?");
					$stmt->execute([$password, self::getUser()->id]);
					header("Location: /");
					exit;
				}
				
			} else {
				$errors[] = "Please provide a safe password";
			}
		}
		
		$view = new \Views\Auth();
		$view->reset_password_form([], $errors);
	}
	
	private static function login_form()
	{
		$username = filter_input(INPUT_POST, 'login', FILTER_SANITIZE_EMAIL);
			
		$password = filter_input(INPUT_POST, 'password');
		$errors = [];
		
		if ($username ){
			$stmt = \DB::getInstance()->prepare("SELECT * FROM users WHERE email = ?");
			$stmt->setFetchMode(\PDO::FETCH_CLASS, "\Users\User");
			$stmt->execute([$username]);
			$user = $stmt->fetch();
			
			if ($user){
				if ($password != "")
				{
					if (password_verify($password, $user->password))
					{
						$_SESSION['user_id'] = $user->id;
						header("Location: /");
						exit;
					} else {
						$errors[] = "Username and password are not valid";
					}
				} else {

					if ($user->password == "")
					{
						$_SESSION['user_id'] = $user->id;
						header("Location: /");
						exit;
					} else {
						$errors[] = "Username and password are not valid";
					}
				}
			} else {
				$errors[] = "Username and password are not valid";
			}

			$values = [
				'login' => $username
			];
		} else {
			$values = [
				'login' => ''
			];
		}

		$login = new \Views\Auth();
		$login->login_form($values, $errors);
	}
	
	/**
	 * 
	 * @return \Users\User Description
	 */
	public static function getUser()
	{
		return self::$user;
	}
	
	/**
	 * 
	 * @return \Users\User
	 */
	public static function getAll()
	{
		
		$reset = filter_input(INPUT_POST, "reset-buddies");
		$stmt = \DB::getInstance()->prepare("SELECT * FROM users");
		$stmt->setFetchMode(\PDO::FETCH_CLASS, "\Users\User");

		$stmt->execute();
		
		if ($users = $stmt->fetchAll())
		{
			return $users;
		}
		return [];
	}


	/**
	 * 
	 * @param type $id
	 * @return \Users\User
	 */
	public static function getUserById($id){
		$stmt = \DB::getInstance()->prepare("SELECT * FROM users WHERE id = ?");
		$stmt->setFetchMode(\PDO::FETCH_CLASS, "\Users\User");
		$stmt->execute([$id]);
		if ($buddy = $stmt->fetch())
		{
			return $buddy;
		}
		return new User();
	}
}
