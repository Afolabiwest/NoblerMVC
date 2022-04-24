<?php

trait FileDownloader{
	public function __construct(){
		
	}

	public static function download($filePath){
		$contentType 	= "";
		
		$filePathData 	= explode('/', trim($filePath, '/'));		
		$filename 		= end($filePathData);
		
		$fileExt 		= self::$getFileExtension($filename);
		$filepath 		= $filePath;
		
		if($fileExt == 'jpg'){
			//	$contentType = "image/jpeg";
			$contentType = "application/octet-stream";
			
		}else if($fileExt == 'mp3'){
			$contentType = "audio/mp3";
			
		}else{
			$contentType = "video/mp4";
			
		}	
			
		header('Content-Type: ' . $contentType);
		header('Content-Description: File Transfer');		
		header('Content-Disposition: attachement; filename=' . $filename );
		header('Content-Transfer-Encoding: Binary');
		header('Expires: 0');
		header('Cache-Control: public');
		header('Pragma: public');
		header('Content-Length: ' . filesize($filepath));			
		readfile($filepath);
		ob_clean();	
		
	}
	
	public static function getFileExtension($filename){
		$fileData = explode(".", $filename);
		$fileExt = end($fileData);
		return $fileExt;
	}

}
?>