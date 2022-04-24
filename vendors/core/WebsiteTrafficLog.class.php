<?php 
class WebsiteTrafficLog extends DBcon{
	
	public $con, $test, $browser,$pageViewed, $browserDesc;	
	public function __construct(){
		$this->con 				= $this->connect();		
		if(!isset($_SERVER['REQUEST_URI'])){
			$this->pageViewed 		= 'Home';
		}else{
			$pageViewedArray 		= explode('/', trim($_SERVER['REQUEST_URI'], '/')); 
			$this->userIp 			= $this->getUserIp();
			$this->pageViewed 		= str_replace('-', ' ', $_SERVER['REQUEST_URI']) == '/' ? 'Home': trim(str_replace('-', ' ', $_SERVER['REQUEST_URI']), '/');
		}
		
		$this->browser 			= $this->getBrowser();
		$this->browserDesc		= $this->browser['name'] . "<strong> Version</strong> " . $this->browser['version'] . " on " .$this->browser['platform'];	
		$this->referer 			= isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : 'http://' . $_SERVER['HTTP_HOST'];				
	}
	
	public function logUserVisit(){
		if($this->checkUserIpExists()){
			if(!$this->checkIsToday() && !$this->ifPageIsAlreadyVisitedToday()){
				//Log user visit
				$this->recordVisitData(true);
			}
			
		}else{
			//Log user visit
			$this->recordVisitData(false);
			$this->recordUniqueVisitData();
		}
		
	}
	
	public function checkIsToday(){
		$queryResult = array();
		$query = $this->con->query("SELECT date FROM non_unique_visitors WHERE visitor_ip = '" . $this->userIp . "' AND page_viewed = '" . $this->pageViewed . "' LIMIT 1");
		if($query){
			$queryResult = $query->fetch_row();
			$todaysDate = date('Y-m-d');
			if($this->setTodaysDate($queryResult[0])  == $todaysDate){
				return true;
			}else{
				return false;	
			}
		}else{
			$this->printMysqlError();	
		}
		
	}
	
	public function checkUserIpExists(){
		$queryResult = array();
		$query = $this->con->query("SELECT COUNT(id) FROM non_unique_visitors WHERE visitor_ip = '" . $this->userIp . "' LIMIT 1");
		if($query){
			$queryResult = $query->fetch_row();
			if($queryResult[0] > 0){
				return true;
			}else{
				return false;	
			}
			
		}else{
			$this->printMysqlError();	
		}
		
	}
	
	
	
	public function pageIsAlreadyVisitedToday(){
		$query = $this->con->query("SELECT id, page_viewed, date FROM non_unique_visitors WHERE visitor_ip = '" . $this->userIp . "' AND page_viewed = '" . $this->pageViewed . "' ORDER BY id DESC LIMIT 1");
		if($query){
			while($rows = $query->fetch_array(MYSQLI_ASSOC)){
				
				if($rows['page_viewed'] == $this->pageViewed && $this->setTodaysDate($rows['date']) == date('Y-m-d')){
					return true;
				}else{
					return false;	
				}
			}
			
		}else{
			$this->printMysqlError();	
			return false;
		}
	}
	
	public function setTodaysDate($todaysDate){
		$todaysDateArray = explode(' ', $todaysDate);
		$todaysDate = $todaysDateArray[0];
		return $todaysDate;
	}
	public function recordVisitData($returningVisit = false){
		$remarks = '';
		if($returningVisit == false){
			$remarks = 'First Visit';
		}else{
			$remarks = 'Returned Visit';
		}
		
		$query = $this->con->query("INSERT INTO non_unique_visitors(visitor_ip, page_viewed, description, referer, remarks, active_status, week, month, year, date)VALUES('" . $this->userIp . "', '" . $this->pageViewed  . "', '" . $this->browserDesc . "', '" . $this->referer . "', '" . $remarks . "', '1', '" . date('W') . "', '" . date('M') . "', '" . date('Y') . "', now())");
		if($query){
			return true;
		}else{
			$this->printMysqlError();
			return false;
		}
	}
	
	public function recordUniqueVisitData(){
		$query = $this->con->query("INSERT INTO unique_visitors(visitor_ip, page_viewed, description, referer, remarks, active_status, week, month, year, date)VALUES('" . $this->userIp . "', '" . $this->pageViewed  . "', '" . $this->browserDesc . "', '" . $this->referer . "', 'First Visit', '1', '" . date('W') . "', '" . date('M') . "', '" . date('Y') . "', now())");
		if($query){
			return true;
		}else{
			$this->printMysqlError();
			return false;
		}
	}
	
	//This method returns array
	public function getStartAndEndDate($week, $year){	
		$time 		= strtotime("1 January $year", time());
		$day 		= date('w', $time);
		$time 		+= ((7*$week)+1-$day)*24*3600;
		$return[0] 	= date('Y-n-j', $time);
		$time 		+= 6*24*3600;
		$return[1] 	= date('Y-n-j', $time);
		return $return;
	}
	
	
	public function getBrowser(){
		$ub 		= "";
		$u_agent 	= isset($_SERVER['HTTP_USER_AGENT'])? $_SERVER['HTTP_USER_AGENT'] : 'Not defined'; 
		$bname 		= 'Unknown';
		$platform 	= 'Unknown';
		$version	= "";
	
		//First get the platform?
		if (preg_match('/linux/i', $u_agent)) {
			$platform = 'linux';
		}
		elseif (preg_match('/macintosh|mac os x/i', $u_agent)) {
			$platform = 'mac';
		}
		elseif (preg_match('/windows|win32/i', $u_agent)) {
			$platform = 'windows';
		}
		
		// Next get the name of the useragent yes seperately and for good reason
		if((preg_match('/MSIE/i',$u_agent) && !preg_match('/Opera/i',$u_agent)) || preg_match('/edge/i',$u_agent)) 
		{ 
			$bname = 'Internet Explorer'; 
			$ub = "MSIE"; 
		} 
		elseif(preg_match('/Firefox/i',$u_agent)) 
		{ 
			$bname = 'Mozilla Firefox'; 
			$ub = "Firefox"; 
		} 
		elseif(preg_match('/Chrome/i',$u_agent)) 
		{ 
			$bname = 'Google Chrome'; 
			$ub = "Chrome"; 
		} 
		elseif(preg_match('/Safari/i',$u_agent)) 
		{ 
			$bname = 'Apple Safari'; 
			$ub = "Safari"; 
		} 
		elseif(preg_match('/iPhone/i',$u_agent)) 
		{ 
			$bname = 'Apple iPhone'; 
			$ub = "iPhone"; 
		}
		elseif(preg_match('/webOS/i',$u_agent)) 
		{ 
			$bname = 'LG WebOS'; 
			$ub = "webOS"; 
		}
		elseif(preg_match('/iPad/i',$u_agent)) 
		{ 
			$bname = 'Apple iPad'; 
			$ub = "Apple iPad"; 
		}
		elseif(preg_match('/android/i',$u_agent)) 
		{ 
			$bname = 'Apple Safari'; 
			$ub = "Apple Safari"; 
		}
		elseif(preg_match('/android/i',$u_agent)) 
		{ 
			$bname = 'Google Android'; 
			$ub = "Android"; 
		}
		elseif(preg_match('/Opera/i',$u_agent)) 
		{ 
			$bname = 'Opera'; 
			$ub = "Opera"; 
		} 
		elseif(preg_match('/Netscape/i',$u_agent)) 
		{ 
			$bname = 'Netscape'; 
			$ub = "Netscape"; 
		} 
		
		// finally get the correct version number
		$known = array('Version', $ub, 'other');
		$pattern = '#(?<browser>' . join('|', $known) . ')[/ ]+(?<version>[0-9.|a-zA-Z.]*)#';
		if (!preg_match_all($pattern, $u_agent, $matches)) {
			// we have no matching number just continue
		}
		
		// see how many we have
		// $i = count($matches['browser']);
		if (is_array($matches['browser']) && count($matches['browser']) > 1 ) {
			//we will have two since we are not using 'other' argument yet
			//see if version is before or after the name
			if (strripos($u_agent,"Version") < strripos($u_agent,$ub)){
				$version= $matches['version'][0];
			}
			else {
				$version= $matches['version'][1];
			}
		}
		else {
			$version= $matches['version'][0];
		}
		
		// check if we have a number
		if ($version==null || $version=="") {$version="?";}
		
		return array(
			'userAgent' => $u_agent,
			'name'      => $bname,
			'version'   => $version,
			'platform'  => $platform,
			'pattern'    => $pattern
		);
	}
	
	private function getUserIp(){
		if(isset($_SERVER['HTTP_CF_CONNECTING_IP'])){
			$_SERVER['REMOTE_ADDR'] 	= $_SERVER['HTTP_CF_CONNECTING_IP'];
			$_SERVER['HTTP_CLIENT_IP'] 	= $_SERVER['HTTP_CF_CONNECTING_IP'];
		}
		$client 	= @$_SERVER['HTTP_CLIENT_IP'];
		$forward 	= @$_SERVER['HTTP_X_FORWARD_FOR'];
		$remote 	= @$_SERVER['REMOTE_ADDR'];
		$ip 		= '';
		if(filter_var($client, FILTER_VALIDATE_IP)){
			$ip = $client;
		}else if(filter_var($forward, FILTER_VALIDATE_IP)){
			$ip = $forward;
		}else {
			$ip = $remote;
		}
		return $ip;
	}

}




?>

















