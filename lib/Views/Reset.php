<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Views;

/**
 * Description of PrayerBuddy
 *
 * @author Hendrik
 */
class Reset {
	
	public function __construct() {
		if (user_is_ubermaster())
		{
			if ($_SERVER['REQUEST_METHOD'] == 'POST')
			{
				$this->reset_buddies();
			}
			$users = \Users\Users::getAll();
			require VIEW_PATH . DIRECTORY_SEPARATOR . 'reset.php';
			
		}
	}
	
	private function reset_buddies ()
	{
		$users = \Users\Users::getAll();
		
		$available = [];
		foreach ($users as $user)
		{
			$user->prayer_id = 0;
			$available[] = $user->id;
		}
		foreach($users as $user)
		{
			if (count($available) > 1)
			{
				while ($user->prayer_id == $user->id || $user->prayer_id == 0)
				{
					$user->prayer_id = $this->get_random_prayer_id($available);
				}
				$key = array_keys($available, $user->prayer_id)[0];
				unset($available[$key]);
				$available = array_values($available);
			} else if ($available[0] != $user->id){
				$user->prayer_id = $available[0];
			} else {
				$this->reset_buddies();
				return;
			}
			
		}
		foreach ($users as $user)
		{
			$user->save();
		}
		
			header("Location: /");
			exit;
	}
	
	private function get_random_prayer_id($available)
	{
		return $available[random_int(0, count($available) -1)];
	}
}
