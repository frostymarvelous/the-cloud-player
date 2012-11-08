<?php

class User
{
	public $login_url = "http://loginUrl";
	public $logout_url = "http://logoutUrl";
	public $nickname = "nickname";
	
	public function __construct()
	{
		
	}
	
	public function is_logged_in()
	{
		return false;
	}

}