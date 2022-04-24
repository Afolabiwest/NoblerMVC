<?php

//	namespace App\Nobler;

$middlewares = include_once('../app/config/middlewares.php');



class Controller{
	
	public $request;
	public $route;
	
	
	protected function middleware( $callback ='' )
	{
		global $middlewares;
		if($callback != '' && is_callable( $callback ) ){
			call_user_func( $callback );			
		}		
		
		if($callback != '' && is_string( $callback ) ){
			if( isset( $middlewares[ $callback ] ) ){
				new $middlewares[ $callback ]();
			}			
		}
		
		
		
	}
	
	public function createTables( $sqlFIle = '' )
	{
		if( $sqlFIle != '' ){
			$sqls = include( dirname( dirname( dirname( __DIR__ ) ) ) ) . DIRECTORY_SEPARATOR . $sqlFIle;
			$i = 1;
			foreach( $sqls as $k => $sql ){			
				if( Tables::query( $sqls[ $k ] ) ){
					echo "{$i}. Table '{$k}' Successfully created<br>";
					$i++;
				}
			}
		}
		
		exit;
		
	}
	
}


?>