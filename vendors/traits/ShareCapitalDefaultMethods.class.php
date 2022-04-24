<?php

trait ShareCapitalDefaultMethods{
	
	public static function getEntriesByPackageId($packageId, $year = '', $limit = '', $offset = ''){		
		$target_year 	= $year == '' ? date('Y') : $year;		
		$lim 			= $limit == '' ? self::$page_limit : $limit;
		
		if($offset == ''){
			$sql = "SELECT * FROM " . self::$table . " WHERE package_id = ? AND year = ? LIMIT " . $lim;			
		}else{
			$sql = "SELECT * FROM " . self::$table . " WHERE package_id = ? AND year = ? LIMIT " . $lim . " OFFSET " .  $offset;			
		}
		
		$result = PDO_DB::select($sql, [$packageId, $target_year]);
		echo $result;
	}
	
	public static function getEntriesAmountSumByPackageId($packageId){
		$sum = 0;
		if(PDO_DB::tableColumExists(self::$table, 'amount')){
			$result = PDO_DB::select("SELECT SUM(amount) AS sums FROM " . self::$table . " WHERE package_id = ?  ", [$packageId]);
			$sum = $result[0]['sums'];
		}		
		echo $sum;
	}
	
	public static function getEntriesCountByPackageId($packageId){
		$result = PDO_DB::select("SELECT COUNT(id) AS counts FROM " . self::$table . " WHERE package_id = ?  ", [$packageId]);				
		echo $result[0]['counts'];
	}
	
	//
	
	public static function getDayEntriesSumByPackageId($packageId, $year = ''){
		$day = date('d');
		$year = $yr != ""  ?  $yr : date('Y');
		$result = PDO_DB::select("SELECT SUM(amount) AS sums FROM " . self::$table . " WHERE package_id = ? AND day = ? AND year = ? ", [$packageId, $day, $year]);
		return $result[0]['sums'];
	}
	
	public static function getWeekEntriesSumByPackageId($packageId, $year = ''){
		$week = date('W');
		$year = $yr != ""  ?  $yr : date('Y');
		$result = PDO_DB::select("SELECT SUM(amount) AS sums FROM " . self::$table . " WHERE package_id = ? AND week = ? AND year = ? ", [$packageId, $week, $year]);
		return $result[0]['sums'];
	}
	
	public static function getMonthEntriesSumByPackageId($packageId, $year = ''){
		$month = date('m');
		$year = $yr != ""  ?  $yr : date('Y');
		$result = PDO_DB::select("SELECT SUM(amount) AS sums FROM " . self::$table . " WHERE package_id = ? AND month = ? AND year = ? ", [$packageId, $month, $year]);
		return $result[0]['sums'];
	}
	
	public static function getDayEntriesSumByPackageId($packageId, $year = ''){
		$sum = 0;
		if(PDO_DB::tableColumExists(self::$table, 'amount') && PDO_DB::tableColumExists(self::$table, 'day')){
			$day 	= date('d');
			$year 	= $yr != ""  ?  $yr : date('Y');
			$result = PDO_DB::select("SELECT SUM(amount) AS sums FROM " . self::$table . " WHERE package_id = ? AND day = ? AND year = ? ", [$packageId, $day, $year]);
			$sum 	= $result[0]['sums'];
		}		
		echo $sum;
	}
	
	public static function getWeekEntriesSumByPackageId($packageId, $year = ''){
		$sum = 0;
		if(PDO_DB::tableColumExists(self::$table, 'amount') && PDO_DB::tableColumExists(self::$table, 'week')){
			$week 	= date('W');
			$year 	= $yr != ""  ?  $yr : date('Y');
			$result = PDO_DB::select("SELECT SUM(amount) AS sums FROM " . self::$table . " WHERE package_id = ? AND week = ? AND year = ? ", [$packageId, $week, $year]);
			$sum 	= $result[0]['sums'];
		}		
		echo $sum;
	}
	
	public static function getMonthEntriesSumByPackageId($packageId, $year = ''){
		$sum = 0;
		if(PDO_DB::tableColumExists(self::$table, 'amount') && PDO_DB::tableColumExists(self::$table, 'month')){
			$month 	= date('m');
			$year 	= $yr != ""  ?  $yr : date('Y');
			$result = PDO_DB::select("SELECT SUM(amount) AS sums FROM " . self::$table . " WHERE package_id = ? AND month = ? AND year = ? ", [$packageId, $month, $year]);
			$sum 	= $result[0]['sums'];
		}		
		echo $sum;
	}


}

?>