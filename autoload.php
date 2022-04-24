<?php
/* */ 
session_start();
$session_params = session_get_cookie_params();
setcookie("PHPSESSID", session_id(), 0, $session_params['path'], $session_params['domain'], true, true);


set_error_handler( function( $errorNo, $errorStr, $errorFile, $errorLine ){
	echo "<h2 align='center'>{$errorNo}:{$errorStr} in file {$errorFile} on line {$errorLine}</h2>" ;	
	die();
} );

 
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
#	error_reporting(0);

ini_set('memory_limit','50M');

date_default_timezone_set("Africa/Lagos");




#/*
 
function load_class( $class )
{
	$appDir 	= scandir( __DIR__ );	
	foreach( $appDir as $dir ){		
		
		if( is_dir( __DIR__ . '/' . $dir ) && $dir != "vendors" ){
			
			$paths_to_class = __DIR__ . DIRECTORY_SEPARATOR . $dir . DIRECTORY_SEPARATOR . $class . '.php';			
			if( file_exists( $paths_to_class ) ){
				require_once( $paths_to_class );
			}
			
		}
		
		if( is_dir( __DIR__ . '/' . $dir ) && $dir == "vendors" ){
			
			$vendorDir = scandir( __DIR__ . '/' .  $dir );
			foreach( $vendorDir as $vendor_dir ){
				
				$paths_to_class = __DIR__ . DIRECTORY_SEPARATOR . 'vendors' . DIRECTORY_SEPARATOR . $vendor_dir. DIRECTORY_SEPARATOR . $class . '.php';			
				$paths_to_smarty_class = __DIR__ . DIRECTORY_SEPARATOR . 'vendors' . DIRECTORY_SEPARATOR . $vendor_dir. DIRECTORY_SEPARATOR . $class . '.class.php';				
				
				if( file_exists( $paths_to_class ) ){
					require_once( $paths_to_class );
				}
				
				if( file_exists( $paths_to_smarty_class ) ){
					require_once( $paths_to_smarty_class );
				}
				
				
			}
		}
		
	}	
}
 
# */

function load_class1( $class )
{
	require_once( __DIR__ . DIRECTORY_SEPARATOR . 'vendors' . DIRECTORY_SEPARATOR . 'core' . DIRECTORY_SEPARATOR . 'FilePaths.php');
	$filepaths 		= FilePaths::get_file_paths( __DIR__ );	
	$paths_to_class = '';
	foreach( $filepaths as $path ){	
		$dirname = dirname( $path );
		if( preg_match( '/\.class/', basename( $path ) ) ){	
			$paths_to_class = $dirname . DIRECTORY_SEPARATOR . $class . '.class.php';	
		
		}else{
			$paths_to_class = $dirname . DIRECTORY_SEPARATOR . $class . '.php';		
			
		}
		
		if( file_exists( $paths_to_class ) ){
			require_once( $paths_to_class );			
		}		
	}	
}




spl_autoload_register( 'load_class' );

include_once( 'vendors/nobler/Nobler.php' );


?>