<?php


/**
 * Smarty Autoloader
 *
 * @package    Smarty
 */

/**
 * Smarty Autoloader
 *
 * @package    Smarty
 * @author     Uwe Tews
 *             Usage:
 *             require_once '...path/Autoloader.php';
 *             Smarty_Autoloader::register();
 *             $smarty = new Smarty();
 *             Note:       This autoloader is not needed if you use Composer.
 *             Composer will automatically add the classes of the Smarty package to it common autoloader.
 */

class Smarty_Autoloader
{
    /**
     * Filepath to Smarty root
     *
     * @var string
     */
    public static $SMARTY_DIR = '';
	

    /**
     * Filepath to Smarty internal plugins
     *
     * @var string
     */
    public static $SMARTY_SYSPLUGINS_DIR = '';

    /**
     * Array with Smarty core classes and their filename
     *
     * @var array
     */
    public static $rootClasses = array('smarty' => 'Smarty.class.php', 'smartybc' => 'SmartyBC.class.php',);

    /**
     * Registers Smarty_Autoloader backward compatible to older installations.
     *
     * @param bool $prepend Whether to prepend the autoloader or not.
     */
    public static function registerBC($prepend = false)
    {
        /**
         * register the class autoloader
         */
        if (!defined('SMARTY_SPL_AUTOLOAD')) {
            define('SMARTY_SPL_AUTOLOAD', 0);
        }
        if (SMARTY_SPL_AUTOLOAD &&
            set_include_path(get_include_path() . PATH_SEPARATOR . SMARTY_SYSPLUGINS_DIR) !== false
        ) {
            $registeredAutoLoadFunctions = spl_autoload_functions();
            if (!isset($registeredAutoLoadFunctions[ 'spl_autoload' ])) {
                spl_autoload_register();
            }
        } else {
            self::register($prepend);
        }
    }

    /**
     * Registers Smarty_Autoloader as an SPL autoloader.
     *
     * @param bool $prepend Whether to prepend the autoloader or not.
     */
	 
    public static function register($prepend = false)
    {
        self::$SMARTY_DIR = defined('SMARTY_DIR') ? SMARTY_DIR : dirname(__FILE__) . DIRECTORY_SEPARATOR;
        self::$SMARTY_SYSPLUGINS_DIR = defined('SMARTY_SYSPLUGINS_DIR') ? SMARTY_SYSPLUGINS_DIR : self::$SMARTY_DIR . 'sysplugins' . DIRECTORY_SEPARATOR;
		
        if (version_compare(phpversion(), '5.3.0', '>=')) {
            spl_autoload_register(array(__CLASS__, 'autoload'), true, $prepend);
        } else {
            spl_autoload_register(array(__CLASS__, 'autoload'));
        }
    }

    /**
     * Handles auto loading of classes.
     *
     * @param string $class A class name.
     */
    public static function autoload($class)
    {
        $_class = strtolower($class);
        if (strpos($_class, 'smarty') !== 0) {
            return;
        }
        $file = self::$SMARTY_SYSPLUGINS_DIR . $_class . '.php';
        if (is_file($file)) {
            include $file;
        } else if (isset(self::$rootClasses[ $_class ])) {
            $file = self::$SMARTY_DIR . self::$rootClasses[ $_class ];
            if (is_file($file)) {
                include $file;
            }
        }
        return;
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
	
	public function secureURIData($uridata = []){
		$data = [];
		foreach($uridata as $key => $value){
			$postedData = strip_tags(htmlentities($value));
			$postedData = str_replace('`', '\`', $postedData);
			$postedData = str_replace("'", "\'", $postedData);
			$postedData = str_replace('"', '\"', $postedData);
			$postedData = str_replace('~', '\~', $postedData);
			$postedData = str_replace('!', '\!', $postedData);
			$postedData = str_replace('|', '\|', $postedData);
			$postedData = str_replace('*', '\*', $postedData);
			$postedData = str_replace('[', '\[', $postedData);
			$postedData = str_replace(']', '\]', $postedData);
			$postedData = str_replace('{', '\{', $postedData);
			$postedData = str_replace('}', '\}', $postedData);
			$postedData = str_replace('(', '\(', $postedData);
			$postedData = str_replace(')', '\)', $postedData);
			$postedData = str_replace('^', '\^', $postedData);
			$postedData = str_replace('&', '\&', $postedData);
			$data[$key] = $postedData;
		}
		return $data;
	}
	
}



spl_autoload_register(function($class){	

	if( is_array(Nobler::$folders) ){
		for($i = 0; $i < count( Nobler::$folders ); $i++){
			$targetClassPath = dirname($_SERVER['DOCUMENT_ROOT']) . "/". Nobler::$folders[$i] . $class . '.class.php';
			
			if(file_exists($targetClassPath) == 1){			
				include_once( $targetClassPath);
				break;
			}		
			
			if(file_exists(dirname($_SERVER['DOCUMENT_ROOT']) . "/". Nobler::$folders[$i] . $class . '.php') == 1){			
				include_once( dirname($_SERVER['DOCUMENT_ROOT']) . "/". Nobler::$folders[$i] . $class . '.php');
				break;
			} 		
			
		}
	}	
	
});





