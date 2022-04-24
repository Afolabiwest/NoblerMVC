<?php

if( !defined( 'HOST' ) ) define( 'HOST', config( 'db_host' ) );
if( !defined( 'USER' ) ) define( 'USER', config( 'user' ) );
if( !defined( 'PASSWORD' ) ) define( 'PASSWORD', config( 'password' ) );
if( !defined( 'DATABASE' ) ) define( 'DATABASE', config( 'database' ) );
if( !defined( 'DRIVER' ) ) define( 'DRIVER', config( 'db_driver' ) );
if( !defined( 'PORT' ) ) define( 'PORT', config( 'db_port' ) );
if( !defined( 'CHARSET' ) ) define( 'CHARSET', 'utf8mb4' );

class PDO_DB{
	
	public static $sql 		= "";
	public static $host 	= HOST;
	public static $user 	= USER;
	public static $password = PASSWORD;
	public static $database = DATABASE;
	public static $driver 	= DRIVER;
	public static $port 	= PORT;
	public static $charset 	= CHARSET;
	public static $transId, $pdo;
	
	public $db_data;
	
	public function __construct(){		
		$this->db_data = getConfigData();		
	}
	
	public static function connect(){
		self::$pdo = null;
		$dsn =  self::$driver . ":host=" . self::$host . ";port=" . self::$port . ";dbname=" . self::$database;		
		try{			
			self::$pdo = new PDO($dsn, self::$user, self::$password);
			self::$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			self::$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
			
		} catch(\PDOException $e){
			#throw new \PDOException($e->getMessage(), (int)$e->getCode());
			die("Check your database connection credentials. Check if the password, user, database, driver and port number are correct.");
		}
		
		return self::$pdo;
	}
	
	public static function selectAll($table, $orderBy = ['field-name' => '', 'direction' => 'ASC'], $limit = ''){
		$con 	= self::connect();
		$data 	= [];
		$ordBy 	= ($orderBy['field-name'] != '')? ' ORDER BY ' . $orderBy['field-name'] . ' ' . $orderBy['direction']: '';
		$lim 	= ($limit != '')? ' LIMIT ' . $limit : '';
		$stmt 	= $con->prepare("SELECT * FROM " . $table . $ordBy . $lim);
		$stmt->execute();
		while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
			$data[] = $row;
		}
		self::$pdo = null;
		return $data;
	}
	
	public static function select($sql, $argArray = []){
		
		if(!preg_match('/[select|SELECT]/', $sql)){
			throw new Exception("Query must be a \"SELECT\" Statement");
		}else{
			$con 	= self::connect();
			$data 	= [];	
			$stmt = $con->prepare($sql);
			if(!$stmt){
				return false;
			}
			if($argArray != null || count($argArray) > 0){
				$stmt->execute($argArray);
			}else{
				$stmt->execute();
			}
			
			while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
				$data[] = $row;
			}
			
			self::$pdo = null;
			return $data;
		}
	}
	
	
	
	
	public static function selectOne($sql, $argArray = []){
		if(!preg_match('/[select|SELECT]/', $sql)){
			throw new Exception("Query must be a \"SELECT\" Statement");
		}else{
			$con 	= self::connect();
			$data 	= [];	
			$stmt = $con->prepare($sql);
			if($argArray != null || count($argArray) > 0){
				$stmt->execute($argArray);
			}else{
				$stmt->execute();
			}
			while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
				$data[] = $row;
			}
			self::$pdo = null;
			return $data[0];
		}
	}
	
	
		
	public static function insert($sql, $argArray = []){
		// echo $sql . '<br>';
		if(!preg_match('/[insert|INSERT]/', $sql)){
			throw new Exception("Query must be a \"INSERT\" Statement");
		}else{
			return self::sql_query($sql, $argArray);
		}		
	}
	
	
	public static function update($sql, $argArray = []){
		if(!preg_match('/[update|UPDATE]/', $sql)){
			throw new Exception("Query must be an \"UPDATE\" Statement");
		}else{
			return self::sql_query($sql, $argArray);
		}		
	}
	
	public static function drop($sql, $argArray = []){
		if(!preg_match('/[delete|DELETE]/', $sql)){
			throw new Exception("Query must be a \"DELETE\" Statement");
			
		}else{
			return self::sql_query($sql, $argArray);
		}		
	}
	
	public static function insert_bulk($data = [], $table){
		$insertDataKeys = array_keys($data);
		$result = PDO_DB::insert("INSERT INTO " . $table . "(" . implode(', ', $insertDataKeys) . ")VALUES(" . ':' . implode(', :', $insertDataKeys) . ")", $data);		
		return $result;
	}
	
	public static function update_bulk($data = [], $where = [], $table, $limit = ""){
		
		$updateDataKeys   = array_keys($data);
		$insertDataValues = array_values($data);
		$whereDataKeys    = array_keys($where);
		$whereDataValues  = array_values($where);
		$bind_data 		  = array_merge($data, $where);
		$queryActionStr   = "";
		$whereActionStr   = "";
		
		for($i = 0; $i < count($updateDataKeys); $i++){
			if($queryActionStr == ""){
				$queryActionStr   .= $updateDataKeys[$i] . "=:" . $updateDataKeys[$i];
			}else{
				$queryActionStr   .= ", " . $updateDataKeys[$i] . "=:" . $updateDataKeys[$i];
			}
		}
		
		for($i = 0; $i < count($whereDataKeys); $i++){
			if($whereActionStr == ""){
				$whereActionStr   .=  $whereDataKeys[$i] . "='" . $whereDataValues[$i] . "'";
			}else{
				$whereActionStr   .= " AND " . $whereDataKeys[$i] . "='" . $whereDataValues[$i] . "'";
			}
		}
		$sql = "UPDATE " . $table . " SET " . $queryActionStr . " WHERE " . $whereActionStr . " LIMIT " . $limit ;
		
		if($limit == ""){
			
			$sql = "UPDATE " . $table . " SET " . $queryActionStr . " WHERE " . $whereActionStr;
		}
		
		self::$sql = $sql;
		return PDO_DB::update($sql, $data);		
		
		
	}
	
	
	public static function sql_query($sql, $argArray = []){
		
		$con 	= self::connect();
		$data 	= [];	
		$stmt 	= $con->prepare($sql);		
		
		if(!$stmt){
			return false;
		}
		
		if($argArray != null || count($argArray) > 0){
			# Utilities::debug_array($argArray);
			$stmt->execute($argArray);
		}else{
			$stmt->execute();
		}
		
		if(preg_match('/[select|SELECT]/', $sql)){
			self::$transId = self::$pdo->lastInsertId();
		}
		self::$pdo = null;
		return true;		
	}
	
	public static function query($sql){
		$con 	= self::connect();
		$result = $con->query($sql);
		self::$pdo = null;
		return $result;
	}
	
	public static function selectCount($sql, $argArray = []){
		$con 	= self::connect();
		$data 	= [];	
		$stmt = $con->prepare($sql);
		if($argArray != null || count($argArray) > 0){
			$stmt->execute($argArray);
		}else{
			$stmt->execute();
		}
		while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
			$data[] = $row;
		}
		self::$pdo = null;
		return count($data);
	}
	
	
	public static function getDataCount($table, $data = [], $limit = 1){
		$con 	= self::connect();
		$where 	= "";
		$sql 	= "";
		
		foreach($data as $k => $v){			
			if($where  == ""){
				$where  .= $k . ' = ?';
			}else{
				$where  .= ' AND ' . $k . ' = ?';
			}
		}
		
		if($data != null || count($data) > 0){		
				$sql = "SELECT COUNT(id) AS counts FROM " . $table . " WHERE " . $where . " LIMIT " . $limit;
		}else{
			$sql = "SELECT COUNT(id) AS counts FROM " . $table . " LIMIT " . $limit;
		}
		
		$stmt = $con->prepare($sql);
		if($data != null || count($data) > 0){
			$stmt->execute(array_values($data));
			
		}else{
			$stmt->execute();
		}
		
		$result = $stmt->fetch(PDO::FETCH_ASSOC);
		self::$pdo = null;
		return $result['counts'];
	}
	
	public static function escapeQuote($string){ $con 	= self::connect(); return $con->quote($string); }

	public static function setTableFieldData($dataArray = [], $key, $optional_value = ''){
		return isset($dataArray[$key])? $dataArray[$key] : $optional_value;
	}
	
	public static function setTableFieldUrlData($dataArray = [], $key, $optional_value = ''){
		return isset($dataArray[$key])? preg_replace('/[^a-zA-Z0-9]/', '-', strtolower($dataArray[$key])) : preg_replace('/[^a-zA-Z0-9]/', '-', strtolower($optional_value));
	}
	
	public static function getPostedData(){
		$postedData = [];
		if(isset($_POST) || count($_POST) > 0){
			foreach($_POST as $k => $v){
				$postedData[$k] = post($v);
			}
		}
		return $postedData;
	}
	
	public static function execute($sql){
		self::connect();
		$dbh = self::$pdo;
		$dbh->exec($sql);
		self::$pdo = null;
	}
	
	public static function db_query($sql){
		self::connect();
		$dbh = self::$pdo;
		$query = $dbh->query($sql);
		self::$pdo = null;
		return $query;
	}
	
	public static function tableExists($table){
		$con 	= self::connect();
		$sql 	= "SHOW TABLES LIKE '" . $table . "'";
		$result = $con->query($sql);
		self::$pdo = null;
		return $result->rowCount() > 0;
		
	}
	
	public static function tableColumExists($table, $column){
		$con 	= self::connect();
		$sql 	= "SHOW COLUMNS FROM " . $table . " LIKE '" . $column . "'";
		$result = $con->query($sql);
		self::$pdo = null;
		return $result->rowCount() > 0;
		
	}
	
	public static function tablesList($database){
		return self::listTables($database);		
	}
	
	public static function listTables($database){
		$con 	= self::connect();
		$data = [];
		$sql 	= "SELECT * FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA LIKE '" . $database . "'";
		$results = $con->query($sql);
		
		foreach($results as $result){
			$data[] = $result['TABLE_NAME'];
		}
		self::$pdo = null;
		return $data;
		
	}
	
	public static function describeTable($table, $default = false){
		
		$sql 	= "SHOW columns FROM " . $table;
		$con 	= self::connect();
		$data 	= [];		
		
		$stmt 	= $con->query("DESCRIBE " . $table);
		$stmt 	= $stmt->fetchAll(PDO::FETCH_ASSOC);
		
		foreach($stmt as $row){
			
			$dataRow 			= [];
			$dataRow['field'] 	= $row['Field'];
			$dataRow['column'] 	= $row['Field'];
			$dataRow['type'] 	= $row['Type'];
			$dataRow['extra'] 	= $row['Extra'] != "" ? $row['Extra'] : "non_auto_increment";
			$dataRow['key_status'] 	= $row['Key'] != "" ? "PRIMARY_KEY" : 'non_key';
			$dataRow['null_status'] = $row['Null'] == "NO" ? 'non_null' : "null";
			$data[] 				= $default ? $row : $dataRow;
			
		}
		self::$pdo = null;
		return $data;		
		
	}
	
	
	public static function getFutureDaysCount($days = 3, $period = 'days'){
		return date('Y-m-d', strtotime(date('Y-m-d') . ' ' . $days . ' ' . $period));	
	}
}



?>