<?php
trait TicketDefaultMethods{
	
	public static function getEntriesByCategoryId($categoryId, $year = '', $limit = '', $offset = ''){		
		$target_year = $year == '' ? date('Y') : $year;		
		$lim 		 = $limit == '' ? self::$page_limit : $limit;
		
		if($offset == ''){
			$sql = "SELECT * FROM " . self::$table . " WHERE category_id = ? AND year = ? LIMIT " . $lim;			
		}else{
			$sql = "SELECT * FROM " . self::$table . " WHERE category_id = ? AND year = ? LIMIT " . $lim . " OFFSET " .  $offset;			
		}
		
		$result = PDO_DB::select($sql, [$categoryId, $target_year]);
		return $result;
	}
	
	public static function getEntriesCountByCategoryId($categoryId){
		$result = PDO_DB::select("SELECT COUNT(id) AS counts FROM " . self::$table . " WHERE category_id = ?  ", [$categoryId]);				
		return  $result[0]['counts'];
	}
	
	

}


?>