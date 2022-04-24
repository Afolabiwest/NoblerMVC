<?php
class Mydb{
	public static $sql = '', $table, $keyArgs = [], $result = [], $whereArray = [];
	public static $driver 	= 'mysql';
	public static $host 	= 'localhost';
	public static $user 	= 'root';
	public static $password = 'ajo4realadmin';
	public static $database = 'b2edge1';
	public static $pdo, $transId, $dbh;
	public static function connect(){
		
		$dsn =  self::$driver . ":host=" . self::$host . ";dbname=" . self::$database;		
		try{			
			self::$pdo = new PDO($dsn, self::$user, self::$password);
			self::$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			self::$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING );
			
		} catch(\PDOException $e){
			throw new \PDOException($e->getMessage(), (int)$e->getCode());
		}
		
		return self::$pdo;
	}
	
	public static function table($tableName){
		self::$table = $tableName;		
		return new self;
	}
	
	public static function select($str = '*'){
		Mydb::$sql = "SELECT * FROM " . Mydb::$table . " ";
		if($str != "*"){
			Mydb::$sql = "SELECT " . $str . " FROM " . Mydb::$table . " ";
		}		
		return new self;
	}
	
	public static function selectCount($col_name){
		Mydb::$sql = "SELECT COUNT(" . $col_name . ") AS " . $col_name ."  FROM " . Mydb::$table . " ";				
		return new self;
	}
	
	public static function selectDistinct($col_name){
		Mydb::$sql = "SELECT DISTINCT(" . $col_name . ") AS " . $col_name ."  FROM " . Mydb::$table . " ";			
		return new self;
	}
	
	public static function selectRange($min, $max, $col_name = "*"){
		Mydb::$sql = "SELECT * FROM " . Mydb::$table . " BETWEEN  " . $min . " AND " . $max . " ";
		if($str != "*"){
			Mydb::$sql = "SELECT " . $col_name . " FROM " . Mydb::$table . " BETWEEN  " . $min . " AND " . $max . " ";
		}		
		return new self;
	}
	
	public static function groupBy($str){
		Mydb::$sql .= " GROUP BY " . $str;				
		return new self;
	}
	
	public static function orderAsc($str){
		Mydb::$sql .= " ORDER BY " . $str . " ASC";				
		return new self;
	}
	
	public static function orderDesc($str){
		Mydb::$sql .= " ORDER BY " . $str . " DESC";				
		return new self;
	}
	
	public static function where($conditionStr = []){
		$where 				= "";		
		if($conditionStr != null){			
			$arrKeys = array_keys($conditionStr);
			
			for($i = 0; $i < count($arrKeys); $i++){
				if($where == ""){
					$where = " WHERE " . $arrKeys[$i] . " = :" . $arrKeys[$i];
				}else{
					$where .= " AND " . $arrKeys[$i] . " = :" . $arrKeys[$i];
				}
			}
		}
		Mydb::$sql 		.= $where;
		self::$keyArgs = array_merge(self::$keyArgs, $conditionStr);
		return new self;
	}
	
	
	public static function limit($limit, $offset = ''){
		$sql = " LIMIT " . $limit;
		if($offset !=''){
			$sql .= " LIMIT " . $limit . " OFFSET " . $offset;
		}
		Mydb::$sql .= $sql;		
		return new self;
	}
	
	
	
	/* 
	//	Single Entries
	//	@Param $data = ['key1' => 'Value One', 'key2' => 'Value Two', 'key3' => 'Value Three'];
	//	Multiple Entries
	//	$data = [
	//		['key1' => 'Value One', 'key2' => 'Value Two', 'key3' => 'Value Three'],
	//		['key1' => 'Value One', 'key2' => 'Value Two', 'key3' => 'Value Three'],
	//		['key1' => 'Value One', 'key2' => 'Value Two', 'key3' => 'Value Three'],
	//		...
	//	];
	//	Mydb::insert($data);
	// Last Insert Entry Id
	//	$lastEntryId = Mydb::$transId; 
	*/
	
	public static function insert($data = []){
		self::$dbh   = self::connect();
		$insertDataKeys = array_keys($data);
		if(isset($data[0]) and !is_array($data[0])){
			$stmt = self::$dbh->prepare("INSERT INTO " . self::$table . "(" . implode(', ', $insertDataKeys) . ")VALUES(" . ':' . implode(', :', $insertDataKeys) . ")");
			if($stmt){
				$stmt->execute($data);		
				self::$transId = self::$dbh->lastInsertId();
				return true;			
			}
			
		}else if(isset($data[0]) and is_array($data[0])){
			$error_count = 0;
			for($i = 0; $i < count($data); $i++){
				$entryData = $data[$i];
				self::insertOne($entryData);
				
				$stmt = self::$dbh->prepare("INSERT INTO " . self::$table . "(" . implode(', ', $insertDataKeys) . ")VALUES(" . ':' . implode(', :', $insertDataKeys) . ")");
				if($stmt){
					$stmt->execute($data);		
					self::$transId = self::$dbh->lastInsertId();								
				}else{
					$error_count++;
				}
			}
			self::$dbh = null;
			return $error_count < 1;
		}
		
		return false;		
	}
	
	public static function insertOne($data = []){
		self::$dbh   = self::connect();
		$insertDataKeys = array_keys($data);		
		$stmt = self::$dbh->prepare("INSERT INTO " . self::$table . "(" . implode(', ', $insertDataKeys) . ")VALUES(" . ':' . implode(', :', $insertDataKeys) . ")");
		if($stmt){
			$stmt->execute($data);		
			self::$transId = self::$dbh->lastInsertId();
			return true;			
		}
		self::$dbh = null;
		return false;		
	}
	
	public static function insertMultiple($data = []){
		if(count($data) > 0 ){
			for($i = 0; $i < count($data); $i++){
				$entryData = $data[$i];
				self::insertOne($entryData);
			}
		}		
	}
	
	public static function update($data = []){		
		$updateDataKeys = array_keys($data);
		self::$keyArgs 	= $data;
		$queryActionStr = "";
		
		for($i = 0; $i < count($updateDataKeys); $i++){
			if($queryActionStr == ""){
				$queryActionStr   .= $updateDataKeys[$i] . "=:" . $updateDataKeys[$i];
			}else{
				$queryActionStr   .= ", " . $updateDataKeys[$i] . "=:" . $updateDataKeys[$i];
			}
		}
		
		self::$sql = "UPDATE " . self::$table . " SET " . $queryActionStr . " ";
		return new self;
	}
	
	public static function drop(){		
		self::$sql = "DELETE FROM " . self::$table . " ";
		return new self;
	}
	
	public static function execute(){
		self::$dbh 	= self::connect();
		$stmt 	= self::$dbh->prepare(Mydb::$sql);
		if($stmt){
			if(count(self::$keyArgs) > 0 || self::$keyArgs !== null){			
				$stmt->execute(self::$keyArgs);
				
			}else{
				$stmt->execute();
			}
			self::$dbh = null;
			self::$keyArgs = [];
			return;
		}
		return false;
	}
	
	public static function get(){		
		self::$dbh = self::connect();
		$stmt = self::$dbh->prepare(Mydb::$sql);
		if($stmt){
			if(self::$keyArgs !== null){
				$stmt->execute(self::$keyArgs);
				
			}else{
				$stmt->execute();
			}
			
			while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
				self::$result[] = $row;
			}		
			
			self::$keyArgs = [];
			self::$dbh = null;
			return self::$result;
		}
		return false;
	}
	
	public static function debugSql(){
		echo self::$sql;
		return new self;
	}
}

?>