<?php
class Users extends Forms{
	public static $tablename = 'admin', $firstname, $gender, $lastname, $email, $password, $passwordConfirm, $hashPass, $hashStr, $response;
	public static $userLoginData 	= [], $postedUserData = [];
	public static $loginStatus 		= false; 
	
	
	public static function login($callback = ''){		
		$responseData = [];	
		$responseData['status'] = 'not-ok';
		$responseData['message'] = 'No action performed.';		
		if(self::is_ajax()){			
			self::$email 		= post('email');			
			self::$password 	= post('password');	
			self::$hashPass 	= Utilities::encript_password(self::$password);	
			
		}else{			
			echo '<script> window.location.href = "/"; </script>'; 
		}
		
		
		if(self::emptyFieldsCheck()){
			
			if($callback != ''){				
				call_user_func($callback, $responseData);				
			}
			
			$responseData['status'] 	= 'not-ok';
			$responseData['message'] 	= 'Complete all fields as highlighted.';
			$responseData['user'] 		= [];
			
		}else if(!self::memberExistCheck()){
			
			if($callback != ''){				
				call_user_func($callback, $responseData);				
			}
			
			$responseData['status'] 	= 'not-ok';
			$responseData['message'] 	= 'Account does not exist in VacSpace record.';
			$responseData['user'] 		= [];
			
		}else if(!self::checkAccountAcivated()){
			 
			if($callback != ''){				
				call_user_func($callback, $responseData);				
			}
			
			$responseData['status'] 	= 'not-ok';
			$responseData['message'] 	= 'Your account has not been activated or disabled. Please, contact the Admin.';
			$responseData['user'] 		= [];
			
		}else if(!self::checkIfPasswordCorrect()){
			
			if($callback != ''){				
				call_user_func($callback, $responseData);				
			}
			
			$responseData['status'] 	= 'not-ok';
			$responseData['message'] 	= 'Wrong password.';
			$responseData['user'] 		= [];
			
		}else{
			
			self::$loginStatus = true;
			
			if($callback != ''){
				
				self::saveUserSession();
				$responseData['user'] 		=  getSession('user');				
				$responseData['status'] 	= 'ok';
				$responseData['message'] 	= 'Login successful! Redirecting ...';				
				call_user_func($callback, $responseData);
				
			}else{
				
				self::saveUserSession();
				$responseData['user'] 		=  getSession('user');				
				$responseData['status'] 	= 'ok';
				$responseData['message'] 	= 'Login successful! Redirecting ...';				
				
			}
			
		}	

		self::$response = $responseData;
		
	}
	
	public static function setRequiredUserPostData($key, $value, $required = false){
		self::$postedData[$key]['value'] 	= $value;
		self::$postedData[$key]['required'] = $required;
	}
	
	public static function createUserAccount($postedData = [], $targetTableName = 'admin', $subject, $mail_content, $redirectUrl = '/account-creation-status/'){
		$response = '';
		echo $response;
	}
	
	public static function uploadPhotograph($userId, $fileIndex, $uploadFolderPath, $targetTableName, $redirectUrl = '/'){
		$response = "";
		if(self::memberExistCheckById($userId)){
			if(!FileUpload::fileIsUploaded($fileIndex)){
				$response = Utilities::message("Please browse for your photograph to continue.");
			
			}else if(!FileUpload::validateFileExtension($fileIndex, ['jpeg', 'jpg', 'png', 'gif'])){
				$response = Utilities::message("Wrong photograph file type. Please, make sure it is either of '.jpeg', '.jpg', '.png' or '.gif' files.");
				
			}else if(!FileUpload::validateFileSize($fileIndex, (2000 * 1024))){
				$response = Utilities::message("Too large file. Please, make sure it is not larger that 2Mb.");
				    
			}else{
				
				$x 			= post('x'); 
				$y 			= post('y');  
				$width 		= post('width');  
				$height 	= post('height');  
				$cont_w 	= post('container-width'); 
				$cont_h 	= post('container-height'); 
			
				$filename 	= hash('crc32', time()) . '_' . date('YmdHis') . '.jpg';
				
				if(FileUpload::uploadFile($fileIndex, $uploadFolderPath, $filename)){
					FileUpload::cropImage($uploadFolderPath . $filename, $x, $y, $width, $height, $cont_w);
					self::updateUserPhotographIndex($userId, $filename, $targetTableName);
					
					$response = Utilities::message("Photograph successfully uploaded.", 'success');
					$response .= '<script>window.setTimeout(function(){window.location.href = "' . $redirectUrl . '";}, 3000);</script>';
				}
			}
		}
		
		echo $response;
	}
	
	public static function updateUserPhotographIndex($userId, $photoname, $table){
		PDO_DB::update("UPDATE " . $table . " SET photo = ? WHERE id = ? LIMIT 1", [$photoname, $userId]);
	}
	
	public  static  function emptyFieldsCheck(){
		if(!self::$email || !self::$password){			
			return true;
		}else{
			return false;		
		}
	}
	
	public  static  function emptyNewAccountFields(){
		if(!self::$firstname || !self::$email || !self::$password || !self::$passwordConfirm){			
			return true;
		}else{
			return false;		
		}
	}
	
	public  static  function emptyFieldExists(){
		$emptyFieldCount = 0;
		if(self::$postedUserData != null || count(self::$postedUserData) > 0){
			foreach(self::$postedUserData as $k => $v){
				if(self::$postedUserData[$k]['required']){
					$emptyFieldCount++;
					break;
				}
			}
		}
		
		return $emptyFieldCount > 0;
	}
	
	public  static  function passwordMatched(){
		return self::$postedData['confirm-password']  == self::$postedData['password'];		
	}
	
	
	public static  function memberExistCheck($email = ''){
		$email = $email != '' ? $email : self::$email;
		$result = PDO_DB::getDataCount(self::$tablename, [ 'email' => $email]);
		
		return $result > 0;
	}
	
	public static  function memberExistCheckById($id){		
		$result = PDO_DB::getDataCount(self::$tablename, ['id' =>  $id]);
		return $result > 0;
	}
	
	public static  function checkIfPasswordCorrect($email = ''){
		$email = $email = '' ? $email : self::$email;		
		$result = PDO_DB::getDataCount(self::$tablename, ['email' => $email, 'password' => self::$hashPass]);
		return $result > 0;
	}

	
	public static  function checkAccountAcivated($email = ''){
		$email = $email != '' ? $email : self::$email;
		$result = PDO_DB::getDataCount(self::$tablename, ['email' => $email, 'active_status' => 1]);
		return $result > 0;
	}
	
	
	public static  function verifyUser(){
		$memberDataArray = [];		
		$result = PDO_DB::select("SELECT * FROM " . self::$tablename . " WHERE  email = ? AND password = ? AND active_status = '1' LIMIT 1", [self::$email, self::$hashPass]);
		$result[0]['logged_in'] = count($result) > 0 ? true : false;
		setSession('user', $result[0]);
	}
	
	public static  function saveUserSession(){
		$memberDataArray = [];
		
		$result = PDO_DB::select("SELECT * FROM " . self::$tablename . " WHERE email = ? AND password = ? AND active_status = '1' LIMIT 1", [self::$email, self::$hashPass]);
		$result[0]['logged_in'] = count($result) > 0 ? true : false;		
		setSession('user', $result[0]);
		self::$userLoginData = $result[0];
	}
	
	
	public static  function redirectIfNotAjax(){
		if(!self::is_ajax()){
			echo '<script> window.location.href = "/"; </script>'; 
		}
	}
	
	public static  function is_ajax(){
	  return isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest';
	}
	
	public  static function logOut($sesname='user', $redirectUrl = '/'){
		clearSession($sesname);
		echo '<script> window.location.href = "' . $redirectUrl . '"; </script>';
	}
	
	public  static function login_home($sesname='user', $redirectUrl = '/home/'){
		$data = getSession($sesname);
		$sesData = is_array($data)? $data : [];			
		if(count($sesData) > 0){
			echo count(getSession($sesname));
			echo '<script> window.location.href = "' . $redirectUrl . '"; </script>';
		}
		
		
	}
	
	public static function resetPassword($tablename = 'admin'){
		
		if(!self::is_ajax()){						
			die();
		}
		$userData = getSession('user');
		$response = [
			'status' 	=> 'not-ok',
			'message' 	=> 'No action performed'
		];
		
		$currentPassword 	= post('current-password');
		$password 			= post('new-password');
		$confPassword 		= post('confirm-password');
		
		if($password == '' || $confPassword == '' || $currentPassword == ''){
			$response = [
				'status' 	=> 'not-ok',
				'message' 	=> 'Complete all fields',
				'type' 		=> 'complete-all-fields'
			];
		
		}else if(!Tables::get($tablename)->entryExistsByColumns([ 'email' => $userData['email'], 'password' => Utilities::encript_password($currentPassword) ])){
			$response = [
				'status' 	=> 'not-ok',
				'message' 	=> 'Wrong current password',
				'type' 		=> 'wrong-current-password'
			];
			
		}else if($password != $confPassword){
			$response = [
				'status' 	=> 'not-ok',
				'message' 	=> 'Passwords not match',
				'type' 		=> 'passwords-not-match'
			];
		
			
		}else{
			$hashpass = Utilities::encript_password($password);
			$userData['password'] = $hashpass;
			
			setSession("user", $userData);
			
			if(Tables::get($tablename)->updateEntryByColumns([
				'password' => $hashpass
			], [
				'id' 	=> $userData['id'],
				'email' => $userData['email']
			])){
				$response = [
					'status' 	=> 'ok',
					'message' 	=> 'Password reset successful',
					'type' 		=> 'something-went-wrong'
				];
			}else{
				
				$response = [
					'status' 	=> 'not-ok',
					'message' 	=> 'Something went wrong',
					'type' 		=> 'something-went-wrong'
				];
				
			}
		
		}
		
		echo json_encode($response);
		
	}
	
	
	public static function postPasswordResetRequest($setup){
		$response = [
			'status' => 'not-ok',
			'message' => 'No action performed',
		];
		$email 	= post('email');
		$userData = self::getUserDataByEmail($email);
		if(!$email){
			
			$response = [
				'status' => 'not-ok',
				'message' => 'Enter your email address',
			];
			
		}else if(!self::memberExistCheck($email)){
			
			$response = [
				'status' => 'not-ok',
				'message' => 'Account does not exist.',
			];
			
		}else{
			
			$password 					= hash('crc32', time());
			$hashpass 					= Utilities::encrypt_password($password);
			$userData['new_password'] 	= $password;
			$userData['email'] 			= $email;
			$userData['subject'] 		= 'Password Reset Request Successful!';
			
			if(Tables::get(self::$tablename)->updateEntryByColumns([
				'password' => $hashpass
			], [
				'email' => $email
			])){
					
				$setup->assign('page_data', $userData);
				
				$mailContent = $setup->fetch('mail/user-password-reset-request-mail.html');
				Utilities::sendMail($email, $userData['firstname'] . ' ' . $userData['lastname'], $userData['subject'], $mailContent);			
				
				$response = [
					'status' => 'ok',
					'message' => 'Password Reset Request successfully effected. Please, check your mail in 5 minutes for the new auto-generated password. Make sure you reset your password during next login.',
				];
				
				$response['user-data'] = $userData;
			
				
			}else{
				$response = [
					'status' => 'not-ok',
					'message' => 'Something went wrong',
				];
				
			}
			
		}
		
		return $response;
	}
	
	public static function getTableName(){
		return self::$tablename;
	}
	
	public static function validateUser(){
		if(!is_array(getSession('user'))  || count(getSession('user')) < 1){
			header('location:/');
		}
	}
	
	public static function getUserDataByEmail($email){
		if(self::memberExistCheck($email)){
			return Tables::get(self::$tablename)->getEntryByColumns([
				'email' => $email
			]);
		}
		return [];
	}
	
	public static function postNewsletterSubscription($tablename = 'newsletter_subscribers'){
		$response = [
			'status' 	=> 'not-ok',
			'message' 	=> 'No action performed'
		];
		
		$email = post('email');
		if(!$email){
			
			$response = [
				'status' 	=> 'not-ok',
				'message' 	=> 'Enter your email address!'
			];
			
		}else if(self::newsletterSubscriberExists($email, $tablename)){
			if(Tables::get($tablename)->updateEntryByColumns([
				'active_status' => 1
			], [
				'email' => $email
			])){
				
				$response = [
					'status' 	=> 'ok',
					'message' 	=> 'You have been successfully re-subscribed!'
				];
			}
			
			
		}else{			
			
			if(Tables::get($tablename)->postEntry([
				'email' 		=> $email, 
				'active_status' => 1
			])){
				
				$response = [
					'status' 	=> 'ok',
					'message' 	=> 'You have been successfully subscribed!'
				];
			}else{
				$response = [
					'status' 	=> 'not-ok',
					'message' 	=> 'Something went wrong!'
				];
			}
			
			return $response;
			
		}
		
	}
	
	public static function newsletterSubscriberExists($email, $tablename = 'newsletter_subscribers'){		
		$result = PDO_DB::getDataCount($tablename, ['email' => $email]);
		return $result > 0;		
	}
	
	
	
}



?>
