<?php

#namespace App\Nobler;

class Route{
	
	public static $routes 			= [];
	public static $routeArgs 		= [];
	public static $routeArgsIndexes = [];
	public static function add( $basepath, $controller ){
		
		$path_argv = $basepath ? explode( "/", trim( $basepath, "/" ) ) : [];
		$routeData = [
			'basepath' 		=> $basepath,
			'controller' 	=> $controller,
			'path_argv' 	=> $path_argv,
			'path_argc' 	=> count( $path_argv )
		];
		
		self::$routes[] = $routeData;
		return new self;
		
	}
	
	public static function name( $route_name ){
		
		$lastEntryIndex = self::getLastEntryIndex();
		
		self::$routes[ $lastEntryIndex ][ 'name' ] = $route_name;
		return new self;
		
	}
	
	public static function middleware( $middleware ){		
		
		$lastEntryIndex = self::getLastEntryIndex();
		self::$routes[ $lastEntryIndex ][ 'middleware' ] = $middleware;
		return new self;
		
		#return count( self::$routes ) - 1;		
	}
	
	public static function getLastEntryIndex(){
		$lastIndex =  count( self::$routes ) - 1;
		return $lastIndex;
	}
	
	
	public static function setRoutePathArgsv( $routeData ){
		
		if( isset( $routeData['path_argv ']) ){
			
			dd( $routeData );	
			$path_argv = $routeData[ 'path_argv' ];	
			for( $i = 0; $i < count( $path_argv ); $i++ ){
				if( preg_match( '/\{[a-zA-Z0-9]\}/', $path_argv[$i] ) ){
					self::$routeArgs[]  	= rtrim( ltrim( $path_argv[$i], '{'), '}');				
				}
			}
			
		}
		
		
	}
	
	public static function setRoutePathArgsIndexes( $routeData ){
		
		$path_argv = $routeData[ 'path_argv' ];	
		for( $i = 0; $i < count( $path_argv ); $i++ ){
			if( preg_match( '/\{[a-zA-Z0-9]\}/', $path_argv[$i] ) ){
				self::$routeArgsIndexes[]  = $i;
			}
		}	
		
	}
	
	
	public static function getRoutePathArgsv( $routeData ){	
	
		self::setRoutePathArgsv( $routeData );
		return self::$routeArgs;
		
	}
	
	public static function getRoutePathArgsIndexes( $routeData ){
		
		self::setRoutePathArgsIndexes( $routeData );
		return self::$routeArgsIndexes;
		
	}
	
	
	
}



?>