<?php

trait CategoriesDefaultMethods{
	
	public static function getEntriesByCategoryId($categoryId, $year = '', $limit = '', $offset = ''){		
		$target_year 	= $year == '' ? date('Y') : $year;		
		$lim 			= $limit == '' ? self::$page_limit : $limit;
		
		if($offset == ''){
			$sql = "SELECT * FROM " . self::$table . " WHERE category_id = ? AND year = ? LIMIT " . $lim;			
		}else{
			$sql = "SELECT * FROM " . self::$table . " WHERE category_id = ? AND year = ? LIMIT " . $lim . " OFFSET " .  $offset;			
		}
		
		$result = PDO_DB::select($sql, [$categoryId, $target_year]);
		echo $result;
	}
	
	public static function getEntriesAmountSumByCategoryId($categoryId){
		$sum = 0;
		if(PDO_DB::tableColumExists(self::$table, 'amount')){
			$result = PDO_DB::select("SELECT SUM(amount) AS sums FROM " . self::$table . " WHERE category_id = ?  ", [$categoryId]);
			$sum = $result[0]['sums'];
		}		
		echo $sum;
	}
	
	public static function getEntriesCountByCategoryId($categoryId){
		$result = PDO_DB::select("SELECT COUNT(id) AS counts FROM " . self::$table . " WHERE category_id = ?  ", [$categoryId]);				
		echo $result[0]['counts'];
	}
	
	//
	
	public static function getDayEntriesSumByCategoryId($categoryId, $year = ''){
		$sum = 0;
		if(PDO_DB::tableColumExists(self::$table, 'amount')){
			$day = date('d');
			$year = $yr != ""  ?  $yr : date('Y');
			$result = PDO_DB::select("SELECT SUM(amount) AS sums FROM " . self::$table . " WHERE category_id = ? AND day = ? AND year = ? ", [$categoryId, $day, $year]);
			$sum = $result[0]['sums'];
		}		
		echo $sum;
	}
	
	public static function getWeekEntriesSumByCategoryId($categoryId, $year = ''){
		$sum = 0;
		if(PDO_DB::tableColumExists(self::$table, 'amount')){
			$week = date('W');
			$year = $yr != ""  ?  $yr : date('Y');
			$result = PDO_DB::select("SELECT SUM(amount) AS sums FROM " . self::$table . " WHERE category_id = ? AND week = ? AND year = ? ", [$categoryId, $week, $year]);
			$sum = $result[0]['sums'];
		}		
		echo $sum;
	}
	
	public static function getMonthEntriesSumByCategoryId($categoryId, $year = ''){
		$sum = 0;
		if(PDO_DB::tableColumExists(self::$table, 'amount')){
			$month = date('m');
			$year = $yr != ""  ?  $yr : date('Y');
			$result = PDO_DB::select("SELECT SUM(amount) AS sums FROM " . self::$table . " WHERE category_id = ? AND month = ? AND year = ? ", [$categoryId, $month, $year]);
			$sum = $result[0]['sums'];
		}		
		echo $sum;
	}
	


}


?>