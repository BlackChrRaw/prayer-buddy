<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Users;

class User {
	
	public $id;
	public $name;
	public $email;
	public $prayer_id;
	public $ubermaster;
	public $password;
	
	/**
	 * 
	 * @return \Users\User
	 */
	function buddy()
	{
		
		return \Users\Users::getUserById($this->prayer_id);
	}
	
	function save()
	{
		$stmt = \DB::getInstance()->prepare("UPDATE users SET name = ?, email = ?, prayer_id = ? WHERE id = ?");
		$stmt->execute([
			$this->name,
			$this->email,
			$this->prayer_id,
			$this->id
		]);
	}
}