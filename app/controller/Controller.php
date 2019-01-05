<?php
/**
*
*/
class Controller
{

	public $url;
	private $adhan;
	private $config;
	private $model;
	private $view;
	private $file_uploaded;

	function __construct()
	{
		include 'libs.php';
		$this->adhan = new Adhan();
		$model = new Model();
		$view = new View();
		$this->model = $model;
		$this->view = $view; 
		$this->url();
		$this->controller();
	}

	/**
	 * @return [type]
	 */
	public function controller()
	{
		if (isset($this->url["cp"])) 
		{
			if (empty($this->url["cp"]) && isset($this->url["query"])) 
			{
				$user_name  = $_GET["user_name"];
				$check_user = $this->model->user_exist($user_name);
				if (is_null($check_user) || $check_user === false) 
				{
					$this->view->error_404();
					return false;
				}
				if (isset($_POST["check"]) && $_POST["check"] == true) 
				{
					if (is_null($check_user["adhan"])) 
					{
						if (is_null($check_user["time_zone"])) 
						{
							echo "please add your Time Zone and try again";
							return false;
						}
						// $this->user_page($check_user["id"], $check_user["time_zone"]);
						$this->first_notify($check_user["id"]);
					}
					else
					{
						if (is_null($check_user["time_zone"]) || is_null($check_user["latitude"]) || is_null($check_user["longitude"]) || is_null($check_user["country"])) 
						{
							echo "please add your Time Zone , latitude , longitude , country and try again";
							return false;
						}
						$this->user_page($check_user["id"], $check_user["time_zone"], $check_user["adhan"], $check_user["latitude"], $check_user["longitude"], $check_user["country"]);
					}
				}
				else
				{
					$this->view->user_page(["user_name"=>$user_name]);
				}
			}
			elseif ($this->url["cp"] == "user") 
			{
				if (!isset($_COOKIE["id"]) && !isset($_COOKIE["user_name"])) 
				{
					header('Location: login');
				}

				if (isset($this->url["query"]) && isset($_GET["logout"])) 
				{
					setcookie("id", '', time()-3600);
					setcookie("user_name", '', time()-3600);
					echo "Ok";
				}
				elseif (isset($this->url["query"]) && isset($_GET["submit"])) 
				{
					if(!empty($_POST['submit']))
				    {
				    	if ($_POST['submit'] == "adhan_form") 
				    	{
							$add = $this->add_alarm($_POST['submit']);
							// print_r ($add);
							if ($add === true) 
							{
								echo "success";
							}
							else
							{
								print_r($add);
							}
				    	}
				    	else
				    	{
							$upload = $this->upload_music();
							if ($upload === true) 
							{
								$add = $this->add_alarm($_POST['submit']);
								// print_r ($add);
								if ($add === true) 
								{
									echo "success";
								}
								else
								{
									print_r($add);
								}
							}
							else
							{
								echo $upload;
							}	
				    	}
					}
					else
					{
						echo "what do you want to do ?";
					}
				}
				else
				{
					date_default_timezone_set("Asia/Tehran");
					$this->view->panel_page($this->url);
				}
			}
			elseif ($this->url["cp"] == "install") 
			{
				$installation = $this->model->installation();
				if($installation["users"] == true && $installation["notif"] == true)
				{
					echo "i have good news... your database is ready to use";
				}
				elseif($installation["users"] == true || $installation["notif"] == true)
				{
					echo "one good news and one bad news...<br> one of database is ready and one of them has error...please check error.log :)";
				}
				elseif($installation["users"] !== true && $installation["notif"] !== true)
				{
					echo "some bad news..!!!!...WRONG.....!!!!<br>";
					var_dump($installation);
				}
			}
			elseif ($this->url["cp"] == "login") 
			{
				if (isset($_COOKIE["id"]) && isset($_COOKIE["user_name"])) 
				{
					header('Location: user');
				}
				if (isset($this->url["query"]) && isset($_GET["register"])) 
				{
					$register = $this->register();
					echo $register;
				}
				elseif (isset($this->url["query"]) && isset($_GET["login"])) 
				{
					$login = $this->login();	
					echo $login;
				}
				else
				{
					$this->view->register_page();
				}
			}
			else
			{
				$this->view->error_404();
			}
		}
		else
		{
			$this->view->page_home();
		}

	}



	/**
	 * @return [type]
	 */
	private function url()
	{
		if (isset($_SERVER['HTTPS']))
        {
            $this->url["protocol"] = "https";
        }
        else
        {
            $this->url["protocol"] = "http";
        }
        if (isset($_SERVER['HTTP_HOST']) && isset($_SERVER['REQUEST_URI']))
        {
            $this->url["site"] = $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
        }
        elseif (isset($_SERVER['HTTP_HOST']))
        {
            $this->url["site"] = $_SERVER['HTTP_HOST'];
        }
        else
        {
            $this->url = null;
            return false;
        }
        $url_exploded = explode("/",$this->url["site"]);
        // $this->url["ex"] = $url_exploded;
        $this->url["base"] = $url_exploded[0];
        if (isset($url_exploded[1]) && !empty($url_exploded[1]))
        {
        	$query_explod = explode("?", $url_exploded[1]);
	        if (isset($query_explod[1]) && !empty($query_explod[1]))
	        {
        		$this->url["cp"] = $query_explod[0];
        		$this->url["query"] = $query_explod[1];
	        }
	        else
	        {
        		$this->url["cp"] = $url_exploded[1];
	        }
        }
        return $this->url;
	}


	/**
	 * @return [type]
	 */
	public function register()
	{
		//$_POST
		// var_dump($_POST);
		if (empty($_POST["user_name"]) || empty($_POST["email"]) || empty($_POST["password"]) || empty($_POST["password2"])) 
		{
			// echo $_POST["password2"];
			return "please complete all input";
			// return false;
		}
		
		$user_name 		= $_POST["user_name"]; 
		$email 			= $_POST["email"]; 
		$password 		= $_POST["password"]; 
		$password2 		= $_POST["password2"];

		if ($password != $password2) 
		{
			return "wrong password";
		}
		else
		{

			$password = password_hash($password, PASSWORD_DEFAULT);
		}

		$registeration 	= $this->model->register($user_name, $email, $password);  
		if ($registeration === true) 
		{
			return "Done";
		}
		else
		{
			return "Worng please tell admin";
		}

	}



	/**
	 * @return [type]
	 */
	public function login()
	{
		//$_POST
		if (empty($_POST["user_name"]) || empty($_POST["password"])) 
		{
			print_r($_POST);
			return "please complete all input";
			// return false;
		}
		

		$user_name 		= $_POST["user_name"]; 
		$password 		= $_POST["password"]; 

		$login_check = $this->model->login_check($user_name, $password);
		if (is_null($login_check)) 
		{
			return "user name or password is wrong";
		}
		elseif ($login_check === false)
		{
			return "somethings is wrong please tell admin";
		}
		
		$id = $login_check;
		setcookie("id", $id, time() + (86400 * 30), "/"); // 86400 = 1 day
		setcookie("user_name", $user_name, time() + (86400 * 30), "/"); // 86400 = 1 day
		return "Ok";
	}


	/**
	 * @return [type]
	 */
	public function upload_music()
	{
		global $web_url;
		$path = MUSIC_DIR; 
		$valid_formats1 = array("mp3", "wav"); 
		$user_name = $_COOKIE["user_name"];
    	if (empty($_FILES['alarm']['name'])) 
    	{
    		return "please select file";
    	}
    	if ((int)$_FILES['alarm']['size'] > 8000000) 
    	{
    		return "please reduce your file size";
    	}
        $alarm = $_FILES['alarm']['name']; 
        $size = $_FILES['alarm']['size'];
        $actual_file_name = $user_name."_".$alarm;
        if (file_exists($path.$actual_file_name)) 
        {
        	$this->file_uploaded = $web_url."assets/music/".$actual_file_name;
		    return true;
		}
        if(strlen($alarm))
        {
            $ext = substr($alarm, -3);
            if(in_array($ext,$valid_formats1))
            {
                $tmp = $_FILES['alarm']['tmp_name'];
                if(move_uploaded_file($tmp, $path.$actual_file_name))
                {
                	$this->file_uploaded = $web_url."assets/music/".$actual_file_name;
                    return true;

                }
                else
                {
                	// return exec("whoami");
                    return "sorry we can't do it";  
                }
            }
            else
            {
            	return "invalid format just upload .MP3 and WAV :)";
            }
        } 
	}



	/**
	 * @param [type]
	 */
	public function add_alarm($type)
	{
		if (empty($type)) 
		{
			return false;
		}
		$user_id = $_COOKIE["id"];
		$user_name = $_COOKIE["user_name"];
		$notif_add = null;
		switch ($type) 
		{
			case 'calendar_form':
				// return $_POST;
				if (empty($_POST["year"]) || empty($_POST["month"]) || empty($_POST["day"]) || empty($_POST["hour"]) || empty($_POST["minute"])) 
				{
					return "please complete all input";
				}
				if (isset($_POST["repeat"]) && !empty($_POST["repeat"])) 
				{
					if (empty($_POST["exp"])) 
					{
						return "please complete exp time";
					}
					$date 	= $_POST["year"]."-".$_POST["month"]."-".$_POST["day"]."@".$_POST["hour"].":".$_POST["minute"]; 
					$unix_time = mktime($_POST["hour"], $_POST["minute"], 0, $_POST["month"], $_POST["day"], $_POST["year"]);
					$exp_time = mktime($_POST["hour"], $_POST["minute"], 0, $_POST["month"], $_POST["day"], $_POST["exp"]);
					$type = "yearly";
					$notif_add = $this->model->notif_add($user_id, $unix_time, $type, $date, null, $exp_time, $this->file_uploaded);
				}
				else 
				{
					$date 	= $_POST["year"]."-".$_POST["month"]."-".$_POST["day"]."@".$_POST["hour"].":".$_POST["minute"]; 
					$unix_time = mktime($_POST["hour"], $_POST["minute"], 0, $_POST["month"], $_POST["day"], $_POST["year"]);
					$type = "once";
					$notif_add = $this->model->notif_add($user_id, $unix_time, $type, $date, null, 0, $this->file_uploaded);
				}

				break;
			case 'monthly_form':
				// return $_POST;
				if (empty($_POST["day"]) || empty($_POST["hour"]) || empty($_POST["exp_year"]) || empty($_POST["exp_month"]) || empty($_POST["minute"])) 
				{
					return "please complete all input";
				}
				$current_year = date("Y");
				$current_month = date("m");
				$date 	= "**"."-"."**"."-".$_POST["day"]."@".$_POST["hour"].":".$_POST["minute"]; 
				$unix_time = mktime($_POST["hour"], $_POST["minute"], 0, $current_month, $_POST["day"], $current_year);
				if ($unix_time - time() <= 0) 
				{
					$current_month = $current_month+1;
					$unix_time = mktime($_POST["hour"], $_POST["minute"], 0, $current_month, $_POST["day"], $current_year);
				}
				$exp_time = mktime($_POST["hour"], $_POST["minute"]+1, 0, $_POST["exp_month"], $_POST["day"], $_POST["exp_year"]);
				if ($exp_time <= time()) 
				{
					return "realy..!!? do you want add this exp time..? anyway i don't add this notif :)";
				}
				// $exp_time = $_POST["exp_year"]."-".$_POST["exp_month"];
				$type = "monthly";
				$notif_add = $this->model->notif_add($user_id, $unix_time, $type, $date, null, $exp_time, $this->file_uploaded);
				// return $current_month." :: :: :: :: ".$current_year;

				break;
			
			case 'week_form':
				// return $_POST;
				if ( empty($_POST["hour"]) || empty($_POST["minute"] || empty($_POST["exp_year"]) || empty($_POST["exp_month"]) || empty($_POST["exp_day"]))) 
				{
					return "please complete all input";
				}
				if (empty($_POST["sat"]) && empty($_POST["sun"]) && empty($_POST["mon"]) && empty($_POST["tue"]) &&empty($_POST["wed"]) && empty($_POST["thu"]) && empty($_POST["fri"]) ) 
				{
					return "please selcet a day";	
				}
				$sat = (empty($_POST["sat"])) ? null : "1-" ;
				$sun = (empty($_POST["sun"])) ? null : "2-" ;
				$mon = (empty($_POST["mon"])) ? null : "3-" ;
				$tue = (empty($_POST["tue"])) ? null : "4-" ;
				$wed = (empty($_POST["wed"])) ? null : "5-" ;
				$thu = (empty($_POST["thu"])) ? null : "6-" ;
				$fri = (empty($_POST["fri"])) ? null : "7" ;
				$custom = $sat.$sun.$mon.$tue.$wed.$thu.$fri;
				if ($custom[strlen($custom) - 1] == '-') 
				{
					$custom = substr($custom, 0, -1);
				}		
				$current_year = date("Y");
				$current_month = date("m");
				$current_week_day = date("w")+2;
				$current_day = date("d");
				$current_month_max_day = cal_days_in_month (CAL_GREGORIAN, $current_month, $current_year);
				// return $current_day;
				$notif_week_days = explode("-",$custom);
				$notif_week_days_num_key = count($notif_week_days);				
				for ($i=0; $i < $notif_week_days_num_key ; $i++) 
				{ 
					if ($notif_week_days[$i] >= $current_week_day) 
					{
						$notif_unix_day = ($notif_week_days[$i] - $current_week_day) + $current_day;
						if ($notif_unix_day > $current_month_max_day) 
						{
							$notif_unix_day = $notif_unix_day - $current_month_max_day;
						}
						if (isset($notif_week_days[$i+1])) 
						{
							$notif_unix_day2 = ($notif_week_days[$i+1] - $current_week_day) + $current_day;
						}
						else
						{
							$notif_unix_day2 = (($notif_week_days[0]+7) - $current_week_day) + $current_day;
						}
						if ($notif_unix_day2 > $current_month_max_day) 
						{
							$notif_unix_day2 = $notif_unix_day2 - $current_month_max_day;
							$current_month = $current_month+1;
							if ($current_month > 12) 
							{
								$current_year = $current_year+1;
								$current_month = 1;
							}
						}

						break;
					}
				}
				if (!isset($notif_unix_day)) 
				{
				 	$notif_week_days[0] = $notif_week_days[0] + 7;
			 		$notif_unix_day = ($notif_week_days[0] - $current_week_day) + $current_day; 
				}
				$date 	= "**"."-"."**"."-"."**"."@".$_POST["hour"].":".$_POST["minute"]; 
				$unix_time = mktime($_POST["hour"], $_POST["minute"], 0, $current_month, $notif_unix_day, $current_year);
				if ($unix_time - time() <= 0) 
				{
					$unix_time = mktime($_POST["hour"], $_POST["minute"], 0, $current_month, $notif_unix_day2, $current_year);
				}
				$exp_time = mktime($_POST["hour"], $_POST["minute"]+1, 0, $_POST["exp_month"], $_POST["day"], $_POST["exp_year"]);
				if ($exp_time <= time()) 
				{
					return "realy..!!? do you want add this exp time..? anyway i don't add this notif :)";
				}
				// $exp_time = $_POST["exp_year"]."-".$_POST["exp_month"];
				$type = "week";
				$notif_add = $this->model->notif_add($user_id, $unix_time, $type, $date, $custom, $exp_time, $this->file_uploaded);
				// return $current_month." :: :: :: :: ".$current_year;

				break;
			case 'adhan_form':
				// return $_POST;
				if (empty($_POST["latitude"]) || empty($_POST["longitude"]) || empty($_POST["country"]) || empty($_POST["time_zone"])) 
				{
					return "please complete all input";
				}
				if (isset($_POST["adhan"]) && isset($_POST["monajat"])) 
				{
					$adhan = 2;
				}
				elseif (isset($_POST["adhan"]) && !isset($_POST["monajat"]))
				{
					$adhan = 1;
				}
				elseif (!isset($_POST["adhan"]) && isset($_POST["monajat"]))
				{
					return "sorry, we can't play Monajat without Adhan :(";
				}
				else
				{
					$adhan = 0;
				}
				$user_exist = $this->model->user_exist($user_name);
				if (date_default_timezone_set($_POST["time_zone"]) == false) 
				{
					return "please enter a valid Time Zone";
				}
				$this->adhan->config($_POST["latitude"], $_POST["longitude"], $_POST["country"], $_POST["time_zone"]);
				$check_coordinate = $this->adhan->check_coordinate($_POST["latitude"], $_POST["longitude"]);
				if ($check_coordinate === false) 
				{
					return "please enter valid lat and long please read Tip on top of page";
				}
				// return $check_coordinate;
				$notif_add = $this->model->adhan_option($user_id, $adhan, $_POST["time_zone"], $_POST["latitude"], $_POST["longitude"], $_POST["country"]);
				break;			
			default:
				return "What the Faz ?";
				break;
		}
		if ($notif_add === true) 
		{
			return true;
		}
		else
		{
			return "Worng please tell admin";
		}

	}




	public function first_notify($_user_id)
	{
		if (is_null($_user_id) || empty($_user_id)) 
		{
			return false;
		}
		$notifies = $this->model->get_notify($_user_id);
		if (!is_array($notifies)) 
		{
			echo " ELSE";
		}
	}


	public function user_page($_user_id, $_time_zone, $_adhan = null, $_lat = null, $_long = null, $_country = null)
	{

		if (is_null($_user_id) || empty($_user_id) || empty($_time_zone) || is_null($_time_zone)) 
		{
			return false;
		}
		$time_zone_set = date_default_timezone_set($_time_zone);
		if ($time_zone_set == false) 
		{
			echo "please enter a valid Time Zone";
			return false;
		}

		$fitst_notify = $this->first_notify($_user_id);
		$fitst_notify_unix = $first_notify["unix_time"];
		if (isset($_adhan) && $_adhan == 1) 
		{
			// means we just must play adhan and notify(if exist)

			$this->adhan->config($_lat, $_long, $_country, $_time_zone);
			$first_adhan = $this->adhan->get_first_adhan();
			$first_adhan_unix = $first_adhan["unix"];
			
		}
		elseif (isset($_adhan) && $_adhan == 2)
		{
			// means we must play adhan and monajat and notify(if exist)

			$this->adhan->config($_lat, $_long, $_country, $_time_zone);
			$first_adhan = $this->adhan->get_first_adhan();
			$first_adhan_unix = $first_adhan["unix"];
		}

		print_r($notifies);
		// print_r($first_adhan);
		// print_r($first_adhan_unix);
	}



}

