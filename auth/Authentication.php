<?php
namespace App\Auth;

class Authentication{
	public static $guard;
	public function handle()
	{
		//	echo "This is System  Authentication middleware. <br> ";		
		//	Authentication::guard( 'admin' )->validate();		
	}
	
	public static function getInstance(){
		return new Authentication;
	}
	
	public static function guard( $guard ){		
		self::$guard 	= $guard;
		return new self;		
	}
	
	public static function validate(){
		
		$auth_guards 		= require_once( dirname( dirname( __FILE__ ) ) . '/config/auth-guards.php' );	
		$userSessionData 	= getSession( $auth_guards[ 'session_key' ] );		
		$sessionGuard 		= $auth_guards[ 'guards' ][ self::$guard ];
		
		if( Tables::get( $sessionGuard['table'] )->entryExistsByColumns( [
			'email' 	=> $userSessionData['email'],
			'password' 	=> $userSessionData['password']
		] ) ){
			return true;
		}
		
		return false;
		
	}
	
	
}


?>