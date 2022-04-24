<?php

class Tables extends PDO_DB{
	
	use DefaultTableEntityMethods;
	public static $dataLimit  	= '1000';
	public static $table  		= '';
	public static $result 		= '';
	public static $sql 			= '';
	public static $table_config = ['type' => 'varchar', 'length' => '255', 'null_status' => 'NOT NULL', 'default' => '', 'enum_options' => '', 'unique_status' => false];
	public static $tables_stack = [];
	public static $response 	= [];
	public static $lim = '', $order = ' id ASC ';
	
	public static function get($table){
		
		self::$table = $table;		
		return new self;
		
	}
	
	public static function set($table){
		return self::get($table);		
	}
	
	public static function postEntry($postedData = []){
		
		return self::addEntry($postedData);
		
	}
	public static function postRow($postedData = []){
		
		return self::addEntry($postedData);
		
	}
	
	public static function getEntryById( $entryId,  $findOrFail =  false ){
		
		if(self::entryExistById($entryId)){
			$result =  PDO_DB::select("SELECT * FROM " . self::$table . " WHERE id  = ? LIMIT 1", [$entryId]);
			if( count( $result[0] ) < 1 && $findOrFail ==  true){
				return http_response_code( 404 );	
			}
			return $result[0];
		}else{
			return 'no data';
		}
		
	}
	
	public static function postRows($dataArrayRows = []){
		
		$errorCount = 0;		
		for($i = 0; $i < count($dataArrayRows); $i++){
			if(!self::entryExistsByColumns($dataArrayRows[$i])){
				if(!self::addEntry($dataArrayRows[$i])){
					$errorCount++;
				}
			}
			
		}		
		return $errorCount < 1;
		
	}
	
	public static function deleteEntryById($entryId){
		// Delete a row based on its ID
		$result =  PDO_DB::drop("DELETE FROM " . self::$table . " WHERE id  = ? LIMIT 1", [$entryId]);
		self::$result = $result;
		return self::$result;
	}

	public static function deleteEntryByColumns($where = [], $whereNot = []){
		
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
		$sql 		= "DELETE FROM " . self::$table . " WHERE " . $whereString . " LIMIT 1";
		$result 	=  PDO_DB::drop($sql, $where_data);
		self::$result = $result;
		return self::$result;
		
	}
	
	public static function deleteEntriesByColumns($where = [], $whereNot = [], $limit = ""){
		
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
		$sql 		= "DELETE FROM " . self::$table . " WHERE " . $whereString;
		
		if($limit !=""){
			$sql 	= "DELETE FROM " . self::$table . " WHERE " . $whereString . " LIMIT " . $limit;
		}
		
		$result 	=  PDO_DB::drop($sql, $where_data);
		self::$result = $result;
		return self::$result;
		
	}
	
	
	public static function entries($offset = 0, $lim = '', $order = ' id ASC '){
		self::$result = self::getEntries($offset, $lim, $order);
		return self::$result;
	}
	
	public static function entriesColumns($columns = [], $offset = 0, $lim = '', $order = ' id ASC '){
		self::$result = self::getEntriesColumns($columns, $offset, $lim, $order);
		return self::$result;
	}
	
	public static function getEntries($offset = 0, $lim = '', $order = ' id ASC '){
		//	Returns all result set  and give the option limit and offset. By default, it returns data
		//	in ascending order but you can specify otherwise
		
		$limit = $lim == '' ? self::$dataLimit : $lim;
		$sql = "SELECT * FROM " . self::$table . " ORDER BY " . $order . " LIMIT " . $limit;
		
		if($offset > 0){
			$sql = "SELECT * FROM " . self::$table . " ORDER BY " . $order . " LIMIT " . $limit . " OFFSET " . $offset;
		}
		// echo $sql;
		
		$result =  PDO_DB::select($sql);		
		self::$result = $result;
		
		//	return new self;
		return self::$result;
		
	}
	
	public static function getEntriesColumns($columns = [], $offset = 0, $lim = '', $order = ' id ASC '){
		//	Returns all result set  and give the option limit and offset. By default, it returns data
		//	in ascending order but you can specify otherwise
		if($columns == null || count($columns) == 0){
			$limit = $lim == '' ? self::$dataLimit : $lim;
			$sql = "SELECT * FROM " . self::$table . " ORDER BY " . $order . " LIMIT " . $limit;
			
			if($offset > 0){
				$sql = "SELECT * FROM " . self::$table . " ORDER BY " . $order . " LIMIT " . $limit . " OFFSET " . $offset;
			}
		}else{
			$targetColumns = implode(", ", $columns);
			$limit = $lim == '' ? self::$dataLimit : $lim;
			$sql = "SELECT " . $targetColumns . " FROM " . self::$table . " ORDER BY " . $order . " LIMIT " . $limit;
			
			if($offset > 0){
				$sql = "SELECT " . $targetColumns . " FROM " . self::$table . " ORDER BY " . $order . " LIMIT " . $limit . " OFFSET " . $offset;
			}
		}
		
		// echo $sql;
		
		$result =  PDO_DB::select($sql);		
		self::$result = $result;
		
		//	return new self;
		return self::$result;
		
	}
	
	public static function entriesCount(){
		self::$result = self::getEntriesCount();
		return self::$result;	
	}
	
	public static function getEntriesCount($where = [], $whereNot = []){
		
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
		
		
		
		if($whereString != ""){
			$result =  PDO_DB::select("SELECT COUNT(id) AS counts FROM " . self::$table . " WHERE " . $whereString, $where_data);
		
		}else{
			$result =  PDO_DB::select("SELECT COUNT(id) AS counts FROM " . self::$table);
		}
		
		self::$result = $result[0]['counts'];		
		return self::$result;
		
	}
	
	public static function getEntriesCountByColumns($where = [], $whereNot = []){
		
		//	Returns the number of entries in table
		
		if($where != null || count($where) > 0){
			
			$where_keys 		= array_keys($where);
			$where_not_keys 	= array_keys($whereNot);			
			$whereString 		= '';
			
			for($i = 0; $i < count($where_keys); $i++){
				if($whereString != ''){
					$whereString .= ' AND ' . $where_keys[$i] . ' = :' .$where_keys[$i];
				}else{
					$whereString .= $where_keys[$i] . ' = :' .$where_keys[$i];
				}
			}
			
			for($i = 0; $i < count($where_not_keys); $i++){
				if($whereString != ''){
					$whereString .= ' AND ' . $where_not_keys[$i] . ' = :' .$where_not_keys[$i];
				}else{
					$whereString .= $where_not_keys[$i] . ' = :' .$where_not_keys[$i];
				}
			}
			
			
		}
		
		//	$bindData = array_merge($where_values, $where_not_values);
		$bindData = array_merge($where, $whereNot);
		
		$sql 	=  "SELECT COUNT(id) AS counts FROM " . self::$table . " WHERE " . $whereString;
		
		$result =  PDO_DB::select($sql, $bindData);		
		
		self::$result = $result[0]['counts'];
		return self::$result;
		
	}
	
	public static function entryExist($columnName, $columnValue){
		
		$sql = "SELECT COUNT(id) AS counts FROM " . self::$table . " WHERE " . $columnName ." = ? LIMIT 1";
		$result =  PDO_DB::select($sql, [$columnValue]);
		self::$result = $result[0]['counts'] > 0;
		return self::$result;
		
	}
	
	public static function entryExists($columnName, $columnValue){
		
		return self::entryExist($columnName, $columnValue);
		
	}
	
	public static function entryExistById($id){
		
		$result =  PDO_DB::select("SELECT COUNT(id) AS counts FROM " . self::$table . " WHERE id = ? LIMIT 1", [$id]);
		self::$result = $result[0]['counts'] > 0;
		//	return new self;
		return self::$result;
		
	}
	
	public static function setFriendlyUrl($text){
		
		$search1 = ['!', '@', '#', '$', '%', '^', '&', '*', '=', '{', '[', '}', ']'];
		$search2 = ['(', ')', '_', '+'];
		$friendly_url = str_replace($search1, "", $text);
		self::$result = str_replace($search2, "-", $friendly_url);
		//	return new self;
		return self::$result;
		
	}
	
	
	
	public static function entryExistsByColumns($where = [], $whereNot = []){
		return self::entryExistByColumns($where, $whereNot);
	}
	
	public static function entryExistByColumns($where = [], $whereNot = [], $findOrFail = false ){
		
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
		
		$sql = "SELECT COUNT(id) AS counts FROM " . self::$table . " WHERE " . $whereString ." LIMIT 1";
		
		$result =  PDO_DB::select($sql, $where_data);
		
		self::$result = $result[0]['counts'] > 0;
		if( $result[0]['counts'] < 1 && $findOrFail == true ){
			return http_response_code( 404 );	
		}	
		return self::$result;
		
	}
	
	//	public static function getEntriesByColumns($where = [], $whereNot = [], $order = 'id DESC', $limit = ''){
	public static function findEntriesByColumns($where = [], $whereNot = [], $order = 'id DESC', $limit = ''){
		$result = self::getEntriesByColumns($where, $whereNot, $order, $limit);
		return $result;
	}
	
	public static function findEntriesByNotColumns($whereNot = [], $order = 'id DESC', $limit = ''){
		return self::getEntriesByColumns([], $whereNot, $order, $limit);
	}
	
	public static function getEntriesByNotColumns($whereNot = [], $order = 'id DESC', $limit = ''){
		return self::getEntriesByColumns([], $whereNot, $order, $limit = '');
	}
	
	public static function getEntriesByColumns($where = [], $whereNot = [], $order = 'id DESC', $limit = ''){
	
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
	
		$sql = "SELECT * FROM " . self::$table . " WHERE " . $whereString ." ORDER BY " . $order;
		if($whereString != '' && $limit != ''){
			$sql = "SELECT * FROM " . self::$table . " WHERE " . $whereString . " ORDER BY " . $order . " LIMIT " . $limit;		
		}
		
		if($whereString == '' && $limit != ''){
			$sql = "SELECT * FROM " . self::$table . " ORDER BY " . $order . " LIMIT " . $limit;		
		}
		
		if($whereString == '' && $limit == ''){
			$sql = "SELECT * FROM " . self::$table . " ORDER BY " . $order ;		
		}
		
		#	echo $sql . '<br>';
		
		$result =  PDO_DB::select($sql, $where_data);
		$result = count($result) > 0 ? $result : [];
		self::$result = $result;
		return self::$result;
		
	}
	
	public static function getEntriesByORColumns($where = [], $order = 'id DESC', $limit = ''){
		
		$whereKeys 		= array_keys($where);
		$whereValues 	= array_values($where);
		
		$whereNotKeys 	= array_keys($whereNot);
		$whereNotValues = array_values($whereNot);
		
		$whereString 	= '';
		
		for($i = 0; $i < count($whereKeys); $i++){
			if($whereString == ''){
				$whereString .= $whereKeys[$i] . '= ?';
			}else{
				$whereString .= ' OR ' . $whereKeys[$i] . '= ?';
			}
		}
		
		
		
		
		$sql = "SELECT * FROM " . self::$table . " WHERE " . $whereString ." ORDER BY " . $order;
		if($limit != ''){
			$sql = "SELECT * FROM " . self::$table . " WHERE " . $whereString . " ORDER BY " . $order . " LIMIT " . $limit;		
		}
		$result =  PDO_DB::select($sql, $whereValues);
		
		self::$result = $result;
		return self::$result;
		
	}
	
	
	public static function getEntriesLikeColumns($searchTerm, $where = [], $order = 'id DESC', $limit = ''){
		
		$whereKeys 		= $where;
		
		$whereString 	= '';
		
		for($i = 0; $i < count($whereKeys); $i++){
			if($whereString == ''){
				//	$whereString .= $whereKeys[$i] . " LIKE '%" . $searchTerm . "%'";
				$whereString .= $whereKeys[$i] . " LIKE '%" . $searchTerm . "%'";
			}else{
				//	$whereString .= ' OR ' . $whereKeys[$i] . " LIKE '%" . $searchTerm . "%'";
				$whereString .= ' OR ' . $whereKeys[$i] . " LIKE '%" . $searchTerm . "%'";
			}
		}
		
		$sql = "SELECT * FROM " . self::$table . " WHERE " . $whereString ." ORDER BY " . $order;
		if($limit != ''){
			$sql = "SELECT * FROM " . self::$table . " WHERE " . $whereString . " ORDER BY " . $order . " LIMIT " . $limit;		
		}
		
		//	$result =  PDO_DB::select($sql, [$searchTerm]);
		$result =  PDO_DB::select($sql);
		
		self::$result = $result;
		return self::$result;
		
	}

	
		
	public static function getEntriesColumnsLikeColumns($searchTerm, $targetColumns = [], $where = [], $order = 'id DESC', $limit = ''){
		
		$whereKeys 		= $where;
		
		$whereString 	= '';
		
		for($i = 0; $i < count($whereKeys); $i++){
			if($whereString == ''){
				//	$whereString .= $whereKeys[$i] . " LIKE '%" . $searchTerm . "%'";
				$whereString .= $whereKeys[$i] . " LIKE '%" . $searchTerm . "%'";
			}else{
				//	$whereString .= ' OR ' . $whereKeys[$i] . " LIKE '%" . $searchTerm . "%'";
				$whereString .= ' OR ' . $whereKeys[$i] . " LIKE '%" . $searchTerm . "%'";
			}
		}
		
		$sql = "SELECT * FROM " . self::$table . " WHERE " . $whereString ." ORDER BY " . $order;
		if($limit != ''){
			$sql = "SELECT * FROM " . self::$table . " WHERE " . $whereString . " ORDER BY " . $order . " LIMIT " . $limit;		
		}
		
		if(count($targetColumns) > 0){
			$target_columns = implode(",", $targetColumns);
			$sql = "SELECT " . $target_columns . " FROM " . self::$table . " WHERE " . $whereString ." ORDER BY " . $order;
			if($limit != ''){
				$sql = "SELECT " . $target_columns . " FROM " . self::$table . " WHERE " . $whereString . " ORDER BY " . $order . " LIMIT " . $limit;		
			}
		}
		
		//	$result =  PDO_DB::select($sql, [$searchTerm]);
		$result =  PDO_DB::select($sql);
		
		self::$result = $result;
		return self::$result;
		
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
		
		if($whereString == ''){
			$sql = "SELECT " . $targetCol . " FROM " . self::$table . " ORDER BY " . $order;
			if($limit != ''){
				$sql = "SELECT " . $targetCol . " FROM " . self::$table . " ORDER BY " . $order . " LIMIT " . $limit;
			}
		}
		
		$result =  PDO_DB::select($sql, $columnValues);
		
		return $result;
		
	}
	
	
	public static function getEntriesColumnsByORColumns($target_col, $whereArgs = [], $order = " id DESC ", $limit = ""){
		
		$targetCol 			= implode(", ", $target_col);
		$columnKeys 		= array_keys($whereArgs);
		$columnValues 		= array_values($whereArgs);
		
		
		$whereString 		= '';
		
		for($i = 0; $i < count($columnKeys); $i++){
			if($whereString == ''){
				$whereString .= $columnKeys[$i] . ' = ?';
			}else{
				$whereString .= ' AND ' . $columnKeys[$i] . ' = ?';
			}
		}
		
		
		$sql = "SELECT " . $targetCol . " FROM " . self::$table . " WHERE " . $whereString ." ORDER BY " . $order;
		if($limit != ''){
			$sql = "SELECT " . $targetCol . " FROM " . self::$table . " WHERE " . $whereString ." ORDER BY " . $order . " LIMIT " . $limit;
		}
		
		$result =  PDO_DB::select($sql, $columnValues);
		return $result;
		
	}
	
	
	public static function getDistinctColumnByColumns($column, $where = [], $whereNot = [], $order = 'id DESC', $limit = ''){
		
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
		
		
		$sql = "SELECT DISTINCT(" . $column . ") FROM " . self::$table . " WHERE " . $whereString ." ORDER BY " . $order;
		if($limit != ''){
			$sql = "SELECT DISTINCT(" . $column . ") FROM " . self::$table . " WHERE " . $whereString . " ORDER BY " . $order . " LIMIT " . $limit;		
		}
		
		if($whereString ==""){
			$sql = "SELECT DISTINCT(" . $column . ") FROM " . self::$table . " ORDER BY " . $order;
			if($limit != ''){
				$sql = "SELECT DISTINCT(" . $column . ") FROM " . self::$table . " WHERE ORDER BY " . $order . " LIMIT " . $limit;		
			}
		}
		
		
		$data = [];
		self::$sql = $sql;
		$result =  PDO_DB::select($sql, $where_data);
		for($i = 0; $i < count($result); $i++){
			$data[] = $result[$i][$column];
		}
		
		self::$result = $data;
		return self::$result;
		
	}
	
	public static function getDistinctColumnsCount($columnName, $where = [], $whereNot = []){
		
		
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
		
		$result = [];
		
		if($whereString != ""){
			$where_data = array_merge($whereValues, $whereNotValues);
			$sql 		= "SELECT COUNT(DISTINCT " . $columnName . ") AS counts FROM " . self::$table . " WHERE " . $whereString;		
			$result 	= PDO_DB::select($sql, $where_data);
			
		
		}else{
			$sql 		= "SELECT COUNT(DISTINCT " . $columnName . ") AS counts FROM " . self::$table;
			$result	 	= PDO_DB::select($sql);
		
		}
		
		self::$result = $result[0]['counts'];
		return self::$result;
		
	}
	
	public static function getEntryWithMaxColumnByColumns($column, $where = [], $whereNot = []){
		
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
		$sql = "SELECT * FROM " . self::$table . " WHERE " . $whereString ." ORDER BY " . $column . " DESC LIMIT 1";     		
		$result =  PDO_DB::select($sql, $where_data);
		
		self::$result = $result;
		return self::$result[0];
		
	}
	
	
	public static function getMaxColumnByColumns($column, $where = [], $whereNot = [], $order = 'id DESC', $limit = ''){
		
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
		
		$sql = "SELECT MAX(" . $column . ") FROM " . self::$table . " WHERE " . $whereString ." ORDER BY " . $order;
		if($limit != ''){
			$sql = "SELECT MAX(" . $column . ") FROM " . self::$table . " WHERE " . $whereString . " ORDER BY " . $order . " LIMIT " . $limit;		
		}
		
		$result =  PDO_DB::select($sql, $where_data);
		
		self::$result = $result;
		return self::$result;
		
	}
	
	
	public static function getMinColumnByColumns($column, $where = [], $whereNot = [], $order = 'id DESC', $limit = ''){
		
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
		
		$sql = "SELECT MIN(" . $column . ") FROM " . self::$table . " WHERE " . $whereString ." ORDER BY " . $order;
		if($limit != ''){
			$sql = "SELECT MIN(" . $column . ") FROM " . self::$table . " WHERE " . $whereString . " ORDER BY " . $order . " LIMIT " . $limit;		
		}
		
		$result =  PDO_DB::select($sql, $where_data);
		
		self::$result = $result;
		return self::$result;
		
	}
	
	
	public static function getEntryByColumns($where = [], $whereNot = [], $findOrFail = false ){
		
		
		
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
		
		$sql 	= "SELECT * FROM " . self::$table . " WHERE " . $whereString ." ORDER BY id DESC  LIMIT 1";
		$result =  PDO_DB::select($sql, $where_data);
		
		self::$result = count($result) > 0 ? $result[0] : [];
		
		if( count( self::$result ) < 1 && $findOrFail ==  true ){
			return http_response_code( 404 );			
		}
		
		//	return new self;
		return self::$result;
		
	}
	
	public static function getEntryExistByColumns($where = [], $whereNot = []){
		
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
		
		$sql = "SELECT COUNT(id) AS counts FROM " . self::$table . " WHERE " . $whereString ." ORDER BY id DESC  LIMIT 1";
		$result =  PDO_DB::select($sql, $where_data);
		
		self::$result = $result[0]['counts'] > 0;
		
		//	return new self;
		return self::$result;
		
	}
	
	public static function getEntriesAmountSumByColumns( $where = [], $whereNot = []){
		// Return the total sum of the amount column
		
		
		$func_args 		= func_get_args();
		/* 
		if( count( $func_args ) < 2 ){
			die( 'Class "Tables::getEntriesAmountSumByColumns" expects 2 associative arrays as arguments on line ' . __LINE__ . ' in file ' . __FILE__ );
		}
		 */
		if( count( $func_args ) > 2 ){
			die( 'Class "Tables::getEntriesAmountSumByColumns" expects only 2 associative arrays as arguments on line ' . __LINE__ . ' in file ' . __FILE__ );
		}
		
		
		
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
		self::$result =  $result[0]['sum'];
		
		return self::$result != NULL ? self::$result : 0;
		
	}
	
	
	
	public static function getLastEntryByColumns($where = [], $whereNot = []){
		// Returns the last entry, 
		
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
		
		$sql = $result = "";		
		$where_data = array_merge($whereValues, $whereNotValues);
		
		if(count($where_data) > 0 || $where_data !==null){
			$sql 	= "SELECT * FROM " . self::$table . " WHERE " . $whereString . " ORDER BY id DESC LIMIT 1";
			$result =  PDO_DB::select($sql, $where_data);
			
		}else{
			$sql 	= "SELECT * FROM " . self::$table . " ORDER BY id DESC LIMIT 1";
			$result =  PDO_DB::select($sql);
			
		}
		
		self::$result =   $result[0];
		
		//	return new self;
		return self::$result;
		
	}
	
	
	public static function getLastEntry($columns = [], $where = [], $whereNot = []){
		
		$sql = $result = "";

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
		
		if($whereString == ""){
			if(count($columns) > 0){				
				$sql 	= "SELECT  " . implode(", ", $columns) . " FROM " . self::$table . " ORDER BY id DESC LIMIT 1";
				
			
			}else{
				$sql 	= "SELECT * FROM " . self::$table . " ORDER BY id DESC LIMIT 1";
				
			}
			
			$result =  PDO_DB::select($sql);
		
		}else{
			
			$where_data = array_merge($whereValues, $whereNotValues);
			if(count($columns) > 0 || $columns !==null){				
				$sql 	= "SELECT  " . implode(", ", $columns) . " FROM " . self::$table . " WHERE " . $whereString . " ORDER BY id DESC LIMIT 1";
				
			}else{
				$sql 	= "SELECT * FROM " . self::$table . " WHERE " . $whereString . " ORDER BY id DESC LIMIT 1";
				
			}
						
			$result =  PDO_DB::select($sql, $where_data);
			
		}
		
		self::$result = count($result) > 0 ?  $result[0] : "";		
		return self::$result;
		
	}
	
	
	
	
	public static function getEntriesColumnSumByColumns($targetColumn, $where = [], $whereNot = []){
		return self::getColumnSumByColumns($targetColumn, $where, $whereNot);
	}
	
	public static function getColumnSumByColumns($targetColumn, $where = [], $whereNot = []){
		//	Returns the total sum of the specified target column
		
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
		$sql 	= "SELECT SUM(" . $targetColumn . ") AS sum FROM " . self::$table . " WHERE " . $whereString;
		
		$result = PDO_DB::select($sql, $where_data);		
		self::$result = $result[0]['sum'];
		
		//	return new self;
		return self::$result != NULL ? self::$result : 0;
		
	}
	
	
	public static function getColumnsSumByColumns($targetColumns = [], $where = [], $whereNot = []){
		
		$data = [];
		
		for($i = 0; $i < count($targetColumns); $i++){
			$data[$targetColumns[$i]] = self::getColumnSumByColumns($targetColumns[$i], $where , $whereNot);
		}
		
		
		return $data;
		
	}
	
	
	
	public static function getColumnSumBetween($targetColumn, $startDate, $endDate){
		// Returns the total sum of target column between specified range of date
		
		$sql 	= "SELECT SUM(" . $targetColumn . ") AS sum FROM " . self::$table . " BETWEEN " . $startDate . " AND " . $endDate;
		$result = PDO_DB::select($sql);		
		self::$result = $result[0]['sum'];
		
		//	return new self;
		return self::$result != NULL ? self::$result : 0;;
		
		
	}
	
	public static function entryColumnDateExistsBetween($targetColumn, $startDate, $endDate){		
		
		$sql 	= "SELECT COUNT(" . $targetColumn . ") AS counts FROM " . self::$table . " BETWEEN " . $startDate . " AND " . $endDate;
		$result = PDO_DB::select($sql);		
		self::$result = $result[0]['counts'] > 0;
		return self::$result;		
		
	}
	
	public static function entryDateColumnLessThanExists($targetColumn, $startDate, $endDate){		
		
		$sql 	= "SELECT COUNT(" . $targetColumn . ") AS counts FROM " . self::$table . " BETWEEN " . $startDate . " AND " . $endDate;
		$result = PDO_DB::select($sql);		
		self::$result = $result[0]['counts'] > 0;
		return self::$result;		
		
	}
	
	
	
	public static function addEntry($postedData = []){
		
		if($postedData != null){
			
			$tableStructureData = self::describeTable(self::$table);		
			$data 				= [];
			
			foreach($tableStructureData as $columnData){
				if($columnData['extra'] != 'auto_increment'){
					if(!preg_match('/enum/', $columnData['type'])){					
						$data[$columnData['column']] = setTableFieldData($postedData, $columnData['column']);
					
					}else{
						$enumOptionArray = explode(',', str_replace([ 'enum', '(', ')', "'" ], '', $columnData['type']));
						$data[$columnData['column']] = setTableFieldData($postedData, $columnData['column'], $enumOptionArray[0]);
					
					}
				}
			}
			
			$tableStructure = self::getStructure(self::$table);	
			$posted_data 	= $postedData;	

			if(in_array('day', $tableStructure) && !array_key_exists('day', $posted_data)){
				$data['day'] = date('d');
				
			}else if(in_array('day', $tableStructure) && array_key_exists('day', $posted_data)){			
				$data['day'] = $posted_data['day'];			
			}
			
			if(in_array('week', $tableStructure) && !array_key_exists('week', $posted_data)){
				$data['week'] = date('W');
				
			}else if(in_array('week', $tableStructure) && array_key_exists('week', $posted_data)){
				$data['week'] = $posted_data['week'];
				
			}
			
			if(in_array('month', $tableStructure) && !array_key_exists('month', $posted_data)){
				$data['month'] = date('m');			
				
			}else if(in_array('month', $tableStructure) && array_key_exists('month', $posted_data)){		
				$data['month'] = $posted_data['month'];
				
			}
			
			if(in_array('year', $tableStructure) && !array_key_exists('year' , $posted_data)){
				$data['year'] = date('Y');
				
			}else if(in_array('year', $tableStructure) && array_key_exists('year' , $posted_data)){
				$data['year'] = $posted_data['year'];
				
			}
			
			if(in_array('date', $tableStructure) && !array_key_exists('date', $posted_data)){
				$data['date'] = date('Y-m-d H:i:s');
				
			}else if(in_array('date', $tableStructure) && array_key_exists('date', $posted_data)){
				$data['date'] = $posted_data['date'];		
				
			}
			
			if( in_array( 'updated_at', $tableStructure ) && !array_key_exists( 'updated_at', $posted_data ) ){
				$data['updated_at'] = date('Y-m-d H:i:s');
				
			}else if( in_array( 'updated_at', $tableStructure ) && array_key_exists( 'updated_at', $posted_data ) ){
				$data['updated_at'] = $posted_data['updated_at'];		
				
			}
			
			if(in_array('created_at', $tableStructure) && !array_key_exists('created_at', $posted_data)){
				$data['created_at'] = date('Y-m-d H:i:s');
				
			}else if(in_array('created_at', $tableStructure) && array_key_exists('created_at', $posted_data)){
				$data['created_at'] = $posted_data['created_at'];		
				
			}
			
			
			
			return PDO_DB::insert_bulk($data, self::$table);
			
		}
		
		
		
		return false;		
		
		
	}
	
	public static function updateEntryById($id, $postedData = []){
		
		$tableStructureData = self::describeTable(self::$table);
		$currEntry 			= self::getEntryById($id);
		$tbStructure  		= self::getStructure(self::$table);
		$data 				= [];	
		
		foreach($tableStructureData as $columnData){
			$data[$columnData['column']] = setTableFieldData($postedData, $columnData['column'], $currEntry[$columnData['column']]);
		}
		
		
		if(in_array('last_updated' , $tbStructure)){
			$data['last_updated'] = setTableFieldData($postedData, 'last_updated', date('Y-m-d H:i:s'));
		}
		// Utilities::debug_array($data);
		return PDO_DB::update_bulk($data, ['id' => $id], self::$table, 1);
	}
	
	public static function updateEntryByColumn($data, $whereArray =[]){	
		
		self::$result = PDO_DB::update_bulk($data, $whereArray, self::$table, 1);
		return self::$result;
		
	}
	
	public static function updateEntryByColumns($data = [], $whereColumnArray = []){
		return PDO_DB::update_bulk($data, $whereColumnArray, self::$table, 1);
	}
	
	
	public static function updateEntriesByColumns($data = [], $whereColumnArray =[]){	
		
		self::$result = PDO_DB::update_bulk($data, $whereColumnArray, self::$table);
		return self::$result;
		
	}
	
	
	public static function incrementFieldByColumns($fields = [], $where = [], $whereNot = [], $limit = ''){
		$updateDataKeys   = $fields;
		
		$whereDataKeys    = array_keys($where);
		$whereDataValues  = array_values($where);
		
		$whereNotDataKeys    = array_keys($whereNot);
		$whereNotDataValues  = array_values($whereNot);
		
		$queryActionStr   = "";
		$whereActionStr   = "";
		
		// Update string
		
		for($i = 0; $i < count($updateDataKeys); $i++){
			if($queryActionStr == ""){
				$queryActionStr   .= $updateDataKeys[$i] . " = " . $updateDataKeys[$i] . " + 1";
			
			}else{
				$queryActionStr   .= ", " . $updateDataKeys[$i] . " = " . $updateDataKeys[$i] . " + 1";
			
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
		
		$sql = "UPDATE " . self::$table . " SET " . $queryActionStr . " WHERE " . $whereActionStr . " LIMIT " . $limit;
		
		if($limit == ""){
			$sql = "UPDATE " . self::$table . " SET " . $queryActionStr . " WHERE " . $whereActionStr;
		}
		
		return PDO_DB::update($sql);
		
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
				$whereActionStr  =  $whereNotDataKeys[$i] . " <> '" . $whereNotDataValues[$i] . "'";
			}else{
				$whereActionStr .= " AND " . $whereNotDataKeys[$i] . " <> '" . $whereNotDataValues[$i] . "'";
			}
		}
		
		
		
		if($whereActionStr != ""){
			$sql = "UPDATE " . self::$table . " SET " . $queryActionStr . " WHERE " . $whereActionStr . " LIMIT " . $limit;
			if($limit == ""){
				$sql = "UPDATE " . self::$table . " SET " . $queryActionStr . " WHERE " . $whereActionStr;
			}
			
			
			return PDO_DB::update($sql, $data);

		}else{
			
			$sql = "UPDATE " . self::$table . " SET " . $queryActionStr . " LIMIT " . $limit;		
			if($limit == ""){
				$sql = "UPDATE " . self::$table . " SET " . $queryActionStr;
			}
			
			return PDO_DB::update($sql);
		}
		
		
	}
	
	
	public static function getEntryColumnsByColumns($target_col = [], $whereArgs = [], $whereNotArgs = [], $order = ' DESC ', $findOrFail =  false ){
		
		
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
		
		$sql = "SELECT " . $targetCol . " FROM " . self::$table . " WHERE " . $whereString ." ORDER BY id " . $order . " LIMIT 1";
		$result =  PDO_DB::select($sql, $columnValues);
		self::$sql = $sql;
		if( count( $result ) < 1 && $findOrFail ==  true ){
			return http_response_code( 404 );	
		}
		return count($result) > 0 ? $result[0] : [];
		
	}
	
	public static function getEntryColumnsByORColumns($target_col = [], $whereArgs = [], $order = ' DESC ', $findOrFail =  true){
		
		
		$targetCol 		= implode(", ", $target_col);
		$columnKeys 	= array_keys($whereArgs);
		$columnValues 	= array_values($whereArgs);
		
		$whereString 	= '';
		
		for($i = 0; $i < count($columnKeys); $i++){
			if($whereString == ''){
				$whereString .= $columnKeys[$i] . ' = ?';
			}else{
				$whereString .= ' OR ' . $columnKeys[$i] . ' = ?';
			}
		}
		
		
		
		$sql = "SELECT " . $targetCol . " FROM " . self::$table . " WHERE " . $whereString ." ORDER BY id " . $order . " LIMIT 1";
		$result =  PDO_DB::select($sql, $columnValues);
		if( count( $result ) < 1 && $findOrFail ==  true ){
			return http_response_code( 404 );	
		}
		return count($result) > 0 ? $result[0] : [];
		
	}
	
	
	
	
	public static function describeTable($table, $default = false){
		self::$result = PDO_DB::describeTable($table, $default);
		return self::$result;
	}
	
	/*
	public static function getStructure($table){
		
		self::$result = PDO_DB::getStructure($table);
		return self::$result;		
		
	}
	*/
	
	public static function getStructure($table){
		$data = [];
		$tb_str = self::describeTable($table, false);
		for($i = 0; $i < count($tb_str); $i++){
			$data[] = $tb_str[$i]['column'];
		}
		self::$result = $data;
		return self::$result;		
		
	}
	
	
	
	
	////////////////////////////////////////////////////
	////////////////////////////////////////////////////
	////////////		CREATING TABLES		////////////
	////////////////////////////////////////////////////
	////////////////////////////////////////////////////
	
	public static function create($table){
		if(!array_key_exists($table, self::$tables_stack)){
			self::$tables_stack[$table] = "";
			self::$table = $table;
		}
		self::$sql = "CREATE TABLE IF NOT EXISTS " . $table . "(";
		self::$sql .= "id int(11) NOT NULL auto_increment, ";
		
		return new self;		
	}
	
	
	
	public static function add($column, $conf = []){
		
		//	$config['null_status']
		
		$config = [
			'type' 			=> self::setConfigData('type', $conf), 
			'length' 		=> self::setConfigData('length', $conf), 
			'null_status' 	=> self::setConfigData('null_status', $conf), 
			'default' 		=> self::setConfigData('default', $conf), 
			'enum_options' 	=> self::setConfigData('enum_options', $conf), 
			'unique_status' => self::setConfigData('unique_status', $conf)
		];
		$unique_status = $config['unique_status'] == false ? "" : " UNIQUE ";
		//	Utilities::debug_array($config);
		
		if($config['type'] == 'enum'){
			$enumOptionArray = explode(", ", $config['enum_options']);
			$optionStr = '';
			for($i = 0; $i < count($enumOptionArray); $i++){
				if($optionStr == ''){
					$optionStr .= "'" . $enumOptionArray[$i] . "'";
				}else{
					$optionStr .= ", '" . $enumOptionArray[$i] . "'";
				}
			}
			
			self::$sql .= $column . " enum(" . $optionStr . ") " . $config['null_status'] . " default '" . $config['default'] . "', ";
			
		}else if($config['type'] == 'datetime'){			
			self::$sql .= $column . " datetime " . $config['null_status'] . " default '" . $config['default'] . "', ";
			
			
		}else if($config['type'] == 'text'){			
			self::$sql .= $column . " text " . $config['null_status'] . ", ";
			
			
		}else if($config['type'] == 'varchar'){			
			self::$sql .= $column . " varchar(" . $config['length'] . ") " . $config['null_status'] . $unique_status . ", ";
			
			
		}else{			
			self::$sql .= $column . " " . $config['type'] . "(" . $config['length'] . ") " . $config['null_status'] . ", ";
		
		}
		
		return new self;
		
	}
	
	public static function updateEntryColumnsByColumns($data, $columnArray =[]){	
		return self::updateEntryByColumn($data, $columnArray);
	}
	
	
	
	public static function finish(){
		self::$sql .= "PRIMARY KEY (id))";
		self::$tables_stack[self::$table] = self::$sql;
		return new self;
	}
	
	
	public static function getTableQueries(){
		return self::$tables_stack;
	}
	
	public static function setup(){
		
		$pdh = PDO_DB::connect();
		$tablequeries = self::$tables_stack;		
		
		foreach($tablequeries as $k => $v){
			if(!PDO_DB::tableExists($k)){
				$pdh->query($v);
				self::$response[] = [
					'message' 	=> "Table " . $k  . " Successfully Created!", 
					'status' 	=> 'ok'
				];
			}else{
				self::$response[] = [
					'message' 	=> "Table " . $k  . " Already Exists!", 
					'status' 	=> 'not-ok'
				];
			}
		}
	}
	
	
	
	public static function setConfigData($index, $array){
		return array_key_exists($index, $array) ? $array[$index] : self::$table_config[$index];
	}

	public static function getNewRefCode($ref_column_name){
		if(self::getEntriesCount() > 0){
			$result = PDO_DB::select("SELECT " . $ref_column_name . " AS reference_code FROM " . self::$table . " ORDER BY id DESC LIMIT 1" );
			return $result[0]['reference_code'] + 1;
		}else{
			return '100001';
		}
	}
	
	public static function postDatedData($posted_data = []){
		$data =  $posted_data;
		$data = [
			'day' 	=> date('d'),
			'week' 	=> date('W'),
			'month' => date('m'),
			'year' 	=> date('Y'),
			'active_status' => 1,
			'date'  => date('Y-m-d H:i:s')
		];
		
		return self::postEntry($data);
		
	}
	
	public static function query($sql){		
		$con = PDO_DB::connect();
		$data = [];
		if(preg_match('/select/i', $sql) === 1 ){
			$stmt = $con->query($sql, PDO::FETCH_ASSOC);
			while($row = $stmt->fetch()){
				$data[] = $row;
			}
			return $data;
		}else{
			return $con->query($sql);
		}
		
	}
	
	
	public static function getEntryRef($columnName, $prefix = 'REF'){
		$ref = '100001';
		if(Tables::get(self::$table)->getEntriesCount() > 0 && Tables::get(self::$table)->getEntriesCountByColumns([ $columnName => "" ]) < 1){
			
			$lastRef 	 = Tables::get(self::$table)->getLastEntry([$columnName], [], [ $columnName => "" ]);		
			$lastRefData = explode("-", $lastRef[$columnName]);
			
			if($lastRef[$columnName] != ""){
				
				$nextRef =  count($lastRefData) > 1 ? $lastRefData[1] + 1 : $lastRefData[0] + 1;
				$ref =  $nextRef ;
				
			}
		
		}
		
		return $prefix . "-" . $ref;
		
	}
	
	
	
	
	########################
	
	public static function selectEntries(){		
		self::$sql = "SELECT * FROM " . self::$table;		
		return new self;		
	}
	public static function selectEntry(){		
		self::$sql = "SELECT * FROM " . self::$table;
		self::$limit =  1;
		return new self;		
	}
	
	public static function selectColumnsEntries($columns){ // Can be indexed array or CSV string
		$columns_str = '';
		if(is_array($columns)){
			$columns_str = implode(", ", $columns);
		}
		self::$sql = "SELECT " . $columns_str . " FROM " . self::$table;		
		return new self;		
	}
	
	public static function selectColumnsEntry($columns){ // Can be indexed array or CSV string
		$columns_str = '';
		if(is_array($columns)){
			$columns_str = implode(", ", $columns);
		}
		self::$sql = "SELECT " . $columns_str . " FROM " . self::$table;
		self::$limit =  1;
		return new self;		
	}
	
	public static function where($where_str = ""){		
		self::$sql .= " WHERE " . $where_str;		
		return new self;		
	}
	
	public static function limit($limit_str = ""){		
		if($limit_str != ""){
			self::$sql .= " LIMIT " . $limit_str;	
		}			
		return new self;		
	}
	
	public static function orderBy($order_by_str = ""){
		$order_str = self::$order;
		if($order_by_str != ""){
			$order_str = $order_by_str;
		}
		self::$sql .= " ORDER BY " . $order_by_str;		
		return new self;		
	}
	
	public static function groupBy($group_by_str){		
		self::$sql .= " ORDER BY " . $group_by_str;		
		return new self;		
	}
	
	public static function run(){
		$result =  PDO_DB::select(self::$sql);		
		return count($result) > 0 ? $result : [];		
	}
	
	
	
	public static function getEntity($table = null){
		
		$targetTable = null;
		if(self::$table != null){
			$targetTable = self::$table;			
		}
		
		if($table != null){
			self::$table = $table;
			$targetTable = $table;			
		}
		
		if($targetTable == null){
			die("No target table supplied!");
		}
		
		$structure 	= Tables::getStructure("schools");
		self::$entityStructure = $structure;
		
		self::$tableObj 	= new Tables();		
		
		for($i = 0; $i < count($structure); $i++){			
			$tableObj->{$structure[$i]} = null;
		}
		
		self::$tableObj->config_data = $tableObj->db_data;
		unset(self::$tableObj->db_data);
		return self::$tableObj;		
		
	}
	
	
	public static function save($table = null){
		
		$targetTable 	= null;
		if(self::$table != null){
			$targetTable = self::$table;			
		}
		
		if($table != null){
			self::$table = $table;
			$targetTable = $table;			
		}
		
		if(self::$entityStructure != []){
			$data 		= [];
			$structure 	= Tables::getStructure($targetTable);
			for($i = 0; $i < count(self::$entityStructure); $i++){			
				$data[self::$entityStructure[$i]] = self::$tableObj->{self::$entityStructure[$i]};
			}
			
			return Tables::get($targetTable)->postEntry($data);	
			
		}
		
	
	}
	
	
	public static function updateEntityByColumns($where = []){		
		
		if(self::$entityStructure != []){			
			$data 		= [];
			$structure 	= Tables::getStructure($targetTable);
			for($i = 0; $i < count(self::$entityStructure); $i++){			
				$data[self::$entityStructure[$i]] = self::$tableObj->{self::$entityStructure[$i]};
			}
			
			return Tables::get(self::$table)->updateEntryByColumns($data, $where);
			
		}
		
	
	}
	
	
	
	

}



?>