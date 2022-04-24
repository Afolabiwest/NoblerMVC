<?php

class Forms{
	
	
	public static $guard; 
	public static $errors 			= []; 
	public static $tableSqls 			= []; 
	public static $tableSqlErrorCount 	= 0;
	public static $response 			= [
			'status' => 'not-ok',
			'message' => 'No action performed',
	];
	
	public static function validateAjaxRequest(){		
		if(!self::is_ajax()){			
			echo '<script> window.location.href = "' . $_SERVER['HTTP_REFERER'] . '"; </script>'; 
			die();
		}		
	}
	
	public static  function is_ajax(){
	  return isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest';
	}
	
		
	public static function getEntryRef($targetTable, $prefix = 'REF'){
		$ref = '100001';
		if(Tables::get($targetTable)->getEntriesCount() > 0){			
			$lastRef 	 = Tables::get($targetTable)->getLastEntry(['ref'], [], [ 'ref' => ""]);		
			if(isset($lastRef['ref'])){
				$lastRefData = explode("-", $lastRef['ref']);
				if($lastRef['ref'] != ""){
					$nextRef =  count($lastRefData) > 1 ? $lastRefData[1] + 1 : $lastRefData[0] + 1;
					$ref =  $nextRef ;
					
				}
			}		
		}
		
		return $prefix . "-" . $ref;
		
	}
	
	public static function createFriendlyUrl($url_str){
		return strtolower(str_replace(" ", "-", $url_str));
	}
	
	public static function emptyRequiredFields( $requiredFieldsArray = [] ){
		$emptyFieldsCount = 0;
		for($i = 0; $i < count( $requiredFieldsArray ); $i++){			
			if( post( $requiredFieldsArray[$i] ) == "" ){
				$emptyFieldsCount++;
			}
		}
		return $emptyFieldsCount > 0;
	}
	
	
	public static function userExist( $tablename, $email ){
		return Tables::get( $tablename )->getEntriesCountByColumns([
			'email' => $email
		]) > 0;
		
	}
	
	public static function runTableSetups(){
		for( $i = 0; $i < count( self::$tableSqls ); $i++ ){
			if( !Tables::query( self::$tableSqls[$i] ) ){
				self::$tableSqlErrorCount++;
			}
		}
		return self::$tableSqlErrorCount < 1;
	}
	
	
	public static function beepJsonResponse( $responseData = [] ){
		echo json_encode($responseData);
	}
	
	public static function getPageParams($index){
		if( isset( Nobler::$params[$index] ) ){
			return Nobler::$params[$index];
		}
		return "";
	}
	
	
	public static function validateImageResolution($imageIndex, $expectedSizeRatio = 1){
		
		if(isset($_FILES[$imageIndex]['name'])){
			$imageData = getimagesize($_FILES[$imageIndex]['tmp_name']);
			if($imageData[0] / $imageData[1] != $expectedSizeRatio){
				return false;
			}			
			return true;			
		}		
		return false;
		
	}
	
	
	
	public static function validate( $fields = [], $customMsgs = [] )
	{
		$errors = [];
		foreach( $fields as $k => $v )
		{
			$checks = explode("|", $v);
			for( $i = 0; $i < count( $checks ); $i++ ){
				
				if ( $checks[$i] == 'required' && isset( $_POST[$k] ) ){
					if( $_POST[$k] == "" ){
						if( !isset( $customMsgs[ $k . '.required' ] ) ){
							$errors[] = $k . " field is required.";
						}else{
							$errors[] = $customMsgs[ $k . '.' .$checks[$i] ];
						}						
					}
				}
				
				if ( $checks[$i] == 'email' && isset( $_POST[$k] ) ){
					if( !preg_match( '/( [a-zA-Z0-9\.]+ )@( [a-zA-Z0-9]+ )\.( [a-z]+ )/', $_POST[$k] ) ){
						if( !isset( $customMsgs[ $k . '.required' ] ) ){
							$errors[] = $k . " must be an email.";
						}else{
							$errors[] = $customMsgs[ $k . '.' .$checks[$i] ];
						}
					}
				}
				
				if ( $checks[$i] == 'phone' && isset( $_POST[$k] ) ){
					if( !is_numeric( $_POST[$k] ) or strlen( $_POST[$k] ) > 10 ){
						if( !isset( $customMsgs[ $k . '.required'  ] ) ){
							$errors[] = $k . " must be a phone number.";
						}else{
							$errors[] = $customMsgs[ $k . '.' .$checks[$i] ];
						}
					}
				}
				
				if ( $checks[$i] == 'number' && isset( $_POST[$k] ) ){
					if( !is_numeric( $_POST[$k] ) ){						
						if( !isset( $customMsgs[ $k . '.required' ] ) ){
							$errors[] = $k . " must be a number.";
						}else{
							$errors[] = $customMsgs[ $k . '.' .$checks[$i] ];
						}
					}
				}
				
				
				
				if ( ( $checks[$i] == 'text' || $checks[$i] == 'string' ) && isset( $_POST[$k] ) ){
					if( is_string( $_POST[$k] ) ){						
						if( !isset( $customMsgs[ $k . '.required' ] ) ){
							$errors[] = $k . " must be a string.";
						}else{
							$errors[] = $customMsgs[ $k . '.' .$checks[$i] ];							
						}
					}
				}

				if( isset( $_POST[$k] ) && preg_match( '/:/', $checks[$i] )){
					
					$checkFunc = explode( ":", $checks[$i] );
					
					if ( $checkFunc[0] == 'exists'  ){
						
						if( Forms::exists( $k, $_POST[$k], $checkFunc[1] ) ){
							
							if( !isset( $customMsgs[ $k . '.' . $checkFunc[0] ] )){
								$errors[] = $k . " value already exists in our records.";
							}else{
								$errors[] = $customMsgs[ $k . '.' . $checkFunc[0] ];							
							}
						}else{
							
						}
					}

					
					if ( $checkFunc[0] == 'not_exists' or $checkFunc[0] == '!exists'  ){
						
						if( !Forms::exists( $k, $_POST[$k], $checkFunc[1] ) ){
							
							if( !isset( $customMsgs[ $k . '.' . $checkFunc[0] ] )){
								$errors[] = $k . " value already exists in our records.";
							}else{
								$errors[] = $customMsgs[ $k . '.' . $checkFunc[0] ];							
							}
						}else{
							
						}
					}
					
					
					if ( $checkFunc[0] == 'password_not_match' or $checkFunc[0] == '!password_match' ){
						if( isset( $_POST['email'] ) && Forms::password_match( $_POST['email'], $_POST[$k], $checkFunc[1] ) ){						
							if( !isset( $customMsgs[ $k . '.password_not_match' ] ) ){								
								$errors[] = $k . " password already used previously.";
							}else{
								$errors[] = $customMsgs[ $k . '.' . $checkFunc[0] ];
							}
						}
					}
					
					if ( $checkFunc[0] == 'password_match' ){
						if( isset( $_POST['email'] ) && !Forms::password_match( $_POST['email'], $_POST[$k], $checkFunc[1] ) ){						
							if( !isset( $customMsgs[ $k . '.password_match' ] ) ){
								$errors[] = $k . " password mismatch.";
								
							}else{
								$errors[] = $customMsgs[ $k . '.' . $checkFunc[0] ];
							}
						}
					}
					
					
					
				}				
				
				if ( !isset( $_POST[$k] ) ){
					$errors[] = "Technical issue: index " . $k . " is not set.";
				} 
				
			}
		}
		
		self::$errors = $errors;
		
		return count( $errors ) < 1;
		
	}
	
	public static function json( $data = [] ){
		return json_encode( $data );
	}
	
	
	public static function errors( $cursor = '' ){
		
		$error = "";
		if( $cursor == 'first' ){
			return self::$errors[0];
		}
		
		if( $cursor == 'last' ){
			return end(self::$errors);
		}
		
		if( is_numeric($cursor) ){
			return isset( self::$errors[$cursor] ) ? self::$errors[$cursor]: self::$errors;
		}
		return self::$errors;
		
	}
	
	
	public static function exists( $key,  $value, $table ){
		return Tables::get( $table )->entryExistsByColumns( [
			$key => $value
		] );
	}
	
	public static function password_match( $email, $password, $table ){
		$passworddata = Tables::get( $table )->getEntryColumnsByColumns( [ 'password' ], [
			'email' => $email
		] );
		
		if( isset( $passworddata['password'] ) ){
			return password_verify( $password, $passworddata['password'] );
		}		
		return false;	
	}
	
	public static function generateRef( $table ){
		
		$result = Tables::query( "SELECT MAX(ref) AS ref FROM " . $table );		
		$result = $result[0]['ref'];
		if( $result == '' ){
			return 100001;
		}
		
		return $result + 1;
		
	}
	
	public static function guard( $guard ){
		self::$guard = $guard;
		return new self;	
	}
	
	
	public static function attempt_login( $extra_login_data = [], $redirectUrl = '' ){
		
		$auth_guards = require_once( dirname( dirname( dirname( __FILE__ ) ) ) . '/config/auth-guards.php' );		
		$guard  	 = '';
		$guardKeys 	= [];
		$guardKeys 	= array_keys( $auth_guards[ 'guards' ] );
		if( self::$guard  != null ){
			$guard  = $auth_guards[ 'guards' ][ self::$guard ];
			
		}else{
			
			$guard  = $auth_guards[ 'guards' ][ $guardKeys[0] ];
			
		}
		
		
		$validate = self::validate([
			'email' 	=> 'required|not_exists:' . $guard['table'],
			'password' 	=> 'required|password_match:' . $guard['table']
		],[
			'email.required' 	=> 'Enter email address.',
			'email.not_exists' 	=> 'Account does not exists in our records.',
			'password.required' => 'Enter account password.',
			'password.password_match' => 'Incorrect Password.',
		]);
		
		if( !$validate ){
			echo self::json( [
				'status'  		=> 'not-ok',
				'message' 		=> self::errors( 'first' ),
				
			] );
			return;
			
		}else{	
			
			$loginData = [
				'email' 	=> post('email'),
				'password' 	=> post('password'),
			]; 
			
			$loginData =  array_merge( $loginData, $extra_login_data );		
			
			if( Authentication::guard( self::$guard )->login( $loginData ) ){
				echo self::json( [
					'status'  		=> 'ok',
					'message' 		=> 'Login successful.',
					'redirect_url' 	=> $redirectUrl,
				] );
				return true;
			}
			
		}
		
		echo self::json( [
			'status'  		=> 'not-ok',
			'message' 		=> 'Something went wrong. Make sure your account is activated.',
			'redirect_url' 	=> $redirectUrl,
		] );
		
		return false;
		
	}
	
	
	public static function response( $data ){
		if( is_string( $data ) ){
			echo  $data;
			
		}else if( is_array( $data )){
			echo json_encode($data);
		}
		echo "{}";
	}
	
	
	
	public static function logout( $guard = '', $redirectUrl = '/' ){
		if( $guard != '' ){
			Authentication::guard( 'parent' )->logout( $redirectUrl );	 
		}else{
			Authentication::logout( $redirectUrl );	 
		}			
	}
	
	
	public static function getMeetingDateString( $datetime )
	{
		
		$date 	= new DateTime( $datetime );
		$result = $date->format('l jS \of F Y h:i:s A');
		return $result;
		
	} 
	
	
	
	
}


?>