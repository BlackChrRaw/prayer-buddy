<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Views;
use Requests\Request;
use Requests\Requests;
use Users\Users;
/**
 * Description of PrayerBuddy
 *
 * @author Hendrik
 */
class PrayerBuddy {
	
	public function __construct() {
		$requests = Requests::getByUserId(Users::getUser()->prayer_id);
		
		require VIEW_PATH . DIRECTORY_SEPARATOR . 'prayer_buddy.php';
		
		if ($_SERVER['REQUEST_METHOD'] == 'POST')
		{
			$requests = filter_input(INPUT_POST, 'requests', FILTER_DEFAULT, FILTER_REQUIRE_ARRAY);
			$submit = filter_input(INPUT_POST, 'submit-requests');
			debug($submit);
			if ($submit)
			{
				Requests::deleteByUserId(Users::getUser()->id);
				foreach ($requests as $request){
					$r = new Request($request);
					$r->save();
				}
				header('Location: /');
				exit;
			}
		}

		$requests = Requests::getByUserId(Users::getUser()->id);

		require VIEW_PATH . DIRECTORY_SEPARATOR . 'user-prayer-request.php';

	}
	
}
