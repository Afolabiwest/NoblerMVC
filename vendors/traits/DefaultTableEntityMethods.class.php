<?php

trait DefaultTableEntityMethods{
	
	public static function getEntryById($entryId){
		if(self::entryExistById($entryId)){
			$result =  PDO_DB::select("SELECT * FROM " . self::$table . " WHERE id  = ? LIMIT 1", [$entryId]);
			return $result[0];
		}else{
			return 'no data';
		}
		
	}
	
	
	public static function deleteEntryById($entryId){
		$result =  PDO_DB::drop("DELETE FROM " . self::$table . " WHERE id  = ? LIMIT 1", [$entryId]);
		return $result;
	}	
	
	public static function fetchEntries($order = ' id ASC ', $offset = 0, $lim = ''){
		return self::getEntries($offset, $lim, $order);
	}
	
	public static function getEntries($offset = 0, $lim = '', $order = ' id ASC '){
		$limit = $lim == '' ? self::$dataLimit : $lim;
		$sql = "SELECT * FROM " . self::$table . " ORDER BY " . $order . " LIMIT " . $limit;
		
		if($offset > 0){
			$sql = "SELECT * FROM " . self::$table . " ORDER BY " . $order . " LIMIT " . $limit . " OFFSET " . $offset;
		}
		// echo $sql;
		$result =  PDO_DB::select($sql);		
		return $result;
	}
	
	public static function getEntriesCount(){
		$result =  PDO_DB::select("SELECT COUNT(id) AS counts FROM " . self::$table);
		return $result[0]['counts'];
	}
	
	public static function entryExist($columnName, $columnValue){
		$sql = "SELECT COUNT(id) AS counts FROM " . self::$table . " WHERE " . $columnName ." = ? LIMIT 1";
		$result =  PDO_DB::select($sql, [$columnValue]);
		return $result[0]['counts'] > 0;
	}
	
	public static function entryExistById($id){
		$result =  PDO_DB::select("SELECT COUNT(id) AS counts FROM " . self::$table . " WHERE id = ? LIMIT 1", [$id]);
		return $result[0]['counts'] > 0;
	}
	
	public static function setFriendlyUrl($text){
		$search1 = ['!', '@', '#', '$', '%', '^', '&', '*', '=', '{', '[', '}', ']'];
		$search2 = ['(', ')', '_', '+'];
		$friendly_url = str_replace($search1, "", $text);
		return str_replace($search2, "-", $friendly_url);
	}
	
	public static function updateEntryColumnsByColumns($data, $columnArray =[]){	
		return self::updateEntryByColumn($data, $columnArray);
	}
	
	
	public static function updateEntryByColumns($data, $columnArray =[]){	
		return PDO_DB::update_bulk($data, $columnArray, self::$table);
	}
	
	public static function updateEntryByColumn($data, $columnArray =[]){	
		return PDO_DB::update_bulk($data, $columnArray, self::$table);
	}
	
	public static function entryExistsByColumns($column_key_val = []){
		return self::entryExistByColumns($column_key_val);
	}
	
	public static function entryExistByColumns($column_key_val = []){
		$columnKeys 	= array_keys($column_key_val);
		$columnValues 	= array_values($column_key_val);
		$whereString 	= '';
		
		for($i = 0; $i < count($columnKeys); $i++){
			if($whereString == ''){
				$whereString .= $columnKeys[$i] . '= ?';
			}else{
				$whereString .= ' AND ' . $columnKeys[$i] . '= ?';
			}
		}
		
		$sql = "SELECT COUNT(id) AS counts FROM " . self::$table . " WHERE " . $whereString ." LIMIT 1";		
		$result =  PDO_DB::select($sql, $columnValues);		
		return $result[0]['counts'] > 0;
	}
	
	
	public static function getEntriesColumnsByColumns($target_col, $whereArgs = [], $whereNotArgs = [], $order = " id DESC ", $limit = ""){
		
		$targetCol 			= implode(", ", $target_col);
		$columnKeys 		= array_keys($whereArgs);
		$columnValues 		= array_values($whereArgs);
		
		$not_columnKeys 	= array_keys($whereNotArgs);
		$not_columnValues 	= array_values($whereNotArgs);
		
		$whereString 		= '';
		
		for($i = 0; $i < count($columnKeys); $i++){
			if($whereString == ''){
				$whereString .= $columnKeys[$i] . ' = ?';
			}else{
				$whereString .= ' AND ' . $columnKeys[$i] . ' = ?';
			}
		}
		
		for($i = 0; $i < count($not_columnKeys); $i++){
			if($whereString == ''){
				$whereString .= $not_columnKeys[$i] . ' <> ?';
			}else{
				$whereString .= ' AND ' . $not_columnKeys[$i] . ' <> ?';
			}
		}
		$columnValues = array_merge($columnValues, $not_columnValues);
		$sql = "SELECT " . $targetCol . " FROM " . self::$table . " WHERE " . $whereString ." ORDER BY " . $order;
		if($limit != ''){
			$sql = "SELECT " . $targetCol . " FROM " . self::$table . " WHERE " . $whereString ." ORDER BY " . $order . " LIMIT " . $limit;
		}
		$result =  PDO_DB::select($sql, $columnValues);
		
		return $result;
		
	}
	
	
	public static function updateColumns($targetCols = [], $whereArgs = [], $whereNotArgs = []){
		
		
		$updateKeys 		= array_keys($targetCols);
		$updatevalues 		= array_values($targetCols);
		
		$columnKeys 		= array_keys($whereArgs);
		$columnValues 		= array_values($whereArgs);
		
		$not_columnKeys 	= array_keys($whereNotArgs);
		$not_columnValues 	= array_values($whereNotArgs);
		
		$updateString 		= '';
		$whereString 		= '';
		
		for($i = 0; $i < count($columnKeys); $i++){
			if($whereString == ''){
				$whereString .= $columnKeys[$i] . ' = ?';
			}else{
				$whereString .= ' AND ' . $columnKeys[$i] . ' = ?';
			}
		}
		
		for($i = 0; $i < count($not_columnKeys); $i++){
			if($whereString == ''){
				$whereString .= $not_columnKeys[$i] . ' <> ?';
			}else{
				$whereString .= ' AND ' . $not_columnKeys[$i] . ' <> ?';
			}
		}
		
		for($i = 0; $i < count($updateKeys); $i++){
			if($updateString == ''){
				$updateString .= $updateKeys[$i] . ' = ?';
				
			}else{
				$updateString .= ', ' . $updateKeys[$i] . ' = ? ';
				
			}
		}
		
		
		$columnValues = array_merge($columnValues, $not_columnValues);
		$sql = "UPDATE " . self::$table . " SET " . $updateString . " WHERE " . $whereString;
		
		$result =  PDO_DB::update_bulk($sql, $columnValues);
		PDO_DB::update_bulk($data, $columnArray, self::$table);
		
		return $result;
		
	}
	
	public static function updateAllColumns($data = [], $where = [], $whereNot = [], $limit = ""){
		
		$updateDataKeys   = array_keys($data);
		$insertDataValues = array_values($data);
		
		$whereDataKeys    = array_keys($where);
		$whereDataValues  = array_values($where);
		
		$whereNotDataKeys    = array_keys($whereNot);
		$whereNotDataValues  = array_values($whereNot);
		
		$bind_data 		  = array_merge($whereDataValues, $whereNotDataValues);
		$where_data 	  = array_merge($where, $whereNot);
		$queryActionStr   = "";
		$whereActionStr   = "";
		
		// Update string
		
		for($i = 0; $i < count($updateDataKeys); $i++){
			if($queryActionStr == ""){
				$queryActionStr   .= $updateDataKeys[$i] . "=:" . $updateDataKeys[$i];
			}else{
				$queryActionStr   .= ", " . $updateDataKeys[$i] . "=:" . $updateDataKeys[$i];
			}
		}
		
		// Where queries
		
		for($i = 0; $i < count($whereDataKeys); $i++){
			if($whereActionStr == ""){
				$whereActionStr  =  $whereDataKeys[$i] . "='" . $whereDataValues[$i] . "'";
			}else{
				$whereActionStr .= " AND " . $whereDataKeys[$i] . "='" . $whereDataValues[$i] . "'";
			}
		}
		
		// Where not queries
		
		for($i = 0; $i < count($whereNotDataKeys); $i++){
			if($whereActionStr == ""){
				$whereActionStr  =  $whereNotDataKeys[$i] . "<>'" . $whereNotDataValues[$i] . "'";
			}else{
				$whereActionStr .= " AND " . $whereNotDataKeys[$i] . "<>'" . $whereNotDataValues[$i] . "'";
			}
		}
		
		if(count($where_data) > 0 || $where_data != NULL){
		
			$sql = "UPDATE " . self::$table . " SET " . $queryActionStr . " WHERE " . $whereActionStr . " LIMIT " . $limit;
			if($limit == ""){
				$sql = "UPDATE " . self::$table . " SET " . $queryActionStr . " WHERE " . $whereActionStr;
			}
			
			return PDO_DB::update($sql, $bind_data);

		}else{
			
			$sql = "UPDATE " . self::$table . " SET " . $queryActionStr . " LIMIT " . $limit;		
			if($limit == ""){
				$sql = "UPDATE " . self::$table . " SET " . $queryActionStr;
			}
			
			return PDO_DB::update($sql);
		}
		
		
	}
	
	
	
	public static function getEntriesCountByColumns($column_key_val = []){
		
		$columnKeys 	= array_keys($column_key_val);
		$columnValues 	= array_values($column_key_val);
		$whereString 	= '';
		
		for($i = 0; $i < count($columnKeys); $i++){
			if($whereString == ''){
				$whereString .= $columnKeys[$i] . '= ?';
			}else{
				$whereString .= ' AND ' . $columnKeys[$i] . '= ?';
			}
		}
		
		$sql = "SELECT COUNT(id) AS counts FROM " . self::$table . " WHERE " . $whereString;
		
		$result =  PDO_DB::select($sql, $columnValues);
		return $result[0]['counts'];
		
		
	}
	
	
	public static function getEntriesByColumns($column_key_val = [], $order = 'id DESC', $limit = ''){
		$columnKeys 	= array_keys($column_key_val);
		$columnValues 	= array_values($column_key_val);
		$whereString 	= '';
		
		for($i = 0; $i < count($columnKeys); $i++){
			if($whereString == ''){
				$whereString .= $columnKeys[$i] . '= ?';
			}else{
				$whereString .= ' AND ' . $columnKeys[$i] . '= ?';
			}
		}
		
		$sql = "SELECT * FROM " . self::$table . " WHERE " . $whereString . " ORDER BY " . $order;	
		
		if($limit != ''){
			$sql = "SELECT * FROM " . self::$table . " WHERE " . $whereString . " ORDER BY " . $order . " LIMIT " . $limit;		
		}
		
		$result =  PDO_DB::select($sql, $columnValues);		
		return $result;
		
	}
	
	public static function getEntryByColumns($column_key_val = []){
		$columnKeys 	= array_keys($column_key_val);
		$columnValues 	= array_values($column_key_val);
		$whereString 	= '';
		
		for($i = 0; $i < count($columnKeys); $i++){
			if($whereString == ''){
				$whereString .= $columnKeys[$i] . '= ?';
			}else{
				$whereString .= ' AND ' . $columnKeys[$i] . '= ?';
			}
		}
		
		$sql = "SELECT * FROM " . self::$table . " WHERE " . $whereString ." ORDER BY id DESC  LIMIT 1";
		$result =  PDO_DB::select($sql, $columnValues);
		
		return count($result) > 0 ? $result[0] : [];
		
	}
	
	public static function getEntryColumnsByColumns($target_col = [], $whereArgs = [], $whereNotArgs = []){
		
		
		$targetCol 		= implode(", ", $target_col);
		$columnKeys 	= array_keys($whereArgs);
		$columnValues 	= array_values($whereArgs);
		
		$not_columnKeys 	= array_keys($whereNotArgs);
		$not_columnValues 	= array_values($whereNotArgs);
		
		$whereString 	= '';
		
		for($i = 0; $i < count($columnKeys); $i++){
			if($whereString == ''){
				$whereString .= $columnKeys[$i] . ' = ?';
			}else{
				$whereString .= ' AND ' . $columnKeys[$i] . ' = ?';
			}
		}
		
		for($i = 0; $i < count($not_columnKeys); $i++){
			if($whereString == ''){
				$whereString .= $not_columnKeys[$i] . ' <> ?';
			}else{
				$whereString .= ' AND ' . $not_columnKeys[$i] . ' <> ?';
			}
		}
		
		$sql = "SELECT " . $targetCol . " FROM " . self::$table . " WHERE " . $whereString ." ORDER BY id DESC  LIMIT 1";
		$result =  PDO_DB::select($sql, $columnValues);
		
		return count($result) > 0 ? $result[0] : [];
		
	}
	
	public static function getEntryExistByColumns($column_key_val = []){
		$columnKeys 	= array_keys($column_key_val);
		$columnValues 	= array_values($column_key_val);
		$whereString 	= '';
		
		for($i = 0; $i < count($columnKeys); $i++){
			if($whereString == ''){
				$whereString .= $columnKeys[$i] . '= ?';
			}else{
				$whereString .= ' AND ' . $columnKeys[$i] . '= ?';
			}
		}
		
		$sql = "SELECT COUNT(id) AS counts FROM " . self::$table . " WHERE " . $whereString ." ORDER BY id DESC  LIMIT 1";
		$result =  PDO_DB::select($sql, $columnValues);
		
		return $result[0]['counts'] > 0;
		
	}
	
	public static function getEntriesAmountSumByColumns($where = [], $whereNot = []){
		$whereKeys 		= array_keys($where);
		$whereValues 	= array_values($where);
		$whereNotKeys 	= array_keys($whereNot);
		$whereNotValues = array_values($whereNot);
		$whereString 	= '';
		
		for($i = 0; $i < count($whereKeys); $i++){
			if($whereString == ''){
				$whereString .= $whereKeys[$i] . '= ?';
			}else{
				$whereString .= ' AND ' . $whereKeys[$i] . '= ?';
			}
		}
		
		for($i = 0; $i < count($whereNotKeys); $i++){
			if($whereString == ''){
				$whereString .= $whereNotKeys[$i] . ' <> ?';
			}else{
				$whereString .= ' AND ' . $whereNotKeys[$i] . ' <> ?';
			}
		}
		
		$where_data = array_merge($whereValues, $whereNotValues);
		$sql = "SELECT SUM(amount) AS sum FROM " . self::$table . " WHERE " . $whereString;
		//	echo $sql . '<br>';
		
		$result =  PDO_DB::select($sql, $where_data);		
		return $result[0]['sum'];
		
	}
	
	public static function getLastEntryByColumns($column_key_val = [], $not_column_key_val = []){
		
		$columnKeys 	= array_keys($column_key_val);
		$columnValues 	= array_values($column_key_val);
		
		$not_columnKeys 	= array_keys($not_column_key_val);
		$not_columnValues 	= array_values($not_column_key_val);
		
		$whereString 	= '';
		
		if(count($columnKeys) > 0){
			for($i = 0; $i < count($columnKeys); $i++){
				if($whereString == ''){
					$whereString .= $columnKeys[$i] . ' = ? ';
				}else{
					$whereString .= ' AND ' . $columnKeys[$i] . ' = ? ';
				}
			}
		}
		
		if(count($not_columnKeys) > 0){
		
			for($i = 0; $i < count($not_columnKeys); $i++){
				if($whereString == ''){
					$whereString .= $not_columnKeys[$i] . ' <> ? ';
				}else{
					$whereString .= ' AND ' . $not_columnKeys[$i] . ' <> ? ';
				}
			}
		}
		
		if($whereString != ""){
			$sql = "SELECT * FROM " . self::$table . " WHERE " . $whereString . " ORDER BY id DESC LIMIT 1";
			$columnValues = array_merge($columnValues, $not_columnValues);
			$result 	  =  PDO_DB::select($sql, $columnValues);
		}else{
			$sql = "SELECT * FROM " . self::$table . " ORDER BY id DESC LIMIT 1";			
			$result 	  =  PDO_DB::select($sql);
		}
		
		
		return $result[0];
	}
	
	
	public static function getColumnSumByColumns($targetColumn, $whereArgs = [], $whereNotArgs = []){
		
		$columnKeys 	= array_keys($whereArgs);
		$columnValues 	= array_values($whereArgs);
		
		$not_columnKeys 	= array_keys($whereNotArgs);
		$not_columnValues 	= array_values($whereNotArgs);
		
		$whereString 	= '';
		
		for($i = 0; $i < count($columnKeys); $i++){
			if($whereString == ''){
				$whereString .= $columnKeys[$i] . ' = ?';
			}else{
				$whereString .= ' AND ' . $columnKeys[$i] . ' = ?';
			}
		}
		
		for($i = 0; $i < count($not_columnKeys); $i++){
			if($whereString == ''){
				$whereString .= $not_columnKeys[$i] . ' <> ?';
			}else{
				$whereString .= ' AND ' . $not_columnKeys[$i] . ' <> ?';
			}
		}
		
		$sql 	= "SELECT SUM(" . $targetColumn . ") AS sum FROM " . self::$table . " WHERE " . $whereString;
		
		$columnValues = array_merge($columnValues, $not_columnValues);
		$result = PDO_DB::select($sql, $columnValues);		
		return $result[0]['sum'];
		
	}
	
	public static function getColumnSumBetween($targetColumn, $startDate, $endDate){
		
		$sql 	= "SELECT SUM(" . $targetColumn . ") AS sum FROM " . self::$table . " WHERE date BETWEEN " . $startDate . " AND " . $endDate;
		$result = PDO_DB::select($sql);		
		return $result[0]['sum'];
		
	}
	
	public static function incrementColumnByColumns(){
		
	}
	
	
}

?>