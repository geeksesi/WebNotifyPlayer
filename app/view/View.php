<?php

/**
*
*/
class View
{

	function __construct()
	{
		
	}


	public function view()
	{

	}


	public function error_404()
	{
		include VIEW_DIR."404.php";
	}


	public function page_home()
	{
		include VIEW_DIR."home.php";
	}

	public function register_page()
	{
		include VIEW_DIR."register.php";
	}


	public function login_page()
	{
		include VIEW_DIR."register.php";
	}


	public function panel_page($_data)
	{
		$user_url = $_data["protocol"]."://".$_data["base"]."?user_name=".$_COOKIE["user_name"];
		$user_url_show = $_data["base"]."?user_name=".$_COOKIE["user_name"];
		include VIEW_DIR."panel.php";
	}


	public function main_page()
	{
		include VIEW_DIR."main.php";
	}	


	public function user_page($_data)
	{
		$user_name = $_data["user_name"];
		include VIEW_DIR."user_page.php";
	}
}
