<?php

class DateSubstractor{
	public static $year;
	public static $month;
	public static $days;
	
	public static function setProperties($latestYear, $olderYear){
		
		$diff	= abs(strtotime($latestYear) - strtotime($olderYear));
		self::$year 	= floor($diff / (365 * 60 * 60 * 24));
		self::$month 	= floor(($diff - self::$year * 365 * 60 * 60 * 24) / (365 * 60 * 60 * 24));
		self::$days 	= floor(($diff - self::$year * 365 * 60 * 60 * 24 - self::$month * 30 * 60 * 60 * 24) / (60 * 60 * 24));
		
	}

}


?>