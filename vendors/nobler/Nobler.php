<?php

include_once( dirname( dirname( __DIR__ ) ) . '/routes.php' );
$database 	 	= include_once( dirname( dirname( __DIR__ ) ) . '/config/database.php');
$middlewares 	= include_once( dirname( dirname( __DIR__ )) . '/config/middlewares.php' );
$settings 		= include_once( dirname( dirname( __DIR__ ) ) . '/config/settings.php' );
if( !defined( 'NOBLER_ROOT' ) ) 
	define( 'NOBLER_ROOT',  dirname( dirname( __DIR__ ) ) . DIRECTORY_SEPARATOR );

class Nobler
{
	public static $csrf, $base_url;
	public static $folders = []; 
	public static $filepaths = []; 
	public static $params  = [];
	public static $config 	= [];
	public static $currentRouteData 	= [];
	public static $routes 	= [];
	public static $env 		= 'env.conf';
	public static $activeMethod = '';
	public static $currentRequestURI = '';
	
	public $request;
	public $middlewares;
	public $user_middlewares;
	public $settings;
	
	public $routeData = [];
	
	public $responseCodes = [
		'200' => 'Request ok',
		'404' => 'Page not found',
		'301' => 'Page moved',
		'419' => 'Page expired',
		'500' => 'Server Error',
	];
	
	public function __construct()
	{
		if( getSession( 'csrf' ) == '' ){
			setCSRF();
		}
		
		self::$csrf =  getSession( 'csrf' );
		
		if( $_SERVER['REQUEST_METHOD'] == 'POST' ){			
			foreach( $_POST as $k => $v ){
				$this->cleanData( $_POST[ $k ] );
			}		
		}
		
		if( $_SERVER['REQUEST_METHOD'] == 'GET' ){			
			foreach( $_POST as $k => $v ){
				$this->cleanData( $_GET[ $k ] );
			}		
		}
		
		if($_SERVER['REQUEST_METHOD'] == 'POST' && self::$csrf != post('csrf-token') ){
			die('Request not allowed. Sensed some CSRF issue.');
		}
		
		
		#	dd(config());
		
		global $middlewares ;
		global $settings ;
		$this->middlewares 		= $middlewares['system'];
		$this->user_middlewares = $middlewares['user'];
		$this->settings 		= $settings;
		
		
		
		foreach( $this->middlewares as $k => $v ){
			$mw = new $v();			
			if( method_exists($mw, 'handle') ){
				$mw->handle();
			}			
		}
	
		$this->route 	= new Route();
		$this->request 	= new Request();
		
		
		$responseCodesKeys = array_keys( $this->responseCodes );		
		if( $_SERVER['REQUEST_METHOD'] == 'POST' ){	
			
			
			if( $settings->validate_post_with_token && !isset( $_POST['csrf-token'] ) ){
				http_response_code( 419 );
				die( '"_token" or "csrf-token" field is not set.' );
			}		
			
			
			if( ( $settings->validate_post_with_token && isset( $_POST['csrf-token'] ) ) && $_POST['csrf-token'] != Request::getSessionToken()  ){
				
				http_response_code( 419 );
				die( 'Session already expired. Token mismatch.' );
			}
			
			
		}
		
		
		if( !$this->matchFound( Route::$routes ) ){
			http_response_code( 404 );			
		}
		
		$responseCode = http_response_code();
		
		if( $responseCode != 200 ){		
			$this->displayErrorPage( $responseCode );		
		}
		
		$this->runController();		
		
	}
	
	public function matchFound( $routes )
	{
		$matchFound 	= false; 
		$routeIndex 	= 0;		
		foreach( $routes as $route ){			
			$matchedBasepath 	= $this->request->path_argv[0] == $route[ 'path_argv' ][0];
			$equalArgc 			= $this->request->path_argc == $route[ 'path_argc' ];
			
			if( $matchedBasepath && $equalArgc ){
				$this->routeData = Route::$routes[ $routeIndex ];				
				self::$routes	 = Route::$routes;				
				self::$currentRouteData = $this->routeData;				
				$matchFound = true;
				break;
			}			
			$routeIndex++;
			
		}
		
		return $matchFound;
		
	}
	
	
	
	public function runController()
	{		
		if( $this->routeData['request_method'] != 'ANY' && $_SERVER['REQUEST_METHOD'] != $this->routeData['request_method'] ){
			die( 'Illegal Access. Request method not allowed! This route requires "<strong>' . $this->routeData['request_method'] . '</strong>" method.' );
		}
		
		if( 0 < count( $this->routeData ) ){
			
			if( isset( $this->routeData[ 'middleware' ] ) ){
				if( is_callable( $this->routeData[ 'middleware' ] ) ){
					call_user_func( $this->routeData[ 'middleware' ] );
					
				}else{
					if( isset( $this->user_middlewares[ $this->routeData[ 'middleware' ] ] ) ){
						$mw = new $this->user_middlewares[ $this->routeData[ 'middleware' ] ]();			
						if( method_exists( $mw, 'handle' ) ){
							$mw->handle();
						}
					}
				}				
			}
			
			$controllerParts = explode( "@", $this->routeData['controller'] );
			if( !class_exists( $controllerParts[0] ) ){
				die( 'Controller "<strong>' . $controllerParts[0] . '</strong>" does not exist!' );
			}
			
			self::$activeMethod = $controllerParts[1];
			
			
			$pathArgs 		= []; 
			$path_argv 		= $this->routeData[ 'path_argv' ];
			$pathArgsArr 	= $this->request->getPathArgv( $path_argv );			
			Nobler::$params = $pathArgsArr;
			$var 			= $controllerParts[1];	
			
			
			if( method_exists( $controllerParts[0], $var ) ){
				$ctrlObj = new $controllerParts[0]();
				call_user_func_array( array( $ctrlObj, $controllerParts[1] ), $pathArgsArr );
			}else{
				die( 'Class(Controller) "<strong>' . $controllerParts[0] . '</strong>" does not contain method "<strong>' . $var . '</strong>"' );
			}
			
		}
		
	}
	
	
	
	public function displayErrorPage( $responseCode )
	{
		die( "Error {$responseCode} occurred!" );
		
		/* 
		switch( $responseCode ){
			case 500:
				// Do stuffs here
				break;
				
			case 404:
				// Do stuffs here
				break;
				
			case 301:
				// Do stuffs here
				break;
				
			case 419:
				// Do stuffs here
				break;
				
			default:	
			
		}	 
		*/
	}
	
	
	public static function route1( $routeName, $pathArgs = [] ){
		
		$routeData = self::$currentRouteData;
		self::$currentRouteData['current_request_uri'] = 'none';
		self::$currentRequestURI = '/';
		$path_argv = $routeData['path_argv'];
		
		
		
		for( $i = 0; $i < count( self::$routes ); $i++ ){
			if( self::$routes[$i]['name'] == $routeName ){
				$routeData = self::$routes[$i];
				break;	
			}	
		}
		
		for( $i = 0; $i < count( $path_argv ); $i++){
			if( preg_match( '/{[a-z-A-Z0-9]+}/', $path_argv[$i] ) ){
				$key = str_replace( [ "{", "}" ], "", $path_argv[$i] ) ;
				if( isset( $pathArgsArr[$key] ) ){
					self::$currentRequestURI .= $pathArgsArr[$key] . '/';
				}
			}else{
				self::$currentRequestURI .= $path_argv[$i] . '/';
			}
		}
		
		
		
		if( $routeData['name'] == $routeName ){
			self::$currentRouteData['current_request_uri'] = self::$currentRequestURI;
			return self::$currentRouteData['current_request_uri'];		
		}
			
		return "/"; 
		
	}
	
	
	public static function route( $routeName, $pathArgs = [] ){
		
		$routeData = self::$currentRouteData;
		self::$currentRequestURI = '';		
		
		for( $i = 0; $i < count( self::$routes ); $i++ ){
			if( self::$routes[$i]['name'] == $routeName ){
				$routeData = self::$routes[$i];
				break;	
			}	
		}
		
		self::$currentRouteData['current_request_uri'] = isset( $routeData['domain'] ) ? $routeData['domain'] : '' ;		
		$path_argv = $routeData['path_argv'];
		
		if( $pathArgs == [] or $pathArgs == null ){				
			$pathArgsArr 	= Request::get_path_argv( $path_argv );
			for( $i = 0; $i < count( $path_argv ); $i++){
				if( preg_match( '/{[a-z-A-Z0-9]+}/', $path_argv[$i] ) ){
					$key = str_replace( [ "{", "}" ], "", $path_argv[$i] ) ;
					if( isset( $pathArgsArr[$key] ) ){
						self::$currentRequestURI .= '/' .  $pathArgsArr[$key];
					}
				}else{
					self::$currentRequestURI .= '/' .  $path_argv[$i];
				}
			}
			
			
		}else{	

			
			for( $i = 0; $i < count( $path_argv ); $i++ ){
				if( preg_match( '/{[a-z-A-Z0-9]+}/', $path_argv[$i] ) ){
					$key = str_replace( [ "{", "}" ], "", $path_argv[$i] ) ;
					if( isset( $pathArgs[$key] ) ){
						self::$currentRequestURI .= '/' .  $pathArgs[$key];
					}
				}else{
					if( $path_argv[$i] != "" ){
						self::$currentRequestURI .= '/' .  $path_argv[$i];
					}
					
				}
			}		
			
			
		}
		
		if( self::$currentRequestURI != "/" )
			self::$currentRequestURI .= '/';
		
		if( $routeData['name'] == $routeName )
			self::$currentRouteData['current_request_uri'] .= self::$currentRequestURI;
			return self::$currentRouteData['current_request_uri'];		
		
			
		return "/"; 
		
	}
	
	
	public static function display( $viewPath = "", $pageData = [] ){
		#dd( $pageData['revenues'][0]['resident'] );
		$smarty 				= new SmartyBC();		
		$smarty->compile_dir 	= NOBLER_ROOT . "bootstrap/compile_dir";
		$smarty->cache_dir 		= NOBLER_ROOT . "bootstrap/cache_dir";	
		$smarty->config_dir 	= NOBLER_ROOT . "bootstrap/config_dir";	
		$smarty->template_dir 	= self::getConfigData('view_dir');
		$smarty->config_load( NOBLER_ROOT . Nobler::$env );

		if( !file_exists( $smarty->template_dir[0] ) )
		{
			
			mkdir( $smarty->template_dir[0] );
			$fhandle = fopen( $smarty->template_dir[0] . "index.php", "w" );
			$data = "<?php\n";
			$data .= "header('location:/') \n";
			$data .= "?>";		
			fwrite( $fhandle, $data, strlen( $data ) );
			fclose( $fhandle );
			
		}
		
		Nobler::$config 	= config();
		
		if( is_array($pageData)){
			foreach( $pageData as $k => $v ){
				$smarty->assign( $k, $v );
			}
		}		
		
		
		
		if( $viewPath != "" && file_exists( $smarty->template_dir[0] . $viewPath ) ){
			$smarty->display( $viewPath );
			
		}else{
			die("View file non-existent. Make sure your view file is the right directory.");
		}

		
	}
	
	public static function fetch( $viewPath = "", $pageData = [] ){
		
		$func_args 	= func_get_args(); 
		
		$smarty 				= new SmartyBC();		
		$smarty->compile_dir 	= NOBLER_ROOT . "bootstrap/compile_dir";
		$smarty->cache_dir 		= NOBLER_ROOT . "bootstrap/cache_dir";	
		$smarty->config_dir 	= NOBLER_ROOT . "bootstrap/config_dir";	
		$smarty->template_dir 	= self::getConfigData('view_dir');
		$smarty->config_load( NOBLER_ROOT . Nobler::$env );
		
		if( !file_exists( $smarty->template_dir[0] ) )
		{
			mkdir( $smarty->template_dir[0] );
			$fhandle = fopen( $smarty->template_dir[0] . "index.php", "w" );
			$data = "<?php\n";
			$data .= "header('location:/') \n";
			$data .= "?>";		
			fwrite( $fhandle, $data, strlen( $data ) );
			fclose( $fhandle );
			
		}
		
		Nobler::$config 	= self::getConfigData();		
		$page_data = is_array( $func_args[0] ) ? $viewPath : $pageData;	
		foreach( $page_data as $k => $v ){
			$smarty->assign( $k, $v );
		}
		
		$view_path = !is_array( $func_args[0]) ? $viewPath : $pageData;	
		
		return $smarty->fetch( $view_path );
		
	}
	
	public static function getConfigData($key = ""){		
		
		$confData 	= explode( "\n", file_get_contents(NOBLER_ROOT . Nobler::$env)  );
		$conf_array = [];
		foreach($confData as $k => $data){
			if($confData[$k] != "" or $confData[$k] != "\n" ){
				$dataArray = explode("=", $confData[$k]);
				if( count( $dataArray ) > 1 ){
					$conf_array[trim($dataArray[0])] = trim($dataArray[1]);
				}			
			}			
		}		
		
		if($key != '' && isset($conf_array[$key])){
			return $conf_array[$key];
			
		}else if($key != '' && !isset($conf_array[$key])){
			return "";
		}	
		
		return $conf_array;
		
	}
	
	
		
	public static function config( $key = '' ){
		
		$conf_array = [];		
		$envFile 	= NOBLER_ROOT . Nobler::$env;
		
		if( file_exists( $envFile ) == 1 ){
			
			$confData 	= explode( "\n", file_get_contents( $envFile ) );			
			foreach( $confData as $k => $data ){
				if( $confData[$k] != "" or $confData[$k] != "\n" ){
					$dataArray = explode( "=" , $confData[$k] );
					if( count( $dataArray ) > 1 ){
						$conf_array[trim($dataArray[0])] = trim( $dataArray[1] );
					}			
				}				
			}
			
			if( $key != '' && isset( $conf_array[$key] ) ){
				return $conf_array[$key];				
			}
			
			if( $key != '' && !isset( $conf_array[$key] ) ){
				return "";
			}
			
			if( $key == '' ){
				return "";
			}
			
		}
		
		return "";
		
	}
	
	public static function get_file_paths( $dirname = '' )
	{
		$files = glob( $dirname  . DIRECTORY_SEPARATOR . "*");
		foreach( $files as $file ){
			if( is_file( $file ) ){
				self::$filepaths[] =  $file;
			}
			
			if(  is_dir( $file ) ){
				self::get_file_paths( $file );
			}
		}
		
		return self::$filepaths;
	}



	
	public static function cleanData($data){
		$postedData = str_replace('?', '&#63', $data);
		$postedData = str_replace('`', '&#96;', $postedData);
		$postedData = str_replace("'", "&apos", $postedData);
		$postedData = str_replace('"', '&quot', $postedData);
		$postedData = str_replace('~', '&#126', $postedData);
		$postedData = str_replace('!', '&#33', $postedData);
		$postedData = str_replace('|', '&#124', $postedData);
		$postedData = str_replace('\\', '&#92', $postedData);
		$postedData = str_replace('*', '&#42', $postedData);
		$postedData = str_replace('[', '&#91', $postedData);
		$postedData = str_replace(']', '&#93', $postedData);
		$postedData = str_replace('{', '&#123', $postedData);
		$postedData = str_replace('}', '&#125', $postedData);
		$postedData = str_replace('(', '&#40', $postedData);
		$postedData = str_replace(')', '&#41', $postedData);
		$postedData = str_replace('^', '&#770', $postedData);
		return $data;
	}
	
	public static function secureURIData($uridata = []){
		$data = [];
		foreach($uridata as $key => $value){
			$postedData = strip_tags(htmlentities($value));
			$postedData = str_replace( '`', '\`', $postedData );
			$postedData = str_replace( "'", "\'", $postedData );
			$postedData = str_replace( '"', '\"', $postedData );
			$postedData = str_replace( '~', '\~', $postedData );
			$postedData = str_replace( '!', '\!', $postedData );
			$postedData = str_replace( '|', '\|', $postedData );
			$postedData = str_replace( '*', '\*', $postedData );
			$postedData = str_replace( '[', '\[', $postedData );
			$postedData = str_replace( ']', '\]', $postedData );
			$postedData = str_replace( '{', '\{', $postedData );
			$postedData = str_replace( '}', '\}', $postedData );
			$postedData = str_replace( '(', '\(', $postedData );
			$postedData = str_replace( ')', '\)', $postedData );
			$postedData = str_replace( '^', '\^', $postedData );
			$postedData = str_replace( '&', '\&', $postedData );
			$data[$key] = $postedData;
		}
		return $data;
	}
		
	
}

Nobler::$base_url = $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST'];

include_once( dirname( __FILE__ ) . '/helpers.php' );
$nobler = new Nobler;




?>