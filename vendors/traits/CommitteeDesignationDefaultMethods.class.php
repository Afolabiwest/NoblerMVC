<?php

trait CommitteeDesignationDefaultMethods{
	
	public static function getEntriesByDesignationId($designationId, $year = '', $limit = '', $offset = ''){		
		$target_year 	= $year == '' ? date('Y') : $year;		
		$lim 			= $limit == '' ? self::$page_limit : $limit;
		
		if($offset == ''){
			$sql = "SELECT * FROM " . self::$table . " WHERE designation_id = ? AND year = ? LIMIT " . $lim;			
		}else{
			$sql = "SELECT * FROM " . self::$table . " WHERE designation_id = ? AND year = ? LIMIT " . $lim . " OFFSET " .  $offset;			
		}
		
		$result = PDO_DB::select($sql, [$designationId, $target_year]);
		echo $result;
	}
	
	public static function getEntriesAmountSumByDesignationId($designationId){
		$sum = 0;
		if(PDO_DB::tableColumExists(self::$table, 'amount')){
			$result = PDO_DB::select("SELECT SUM(amount) AS sums FROM " . self::$table . " WHERE designation_id = ?  ", [$designationId]);
			$sum = $result[0]['sums'];
		}		
		echo $sum;
	}
	
	public static function getEntriesCountByDesignationId($designationId){
		$result = PDO_DB::select("SELECT COUNT(id) AS counts FROM " . self::$table . " WHERE designation_id = ?  ", [$designationId]);				
		echo $result[0]['counts'];
	}
	
	//
	
	
	public static function getDayEntriesSumByDesignationId($designationId, $year = ''){
		$sum = 0;
		if(PDO_DB::tableColumExists(self::$table, 'amount') && PDO_DB::tableColumExists(self::$table, 'day')){
			$day 	= date('d');
			$year 	= $yr != ""  ?  $yr : date('Y');
			$result = PDO_DB::select("SELECT SUM(amount) AS sums FROM " . self::$table . " WHERE designation_id = ? AND day = ? AND year = ? ", [$designationId, $day, $year]);
			$sum 	= $result[0]['sums'];
		}		
		echo $sum;
	}
	
	public static function getWeekEntriesSumByDesignationId($designationId, $year = ''){
		$sum = 0;
		if(PDO_DB::tableColumExists(self::$table, 'amount') && PDO_DB::tableColumExists(self::$table, 'week')){
			$week 	= date('W');
			$year 	= $yr != ""  ?  $yr : date('Y');
			$result = PDO_DB::select("SELECT SUM(amount) AS sums FROM " . self::$table . " WHERE designation_id = ? AND week = ? AND year = ? ", [$designationId, $week, $year]);
			$sum 	= $result[0]['sums'];
		}		
		echo $sum;
	}
	
	public static function getMonthEntriesSumByDesignationId($designationId, $year = ''){
		$sum = 0;
		if(PDO_DB::tableColumExists(self::$table, 'amount') && PDO_DB::tableColumExists(self::$table, 'month')){
			$month 	= date('m');
			$year 	= $yr != ""  ?  $yr : date('Y');
			$result = PDO_DB::select("SELECT SUM(amount) AS sums FROM " . self::$table . " WHERE designation_id = ? AND month = ? AND year = ? ", [$designationId, $month, $year]);
			$sum 	= $result[0]['sums'];
		}		
		echo $sum;
	}


}


?>