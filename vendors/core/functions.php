<?php

$directoryData 		= DirectoryWatcher::loadDirectoriesJSON();
Buttress::$folders 	= $directoryData['directories'];
$session			= $directoryData['session-key'];


if(!defined('SESSION_NAME')) define('SESSION_NAME', encript_string($session) );

function post($index){
	if(count($_POST) > 0 && isset($_POST[$index])){		
		$postedData = htmlentities(strip_tags($_POST[$index]));
		$postedData = Smarty_Autoloader::cleanData($postedData);		
		return $postedData;		
	}else{
		return '';
	}
}

function get($index){
	if(count($_GET) > 0 && isset($_GET[$index])){
		$postedData = htmlentities(strip_tags($_POST[$index]));
		$postedData = Smarty_Autoloader::cleanData($postedData);		
		return $postedData;		
	}else{
		return '';
	}
}

function post_file($index){
	if(count($_FILE) > 0 && isset($_FILE[$index])){
		$postedData['name'] 	= $_FILE[$index]['name'];
		$postedData['tmp_name'] = $_FILE[$index]['tmp_name'];	
		$postedData['size'] 	= $_FILE[$index]['size'];	
		$postedData['error'] 	= $_FILE[$index]['error'];	
		return $postedData;		
	}else{
		return 'Undefined index "$_FILE[\'' . $index . '\']"';
	}
}



function setRememberMeSession($sesname){
	$hour = time() + 3600 + 24 + 30;
	$session = is_array(getSession($sesname))? "array-" .serialize(getSession($sesname)) : getSession($sesname);
	setcookie(SESSION_NAME . $sesname, $session, $hour);	
}

function getRememberMeSession($sesname){	
	if(isset($_COOKIE[SESSION_NAME . $sesname]) && $_COOKIE[SESSION_NAME . $sesname] !=""){
		$cookieStr = $_COOKIE[SESSION_NAME . $sesname];		
		if(strpos($cookieStr, 'array-', 0) !== FALSE){
			
			$cookieStr = substr($cookieStr, 6);			
			$cookieStr = unserialize($cookieStr);
		}
		return $cookieStr;
	}
	return null;
}


function clearRememberMeSession($sesname){	
	setcookie(SESSION_NAME . $sesname, "", time() - 3600);
}


function setSession($sesname, $sesval){
	$_SESSION[SESSION_NAME][$sesname] = AESEncrypt(serialize($sesval), APP_KEY );
}

function getSession($sesname){
	if(isset($_SESSION[SESSION_NAME][$sesname])){
		return unserialize(AESDecrypt($_SESSION[SESSION_NAME][$sesname], APP_KEY) );		
	}
	return '';
}

function clearSession($sesname = ''){
	if($sesname == ''){
		if(isset($_SESSION[SESSION_NAME][$sesname])){
			unset($_SESSION[SESSION_NAME][$sesname]);
		}
	}else{
		if(isset($_SESSION[SESSION_NAME])){
			unset($_SESSION[SESSION_NAME]);
		}
	}
}

function session(){
	if(!isset($_SESSION[Buttress::$session_key])){
		$_SESSION[SESSION_NAME] = [];		
	}
	return $_SESSION[SESSION_NAME];
}

function setTableFieldData($dataArray = [], $key, $optional_value = ''){
	return isset($dataArray[$key])? $dataArray[$key] : $optional_value;
}

function get_web_file($filepath, $filename, $directoryPath){
	$data = file_get_contents($filepath);
	$file = fopen($directoryPath . $filename, 'w');
	fwrite($file, $data);
	fclose($file);
}

function get_multi_web_file($fileRootUrl, $file_name_array, $saveDirectoryPath){
	for($i = 0; $i < count($file_name_array); $i++){
		get_web_file($fileRootUrl . $file_name_array[$i], $file_name_array[$i],  $saveDirectoryPath);
	}
}


function setCSRF(){
	
	if(!isset($_SESSION[SESSION_NAME]['csrf'])){		
		setSession('csrf', md5(hash('crc32', time())));
	}
	
	if(isset($_SESSION[SESSION_NAME]['csrf'])){		
		Buttress::$csrf = getSession('csrf');
	}
}



function validateUserSession($userData = [], $sessionName = 'user', $table = 'admin'){
	if(is_array($userData) && count($userData) > 0 && array_key_exists('email', $userData)  && array_key_exists('password', $userData) ){
		$result = PDO_DB::select("SELECT COUNT(id) AS counts FROM " . $table . " WHERE email = ? AND password = ? LIMIT 1", [$userData['email'], $userData['password']]);
		if($result[0]['counts'] < 1 || $result[0]['counts'] == 0 || $result[0]['counts'] ==''){
			clearSession($sessionName);
			header('location:/');
			exit;
		}else{
			
		}
	}else{
		clearSession($sessionName);
		header('location:/');
		exit;
	}
}

function encript_string($string){
	return sha1(sha1(md5($string)));
}

function map_array($array = [], $callback = ''){
	$returns = '';
	$my_array = $array;
	if($callback != ''){
		for($i = 0; $i < count($my_array); $i++){
			call_user_func($callback, $my_array[$i]);
		}
	}	
	return $my_array;	
}

function debug_array($arr){
	echo '<pre>';
	print_r($arr);
	echo '</pre>';
}

function generateRandomCharacter(){
		
	$seed = str_split('abcdefghijklmnopqrstuvwxyz'
			 .'ABCDEFGHIJKLMNOPQRSTUVWXYZ'
			 .'0123456789'); // and any other characters
	shuffle($seed); // probably optional since array_is randomized; this may be redundant
	$rand = '';
	foreach (array_rand($seed, 8) as $k){
		$rand .= $seed[$k];	
	}
	return $rand;

}

function getFileFolder(){
	$folderPath = explode("/", str_replace("\\", "/", dirname(__FILE__)));
	return end($folderPath);	
}


/**
 * crypt AES 256
 *
 * @param data $data
 * @param string $password
 * @return base64 encrypted data
 */
function AESEncrypt($data, $password) {
	// Set a random salt
	$salt = openssl_random_pseudo_bytes(16);

	$salted = '';
	$dx = '';
	// Salt the key(32) and iv(16) = 48
	while (strlen($salted) < 48) {
	  $dx = hash('sha256', $dx.$password.$salt, true);
	  $salted .= $dx;
	}

	$key = substr($salted, 0, 32);
	$iv  = substr($salted, 32,16);

	$encrypted_data = openssl_encrypt($data, 'AES-256-CBC', $key, true, $iv);
	return base64_encode($salt . $encrypted_data);
}

 /**
  * decrypt AES 256
  *
  * @param data $edata
  * @param string $password
  * @return decrypted data
  */
  
function AESDecrypt($edata, $password) {
	$data = base64_decode($edata);
	$salt = substr($data, 0, 16);
	$ct = substr($data, 16);

	$rounds = 3; // depends on key length
	$data00 = $password.$salt;
	$hash = array();
	$hash[0] = hash('sha256', $data00, true);
	$result = $hash[0];
	for ($i = 1; $i < $rounds; $i++) {
		$hash[$i] = hash('sha256', $hash[$i - 1].$data00, true);
		$result .= $hash[$i];
	}
	$key = substr($result, 0, 32);
	$iv  = substr($result, 32,16);

	return openssl_decrypt($ct, 'AES-256-CBC', $key, true, $iv);
}

function getConfigData($key = ""){
	$data 	= [];	
	$file 	= fopen( BUTTRESS_ROOT . "/" .config('config_dir') . '/' . config('config_file'), 'r' );		
	$result = fgets($file);		
	while(! feof($file)){		
		$line = explode('=', ltrim(rtrim(fgets($file))));
		if(isset($line[1]) && $line[1] != ''){
			$configData = [];
			$data[trim($line[0])] =  trim($line[1]);
		}		
	}
	
	if($key != ""){
		return $data[$key];
	}
		
	return $data;
}

function config($key = ''){
	
	$confData 	= explode("\n", file_get_contents("../lib/" . Buttress::$env));
	$conf_array = [];
	#	Tools::debug_array($confData);
	foreach($confData as $k => $data){
		#	echo $confData[$k] . " -> w <br>";
		if($confData[$k] != "" or $confData[$k] != "\n" ){
			$dataArray = explode("=", $confData[$k]);
			$conf_array[trim($dataArray[0])] = trim($dataArray[1]);
		}	
		
	}
	
	if($key != '' && isset($conf_array[$key])){
		return $conf_array[$key];
		
	}else if($key != '' && !isset($conf_array[$key])){
		return "";
	}
	
	return $conf_array;
	
}


function display($pageData = [], $viewPath = ""){
	
	$buttress 	= new Buttress();
	$config 	= getConfigData();
	$buttress->compile_dir 	= BUTTRESS_ROOT . "/" . config('compile_dir');
	$buttress->cache_dir 	= BUTTRESS_ROOT . "/" . config('cache_dir');	
	$buttress->config_dir 	= BUTTRESS_ROOT . "/" . config('config_dir');	
	$buttress->template_dir = BUTTRESS_ROOT . "/" . config('view_dir');
	
	if(!file_exists($buttress->template_dir[0])){
		
		mkdir($buttress->template_dir[0]);
		$fhandle = fopen($buttress->template_dir[0] . "index.php", "w");
		$data = "<?php\n";
		$data .= "header('location:/') \n";
		$data .= "?>";		
		fwrite($fhandle, $data, strlen($data));
		fclose($fhandle);
		
	}
	
	Buttress::$config 		= $buttress->getConfigVars();	
	$buttress->config_load(config('config_file'));
	
	foreach($pageData as $k => $v){
		$buttress->assign($k, $v);
	}
	
	$buttress->display($viewPath);
	
}


function fetch($pageData = [], $viewPath = ""){
	
	$buttress 	= new Buttress();
	$config 	= getConfigData();
	$buttress->compile_dir 	= BUTTRESS_ROOT . "/" . config('compile_dir');
	$buttress->cache_dir 	= BUTTRESS_ROOT . "/" . config('cache_dir');	
	$buttress->config_dir 	= BUTTRESS_ROOT . "/" . config('config_dir');;	
	$buttress->template_dir = BUTTRESS_ROOT . "/" . config('view_dir');;		
	Buttress::$config 		= $buttress->getConfigVars();	
	$buttress->config_load(config('config_file'));
	
	foreach($pageData as $k => $v){
		$buttress->assign($k, $v);
	}	
	return $buttress->fetch($viewPath);
	
}


?>