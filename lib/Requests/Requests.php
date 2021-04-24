<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Requests;
use DB;
/**
 * Description of Requests
 *
 * @author Hendrik
 */
class Requests {
	
	public static function getByUserId($user_id): array
	{
		$stmt = DB::getInstance()->prepare("SELECT * FROM requests WHERE user_id = ?");
		$stmt->setFetchMode(\PDO::FETCH_CLASS, '\Requests\Request');
		$stmt->execute([$user_id]);
		if ($requests = $stmt->fetchAll()){
			return $requests;
		}
		return [];
	}
	
	public static function deleteByUserId($user_id)
	{
		$stmt = DB::getInstance()->prepare("DELETE FROM requests WHERE user_id = ?");
		$stmt->execute([$user_id]);
	}
	
}
