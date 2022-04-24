<?php

#namespace App\Nobler;

class Route{
	
	
	public static $prefix, $suffix, $domain;
	public static $group 			= false;
	public static $routes 			= [];
	public static $routeArgs 		= [];
	public static $routeArgsIndexes = [];
	public static function add( $basepath, $controller ){
	
		$routePathArgv 	= self::getRouteBasepathArgv( $basepath );
		$path_argv 		= $routePathArgv[ 'path_argv' ];
		$base_path 		= $routePathArgv[ 'base_path' ];
		
		$routeData = [
			'basepath' 		=> $base_path,
			'controller' 	=> $controller,
			'path_argv' 	=> $path_argv,
			'path_argc' 	=> count( $path_argv ),
			'request_method'=> 'ANY',
		];
		
		$routeData['domain'] = self::$domain != null ? self::$domain : '';
		$routeData['prefix'] = self::$prefix != null ? self::$prefix : '';
		$routeData['suffix'] = self::$suffix != null ? self::$suffix : '';
		
		self::$routes[] = $routeData;
		return new self;
		
	}
	
	public static function post( $basepath, $controller ){
		
		$routePathArgv 	= self::getRouteBasepathArgv( $basepath );
		$path_argv 		= $routePathArgv[ 'path_argv' ];
		$base_path 		= $routePathArgv[ 'base_path' ];
		
		$routeData = [
			'basepath' 		=> $base_path,
			'controller' 	=> $controller,
			'path_argv' 	=> $path_argv,
			'path_argc' 	=> count( $path_argv ),
			'request_method' 	=> 'POST',
		];
		
		$routeData['domain'] = self::$domain != null ? self::$domain : '';
		$routeData['prefix'] = self::$prefix != null ? self::$prefix : '';
		$routeData['suffix'] = self::$suffix != null ? self::$suffix : '';
		
		self::$routes[] = $routeData;
		return new self;
		
	}
	
	public static function get( $basepath, $controller ){
		
		$routePathArgv 	= self::getRouteBasepathArgv( $basepath );
		$path_argv 		= $routePathArgv[ 'path_argv' ];
		$base_path 		= $routePathArgv[ 'base_path' ];
		
		$routeData = [
			'basepath' 		=> $base_path,
			'controller' 	=> $controller,
			'path_argv' 	=> $path_argv,
			'path_argc' 	=> count( $path_argv ),
			'request_method' 	=> 'GET',
		];
		
		$routeData['domain'] = self::$domain != null ? self::$domain : '';
		$routeData['prefix'] = self::$prefix != null ? self::$prefix : '';
		$routeData['suffix'] = self::$suffix != null ? self::$suffix : '';
		
		self::$routes[] = $routeData;
		return new self;
		
	}
	
	public static function put( $basepath, $controller ){
		
		$routePathArgv 	= self::getRouteBasepathArgv( $basepath );
		$path_argv 		= $routePathArgv[ 'path_argv' ];
		$base_path 		= $routePathArgv[ 'base_path' ];
		
		$routeData = [
			'basepath' 		=> $base_path,
			'controller' 	=> $controller,
			'path_argv' 	=> $path_argv,
			'path_argc' 	=> count( $path_argv ),
			'request_method' 	=> 'PUT',
		];
		
		$routeData['domain'] = self::$domain != null ? self::$domain : '';
		$routeData['prefix'] = self::$prefix != null ? self::$prefix : '';
		$routeData['suffix'] = self::$suffix != null ? self::$suffix : '';
		
		self::$routes[] = $routeData;
		return new self;
		
	}
	
	public static function delete( $basepath, $controller ){
		
		$routePathArgv 	= self::getRouteBasepathArgv( $basepath );
		$path_argv 		= $routePathArgv[ 'path_argv' ];
		$base_path 		= $routePathArgv[ 'base_path' ];
		
		$routeData = [
			'basepath' 		=> $base_path,
			'controller' 	=> $controller,
			'path_argv' 	=> $path_argv,
			'path_argc' 	=> count( $path_argv ),
			'request_method' 	=> 'DELETE',
		];
		
		$routeData['domain'] = self::$domain != null ? self::$domain : '';
		$routeData['prefix'] = self::$prefix != null ? self::$prefix : '';
		$routeData['suffix'] = self::$suffix != null ? self::$suffix : '';
		
		self::$routes[] = $routeData;
		return new self;
		
	}
	
	public static function getRouteBasepathArgv( $basepath ){
		
		$base_path = '';		
		if( self::$domain != null ){			
			if( self::$prefix != null ){
				$base_path .= self::$domain  . '/' . self::$prefix . $basepath;					
			}else{
				$base_path .= self::$domain  . $basepath;				
			}
			
			
		}else{
			if( self::$prefix != null ){
				$base_path .=  "/" . self::$prefix . $basepath;					
			}else{
				$base_path .=  $basepath;				
			}
			
		}
		
		
		
		if( self::$suffix != null ){
			$base_path .= self::$suffix . '/';			
		}
		
		
		if( self::$group ){
			// Yet to know what to do.
		}
		
		$parsed_base_path = parse_url( $base_path );		
		return [
			'path_argv' => $base_path ? explode( "/", trim( $parsed_base_path['path'], "/" ) ) : [],
			'base_path' => $base_path
		];
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
			
			#	dd( $routeData );	
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
	
	public static function group( $callback = '' )
	{		
		self::$group = true;
		if( $callback != '' ){
			call_user_func( $callback );
			self::$group = false;
		}
		return new self;		
	}
	
	
	public static function prefix( $prefixName, $callback = '' )
	{		
		self::$prefix = $prefixName != '' ? $prefixName : null;
		if( $prefixName != '' && $callback != '' ){
			call_user_func( $callback );
			self::$prefix = null;
		}
		return new self;		
	}
	
	
	public static function suffix( $suffixName = '', $callback = '' )
	{		
		self::$suffix = $suffixName != '' ? $suffixName : null;
		if( $suffixName != '' && $callback != '' ){
			call_user_func( $callback );
			self::$suffix = null;
		}
		return new self;		
	}
	
	public static function domain( $domainName, $callback = '' )
	{		
		self::$domain = $domainName;
		if( $callback != '' ){
			call_user_func( $callback );
			self::$domain = null;
		}
		return new self;		
	}
	
	
	
	
	
}



?>