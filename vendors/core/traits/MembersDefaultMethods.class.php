<?php

trait MembersDefaultMethods{
	
	public static function getEntriesByMemberId($memberId, $year = '', $limit = '', $offset = ''){		
		$target_year 	= $year == '' ? date('Y') : $year;		
		$lim 			= $limit == '' ? self::$page_limit : $limit;
		
		if($offset == ''){
			$sql = "SELECT * FROM " . self::$table . " WHERE member_id = ? AND year = ? LIMIT " . $lim;			
		}else{
			$sql = "SELECT * FROM " . self::$table . " WHERE member_id = ? AND year = ? LIMIT " . $lim . " OFFSET " .  $offset;			
		}
		
		$result = PDO_DB::select($sql, [$memberId, $target_year]);
		return $result;
	}
	
	public static function getEntryByEmail($email){		
		$result = PDO_DB::select("SELECT * FROM " . self::$table . " WHERE email = ? LIMIT 1", [$email]);
		return $result[0];
	}
	
	public static function getEntriesAmountSumByMemberId($memberId){
		$sum = 0;
		if(PDO_DB::tableColumExists(self::$table, 'amount')){			
			$result = PDO_DB::select("SELECT SUM(amount) AS sums FROM " . self::$table . " WHERE member_id = ?  ", [$memberId]);
			$sum 	= $result[0]['sums'];
		}
		
		
		return $sum;
	}
	
	public static function getEntriesCountByMemberId($memberId){
		$sum = 0;
		if(PDO_DB::tableColumExists(self::$table, 'amount')){
			$result = PDO_DB::select("SELECT COUNT(id) AS counts FROM " . self::$table . " WHERE member_id = ?  ", [$memberId]);				
			$sum 	= $result[0]['counts'];
		}		
		return $sum;
	}
	
	public static function getDayEntriesSumByMemberId($memberId, $year = ''){
		$sum = 0;
		if(PDO_DB::tableColumExists(self::$table, 'amount') && PDO_DB::tableColumExists(self::$table, 'day')){
			$day 	= date('d');
			$year 	= $yr != ""  ?  $yr : date('Y');
			$result = PDO_DB::select("SELECT SUM(amount) AS sums FROM " . self::$table . " WHERE member_id = ? AND day = ? AND year = ? ", [$memberId, $day, $year]);
			$sum 	= $result[0]['sums'];
		}		
		return $sum;
	}
	
	public static function getWeekEntriesSumByMemberId($memberId, $year = ''){
		$sum = 0;
		if(PDO_DB::tableColumExists(self::$table, 'amount') && PDO_DB::tableColumExists(self::$table, 'week')){
			$week 	= date('W');
			$year 	= $yr != ""  ?  $yr : date('Y');
			$result = PDO_DB::select("SELECT SUM(amount) AS sums FROM " . self::$table . " WHERE member_id = ? AND week = ? AND year = ? ", [$memberId, $week, $year]);
			$sum 	= $result[0]['sums'];
		}		
		return $sum;
	}
	
	public static function getMonthEntriesSumByMemberId($memberId, $year = ''){
		$sum = 0;
		if(PDO_DB::tableColumExists(self::$table, 'amount') && PDO_DB::tableColumExists(self::$table, 'month')){
			$month 	= date('m');
			$year 	= $yr != ""  ?  $yr : date('Y');
			$result = PDO_DB::select("SELECT SUM(amount) AS sums FROM " . self::$table . " WHERE member_id = ? AND month = ? AND year = ? ", [$memberId, $month, $year]);
			$sum 	= $result[0]['sums'];
		}		
		return $sum;
	}


}

?>