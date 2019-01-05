<?php

/**
*
*/
class Model
{
	private $db;

	function __construct()
	{
		$servername = "localhost";
		$username = "root";
		$password = "javadkhof";
		$dbname = "oap";

		// Create connection
		$connect = new mysqli($servername, $username, $password, $dbname);
		
		if ($connect->connect_error) 
		{
			$this->db = false;
		}
		$this->db = $connect;
	}

	
	public function installation()
	{
		if (is_null($this->db) || $this->db === false ) 
		{
			return false;
		}
		$creat_table_users_query = "
			CREATE TABLE users (
				id INT(5) AUTO_INCREMENT ,
				user_name VARCHAR(30) ,
				email VARCHAR(50) ,
				password TEXT ,
				adhan INT(1) ,
				time_zone VARCHAR(30) ,
				latitude TEXT ,
				longitude TEXT ,
				country VARCHAR(30) ,
				timestamp TIMESTAMP DEFAULT CURRENT_TIMESTAMP ,
				PRIMARY KEY (id), UNIQUE (user_name)
			) 
			ENGINE = InnoDB CHARSET=utf8 COLLATE utf8_bin;
		";
		$creat_table_notif_query = "
			CREATE TABLE notif (
				id INT(5) AUTO_INCREMENT ,
				user_id VARCHAR(5) , 
				unix_time INT(12) , 
				type VARCHAR(12) , 
				date VARCHAR(20) , 
				custom TEXT , 
				file_to_play TEXT ,
				expire_time INT(12) ,
				exp INT(1) , 
				time_stamp TIMESTAMP DEFAULT CURRENT_TIMESTAMP , 
				PRIMARY KEY (id)
			)
				 ENGINE = InnoDB CHARSET=utf8 COLLATE utf8_bin;
		";
		if ($this->db->query($creat_table_users_query) === TRUE) 
		{
			$ret["users"] = true; 
		} 
		else 
		{
			$ret["users"] = "Error creating table: " . $this->db->error; 
		}
		if ($this->db->query($creat_table_notif_query) === TRUE) 
		{
			$ret["notif"] = true; 
		} 
		else 
		{			
			$ret["notif"] = "Error creating table: " . $this->db->error; 
		}
		return $ret;
	}
	


	/**
	 * @param  [type]
	 * @param  [type]
	 * @param  [type]
	 * @return [type]
	 */
	public function register($_user_name, $_email, $_password)
	{
		if (is_null($_user_name) || is_null($_email) || is_null($_password)) 
		{
			return false;
		}
		if (is_null($this->db) || $this->db === false ) 
		{
			return false;
		}
		$register_query = "INSERT INTO users (user_name, email, password) VALUES ('{$_user_name}', '{$_email}', '{$_password}')";

		if ($this->db->query($register_query ) === TRUE) 
		{
		    return true;
		}
		else 
		{
			error_log($register_query ." :::: ::: ::: ::: ".$this->db->error);
		    return false;
		}
	}


	/**
	 * [login_check description]
	 * @param  [type] $_user_name [description]
	 * @param  [type] $_password  [description]
	 * @return [type]             [description]
	 */
	public function login_check($_user_name, $_password)
	{
		if (is_null($_user_name) || is_null($_password)) 
		{
			return false;
		}
		if (is_null($this->db) || $this->db === false ) 
		{
			return false;
		}
		$login_query = "SELECT id,password FROM users WHERE user_name='{$_user_name}'";
		$login_result = $this->db->query($login_query);
		if ($login_result->num_rows <= 0) 
		{
		    return null;
		}
		foreach ($login_result->fetch_assoc() as $key => $value) 
		{
			$login[$key] = $value;
		}
		if (password_verify($_password, $login["password"])) 
		{
			return $login["id"];
		}
		else
		{
			return null;
		}
	}



	/**
	 * [notif_add description]
	 * @param  [type] $_user_id     [description]
	 * @param  [type] $_unix_time   [description]
	 * @param  [type] $_type        [description]
	 * @param  [type] $_date        [description]
	 * @param  [type] $_custom      [description]
	 * @param  [type] $_expire_time [description]
	 * @return [type]               [description]
	 */
	public function notif_add($_user_id, $_unix_time, $_type, $_date, $_custom = null, $_expire_time = null, $_file_to_play)
	{
		if (empty($_user_id) || empty($_unix_time) || empty($_type) || empty($_date) || empty($_file_to_play)) 
		{
			return null;
		}
		if (is_null($this->db) || $this->db === false ) 
		{
			return false;
		}
		$notif_query = "INSERT INTO notif (user_id, unix_time, type, date, custom, file_to_play, expire_time) VALUES ('{$_user_id}', '{$_unix_time}', '{$_type}', '{$_date}', '{$_custom}', '{$_file_to_play}', '{$_expire_time}')";

		if ($this->db->query($notif_query) === TRUE) 
		{
		    return true;
		}
		else 
		{
			error_log($notif_query ." :::: ::: ::: ::: ".$this->db->error);
		    return false;
		}
		
	}



	/**
	 * [adhan_option description]
	 * @param  [type] $_user_id   [description]
	 * @param  [type] $_adhan     [description]
	 * @param  [type] $_time_zone [description]
	 * @param  [type] $_latitude  [description]
	 * @param  [type] $_longitude [description]
	 * @param  [type] $_country   [description]
	 * @return [type]             [description]
	 */
	public function adhan_option($_user_id, $_adhan, $_time_zone, $_latitude, $_longitude, $_country)
	{
		if (is_null($_adhan) || is_null($_user_id) || is_null($_time_zone) || is_null($_latitude) || is_null($_longitude) || is_null($_country)) 
		{
			return null;
		}
		if (is_null($this->db) || $this->db === false ) 
		{
			return false;
		}
		$register_query = "UPDATE users SET adhan = '{$_adhan}', time_zone = '{$_time_zone}', latitude = '{$_latitude}',longitude = '{$_longitude}', country = '{$_country}' WHERE id = '{$_user_id}'";

		if ($this->db->query($register_query ) === TRUE) 
		{
		    return true;
		}
		else 
		{
			error_log($register_query ." :::: ::: ::: ::: ".$this->db->error);
		    return false;
		}		
	}



	/**
	 * [user_exist description]
	 * @param  [type] $_user_name [description]
	 * @return [type]             [description]
	 */
	public function user_exist($_user_name)
	{
		if (is_null($_user_name)) 
		{
			return null;
		}
		if (is_null($this->db) || $this->db === false ) 
		{
			return false;
		}

		$user_query = "SELECT * FROM users WHERE user_name ='{$_user_name}' ";
		$user_result = $this->db->query($user_query);
		if ($user_result->num_rows <= 0) 
		{
		    return null;
		}
		return $user_result->fetch_assoc();
	}



	public function get_notify($_user_id)
	{
		if (is_null($_user_id)) 
		{
			return null;
		}
		if (is_null($this->db) || $this->db === false ) 
		{
			return false;
		}

		$notify_query = "SELECT * FROM notif WHERE user_id = ".$_user_id;
		$notify_result = $this->db->query($notify_query);
		if ($notify_result->num_rows <= 0) 
		{
		    return null;
		}
		$export = [];
		while($row = $notify_result->fetch_assoc()) 
		{
        	$export[] = $row;
    	}
		return $export;

	}

}
