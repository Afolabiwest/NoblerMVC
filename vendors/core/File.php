<?php

class FileProcessor extends ImageCropper{
	use FileDownloader;
	
	public static function isValidExtension($filename, $allowedExt = ['jpg', 'jpeg', 'png', 'gif', 'pdf']){		
		return in_array(self::getFileExtension($filename), $allowedExt);
	}
	
	public static function getFileExtension($filename){
		$file_data_array 	= explode('.', $filename);
		$ext 				= end($file_data_array);
		return $ext;
	}
	
	public static function uploadFile($file_index, $filename, $targetDir){
		if(array_key_exists($file_index, $_FILES)){
			move_uploaded_file($_FILES[$file_index]['tmp_name'], rtrim($targetDir, "/") . '/' . $filename);
		}
	}
	
	


}


?>