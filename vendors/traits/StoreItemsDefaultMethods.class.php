<?php

trait StoreItemsDefaultMethods{
	
	public static function getEntriesByStoreItemId($storeItemId, $year = '', $limit = '', $offset = ''){		
		$target_year 	= $year == '' ? date('Y') : $year;		
		$lim 			= $limit == '' ? self::$page_limit : $limit;
		
		if($offset == ''){
			$sql = "SELECT * FROM " . self::$table . " WHERE item_id = ? AND year = ? LIMIT " . $lim;			
		}else{
			$sql = "SELECT * FROM " . self::$table . " WHERE item_id = ? AND year = ? LIMIT " . $lim . " OFFSET " .  $offset;			
		}
		
		$result = PDO_DB::select($sql, [$storeItemId, $target_year]);
		echo $result;
	}
	
	public static function getEntriesAmountSumByStoreItemId($storeItemId){
		$sum = 0;
		if(PDO_DB::tableColumExists(self::$table, 'amount')){
			$result = PDO_DB::select("SELECT SUM(amount) AS sums FROM " . self::$table . " WHERE item_id = ?  ", [$storeItemId]);
			$sum = $result[0]['sums'];
		}		
		echo $sum;
	}
	
	public static function getEntriesCountByStoreItemId($storeItemId){
		$result = PDO_DB::select("SELECT COUNT(id) AS counts FROM " . self::$table . " WHERE item_id = ?  ", [$storeItemId]);				
		echo $result[0]['counts'];
	}
	
	//
	
	
	public static function getDayEntriesSumByStoreItemId($storeItemId, $year = ''){
		$sum = 0;
		if(PDO_DB::tableColumExists(self::$table, 'amount') && PDO_DB::tableColumExists(self::$table, 'day')){
			$day 	= date('d');
			$year 	= $yr != ""  ?  $yr : date('Y');
			$result = PDO_DB::select("SELECT SUM(amount) AS sums FROM " . self::$table . " WHERE item_id = ? AND day = ? AND year = ? ", [$storeItemId, $day, $year]);
			$sum 	= $result[0]['sums'];
		}		
		echo $sum;
	}
	
	public static function getWeekEntriesSumByStoreItemId($storeItemId, $year = ''){
		$sum = 0;
		if(PDO_DB::tableColumExists(self::$table, 'amount') && PDO_DB::tableColumExists(self::$table, 'week')){
			$week 	= date('W');
			$year 	= $yr != ""  ?  $yr : date('Y');
			$result = PDO_DB::select("SELECT SUM(amount) AS sums FROM " . self::$table . " WHERE item_id = ? AND week = ? AND year = ? ", [$storeItemId, $week, $year]);
			$sum 	= $result[0]['sums'];
		}		
		echo $sum;
	}
	
	public static function getMonthEntriesSumByStoreItemId($storeItemId, $year = ''){
		$sum = 0;
		if(PDO_DB::tableColumExists(self::$table, 'amount') && PDO_DB::tableColumExists(self::$table, 'month')){
			$month 	= date('m');
			$year 	= $yr != ""  ?  $yr : date('Y');
			$result = PDO_DB::select("SELECT SUM(amount) AS sums FROM " . self::$table . " WHERE item_id = ? AND month = ? AND year = ? ", [$storeItemId, $month, $year]);
			$sum 	= $result[0]['sums'];
		}		
		echo $sum;
	}


}


?>