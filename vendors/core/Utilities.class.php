<?php 

class Utilities{
	public $hello = 'Initializing ...';
	public static $configData = [], $response;
	public function secureData($str){
		$securedStr = stripslashes(htmlentities($str));
		return $securedStr;	
	}
	
	public function beepMessage($str, $msgType = NULL){	
		$colorStr = $icon = "";	
		if($msgType == NULL){
			$colorStr = "#f00";
			$icon = "bar";	
		}else if($msgType == 'success'){
			$icon = "check";	
			$colorStr = "green";	
		}else if($msgType == 'info-square'){
			$icon = "exclamation-circle";	
			$colorStr = "#00c4ff";
		}else if($msgType == 'warning'){
			$icon = "engine-warning";	
			$colorStr = "#e4a48b";
		}
		
		return '<p style="color:#666; border-left:5px solid ' . $colorStr . '; padding:10px; background-color:#eee;">	' . $str . ' <span class="fal fa-' . $icon. ' pull-right" style="color:' . $colorStr . '"></span></p>';
	
	}
	
	public static function message($str, $msgType = NULL){	
		$colorStr = $icon = "";	
		if($msgType == NULL){
			$colorStr = "#f00";
			$icon = "bar";	
		}else if($msgType == 'success'){
			$icon = "check";	
			$colorStr = "green";	
		}else if($msgType == 'info'){
			$icon = "exclamation-circle";	
			$colorStr = "#00c4ff";
		}else if($msgType == 'warning'){
			$icon = "exclamation-triangle";	
			$colorStr = "#e4a48b";
		}
		
		return '<p style="color:#666;  text-align:center; border-left:5px solid ' . $colorStr . '; padding:10px; background-color:#eee;">	' . $str . ' <span class="fal fa-' . $icon. ' pull-right" style="color:' . $colorStr . '"></span></p>';
	
	}
	
	public static function bt_message($str, $msgType = 'warning'){		
		
		$message = '<div class="alert alert-' . $msgType . '">	'; 
		$message .= $str ;
		$message .= '<button type="button" class="close" data-dismiss="alert" arial-label="Close">';
		$message .= '<span arial-hidden="true">&times;</span>';
		$message .= '</button>';
		$message .= '</div>';
		return $message;
	}
	
	
	public function formatURLVar($str){
		$strg = explode(" ", $str);
		$urlVar = $strg[0] . '-';
		for($i = 1; $i < sizeof($strg); $i++){
			$urlVar .= $strg[$i] . '-';
		}
		$finalStr = rtrim($urlVar, '-');
		return $finalStr;
	}
	
	public function formatInverseURLVar($str){
		$strg = explode("-", $str);
		$urlVar = $strg[0] . ' ';
		for($i = 1; $i < sizeof($strg); $i++){
			$urlVar .= $strg[$i] . ' ';
		}
		$finalStr = rtrim($urlVar, ' ');
		return $finalStr;		
	}
	
	
	public function shortenArticle($str, $tr2){
		if(sizeof(explode(' ', $str)) > $tr2){
			return implode(' ', array_slice(explode(' ', $str), 0, $tr2)) . ' ...';
		}
		return implode(' ', array_slice(explode(' ', $str), 0, $tr2));
	}
	public static function shortenStatement($str, $tr2){
		if(sizeof(explode(' ', $str)) > $tr2){
			return implode(' ', array_slice(explode(' ', $str), 0, $tr2)) . ' ...';
		}
		return implode(' ', array_slice(explode(' ', $str), 0, $tr2));
	}
	
	public static function shortenText($str, $tr2){
		if(sizeof(explode(' ', $str)) > $tr2){
			return implode(' ', array_slice(explode(' ', $str), 0, $tr2)) . ' ...';
		}
		return implode(' ', array_slice(explode(' ', $str), 0, $tr2));
	}
	
	public function createFolder($folderPath, $folderId){
		if(file_exists($folderPath . '/' . $folderId) != 1){
			mkdir($folderPath . '/' . $folderId, 0755);			
			$data = '<?php header("location:http://' . $_SERVER['HTTP_HOST'] . '"); ?>';
			$handle = fopen($folderPath . '/' . $folderId .'/index.php', 'w');
			fwrite($handle, $data);
			chmod($folderPath . '/' . $folderId .'/index.php', '0755');
		}	
	}
	
	public function createThumbnails($imageDir, $imageResource, $thumbname){
		$imageCropper = new ImageCropper($imageResource);
		$imageCropper->createThumbnail($imageDir, $thumbname);
	}
	
	
	public static function maketTimeAgo($str){
   		$difference = time() - self::convert_datetime($str);
   		$periods = array("Sec", "Min", "Hr", "Day", "Week", "Month", "Year", "Decade");
   		$lengths = array("60","60","24","7","4.35","12","10");
   		for($j = 0; $difference >= $lengths[$j]; $j++)
   			$difference /= $lengths[$j];
   			$difference = round($difference);
   		if($difference != 1) $periods[$j].= "s";
   			$text = "$difference $periods[$j] Ago";
   			return $text;
	}
	
	public static function makeTimeAgo($str){
   		$difference = time() - self::convert_datetime($str);
   		$periods = array("Sec", "Min", "Hr", "Day", "Week", "Month", "Year", "Decade");
   		$lengths = array("60","60","24","7","4.35","12","10");
   		for($j = 0; $difference >= $lengths[$j]; $j++)
   			$difference /= $lengths[$j];
   			$difference = round($difference);
   		if($difference != 1) $periods[$j].= "s";
   			$text = "$difference $periods[$j] Ago";
   			return $text;
		
	}
	 
	public static function convert_datetime($str) {
   		list($date, $time) = explode(' ', $str);
    	list($year, $month, $day) = explode('-', $date);
    	list($hour, $minute, $second) = explode(':', $time);
    	$timestamp = mktime($hour, $minute, $second, $month, $day, $year);
    	return $timestamp;
	}
	
		
	
	
	public function asyncronousRequestCheck()
	{
		if (!$this->isAsyncronousRequest()) {
			header( 'location:' . $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST'] );	
		}
				
	}
	public function isAsyncronousRequest(){
		  return isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest';		  
	}
	
	public function getServerHostURL()
	{
		return $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST'] ;
	}
	
	public function getDefaultPage($pageURL = NULL){
		if($pageURL == NULL){
			return '' . $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST'];
		}else{			
			return $pageURL;
		}
		
	}
	public function getServerName(){
		return str_replace('www.', '', $_SERVER['SERVER_NAME']);	
	}
	
	public function getRequestURI(){
		if(isset($_SERVER['REQUEST_URI'])){
			return $_SERVER['REQUEST_URI'];
		}
	}
	
	public function redirectIfNotAjax(){
		if(!$this->is_ajax()){
			header('location:' . $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST']);
		}
	}
	
	public static function is_ajax(){
	  return isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest';
	}
	
	public static function makeSHA1Password($passwordString){
		return sha1(sha1($passwordString));
	}
	
	public static function makeSHA1_MD5Password($passwordString){
		return sha1(sha1(md5($passwordString)));
	}
	
	public static function encript_password($passwordString){
		return sha1(sha1(md5($passwordString)));
	}
	
	public static function encrypt_password($passwordString){
		return self::encript_password($passwordString);
	}
	
	public static function makeMD5Password($passwordString){
		return md5(md5($passwordString));
	}
	
	public static function setSessionData($sessionDataName, $sessionDataArray = [], $sessionToken = NULL){
		if($sessionToken != NULL){
			$_SESSION[$this->makeSHA1_MD5Password($sessionToken . $sessionDataName)] = $sessionDataArray;
		}else{
			$_SESSION[$this->makeSHA1_MD5Password($sessionDataName)] = $sessionDataArray;
		}		
	}
	
	
	public static function getSessionData($sessionDataName, $sessionToken = NULL){
		if($sessionToken != NULL && isset($_SESSION[$this->makeSHA1_MD5Password($sessionToken . $sessionDataName)])){
			return $_SESSION[$this->makeSHA1_MD5Password($sessionToken . $sessionDataName)];
		}else if($sessionToken == NULL && isset($_SESSION[$sessionDataName])){
			return $_SESSION[$this->makeSHA1_MD5Password($sessionDataName)];
		}else{
			return [];
		}
		
	}
	
	public static function clearSessionData($sessionDataName, $sessionToken = NULL){
		if($sessionToken != NULL && isset($_SESSION[$this->makeSHA1_MD5Password($sessionToken . $sessionDataName)])){
			unset($_SESSION[$this->makeSHA1_MD5Password($sessionToken . $sessionDataName)]);
		}else if($sessionToken == NULL && isset($_SESSION[$sessionDataName])){
			unset($_SESSION[$this->makeSHA1_MD5Password($sessionDataName)]);
		}		
	}
	
	
	
	public static function setCookies($cookieDataName, $cookieDataArray = [], $cookieToken = NULL, $httpOnly = false){
		$httpOnlyStatus = ($httpOnly == false)? $httpOnly : true;
		if($cookieToken != NULL){
			setcookie($this->makeMD5Password($cookieToken . $cookieDataName), $cookieDataArray, time()+86400, '/', $_SERVER['HTTP_HOST'], $httpOnlyStatus, true);			
		}else{
			setcookie($this->makeMD5Password($cookieDataName), $cookieDataArray,  time()+86400, '/', $_SERVER['HTTP_HOST'], $httpOnlyStatus, true);			
		}
	}
	
	public static function getCookies($cookieDataName,  $cookieToken = NULL){		
		if($cookieToken != NULL && isset($_COOKIE[$this->makeSHA1_MD5Password($cookieToken . $cookieDataName)])){
			return $_COOKIE[$this->makeMD5Password($cookieToken . $cookieDataName)];
		}else if($cookieToken == NULL && isset($_COOKIE[$this->makeMD5Password($cookieDataName)])){
			return $_COOKIE[$this->makeMD5Password($cookieDataName)];
		}
	}
	
	public static function clearCookies($cookieDataName,  $cookieToken = NULL){		
		if($cookieToken != NULL && isset($_COOKIE[$this->makeMD5Password($cookieToken . $cookieDataName)])){
			setcookie($this->makeMD5Password($cookieToken . $cookieDataName), "", time() - 3600);
		}else if($cookieToken == NULL && isset($_COOKIE[$this->makeMD5Password($cookieDataName)])){
			setcookie($this->makeMD5Password($cookieDataName), "", time() - 3600);
		}
	}
	
	public static function generateRandomCharacter(){
		
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
	
	
	public  static function debuggSession($sessionDataName, $sessionToken = NULL){
		if($sessionToken != NULL  &&  isset($_SESSION[$this->makeSHA1_MD5Password($sessionToken . $sessionDataName)])){
			echo '<pre>';
			print_r($_SESSION[$this->makeSHA1_MD5Password($sessionToken . $sessionDataName)]);
			echo '</pre>';
			
		}else if($sessionToken == NULL  &&  isset($_SESSION[$this->makeSHA1_MD5Password($sessionDataName)])){
			echo '<pre>';
			print_r($_SESSION[$this->makeSHA1_MD5Password($sessionDataName)]);
			echo '</pre>';			
		}else{
			echo '<pre>';
			print_r([]);
			echo '</pre>';
		}
	}
	
	public static function debuggArray($array = []){
		echo '<pre>';
		print_r($array);
		echo '</pre>';
	}
	
	public static function debugArray($array = []){
		self::debuggArray($array);
	}
	
	public static function debug_array($array = []){
		self::debuggArray($array);
	}
	
	
	public static function sendMail($email, $fullname, $subject, $mail_content, $alt_content = ''){
		
		//Create a new PHPMailer instance		
		$mail = new PHPMailer();		

		if( preg_match( "/yahoo/", $email ) || preg_match( "/ymail/", $email ) || preg_match( "/outlook/", $email ) ){
			
			//Tell PHPMailer to use SMTP
			$mail->isSMTP();
			//Enable SMTP debugging
			// 0 = off (for production use)
			// 1 = client messages
			// 2 = client and server messages
			$mail->SMTPDebug 	= 0;
			//Ask for HTML-friendly debug output
			$mail->Debugoutput 	= 'html';
			//Set the hostname of the mail server
			$mail->Host 		= config('mail_host');;
			//Set the SMTP port number - likely to be 25, 465 or 587
			$mail->Port 		= config('mail_port');
			//Whether to use SMTP authentication
			$mail->SMTPAuth 	= true;
			//Username to use for SMTP authentication
			$mail->Username 	= config('support_mail');
			//Password to use for SMTP authentication
			$mail->Password 	= config('support_mail_password');	
		
		}
		
		//Set who the message is t be sent from
		$mail->setFrom( config('support_mail'), config('company_name'));		
		//Set who the message is to be sent to
		$mail->addAddress($email, $fullname);		
		//Set the subject line
		$mail->isHTML(true);
		$mail->Subject 	= $subject;
		$mail->Body 	= $mail_content;
		$mail->AltBody 	= $alt_content != '' ? $alt_content : 'Use mordern browser or email client to view this mail accurately.';
		if(!$mail->send()){
			echo $mail->ErrorInfo;
			return false;
		}
		//send the message, check for errors
		
		return true;
		
		
	}
	
	
	
	public static function sendCopiedMails($email, $fullname, $subject, $mail_content, $otherReceivers = [], $alt_content = ""){
		
		//Create a new PHPMailer instance		
		$mail = new PHPMailer();		

		if( preg_match( "/yahoo/", $email ) || preg_match( "/ymail/", $email ) || preg_match( "/outlook/", $email ) ){
			
			//Tell PHPMailer to use SMTP
			$mail->isSMTP();
			//Enable SMTP debugging
			// 0 = off (for production use)
			// 1 = client messages
			// 2 = client and server messages
			$mail->SMTPDebug 	= 0;
			//Ask for HTML-friendly debug output
			$mail->Debugoutput 	= 'html';
			//Set the hostname of the mail server
			$mail->Host 		=  config('mail_host');;
			//Set the SMTP port number - likely to be 25, 465 or 587
			$mail->Port 		=  config('mail_port');
			//Whether to use SMTP authentication
			$mail->SMTPAuth 	= true;
			//Username to use for SMTP authentication
			$mail->Username 	= config('support_mail');
			//Password to use for SMTP authentication
			$mail->Password 	= config('support_mail_password');	
		
		}
		
		//Set who the message is t be sent from
		$mail->setFrom( config('support_mail'), config('company_name') );		
		//Set who the message is to be sent to
		$mail->addAddress($email, $fullname);
		if(is_array($otherReceivers) && $otherReceivers != null){
			foreach($otherReceivers as $receiver){
				$mail->addCC($receiver['email'], $receiver['fullname']);
			}
		}
		//Set the subject line
		$mail->isHTML(true);
		$mail->Subject 	= $subject;
		$mail->Body 	= $mail_content;
		$mail->AltBody 	= $alt_content != '' ? $alt_content : 'Use mordern browser or email client to view this mail accurately.';
		if(!$mail->send()){
			echo $mail->ErrorInfo;
			return false;
		}
		//send the message, check for errors
		
		return true;
		
		
	}
	
	
	public static function sendBlindMails($email, $fullname, $subject, $mail_content, $otherReceivers = []){
		
		//Create a new PHPMailer instance		
		$mail = new PHPMailer();		

		if( preg_match( "/yahoo/", $email ) || preg_match( "/ymail/", $email ) || preg_match( "/outlook/", $email ) ){
			
			//Tell PHPMailer to use SMTP
			$mail->isSMTP();
			//Enable SMTP debugging
			// 0 = off (for production use)
			// 1 = client messages
			// 2 = client and server messages
			$mail->SMTPDebug 	= 0;
			//Ask for HTML-friendly debug output
			$mail->Debugoutput 	= 'html';
			//Set the hostname of the mail server
			$mail->Host 		= config('mail_host');;
			//Set the SMTP port number - likely to be 25, 465 or 587
			$mail->Port 		= config('mail_port');
			//Whether to use SMTP authentication
			$mail->SMTPAuth 	= true;
			//Username to use for SMTP authentication
			$mail->Username 	= config('support_mail');
			//Password to use for SMTP authentication
			$mail->Password 	= config('support_mail_password');	
		
		}
		
		//Set who the message is t be sent from
		$mail->setFrom( config( 'support_mail' ), config( 'company_name' ) );		
		//Set who the message is to be sent to
		$mail->addAddress($email, $fullname);
		if(is_array($otherReceivers) && $otherReceivers != null){
			foreach($otherReceivers as $receiver){
				$mail->addBCC($receiver['email'], $receiver['fullname']);
			}
		}
		//Set the subject line
		$mail->isHTML(true);
		$mail->Subject 	= $subject;
		$mail->Body 	= $mail_content;
		$mail->AltBody 	= $alt_content != '' ? $alt_content : 'Use mordern browser or email client to view this mail accurately.';
		if(!$mail->send()){
			echo $mail->ErrorInfo;
			return false;
		}
		//send the message, check for errors
		
		return true;
		
		
	}
	
	
	
	public static function initConfigData(){			
		self::$configData = getConfigData()	;
	}
	
	public static function getConfigData($index){
		if(!isset(self::$configData[$index])){
			self::$configData = getConfigData()	;
		}	
		$data = isset(self::$configData[$index]) ? self::$configData[$index] : '';
		return $data;
	}
	
	public static function getArticleRefererData(){
		$refererUrl = '';
		
		if(isset($_SERVER['HTTP_REFERER'])){
			$refererData =  explode('/', str_replace('http://', '', str_replace('https://', '', rtrim($_SERVER['HTTP_REFERER'], '/'))));
			if(count($refererData) > 2 || count($refererData) == 4){
				$refererUrl = $refererData[2] . '/' . $refererData[3] . '/';
			}else if(count($refererData) > 2  && count($refererData) < 4){
				$refererUrl = '/';
			}else if(count($refererData) > 2){
				$refererUrl = $refererData[2] . '/';
			}			
		}
		
		return $refererUrl;
	}
	
	public static function validateUser(){
		if(count(getSession('user')) < 1){
			header('location:/');
		}
	}
	
	public static function getUserIp(){		
		$ipaddress = '';
		if (getenv('HTTP_CLIENT_IP'))
			$ipaddress = getenv('HTTP_CLIENT_IP');
		else if(getenv('HTTP_X_FORWARDED_FOR'))
			$ipaddress = getenv('HTTP_X_FORWARDED_FOR');
		else if(getenv('HTTP_X_FORWARDED'))
			$ipaddress = getenv('HTTP_X_FORWARDED');
		else if(getenv('HTTP_FORWARDED_FOR'))
			$ipaddress = getenv('HTTP_FORWARDED_FOR');
		else if(getenv('HTTP_FORWARDED'))
		   $ipaddress = getenv('HTTP_FORWARDED');
		else if(getenv('REMOTE_ADDR'))
			$ipaddress = getenv('REMOTE_ADDR');
		else
			$ipaddress = 'UNKNOWN';
		return $ipaddress;

	}
	
	public static function getIpStack($apiKey, $userIp = ''){
		$ip = $userIp != '' ? $userIp : self::getUserIp();
		$url = 'http://api.ipstack.com/' . $ip . '?access_key=' . $apiKey . '&output=json';
		if($_SERVER['REQUEST_SCHEME'] == 'https'){
			$url = 'https://api.ipstack.com/' . $ip . '?access_key=' . $apiKey . '&output=json';
		}
		
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		$response = curl_exec($ch);
		
		if($response){
			$output = json_decode($response);
			curl_close($ch);
			// echo $output->ip;
			return $output;
		}else{
			$response =  [
				'city' 			=> '',
				'region_code' 	=> '',
				'region_name' 	=> '',
				'country_code' 	=> '',
				'country_name' 	=> '',
				'continent_code'=> '',
				'continent_name'=> '',
				'latitude' 		=> '',
				'longitude' 	=> '',
				'location' 		=> ['calling_code' => '', 'country_flag' => '', 'currency_code' => ''],			
				'currency' 		=> ['currency_code' => '']
			];
			
			return json_decode(json_encode($response));
		}
	}
	
	public static function getFutureDaysCount($days = 3, $period = 'days'){
		return date('Y-m-d', strtotime(date('Y-m-d') . ' ' . $days . ' ' . $period));	
	}
	
	public static function getDateText($date){
		return date( 'jS M y', strtotime(date('Y-m-d H:i:s')));	
	}
	
	public static function getYearDifference($latestYear, $olderYear){
		$diff	= abs(strtotime($latestYear) - strtotime($olderYear));
		$year 	= floor($diff / (365 * 60 * 60 * 24));
		$month 	= floor(($diff - $year * 365 * 60 * 60 * 24) / (365 * 60 * 60 * 24));
		$days 	= floor(($diff - $year * 365 * 60 * 60 * 24 - $month * 30 * 60 * 60 * 24) / (60 * 60 * 24));
		
		return $year ;
	}
	
	public static function debug_class($className){
		self::debuggArray(get_class_methods($className));
	}
	
	public static function convertNumberToMonthName($number){
		return date("F", mktime(0, 0, 0, $number, 10));
	}
	
	public static function getMonthDiff($olderDate, $latestDate = ''){
		$date1 	= $olderDate;	
		$date2 	= $latestDate == '' ? date('Y-m-d') : $latestDate;
		$ts1 	= strtotime($date1);
		$ts2 	= strtotime($date2);
		$year1 	= date('Y', $ts1);
		$year2 	= date('Y', $ts2);
		$month1 = date('m', $ts1);
		$month2 = date('m', $ts2);
		$diff = (($year2 - $year1) * 12) + ($month2 - $month1);

		return $diff;
	}
	
	public static function getDateFromDatetime($datetime){
		$dateData = getdate($datetime);
		return $dateData['weekday'] . ' ' . $dateData['month'] . ' ' . $dateData['mday'] . ' ' . $dateData['year'];
	}
	
	public static function getDayFromDatetime($datetime){
		$dateData = explode(" ", $datetime);
		return $dateData[0];
	}
	
	public static function getPrincipal($amount, $interestRate){
		$principal = ($loan_repayments[$i]['amount'] * 100) /  ($interestRate + 100);
		return $principal;
	}
	
	
	public static function getInterest($amount, $interestRate){
		$principal = self::getPrincipal($amount, $interestRate);
		$interest  = ($principal * $interestRate) / 100;
	}
	
	public static function createPrivileges($privileges = [], $coopId = ''){
		for($i = 0; $i < count($privileges); $i++){
	
			$remarks 		= ucfirst(str_replace("-", " ", $privileges[$i]));
			$privilegeLabel = ucwords(str_replace("-", " ", $privileges[$i]));
			if(!Tables::get('privileged_page_links')->entryExistsByColumns([ 'coop_id' => 1, 'link_url' =>  $privileges[$i] ])){
				$priv_data = [
					'coop_id' 		=> $coopId,
					'link_name' 	=> $privileges[$i],
					'parent_label' 	=> '',
					'link_label' 	=> $privilegeLabel,
					'link_url' 		=> $privileges[$i],
					'remarks' 		=> $remarks,
					'active_status' => 1,
				];
				Tables::get('privileged_page_links')->postEntry($priv_data);
			}
			
		}
	}
	
	public static function setMonthName($monthNumber){
		return date('F', mktime(0, 0, 0, $monthNumber, 10));
	}
	
	
	public static function addDaysToDate($date, $number = 1, $days_weeks_or_months = 'days'){		
		return date('Y-m-d H:i:s', strtotime($date . ' + ' . $number . ' ' . $days_weeks_or_months));		
	}
	
	
	public static function substractDaysToDate($date, $number = 1, $days_weeks_or_months = 'days'){		
		return date('Y-m-d H:i:s', strtotime($date . ' - ' . $number . ' ' . $days_weeks_or_months));		
	}
	
	public static function getMonthLastDay($curr_date = ''){
		$currDate = $curr_date != '' ? $curr_date : date('Y-m-d');
		$lastDate = explode('-', date('Y-m-t', strtotime($currDate)));
		return $lastDate[2];
	}
	
	public static function substractDate($previous_date, $most_recent_data = ""){
		
		$leftDate = $most_recent_data;
		if($most_recent_data == ""){
			$leftDate = date("Y-m-d");
		}
		
		$date1 = date_create($leftDate);
		$date2 = date_create($previous_date);
		
		$diff = date_diff($date2, $date1);
		return $diff->format("%a");
		
	}
	
	public static function getlowerCaseLetters(){
		return [
			'a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'l', 'm', 'n', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z'
		];
	}
	
	public static function getCapitalCaseLetters(){
		$data = [];
		$lowerCaseLetter = self::getlowerCaseLetters();
		for($i = 0; $i < count($lowerCaseLetter); $i++){
			$data[] = strtoupper($lowerCaseLetter[$i]);
		}
		
		return $data;
	}
	
	
	public static function isValidPhoneNumber($phone){
         // Allow +, - and . in phone number
        $filtered_phone_number = filter_var($phone, FILTER_SANITIZE_NUMBER_INT);
        // Remove "-" from number
        $phone_to_check = str_replace("-", "", $filtered_phone_number);
    
        // Check the lenght of number
        // This can be customized if you want phone number from a specific country
        if (strlen($phone_to_check) < 10 || strlen($phone_to_check) > 14) {
            return false;
        } 
           
        return true;        
    }
	
	public static function mergeIndexedArray($array1, $array2){
		$newArray = [];
		for($i = 0; $i < count($array1); $i++){
			if(!in_array($array1[$i], $newArray)){
				$newArray[] = $array1[$i];
			}
		}
		
		for($i = 0; $i < count($array2); $i++){
			if(!in_array($array2[$i], $newArray)){
				$newArray[] = $array2[$i];
			}
		}
		
		return $newArray;
		
	}
	
	 /**
	  * decrypt AES 256
	  *
	  * @param data $edata
	  * @param string $password
	  * @return decrypted data
	  */
	  
	public static function AESDecrypt($edata, $password) {
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

	/**
	 * crypt AES 256
	 *
	 * @param data $data
	 * @param string $password
	 * @return base64 encrypted data
	 */
	public static function AESEncrypt($data, $password) {
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
	
	public static function getPageParams($index){
		if(isset(Nobler::$params[$index])){
			return Nobler::$params[$index];
		}
		return "";
	}
	
	
		
	
}


?>