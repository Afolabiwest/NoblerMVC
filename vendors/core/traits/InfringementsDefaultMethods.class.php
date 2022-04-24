<?php

trait InfringementsDefaultMethods{
	
	public static function getEntriesByInfringementCategoryId($infringementCategoryId, $year = '', $limit = '', $offset = ''){		
		$target_year 	= $year == '' ? date('Y') : $year;		
		$lim 			= $limit == '' ? self::$page_limit : $limit;
		
		if($offset == ''){
			$sql = "SELECT * FROM " . self::$table . " WHERE category_id = ? AND year = ? LIMIT " . $lim;			
		}else{
			$sql = "SELECT * FROM " . self::$table . " WHERE category_id = ? AND year = ? LIMIT " . $lim . " OFFSET " .  $offset;			
		}
		
		$result = PDO_DB::select($sql, [$infringementCategoryId, $target_year]);
		echo $result;
	}
	
	public static function getEntriesAmountSumByInfringementCategoryId($infringementCategoryId){
		$sum = 0;
		if(PDO_DB::tableColumExists(self::$table, 'amount')){
			$result = PDO_DB::select("SELECT SUM(amount) AS sums FROM " . self::$table . " WHERE category_id = ?  ", [$infringementCategoryId]);
			$sum = $result[0]['sums'];
		}		
		echo $sum;
	}
	
	public static function getEntriesCountByInfringementCategoryId($infringementCategoryId){
		$result = PDO_DB::select("SELECT COUNT(id) AS counts FROM " . self::$table . " WHERE category_id = ?  ", [$infringementCategoryId]);				
		echo $result[0]['counts'];
	}
	
	//
	
	
	public static function getDayEntriesSumByInfringementCategoryId($infringementCategoryId, $year = ''){
		$sum = 0;
		if(PDO_DB::tableColumExists(self::$table, 'amount') && PDO_DB::tableColumExists(self::$table, 'day')){
			$day 	= date('d');
			$year 	= $yr != ""  ?  $yr : date('Y');
			$result = PDO_DB::select("SELECT SUM(amount) AS sums FROM " . self::$table . " WHERE category_id = ? AND day = ? AND year = ? ", [$infringementCategoryId, $day, $year]);
			$sum 	= $result[0]['sums'];
		}		
		echo $sum;
	}
	
	public static function getWeekEntriesSumByInfringementCategoryId($infringementCategoryId, $year = ''){
		$sum = 0;
		if(PDO_DB::tableColumExists(self::$table, 'amount') && PDO_DB::tableColumExists(self::$table, 'week')){
			$week 	= date('W');
			$year 	= $yr != ""  ?  $yr : date('Y');
			$result = PDO_DB::select("SELECT SUM(amount) AS sums FROM " . self::$table . " WHERE category_id = ? AND week = ? AND year = ? ", [$infringementCategoryId, $week, $year]);
			$sum 	= $result[0]['sums'];
		}		
		echo $sum;
	}
	
	public static function getMonthEntriesSumByInfringementCategoryId($infringementCategoryId, $year = ''){
		$sum = 0;
		if(PDO_DB::tableColumExists(self::$table, 'amount') && PDO_DB::tableColumExists(self::$table, 'month')){
			$month 	= date('m');
			$year 	= $yr != ""  ?  $yr : date('Y');
			$result = PDO_DB::select("SELECT SUM(amount) AS sums FROM " . self::$table . " WHERE category_id = ? AND month = ? AND year = ? ", [$infringementCategoryId, $month, $year]);
			$sum 	= $result[0]['sums'];
		}		
		echo $sum;
	}


}


?>