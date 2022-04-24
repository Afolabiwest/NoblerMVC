<?php


if (! function_exists( 'config' ) ) {
	function config($key = ''){	
		return Nobler::getConfigData($key);	
	}
}

$sitekey 	= config( 'sitekey' );
$sessioName = config( 'session_name' );

if( !defined( 'SESSION_NAME' ) ) define( 'SESSION_NAME', $sessioName );
if( !defined( 'APP_KEY' ) ) define( 'APP_KEY', $sitekey );

if (! function_exists( 'post' ) ) {
	function post($index){
		if(count($_POST) > 0 && isset($_POST[$index])){		
			$postedData = htmlentities( strip_tags( $_POST[$index] ) );
			$postedData = Nobler::cleanData( $postedData );		
			return $postedData;		
		}else{
			return '';
		}
	}
}

if (! function_exists( 'text' ) ) {
	function text($index){
		if( count( $_POST ) > 0 && isset( $_POST[$index] ) ){		
			$postedData = htmlentities( $_POST[$index] );
			$postedData = Nobler::cleanData( $postedData );		
			return $postedData;		
		}else{
			return '';
		}
	}
}

if (! function_exists( 'get' ) ) {
	function get($index){
		if(count($_GET) > 0 && isset($_GET[$index])){
			$postedData = htmlentities(strip_tags($_POST[$index]));
			$postedData = Nobler::cleanData($postedData);		
			return $postedData;		
		}else{
			return '';
		}
	}
}

if (! function_exists( 'post_file' ) ) {
	function post_file($index){	
		if(isset($_FILES[$index]) &&  count($_FILES) > 0){
			$postedData['name'] 	= $_FILES[$index]['name'];
			$postedData['tmp_name'] = $_FILES[$index]['tmp_name'];	
			$postedData['size'] 	= $_FILES[$index]['size'];	
			$postedData['error'] 	= $_FILES[$index]['error'];	
			return $postedData;		
		}else{
			return 'Undefined index "$_FILES[\'' . $index . '\']"';
		}
	}
}


if (! function_exists( 'setRememberMeSession' ) ) {
	function setRememberMeSession($sesname){
		$hour = time() + 3600 + 24 + 30;
		$session = is_array( getSession($sesname))? "array-" .serialize(getSession($sesname)) : getSession($sesname);
		setcookie(SESSION_NAME . $sesname, $session, $hour);	
	}
}

if (! function_exists( 'getRememberMeSession' ) ) {
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
}

if (! function_exists( 'clearRememberMeSession' ) ) {
	function clearRememberMeSession($sesname){	
		setcookie(SESSION_NAME . $sesname, "", time() - 3600);
	}
}

if (! function_exists( 'setSession' ) ) {
	function setSession($sesname, $sesval){
		
		$_SESSION[SESSION_NAME][$sesname] = AESEncrypt(serialize($sesval), APP_KEY );
	}
}


if (! function_exists( 'getSession' ) ) {
	function getSession($sesname, $guard = "" ){
		if( $guard == "" ){
			if(isset($_SESSION[SESSION_NAME][$sesname])){
				return unserialize(AESDecrypt($_SESSION[SESSION_NAME][$sesname], APP_KEY) );		
			}
		}else{
			return Authentication::getUserSession( $guard );
		}
		
		return '';
	}
}


if (! function_exists( 'getUserSession' ) ) {
	function getUserSession( $guard ){
		return Authentication::getUserSession( $guard );
	}
}


if (! function_exists( 'clearSession' ) ) {
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
		return true;
	}
}

if (! function_exists( 'redirect' ) ) {
	function redirect($url = '/'){
		echo '<script>location.href="' . $url . '"</script>';
	}
}

if (! function_exists( 'session' ) ) {
	function session(){
		if(!isset($_SESSION[Buttress::$session_key])){
			$_SESSION[SESSION_NAME] = [];		
		}
		return $_SESSION[SESSION_NAME];
	}
}

if (! function_exists( 'setTableFieldData' ) ) {
	function setTableFieldData($dataArray, $key, $optional_value = ''){
		return isset($dataArray[$key])? $dataArray[$key] : $optional_value;
	}
}

if (! function_exists( 'get_web_file' ) ) {
	function get_web_file($filepath, $filename, $directoryPath){
		$data = file_get_contents($filepath);
		$file = fopen($directoryPath . $filename, 'w');
		fwrite($file, $data);
		fclose($file);
	}
}

if (! function_exists( 'get_multi_web_file' ) ) {
	function get_multi_web_file($fileRootUrl, $file_name_array, $saveDirectoryPath){
		for($i = 0; $i < count($file_name_array); $i++){
			get_web_file($fileRootUrl . $file_name_array[$i], $file_name_array[$i],  $saveDirectoryPath);
		}
	}
}

if (! function_exists( 'setCSRF' ) ) {
	function setCSRF(){		
		if(!isset($_SESSION[SESSION_NAME]['csrf'])){		
			setSession('csrf', md5(hash('crc32', time())));
		}
		
		if(isset($_SESSION[SESSION_NAME]['csrf'])){		
			Nobler::$csrf = getSession('csrf');
		}
	}
}



if (! function_exists( 'encript_string' ) ) {
	function encript_string($string){
		return sha1( sha1 ( md5( $string ) ) );
	}
}


if (! function_exists( 'debug_array' ) ) {
	function debug_array($arr){
		echo '<pre>';
		print_r($arr);
		echo '</pre>';
	}
}

if (! function_exists( 'dd' ) ) {
function dd($arr){
	debug_array($arr);
	exit;
}
}

if (! function_exists( 'generateRandomCharacter' ) ) {
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
}

if (! function_exists( 'getFileFolder' ) ) {
	function getFileFolder(){
		$folderPath = explode("/", str_replace("\\", "/", dirname(__FILE__)));
		return end($folderPath);	
	}
}

if (! function_exists( 'AESEncrypt' ) ) {
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
}

if (! function_exists('AESDecrypt')) {
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
}

if (! function_exists( 'params' ) ) {
	function params($index){
		return getPageParams($index);
	}
}

if (! function_exists( 'getHomePath' ) ) {
	function getHomePath(){
		return str_replace("\\", "/", dirname(__DIR__)) . '/';
	}
}



if (! function_exists( 'get_image' ) ) {
    function get_image( $path, $default ="")
    {
        if( !file_exists( public_path() . $path )){
			$imagedata = base64_encode(file_get_contents( public_path() . $default ));
			return 'data:' . mime_content_type( public_path() . $default ) . ';base64,'. $imagedata;
		}
		$imagedata = base64_encode(file_get_contents( public_path() . $path));
		return 'data:' . mime_content_type( public_path() . $path ) . ';base64,'. $imagedata;		
    }
}

if (! function_exists( 'public_path' ) ) {
    function public_path() 
    {
        return $_SERVER['DOCUMENT_ROOT'];
    }
}

if (! function_exists('shorten_article')) {
    function shorten_article( $article, $limit = 10 )
	{
		$str = explode(" ", $article);
		$strArray = [];
		$newstr =  "";
		if( count($str) > $limit ){
			$strArray = array_splice( $str, 0, $limit );
			$newstr = implode(" ", $strArray) . " ...";
		}else{
			$newstr = $article;
		}
		
		return $newstr;
	}

}


if (! function_exists( 'getConfigData' ) ) {
	function getConfigData( $key = "" )
	{
		return Nobler::getConfigData($key);	
	}
}



if (! function_exists( 'getPageParams' ) ) {
	function getPageParams( $index )
	{
		if(isset(Nobler::$params[$index])){
			return Nobler::$params[$index];
		}
		return "";
	}
}




if (! function_exists( 'display' ) ) {
	function display( $pageData = [], $viewPath = "" )
	{		
		Nobler::display( $pageData, $viewPath );	
	}
}


if (! function_exists( 'fetch' ) ) {
	function fetch( $pageData = [], $viewPath = "" )
	{	
		return Nobler::fetch( $pageData, $viewPath );	
	}
}


if (! function_exists( 'route' ) ) {
	function route( $routeName, $routeArgs = [] )
	{
		return Nobler::route( $routeName, $routeArgs ); 	
	}
}

if (! function_exists( 'login' ) ) {
	function login( $checkData = [], $guard = '', $redirectUrl = '/' )
	{
		if( $guard != '' ){
			Forms::guard( $guard )->attempt_login( $checkData, $guard, $checkData );	 
		}else{
			Forms::attempt_login( $checkData, $guard, $checkData );	 
		}			
	}
}

if (! function_exists( 'logout' ) ) {
	function logout( $guard = '', $redirectUrl = '/' )
	{
		if( $guard != '' ){
			Forms::guard( $guard )->logout( $redirectUrl );	 
		}else{
			Forms::logout( $redirectUrl );;	 
		}			
	}
}


if (! function_exists( 'user' ) ) {
	function user( $guard = '' )
	{
		return $guard != '' ? Authentication::getUserSession( $guard ) : 	Authentication::getUserSession();
	}
}



if (! function_exists( 'list_file_paths' ) ) {
	function list_file_paths( $dirname = '' )
	{
		return Nobler::get_file_paths( $dirname );
	}
}


?>
