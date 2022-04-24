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
			
			if( $settings->validate_post_with_token && !isset( $_POST['_token'] ) ){
				http_response_code( 419 );
				die( '_token field is not set.' );
			}
			
			if( $settings->validate_post_with_token && isset( $_POST['_token'] ) && $_POST['_token'] != $this->getSessionToken() ){
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
	
	
	public static function getSessionToken(){
		return '';
	}

		
	
}



?>