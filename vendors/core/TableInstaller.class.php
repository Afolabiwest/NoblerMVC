<?php

class TableInstaller{
	public static $tableName, 
	$tables 		= [], 
	$table_columns 	= [],
	$sqlQueryString = "", 
	$foreignKeys 	= [],
	$unique_keys 	= [];
	
	public function create($table, $primary_column_length = 255){
		self::$tableName 		= $table;
		self::$tables[] 		= $table;
		self::$table_columns 	= [];
		self::$foreignKeys 		= [];
		self::$sqlQueryString 	= "CREATE TABLE " . $table . "(\r\n";
		self::$sqlQueryString 	.= "\t\t\t" . " id int(" . $primary_column_length . ") auto_increment NOT NULL," . "\r\n";
		
		self::$table_columns[$columnName] = [
			'type' 				=>  'int',
			'length' 			=>  $primary_column_length,
			'null_status' 		=>  'NOT NULL',
			'foreign_key_status'=>  $foreignKeyStatus
		];
		
		return new self;
	}
	  
	public static set_varchar($columnName, $foreignKeyStatus = false, $length = 255, $nullStatus = 'NULL'){		
		self::$sqlQueryString .= "\t\t\t" . $columnName . " varchar(" . $length . ") " . $nullStatus . "," . "\r\n";
		
		self::$table_columns[$columnName] = [
			'type' 				=>  'varchar',
			'length' 			=>  $length,
			'null_status' 		=>  $nullStatus,
			'foreign_key_status'=>  $foreignKeyStatus
		];
		
		if($foreignKeyStatus){
			self::$foreignKeys[] = $columnName;
		}
		
		return new self;
	}
	
	public static set_int($columnName, $foreignKeyStatus = false, $length = 255, $nullStatus = 'NULL'){		
		self::$sqlQueryString .= "\t\t\t" . $columnName . " int(" . $length . ") " . $nullStatus . "," . "\r\n";
		
		self::$table_columns[$columnName] = [
			'type' 				=>  'int',
			'length' 			=>  $length,
			'null_status' 		=>  $nullStatus,
			'foreign_key_status' =>  $foreignKeyStatus
		];
		
		if($foreignKeyStatus){
			self::$foreignKeys[] = $columnName;
		}
		
		return new self;
	}
	
	public static set_bigint($columnName, $foreignKeyStatus = false, $length = 255, $nullStatus = 'NULL'){		
		self::$sqlQueryString .= "\t\t\t" . $columnName . " bigint(" . $length . ") " . $nullStatus . "," . "\r\n";
		
		self::$table_columns[$columnName] = [
			'type' 				=>  'bigint',
			'length' 			=>  $length,
			'null_status' 		=>  $nullStatus,
			'foreign_key_status' =>  $foreignKeyStatus
		];
		
		if($foreignKeyStatus){
			self::$foreignKeys[] = $columnName;
		}
		
		return new self;
	}
	
	public static set_text($columnName, $nullStatus = 'NULL'){		
		self::$sqlQueryString .= "\t\t\t" . $columnName . " text " . $nullStatus . ",.\r\n";
		
		self::$table_columns[$columnName] = [
			'type' 				=>  'text',
			'length' 			=>  'none',
			'null_status' 		=>  $nullStatus,
			'foreign_key_status' =>  'none'
		];
		
		if($foreignKeyStatus){
			self::$foreignKeys[] = $columnName;
		}
		
		return new self;
	}
	
	public static set_enum($columnName, $values = "'0', '1'", $default = 0 ){		
		self::$sqlQueryString .= "\t\t\t" . $columnName . " enum(" . $values . ") NOT NULL default '" . $default . "'," . "\r\n";
		
		self::$table_columns[$columnName] = [
			'type' 				=>  'enum',
			'length' 			=>  'none',
			'null_status' 		=>  false,
			'foreign_key_status' =>  'none',
			'default_value' 	=>   $default
		];
		
		if($foreignKeyStatus){
			self::$foreignKeys[] = $columnName;
		}
		
		return new self;
	}
	
	public static set_datetime($columnName){		
		self::$sqlQueryString .= "\t\t\t" . $columnName . " datetime NOT NULL default '0000-00-00 00:00:00'," . "\r\n";
		
		self::$table_columns[$columnName] = [
			'type' 				=>  'datetime',
			'length' 			=>  'none',
			'null_status' 		=>  'none',
			'foreign_key_status'=>  'none',
			'default_value' 	=>  'none'
		];
		
		return new self;
	}
	
	public static set_unique_key($columnName){		
		self::$unique_keys[] = $columnName;
		
		if($foreignKeyStatus){
			self::$foreignKeys[] = $columnName;
		}
		
		return new self;
	}
	
	public static finish(){
		if(count(self::$unique_keys) > 0){
			self::$sqlQueryString .= "\t\t\t" . " PRIMARY KEY (id)," . "\r\n";
			
			$uniqueKeyString = "";
			if(count(self::$unique_keys) > 1){
				for($i = 0; $i < count(self::$unique_keys); $i++){
					if($uniqueKeyString == ""){
						self::$sqlQueryString .= "\t\t\t" . "UNIQUE KEY " . self::$unique_keys[$i] . " (" . $columnName . ")";
					}else{
						self::$sqlQueryString .= ", \r\n\t\t\t" . "UNIQUE KEY " . self::$unique_keys[$i] . " (" . $columnName . ")";
					}					
				}
				
			}else{
				self::$sqlQueryString .= "\t\t\t" . "UNIQUE KEY " . self::$unique_keys[0] . " (" . $columnName . ")" . "\r\n";
			}			
			
		}else{
			self::$sqlQueryString .= "\t\t\t" . " PRIMARY KEY (id)" . "\r\n";
		}
		
		self::$sqlQueryString .= "\t\t);" . "\r\n";
		
		self::$tables[self::$tableName] = self::$sqlQueryString;
		return new self;
		
	}
	
	public static setInstallerClass(){
		$installer_class_string = '<?php' . '\r\n\r\n'; 
		$installer_class_string .= 'class Install{';
		$installer_class_string .= '\t' . 'public static $tableStructures, $response = [];';	
		$installer_class_string .= '\t' . 'public function setup(){';
		$installer_class_string .= '\t\t' . 'self::setDatabaseTableStructure();';
		$installer_class_string .= '\t\t' . '$pdh = PDO_DB::connect();';
					
		$installer_class_string .= '\t\t' . 'foreach(self::$tableStructures as $k => $v){';
		$installer_class_string .= '\t\t\t' . 'if(!PDO_DB::tableExists($k)){';
		$installer_class_string .= '\t\t\t\t' . '$pdh->query($v);';
		$installer_class_string .= '\t\t\t\t' . 'self::$response[] = [';
		$installer_class_string .= '\t\t\t\t\t' . '\'message\' 	=> "Table " . $k  . " Successfully Created!",'; 
		$installer_class_string .= '\t\t\t\t\t' . '\'status\' 	=> \'ok\'';
		$installer_class_string .= '\t\t\t\t' . '];';
		$installer_class_string .= '\t\t\t' . '}else{';
		$installer_class_string .= '\t\t\t\t' . 'self::$response[] = [';
		$installer_class_string .= '\t\t\t\t\t' . '\'message\' 	=> "Table " . $k  . " Already Exists!",'; 
		$installer_class_string .= '\t\t\t\t\t' . '\'status\' 	=> \'not-ok\'';
		$installer_class_string .= '\t\t\t\t' . '];';
		$installer_class_string .= '\t\t\t' . '}';
		$installer_class_string .= '\t\t' . '}';
		$installer_class_string .= '\t' . '}';
				
		$installer_class_string .= '\t' . 'public static function setDatabaseTableStructure(){';
		
		foreach(self::$tables as $k => $v){
			$installer_class_string .= '\t\t' . 'self::$tableStructures["' . $k . '"] = ' . $v . '\r\n';
			self::createEntity($k);
		}
		
		$installer_class_string .= '}\r\n\r\n';
		$installer_class_string .= '?>';
		
		$fh = fopen(dirname($_SERVER['DOCUMENT_ROOT']) . '/lib/core/TableInstaller.class.php', 'w');
		fwrite($fh, $installer_class_string);
		fclose($fh);
		
		
	}
	
	public static function createEntity($tableName){
		$entity_class_string = '<?php' . '\r\n\r\n';
		$entity_class_string .= 'class ' . self::camelCaseClassName($tableName, true). '{\r\n\r\n';
		$entity_class_string .= '\t' . 'use DefaultTableEntityMethods';
		$entity_class_string .= '\t' . 'public static $table = ' . $tableName;
		
		// postEntry function Starts here
		
		$entity_class_string .= '\t' . 'public static function postEntry($postedData = []){';
		$entity_class_string .= '\t\t' . '$data = [';
		
		// $fieldStrs = '';
		foreach(self::$table_columns as $k => $v){
			
			if(self::$v['type'] == 'enum'){				
				$entity_class_string .= '\t\t\t"' . $k . '" => setTableFieldData($postedData, "' . $k . '", ' . $v['default_value'] . '),';
			}else{
				$entity_class_string .= '\t\t\t"' . $k . '" => setTableFieldData($postedData, "' . $k . '"),';
			}	
			
		}
		
		$entity_class_string .= '\t\t\t' . 'last_updated => setTableFieldData($postedData, "last_updated", ' . date("Y-m-d H:i:s") . '),';
		$entity_class_string .= '\t\t\t' . 'date => date("Y-m-d H:i:s")';

		$entity_class_string .= '\t\t' . ']';
		//	$entity_class_string .= '\t\t' . 'return PDO_DB::insert_bulk($data, ' . $tableName . ');';		
		$entity_class_string .= '\t\t' . 'return PDO_DB::insert_bulk($data, self::$table);';		
		
		$entity_class_string .= '\t' . '}';
		$entity_class_string .= '\r\n\r\n';
		
		// postEntry function Ends here
		
		// updateEntryById function Starts here
		
		$entity_class_string .= '\t' . 'public static function updateEntryById($id, $postedData = []){';
		$entity_class_string .= '\t\t' . '$currData = self::getEntryById($id);';
		$entity_class_string .= '\t\t' . '$data = [';		
		
		foreach(self::$table_columns as $k => $v){			
			$entity_class_string .= '\t\t\t' . $k . '=> setTableFieldData($postedData, "' . $k . '", $currData[' . $k . ']),';
		}
		
		
		$entity_class_string .= '\t\t\t' . 'last_updated => setTableFieldData($postedData, "last_updated", ' . date("Y-m-d H:i:s") . '),';
		$entity_class_string .= '\t\t\t' . 'date => date("Y-m-d H:i:s")';
		$entity_class_string .= '\t\t' . ']';
		
		//	$entity_class_string .= '\t\t' . 'return PDO_DB::update_bulk($data, ["id" => $id], ' . $tableName . ');';
		$entity_class_string .= '\t\t' . 'return PDO_DB::update_bulk($data, ["id" => $id], self::$table);';
		
		
		$entity_class_string .= '\t' . '}';
		$entity_class_string .= '\r\n\r\n';
		
		// updateEntryById function Ends here
		
		
		if(count($foreignKeys) > 0){
			foreach($foreignKeys as $k => $v){
				$methodSurfix 	= self::camelCaseName($k, true);
				$argSurfix 		= self::camelCaseName($k);
				
				$entity_class_string .= '\t' . 'public static function getEntryBy' . $methodSurfix . '($' . $argSurfix . '){';
				$entity_class_string .= '\t\t' . '$result = PDO_DB::select("SELECT * FROM ' . $tableName . ' WHERE ' . $k . ' = ? LIMIT 1", [$' . $argSurfix . '])';
				$entity_class_string .= '\t\t' . 'return $result[0]';			
				$entity_class_string .= '\t' . '}';
				$entity_class_string .= '\r\n\r\n';
				
				$entity_class_string .= '\t' . 'public static function getEntriesBy' . $methodSurfix . '($' . $argSurfix . '){';
				$entity_class_string .= '\t\t' . '$results = PDO_DB::select("SELECT * FROM ' . $tableName . ' WHERE ' . $k . ' = ? LIMIT 1", [$' . $argSurfix . '])';
				$entity_class_string .= '\t\t' . 'return $results';			
				$entity_class_string .= '\t' . '}';
				$entity_class_string .= '\r\n\r\n';
				
				$entity_class_string .= '\t' . 'public static function getEntriesCountBy' . $methodSurfix . '($' . $argSurfix . '){';
				$entity_class_string .= '\t\t' . '$result = PDO_DB::select("SELECT COUNT(id) AS counts FROM ' . $tableName . ' WHERE ' . $k . ' = ?", [$' . $argSurfix . '])';
				$entity_class_string .= '\t\t' . 'return $result[0]["counts"]';			
				$entity_class_string .= '\t' . '}';
				$entity_class_string .= '\r\n\r\n';
			}
		}
		
		
		
		if(count($unique_keys) > 0){		
			foreach($unique_keys as $k => $v){
				$methodSurfix 	= self::camelCaseName($k, true);
				$argSurfix 		= self::camelCaseName($k);				
				
				$entity_class_string .= '\t' . 'public static function getEntryBy' . $methodSurfix . '($' . $argSurfix . '){';
				$entity_class_string .= '\t\t' . '$result = PDO_DB::select("SELECT * FROM ' . $tableName . ' WHERE ' . $k . ' = ? LIMIT 1", [$' . $argSurfix . '])';
				$entity_class_string .= '\t\t' . 'return $result[0]';			
				$entity_class_string .= '\t' . '}';
				$entity_class_string .= '\r\n\r\n';
				
				$entity_class_string .= '\t' . 'public static function getEntriesBy' . $methodSurfix . '($' . $argSurfix . '){';
				$entity_class_string .= '\t\t' . '$results = PDO_DB::select("SELECT * FROM ' . $tableName . ' WHERE ' . $k . ' = ? LIMIT 1", [$' . $argSurfix . '])';
				$entity_class_string .= '\t\t' . 'return $results';			
				$entity_class_string .= '\t' . '}';
				$entity_class_string .= '\r\n\r\n';
				
				$entity_class_string .= '\t' . 'public static function getEntriesCountBy' . $methodSurfix . '($' . $argSurfix . '){';
				$entity_class_string .= '\t\t' . '$result = PDO_DB::select("SELECT COUNT(id) AS counts FROM ' . $tableName . ' WHERE ' . $k . ' = ?", [$' . $argSurfix . '])';
				$entity_class_string .= '\t\t' . 'return $result[0]["counts"]';			
				$entity_class_string .= '\t' . '}';
				$entity_class_string .= '\r\n\r\n';
			}
		}		
		
		$entity_class_string .= '}\r\n\r\n';
		$entity_class_string .= '?>';
		
		$entityClassName = self::camelCaseClassName($tableName, true);
		$fh = fopen(dirname($_SERVER['DOCUMENT_ROOT']) . '/lib/classes/helpers/' . $entityClassName, 'w');
		fwrite($fh, $data);
		fclose($fh);
	}
	
	public static function camelCaseClassName($var_name, $fromStart = false){
		if($fromStart){
			return str_replace(' ', '', ucwords(str_replace('_', ' ', $var_name))) . 'Entity';
		}else{
			
			$var_name_string_array = explode('_', $var_name);
			$className = $var_name_string_array[0];
			
			for($i = 1; $i < count($var_name_string_array); $i++){
				$className .= ucwords($var_name_string_array[$i]);
			}
			
			return $className . 'Entity.class.php';			
		}
	}
	
	public static function camelCaseName($var_name, $fromStart = false){
		if($fromStart){
			return str_replace(' ', '', ucwords(str_replace('_', ' ', $var_name)));
		}else{
			
			$var_name_string_array = explode('_', $var_name);
			$className = $var_name_string_array[0];
			
			for($i = 1; $i < count($var_name_string_array); $i++){
				$className .= ucwords($var_name_string_array[$i]);
			}
			
			return $className;			
		}
	}
	
}




?>