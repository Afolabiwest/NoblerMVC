<?php
# Authentication::guard( 'admin' )->validate();

class Authentication{
	
	public static $guard;	
	public static $user 			= [];	
	public static $errors 			= [];	
	public static $excludedMethods 	= [];	
	public static function getInstance(){
		return new Authentication;
	}
	
	public static function guard( $guard ){		
		self::$guard 	= $guard;
		return new self;		
	}
	
	public static function exclude( $excludedMethods 	= [] ){		
		self::$excludedMethods 	= $excludedMethods;
		return new self;		
	}
	
	public static function validate( $callback = '',  $redirectUrl = "/" ){
		
		$func_args 	= func_get_args(); 
		
		if( $callback != '' && self::is_closure( $func_args[0] ) ){
			call_user_func( $func_args[0] );
		}
		
		if( !self::is_excluded() ){
		
			$auth_guards 	 = require_once( dirname( dirname( dirname( __FILE__ ) ) ) . '/config/auth-guards.php' );	
			$userSessionData = getSession( $auth_guards[ 'session_key' ] );		
			$validated 		 = 0;

			$guardKeys 		 = [];
			$guardKeys 		 = array_keys( $auth_guards[ 'guards' ] );
			if( self::$guard  != null ){
				$sessionGuard  = $auth_guards[ 'guards' ][ self::$guard ];			
			}else{			
				$sessionGuard  = $auth_guards[ 'guards' ][ $guardKeys[0] ];			
			}	
			
			if( self::$guard ){
				$userSessionData = getSession( $auth_guards[ 'session_key' ], self::$guard );		
			}
			
			if( $userSessionData != null && isset( $userSessionData->guard ) ){			
				if( Tables::get( $sessionGuard['table'] )->entryExistsByColumns( [
					'email' 	=> $userSessionData->email,
					'password' 	=> $userSessionData->password
				] ) ){
					$validated = 1;				
					if( $userSessionData->guard != self::$guard && $_SERVER['REQUEST_URI'] != $redirectUrl ){
						header( "location:" . $redirectUrl );
					}				
				}			
			}else{
				header( "location:" . $redirectUrl );
			}
			
			
			if( !self::verifyUser( $userSessionData->email, $userSessionData->password, $auth_guards ) ){				
				header( "location:" . $redirectUrl );			
			} 		
			
			if( self::$guard != null && isset( $userSessionData->guard ) && $userSessionData->guard != self::$guard && $_SERVER['REQUEST_URI'] != $redirectUrl ){			
				header( "location:" . $redirectUrl );
			}	

		}else{
			#	echo '<br>Excluded!<br>';
		}	
		
		
	}
	
	
	public static function login( $loginData = [] ){
		
		$auth_guards 	 	= require( dirname( dirname( dirname( __FILE__ ) ) ) . '/config/auth-guards.php' );
		$passwordVerified 	= false;
		$validated 			= false;
		$userData 			= [];
		
		$guardKeys 	= [];
		$guardKeys 	= array_keys( $auth_guards[ 'guards' ] );
		if( self::$guard  != null ){
			$sessionGuard  = $auth_guards[ 'guards' ][ self::$guard ];			
		}else{			
			$sessionGuard  = $auth_guards[ 'guards' ][ $guardKeys[0] ];			
		}	
				
		if( $loginData != [] && isset( $loginData['password'] ) ){			
			$checkData = [];
			foreach( $loginData as $k => $v ){
				if( $k != 'password' ){
					$checkData[$k] = $v;
				}				
			}
			
			if( Tables::get( $sessionGuard['table'] )->entryExistsByColumns( $checkData ) ){
				$userData = Tables::get( $sessionGuard['table'] )->getEntryByColumns( $checkData );
				if( $userData != null ){
					$passwordVerified = password_verify( $loginData['password'], $userData['password'] );
				}else{
					self::$errors[] = 'Something is wrong with the account detail.';
				}				
				
			}else{
				self::$errors[] = 'Account does not exist.';				
			}			
			
		}else{
			self::$errors[] = 'Enter your password.';
		}
		
		if( $passwordVerified && $userData ){
			if( self::$guard  != null ){
				$userData['guard'] = self::$guard;			
				setSession( $auth_guards[ 'session_key' ] . '-' . self::$guard, $userData );
			}else{							
				setSession( $auth_guards[ 'session_key' ], $userData );
			}
			
			self::$user = getSession( $auth_guards[ 'session_key' ] );
			$validated 	= true;
			
		}else{
			self::$errors[] = 'Wrong password.';
			
		}
		
		return $validated;
		
	}
	
	public static function getUserSession( $guard = '' ){
		
		$auth_guards 	= require( dirname( dirname( dirname( __FILE__ ) ) ) . '/config/auth-guards.php' );		
		if( $guard != '' ){
			$user = getSession( $auth_guards[ 'session_key' ] . '-' . $guard );
			if( $user ){
				return (object) $user;			
			}
			
		}else{
			return (object) getSession( $auth_guards[ 'session_key' ] );
		}

		return '';	
		
	}
	
	public static function user( $guard = '' )
	{		
		return getUserSession( $guard );		
	}
	
	
	public static function logout( $redirectUrl = '/' ){
		
		$auth_guards 	= require( dirname( dirname( dirname( __FILE__ ) ) ) . '/config/auth-guards.php' );
		if( self::$guard  != null ){
			$user = getSession( $auth_guards[ 'session_key' ] . '-' . self::$guard );
			if( $user ){
				clearSession( $auth_guards[ 'session_key' ] . '-' . self::$guard );
				#	header( 'location:' . $redirectUrl );
				#	header( 'location:' . $redirectUrl );
				echo "<script>location.href = '" + $redirectUrl + "'; </script>";
				return;
			}
			
		}
		
		clearSession( $auth_guards[ 'session_key' ] );
		#	header( 'location:' . $redirectUrl );
		
		echo "<script>location.href = '" . $redirectUrl . "'; </script>";
		
	}
	
	
	
	public static function verifyUser( $email, $password, $guard = [] ){
		
		$auth_guards 	 	= $guard != [] ? $guard : require_once( dirname( dirname( dirname( __FILE__ ) ) ) . '/config/auth-guards.php' );	
		$passwordVerified 	= false;
		$validated 			= false;
		$userData 			= [];

		$guardKeys 	= [];
		$guardKeys 	= array_keys( $auth_guards[ 'guards' ] );
		if( self::$guard  != null ){
			$sessionGuard  = $auth_guards[ 'guards' ][ self::$guard ];			
		}else{			
			$sessionGuard  = $auth_guards[ 'guards' ][ $guardKeys[0] ];			
		}	

		
		
		if( Tables::get( $sessionGuard['table'] )->entryExistsByColumns( [ 'email' => $email ] ) ){			
			$userData = Tables::get( $sessionGuard['table'] )->getEntryByColumns( [ 'email' => $email ] );			
			if( count($userData) > 0 ){					
				return  $password == $userData['password'];
			}		
		}
		
		return false;
		
	}
	
	
	public static function is_excluded(){
		$routes = Route::$routes;
		$isExcluded = false;
		for( $i = 0; $i < count( $routes ); $i++ ){			
			$ctrl 		= $routes[$i]['controller'];
			$ctrlData 	= explode( '@', $routes[$i]['controller']);
			$class 		= $ctrlData[0];
			$mthd 		= $ctrlData[1];
			if( in_array( Nobler::$activeMethod, self::$excludedMethods ) && method_exists( $class, Nobler::$activeMethod ) ){
				$isExcluded = true; 
				break;
			}
		}		
		
		return $isExcluded;
		
	}
	
	
	
	
	
	public static function is_closure( $t )
	{
		return $t instanceof \Closure;
	}
	
	
}


?>