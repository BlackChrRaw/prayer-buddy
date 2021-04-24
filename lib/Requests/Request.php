<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Requests;
use Users\Users;
use DB;
/**
 * Description of Request
 *
 * @author Hendrik
 */
class Request {
	public $id;
	public $content;
	public $user_id;
	private $new = false;
	//put your code here
	
	public function __construct($content = null) {
		if (!is_null($content))
		{
			$this->content = $content;
			$this->user_id = Users::getUser()->id;
			$this->new = true;
		}
	}
	
	public function save(){
		if ($this->new)
		{
			$stmt = DB::getInstance()->prepare("INSERT INTO requests SET content = ?, user_id = ?");
			$stmt->execute([$this->content, $this->user_id]);
		} else {
			$stmt = DB::getInstance()->prepare("UPDATE requests SET content = ? WHERE id = ?");
			$stmt->execute([$this->content, $this->id]);
		}
		
		
	}
}
