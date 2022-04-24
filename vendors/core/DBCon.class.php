<?php 
class DBCon{
	public $con, $resultArray = array(), $resultCount, $transId, $response, $errorType;
	public function __construct(){
		
		$this->connect();
	}
	public function connect()
	{		
		Utilities::initConfigData();
		$configData = Utilities::$configData;
		
		//	$this->con = new mysqli($_SERVER['MY_HOST'], $_SERVER['USER'], $_SERVER['PASS'], $_SERVER['MY_DB']);
		$this->con = new mysqli($configData['db_host'], $configData['user'], $configData['password'], $configData['database']);
		if($this->con->connect_error){
			return @$this->con->connect_error;
			
		}else{			
			return $this->con;		
		}
		
	}
	
	
	############################################################
	###########################  INSERT QUERY ***** ############
	############################################################
	
	public function insertQuery($insertArray = array(), $table, $date = true)
	{
		if(is_array($insertArray) || $insertArray !== NULL){
			$fields = implode(", ", array_keys($insertArray));
			$values = "'". implode("', '", array_values($insertArray)) . "'";
			$sql = "";
			$nowDate = $date;
				
			if($nowDate == false){
				$sql = "INSERT INTO " . $table . "(" . $fields . ")VALUES(" . $values . ")";
			}else{
				$sql ="INSERT INTO " . $table . "(" . $fields . ", date)VALUES(" . $values . ", now())";
			}
			//echo $sql;
			$query = $this->con->query($sql);
			
			if($query){
				$this->transId = $this->con->insert_id;
				return true;				
			}else{
				$this->response = $this->printMysqlError();
				return false;	
			}
		}
	}
	
	############################################################
	###########################  UPDATE QUERY ***** ############
	############################################################
	
	public function updateQuery($updateArray = array(),  $whereArray = array(), $table)
	{
		if(is_array($updateArray) || $updateArray !== NULL && is_array($whereArray) || $whereArray !== NULL){
			$updateString = $whereString ="";
			
			foreach($updateArray as $key => $value){
				$updateString .= $key . " = '" . $value . "', ";	
			}
			$updateString = rtrim($updateString, ', ');
			
			if(count($whereArray) > 1){				
				foreach($whereArray as $key => $value){
					$whereString .= $key . " = '" . $value . "' AND ";	
					
				}				
			}else{				
				foreach($whereArray as $key => $value){
					$whereString = $key . " = '" . $value . "'";	
				}	
			}
			$whereString = rtrim($whereString, " AND ");
			//echo "UPDATE " . $table . " SET " . $updateString . " WHERE " . $whereString . " LIMIT 1<br />";
			$query = $this->con->query("UPDATE " . $table . " SET " . $updateString . " WHERE " . $whereString . " LIMIT 1");	
			if($query){
				return true;				
			}else{
				$this->response = $this->printMysqlError(); echo ' Error on line ' . __LINE__;
				return false;	
			}	
			
			$whereString = rtrim($whereString, " AND ");
		}
	}
	
	
	############################################################
	##############  SELECT SPECIFIC ROW QUERY ***** ############
	############################################################
	
	public function selectPreciseQuery($fieldArray = array(), $whereArray = array(), $table, $offset = NULL)
	{
		if(is_array($fieldArray) || $fieldArray !== NULL && is_array($whereArray) || $whereArray !== NULL){
			$selectString = $whereString ="";
			
			$selectString = implode($fieldArray, ", ");
			
			if(count($whereArray) > 1){				
				foreach($whereArray as $key => $value){
					$whereString .= $key . " = '" . $value . "' AND ";	
					
				}				
			}else{				
				foreach($whereArray as $key => $value){
					$whereString = $key . " = '" . $value . "'";	
				}	
			}
			
			if($offset == NULL){
				$offset = ' LIMIT  1';
			}else{
				$offset = ' LIMIT ' . $offset;
			}
			
			
			$whereString = rtrim($whereString, " AND ");
			//echo "SELECT " . $selectString . " FROM " . $table . " WHERE " . $whereString . $offset .'<br />';
			$query = $this->con->query("SELECT " . $selectString . " FROM " . $table . " WHERE " . $whereString . $offset);	
			if($query){
				$this->resultArray = $query->fetch_array(MYSQLI_ASSOC);
				return true;
					
			}else{
				$this->response = $this->negativeResponse($this->printMysqlError());
				return false;	
			}
			$whereString = rtrim($whereString, " AND ");
			
		}
		
	}
	
	############################################################
	################### SELECT ALL ROWS QUERY ***** ############
	############################################################

	public function selectAllQuery($fieldArray = array(), $table, $offset = NULL)
	{
		if(is_array($fieldArray) || $fieldArray !== NULL){
			$selectString = implode(", ", $fieldArray);
			
			
			
			if($offset == NULL){
				$offset = ' LIMIT  1';
			}else{
				$offset = ' LIMIT ' . $offset;
			}
			//echo "SELECT " . $selectString . " FROM " . $table . " WHERE " . $offset . '<br />';
			$query = $this->con->query("SELECT " . $selectString . " FROM " . $table .  $offset);	
			if($query){
				
				$this->resultArray = $query->fetch_array(MYSQLI_ASSOC);
						
			}else{
				$this->response = $this->negativeResponse($this->printMysqlError());
				return false;	
			}	
			
		}else if(func_num_args() < 2 || func_num_args() > 2){
			$message = "Two parameters are expected but " . func_num_args() . '  given!';
			$this->response = $this->negativeResponse($message);
			return false;	
		}else if(!is_array($fieldArray) || $fieldArray == NULL ){
			$this->response = $this->negativeResponse('Parameter 1 must be an array');
			return false;	
		}else if(!isset($table)){
			$this->negativeResponse('The table argument is missing');
			return false;	
		}
		
		
	}
	
	############################################################
	################  SELECT COUNT ROWS QUERY ***** ############
	############################################################
	
	public function selectCountPreciseResults($whereArray = array(), $table, $offset = NULL)
	{
		if(is_array($whereArray) || $whereArray !== NULL){
			$whereString ="";
						
			if(count($whereArray) > 1){				
				foreach($whereArray as $key => $value){
					$whereString .= $key . " = '" . $value . "' AND ";	
					
				}				
			}else if(count($whereArray) <= 1){				
				foreach($whereArray as $key => $value){
					$whereString = $key . " = '" . $value . "'";	
				}	
			}
			
			if($offset == NULL){
				$offset = ' LIMIT 1';
			}else{
				$offset = ' LIMIT ' . $offset;
			}
			$whereString = rtrim($whereString, " AND ");
			//echo  "SELECT COUNT(id) FROM " . $table . " WHERE " . $whereString . $offset;
			$query = $this->con->query("SELECT COUNT(id) FROM " . $table . " WHERE " . $whereString . $offset);	
			if($query){
				$queryResult = $query->fetch_row();
				
				$this->resultCount = $queryResult[0];
				
				//return $this->resultCount;				
			}else{
				$this->response = $this->negativeResponse($this->printMysqlError());
				return false;	
			}	
			
		}
		
	}
	
	############################################################
	####################  DELETE ROWS QUERY  ***** #############
	############################################################
	
	public function deleteRowQuery($whereArray = array(), $table, $offset = NULL)
	{
		if(is_array($whereArray) || $whereArray !== NULL){
			$whereString ="";
						
			if(count($whereArray) > 1){				
				foreach($whereArray as $key => $value){
					$whereString .= $key . " = '" . $value . "' AND ";	
					
				}				
			}else{				
				foreach($whereArray as $key => $value){
					$whereString = $key . " = '" . $value . "'";	
				}	
			}
			
			if($offset == NULL){
				$offset = ' LIMIT 1';
			}else{
				$offset = ' LIMIT ' . $offset;
			}
		
			$whereString = rtrim($whereString, " AND ");
			$query = $this->con->query("DELETE FROM " . $table . " WHERE " . $whereString . $offset);	
			if($query){			
				return true;				
			}else{
				$this->response = $this->negativeResponse($this->printMysqlError());
				return false;	
			}
			
			$whereString = rtrim($whereString, " AND ");
			
		}
		
	}
	
	public function customInsertQuery($insertArrays, $table){
		if(!$this->customCheckEmptyFields($insertArrays)){
			$this->errorType = 'empty_field';
			$this->response = '<p style="display:block; padding:5px 7px; border:1px solid #eee; border-left:5px; solid #f00;"> Complete all required field(s)</p>';
		}else if($this->checkEmptyFields($insertArrays)){
			$tableColumn = $insertArrays[0];
			$fieldValue = $this->con->real_escape_string(htmlentities(stripslashes($insertArrays[0][0])));
			for($i = 1; $i < sizeof($insertArrays); $i++){
				$tableColumn .= ", " . $insertArray[$i];
				$fieldValue .= ", '" . $this->con->real_escape_string(htmlentities(stripslashes($insertArray[$i][0]))) . "'";
			}
			$tableColumn .= ', date';
			$fieldValue .= ', now()';
			
			$query = $this->con->query("INSERT INTO " . $table . "(" . $tableColumn . ")VALUES(" . $fieldValue . ")");
			if($query){
				return true;
			}else{
				$this->printMysqlError();
				return false;
			}
			
			
		}
		
		
	}
	
	public function customCheckEmptyFields($insertArrays){
		$i = 0;
		foreach($insertArrays as $insertArray){
			list($value, $requiredStatus) = $insertArray[$i];
			if($requiredStatus == 'true' && $value == ""){
				return false;
				break;
			}
			$i++;
		}
		return true;
	}
	public function escapeString($str)
	{
		return $this->con->real_escape_string($str);		
	}
	
	public function printMysqlError()
	{
		if($this->con->error){
			echo $this->con->error;
		}
	
	}
	
	
}




?>

<?php 
class CreateTable1 extends DBCon{
	public $conn, $pageElements = array();
	
	public function __construct(){
		$this->conn = $this->connect();	
	}	
	
	public function createTable($tableName, $sql){
		$checkTableQuery = $this->conn->query('SELECT 1 FROM ' . $tableName . ' LIMIT 1');
		if(!$checkTableQuery){			
			$createTableQuery = $this->conn->query($sql);
			if($createTableQuery){
				$this->logSuccessMessage($tableName);
			}else{
				if($this->conn->error){
					$this->logFailureMessage($tableName). '&nbsp;&nbsp;-&nbsp;&nbsp;' . $this->conn->error;
				}			
			}		
			
		}else{
			echo $this->logFailureMessage($tableName);
		
		}
	
	}
	
	public function printPageMessage(){
		$htmlBody = '<html>
						<head>
							<title>Boombell  Database Installation</title>
							<style>
								a.btn-link{ display:inline; padding:12px 36px; border:1px solid #eee; background-color:#09c; text-decoration:none; color:#fff; border-radius:6px;}
							</style>
						</head>
					<body style="background-color:#eee; margin:0; padding:0px; font-family:sans-serif;"><div style="width:1000px; border:1px solid #eee; margin:auto; padding:12px; background-color:#fff;">';
		$htmlBody .= '<br />
					  <h1 style="margin:0px; margin-bottom:12px; font-family:sans-serif;">
							<span style="font-weight:600;color:#739e21;">Boombell </span><span style="font-weight:300;color:#666; ">Global Network</span>
					  </h1>
					  <hr />
					  <big> Database Installation</big>
					  <br /><br />';
		for($i =0 ; $i < count($this->pageElements); $i++){
			$htmlBody .= $this->pageElements[$i];
		}
		$htmlBody .= '<p style="display:block; margin:36px 0;">
							<a href="#" class="btn-link">Continue</a>
					  </p>
					  <hr />
					  </div>
					  </body>';
		
		echo $htmlBody;
		
	}
	
	public function activateCreateTable($tablesArray){
		foreach($tablesArray as $key => $value){
			$this->createTable($key, $value);		
		}
		$this->printPageMessage();
	}
	
	public function logSuccessMessage($tableName){
		array_push($this->pageElements, '<p style="display:block;  margin-bottom:10px; color:#333; background-color:#0f9; padding:10px;"><strong>' . $tableName .'</strong> table created successfully!<br /></p>');
		
	}
	
	public function logFailureMessage($tableName){
		array_push($this->pageElements, '<p style="display:block; margin-bottom:10px; color:#333; background-color:orange; padding:10px;"><strong>' . $tableName .'</strong> table already created!<br /></p>');
		
	}
	
}

?>



