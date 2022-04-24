<?php
#namespace App\Nobler;
$settings = include_once('../app/config/settings.php');

class Request{
	
	public $path_argv 	= [];	
	public $path_argc 	= 0;
	public $request 	= 0;

	public function __construct()
	{
		global $settings;
		$requestUri = $_SERVER[ 'REQUEST_URI' ] ;
		$this->path_argv = explode( "/", trim( $requestUri, "/" ) );
		$this->path_argc = count( $this->path_argv );
		
		if( $_SERVER['REQUEST_METHOD'] == 'POST' ){
			/* 
			if(  ( $settings->validate_post_with_token && !isset( $_POST['_token'] ) ) or  ( $settings->validate_post_with_token && !isset( $_POST['csrf-token'] )) ){
				http_response_code( 419 );
				die( '"_token" or "csrf-token" field is not set.' );
			} 
			*/
			
			/* 
			if( ( $settings->validate_post_with_token && isset( $_POST['_token'] ) && $_POST['_token'] != Request::getSessionToken() ) or ( $settings->validate_post_with_token && isset( $_POST['csrf-token'] ) && $_POST['csrf-token'] != Request::getSessionToken() ) ){
				http_response_code( 419 );
				die( 'Session already expired. Token mismatch.' );
			} 
			*/
			
			if( $settings->validate_post_with_token && !isset( $_POST['csrf-token'] ) ){
				http_response_code( 419 );
				die( '"_token" or "csrf-token" field is not set.' );
			}		
			
			
			if( ( $settings->validate_post_with_token && isset( $_POST['csrf-token'] ) ) && $_POST['csrf-token'] != Request::getSessionToken()  ){
				http_response_code( 419 );
				die( 'Session already expired. Token mismatch.' );
			}
			
			$this->request = (object) [];
			foreach( $_POST as $k => $v )
			{
				$this->request->$k = htmlspecialchars( $v );				
			}	
			
		}
		
		if( $_SERVER['REQUEST_METHOD'] == 'GET' ){
			$this->request = (object) [];
			foreach( $_GET as $k => $v )
			{
				$this->request->$k = urlencode( htmlspecialchars( $v ) );				
			}			
		}
		

		
	}
	
	public function getPathArgv( $path_argv )
	{		
		return Request::get_path_argv( $path_argv );			
	}
	
	public static function get_path_argv( $path_argv )
	{		
		$pathArgs 		= []; 
		$path_argv_array = $_SERVER['REQUEST_URI'] ? explode( "/", trim( $_SERVER['REQUEST_URI'], "/" ) ) : [];		
		for( $i= 0 ; $i < count( $path_argv ); $i++  ){
			$k = $path_argv[$i];
			if( preg_match( '/{[a-z-A-Z0-9]+}/', $k ) ){
				$key = str_replace( [ "{", "}" ], "", $k ) ;
				$pathArgs[$key] = $path_argv_array[$i];
			}				
		}
		
		return $pathArgs;
			
	}	
	
	
	public static function getSessionToken(){
		return getSession( 'csrf' );
	}

		
	
}



?>