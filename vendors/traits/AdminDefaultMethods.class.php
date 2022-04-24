<?php

trait AdminDefaultMethods{
	
	public static function getEntriesByAdminId($adminId, $year = '', $limit = '', $offset = ''){		
		$target_year 	= $year == '' ? date('Y') : $year;		
		$lim 			= $limit == '' ? self::$page_limit : $limit;
		
		if($offset == ''){
			$sql = "SELECT * FROM " . self::$table . " WHERE admin_id = ? AND year = ? LIMIT " . $lim;			
		}else{
			$sql = "SELECT * FROM " . self::$table . " WHERE admin_id = ? AND year = ? LIMIT " . $lim . " OFFSET " .  $offset;			
		}
		
		$result = PDO_DB::select($sql, [$adminId, $target_year]);
		echo $result;
	}
	
	public static function getEntriesAmountSumByAdminId($adminId){
		$sum = 0;
		if(PDO_DB::tableColumExists(self::$table, 'amount')){
			$result = PDO_DB::select("SELECT SUM(amount) AS sums FROM " . self::$table . " WHERE admin_id = ?  ", [$adminId]);
			$sum = $result[0]['sums'];
		}		
		echo $sum;
	}
	
	public static function getEntriesCountByAdminId($adminId){
		$result = PDO_DB::select("SELECT COUNT(id) AS counts FROM " . self::$table . " WHERE admin_id = ?  ", [$adminId]);				
		echo $result[0]['counts'];
	}
	
	//
	
	
	public static function getDayEntriesSumByAdminId($adminId, $year = ''){
		$sum = 0;
		if(PDO_DB::tableColumExists(self::$table, 'amount') && PDO_DB::tableColumExists(self::$table, 'day')){
			$day 	= date('d');
			$year 	= $yr != ""  ?  $yr : date('Y');
			$result = PDO_DB::select("SELECT SUM(amount) AS sums FROM " . self::$table . " WHERE admin_id = ? AND day = ? AND year = ? ", [$adminId, $day, $year]);
			$sum 	= $result[0]['sums'];
		}		
		echo $sum;
	}
	
	public static function getWeekEntriesSumByAdminId($adminId, $year = ''){
		$sum = 0;
		if(PDO_DB::tableColumExists(self::$table, 'amount') && PDO_DB::tableColumExists(self::$table, 'week')){
			$week 	= date('W');
			$year 	= $yr != ""  ?  $yr : date('Y');
			$result = PDO_DB::select("SELECT SUM(amount) AS sums FROM " . self::$table . " WHERE admin_id = ? AND week = ? AND year = ? ", [$adminId, $week, $year]);
			$sum 	= $result[0]['sums'];
		}		
		echo $sum;
	}
	
	public static function getMonthEntriesSumByAdminId($adminId, $year = ''){
		$sum = 0;
		if(PDO_DB::tableColumExists(self::$table, 'amount') && PDO_DB::tableColumExists(self::$table, 'month')){
			$month 	= date('m');
			$year 	= $yr != ""  ?  $yr : date('Y');
			$result = PDO_DB::select("SELECT SUM(amount) AS sums FROM " . self::$table . " WHERE admin_id = ? AND month = ? AND year = ? ", [$adminId, $month, $year]);
			$sum 	= $result[0]['sums'];
		}		
		echo $sum;
	}


}


?>