<?php
class FilePaths{
	public static $filepaths = [];
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

}

?>