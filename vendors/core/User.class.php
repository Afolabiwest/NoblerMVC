<?php


class User extends Forms{
	
	public static $table = "";
	public static $userData = "";
	public static $isLoggedIn = false;
	public static $response = [];
	
	public static function login($email, $hash_password){
		
		self::$response = [
			'status' 	=> 'not-ok',
			'message' 	=> 'No action performed!',
		];
		
		if($email == "" or $hash_password == ""){
			self::$response = [
				'status' 	=> 'not-ok',
				'message' 	=> 'Make sure you enter your email and password.',
			];
			
		}elseif(!Tables::get(self::$table)->entryExistsByColumns([ 'email' => $email ])){
			self::$response = [
				'status' 	=> 'not-ok',
				'message' 	=> 'Account does not exists. Try to create account.',
			];
			
		}elseif(!Tables::get(self::$table)->entryExistsByColumns([ 'email' => $email, 'password' => $hash_password  ])){
			self::$response = [
				'status' 	=> 'not-ok',
				'message' 	=> 'Incorrect password.',
			];
			
		}elseif(!Tables::get(self::$table)->entryExistsByColumns([ 'email' => $email, 'password' => $hash_password, 'active_status' => 1 ])){
			self::$response = [
				'status' 	=> 'not-ok',
				'message' 	=> 'Your account is not active. Please, contact the admin for help',
			];
			
		
		}else{
			self::$userData = Tables::get(self::$table)->getEntryByColumns([
				'email' 	=> $email, 
				'password' 	=> $hash_password
			]);
			
			setSession("user", self::$userData);
			
			self::$response = [
				'status' => 'ok',
				'message' => 'Successfully logged in!',
			];
			
			self::$isLoggedIn = true;
			
		}
		
		#	Tools::beepJSON($response);
		
		
	}
	
	public static function logout(){
		clearSession("user");
	}
	
	public static function verify(){
		$user = getSession("user");
		if($user != "" && is_array($user)){
			return Tables::get(self::$table)->entryExistByColumns([
				'email' 	=> $user['email'],
				'password' 	=> $user['password'],
			]); 
		}
		
		return false;
	}
	
	public static function getData(){
		$user 	= getSession("user");
		if($user != "" && is_array($user)){
			if(Tables::get(self::$table)->entryExistByColumns([
				'email' 	=> $user['email'],
				'password' 	=> $user['password'],
			])){
				return Tables::get(self::$table)->getEntryByColumns([
					'email' 	=> $user['email'],
					'password' 	=> $user['password'],
				]);		
			}
		}
		
		return [];
	}
	
	
	public static function updateData($updateData = []){
		$user 	= getSession("user");
		if($user != "" && is_array($user)){
			if(Tables::get(self::$table)->entryExistByColumns([
				'email' 	=> $user['email'],
				'password' 	=> $user['password'],
			])){
				return Tables::get(self::$table)->updateEntryByColumns($updateData, [
					'id' => $user['id']
				]);		
			}
		}
		
		return false;
	}
	
	public static function setTable($tableName){
		self::$table = $tableName;
	}
	
	public static function postPasswordResetData($target_table = ""){
		
		$table = self::$table;
		if($target_table != ""){
			$table = $target_table;
		}		
		
		self::validateAjaxRequest();
		$userData 		 = getSession('user');
		$currentPassword = post('old-password');
		$password 		 = post('password');
		$confirmPassword = post('confirm-password');
		
		
		$response = [
			'status' 	=> 'not-ok',
			'message' 	=> 'No action performed.',
		];
		
		if($currentPassword == '' || $password == '' || $confirmPassword == ''){
			
			$response = [
				'status' 	=> 'not-ok',
				'message' 	=> 'Complete all fields. xx',
				'dara' 	=> $currentPassword,
			];
		
		}else if(!Tables::get($table)->entryExistByColumns(['email' => $userData['email'],  'password' => Utilities::encrypt_password($currentPassword)])){
			
			$response = [
				'status' 	=> 'not-ok',
				'message' 	=> 'Current Password not correct.',
			];
		
		}else if($password != $confirmPassword){
			
			$response = [
				'status' 	=> 'not-ok',
				'message' 	=> 'Password not matched.',
			];
		
		}else if($password == $currentPassword){
			
			$response = [
				'status' 	=> 'not-ok',
				'message' 	=> 'You can\'t used the same password as your current password.',
			];
		
		}else{
			
			if(Tables::get($table)->updateEntryById($userData['id'], ['password' => Utilities::encrypt_password($password)])){
				$response = [
					'status' 	=> 'ok',
					'message' 	=> 'Password reset successful.',
				];
				
				$userData['password'] = Utilities::encrypt_password($password);
				
				setSession("user", $userData);
				
			}else{
				$response = [
					'status' 	=> 'not-ok',
					'message' 	=> 'Something went wrong.',
				];
			}
		}
		
		Tools::beepJSON($response);
		
	}
	
		
	public static function postPasswordResetRequest(){
		$response = [
			'status' => 'not-ok',
			'message' => 'No action performed',
		];
		$email 		= post('email');
		$userData 	= self::getUserDataByEmail($email);
		if(!$email){
			
			$response = [
				'status' => 'not-ok',
				'message' => 'Enter your email address',
			];
			
		}else if(!self::memberExistCheck($email)){
			
			$response = [
				'status' 	=> 'not-ok',
				'message' 	=> 'Account does not exist.',
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
				
				$mailContent = fetch($userData, 'mail/user-password-reset-request-mail.html');
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
		
		Tools::beepJSON($response);
		
	}
	
	
	
	
}


?>