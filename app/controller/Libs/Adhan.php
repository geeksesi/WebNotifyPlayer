<?php

/**
 * 
 */
class Adhan
{
	private $region;
	private $now;
	private $pray_data;
	private $pray_time;
	private $pray_time_unix;
	private $config_set = false;


	/**
	 * [config description]
	 * @param  [type] $_lat     [description]
	 * @param  [type] $_long    [description]
	 * @param  [type] $_country [description]
	 * @param  [type] $_zone    [description]
	 * @return [type]           [description]
	 */
	public function config($_lat, $_long, $_country, $_zone)
	{
		$this->region["lat"]			= $_lat; 
		$this->region["long"]			= $_long; 
		$this->region["country"]		= $_country; 
		$this->region["zone"]			= $_zone; 

		date_default_timezone_set($_zone);
		//now time
		$date['d']  	= date('d', time());
		$date['m']  	= date('m', time());
		$date['y']  	= date('Y', time());
		$date['h']  	= date('H', time());
		$date['i']  	= date('i', time());
		$date['full']  	= date('d/m/Y H:i', time());
		$date['time']  	= time();
		$this->now 		= $date;

		$this->config_set = true;
	}


	/**
	 * [check_coordinate description]
	 * @param  [type] $_lat  [description]
	 * @param  [type] $_long [description]
	 * @return [type]        [description]
	 */
	public function check_coordinate($_lat, $_long)
	{
		if ($this->config_set == false) 
		{
			return false;
		}
		$api_link = "http://api.aladhan.com/v1/calendar?latitude=".$_lat."&longitude=".$_long."&method=2&month=".$this->now["m"]."&year=".$this->now["y"];
		$api_content = file_get_contents($api_link);
		$api_decode = json_decode($api_content, true);
		if ($api_decode["code"] === 200) 
		{
			return true;
		}
		else
		{
			return false;
		}
	}



	/**
	 * [pray_time description]
	 * @return boolean 
	 */
	private function pray_time()
	{

		if ($this->config_set == false) 
		{
			return false;
		}

		//api nedded data
		$pray_data["lat"] 				= $this->region["lat"];
		$pray_data["long"] 				= $this->region["long"];
		$pray_data["country"] 			= $this->region["country"];
		$pray_data["timezonestring"] 	= $this->region["zone"];
		$pray_data["method"] 			= "7";
		$pray_data["day"] 				= (int)$this->now['d'] - 1;
		$this->pray_data 				= $pray_data;

		//API
		//http://api.aladhan.com/v1/calendar?latitude=$pray_data["lat"]&longitude=$pray_data["long"]&method=2&month=4&year=2017
		$api["url"] = "http://api.aladhan.com/v1/calendar?latitude=".$pray_data["lat"]."&longitude=".$pray_data["long"]."&method=".$pray_data["method"]."&month=".$this->now['m']."&year=".$this->now['y']."&timezonestring=".$pray_data["timezonestring"]; 
		$json = file_get_contents($api["url"]);

		$deecode = json_decode($json, true);
		foreach ($deecode as $key => $value) 
		{
			if (is_array($value)) 
			{
				$pray_array = $value[$pray_data["day"]];
			}
		}

		//api  outpot data
		$pray["fajr"]				= $pray_array["timings"]["Fajr"];
		$pray["fajr_hour"]			= (int)substr($pray["fajr"], 0, 2);
		$pray["fajr_minute"]		= (int)substr($pray["fajr"], 3, 3);

		$pray["sunrise"]			= $pray_array["timings"]["Sunrise"];
		$pray["sunrise_hour"]		= (int)substr($pray["sunrise"], 0, 2);
		$pray["sunrise_minute"]	= (int)substr($pray["sunrise"], 3, 3);
		
		$pray["dhuhr"]				= $pray_array["timings"]["Dhuhr"];
		$pray["dhuhr_hour"]			= (int)substr($pray["dhuhr"], 0, 2);
		$pray["dhuhr_minute"]		= (int)substr($pray["dhuhr"], 3, 3);
		
		$pray["sunset"]				= $pray_array["timings"]["Sunset"];
		$pray["sunset_hour"]		= (int)substr($pray["sunset"], 0, 2);
		$pray["sunset_minute"]		= (int)substr($pray["sunset"], 3, 3);
		
		$pray["maghrib"]			= $pray_array["timings"]["Maghrib"];
		$pray["maghrib_hour"]		= (int)substr($pray["maghrib"], 0, 2);
		$pray["maghrib_minute"]		= (int)substr($pray["maghrib"], 3, 3);

		$this->pray_time 			= $pray;

		//make api outpot to unix time
		$pray_unix["fajr"]		= mktime($pray["fajr_hour"], $pray["fajr_minute"], 0, $this->now['m'], $this->now['d'], $this->now['y']);
		$pray_unix["sunrise"]	= mktime($pray["sunrise_hour"], $pray["sunrise_minute"], 0, $this->now['m'], $this->now['d'], $this->now['y']);
		$pray_unix["dhuhr"]	= mktime($pray["dhuhr_hour"], $pray["dhuhr_minute"], 0, $this->now['m'], $this->now['d'], $this->now['y']);
		$pray_unix["sunset"]	= mktime($pray["sunset_hour"], $pray["sunset_minute"], 0, $this->now['m'], $this->now['d'], $this->now['y']);
		$pray_unix["maghrib"]	= mktime($pray["maghrib_hour"], $pray["maghrib_minute"], 0, $this->now['m'], $this->now['d'], $this->now['y']);
		$this->pray_time_unix 	= $pray_unix;

		return true;
	}


	/**
	 * [get_first_adhan description]
	 * @return [type] [description]
	 */
	public function get_first_adhan()
	{
		if ($this->config_set == false) 
		{
			return false;
		}

		$this->pray_time();
		// return $this->pray_time;
		$unix_fajr 		= $this->pray_time_unix["fajr"]		-	$this->now["time"];  
		$unix_sunrise 	= $this->pray_time_unix["sunrise"] 	-	$this->now["time"];  
		$unix_dhuhr 	= $this->pray_time_unix["dhuhr"] 	-	$this->now["time"];  
		$unix_sunset 	= $this->pray_time_unix["sunset"] 	-	$this->now["time"];  
		$unix_maghrib 	= $this->pray_time_unix["maghrib"] 	-	$this->now["time"]; 
		
		if ($unix_fajr > 0) 
		{
			$export["delay"] = ($unix_fajr * 1000);
			$export["unix"] = $this->pray_time_unix["fajr"];
			$export["type"] = "fajr";
		}
		elseif ($unix_sunrise > 0) 
		{
			$export["delay"] = ($unix_sunrise * 1000);
			$export["unix"] = $this->pray_time_unix["sunrise"];
			$export["type"] = "sunrise";			
		}
		elseif ($unix_dhuhr > 0) 
		{
			$export["delay"] = ($unix_dhuhr * 1000);
			$export["unix"] = $this->pray_time_unix["dhuhr"];
			$export["type"] = "dhuhr";
		}
		elseif ($unix_sunset > 0) 
		{
			$export["delay"] = ($unix_sunset * 1000);
			$export["unix"] = $this->pray_time_unix["sunset"];
			$export["type"] = "sunset";
		}
		elseif ($unix_maghrib > 0) 
		{
			$export["delay"] = ($unix_maghrib * 1000);
			$export["unix"] = $this->pray_time_unix["maghrib"];
			$export["type"] = "maghrib";			
		}
		else
		{
			$export["delay"] = 0;
			$export["unix"] = 0;
			$export["type"] = "delay";
			//7200 s
		}
		return $export;
	}


}