<?php
class FileUpload{
	public static $x, $y, $width, $height, $cont_w, $cont_h;
	public function __construct(){
		self::_init();
	}
	
	public static function _init(){					
		self::$x 		= post('x'); 
		self::$y 		= post('y');  
		self::$width 	= post('width');  
		self::$height 	= post('height');  
		self::$cont_w 	= post('container-width'); 
		self::$cont_h 	= post('container-height');
	}
	
	public static function validateFileExtension($file_index, $allowedExt = ['jpg', 'png', 'gif', 'svg']){
		$fileDataArray 	= explode(".", $_FILES[$file_index]['name']);
		$fileExt 		= end($fileDataArray);
		
		return in_array($fileExt, $allowedExt);
	}
	
	public static function validateFileExtensionFromName($name, $allowedExt = ['jpg', 'png', 'gif', 'svg']){
		$fileDataArray 	= explode(".", $name);
		$fileExt 		= end($fileDataArray);		
		return in_array($fileExt, $allowedExt);
	}
	
	public static function getFileExtensionFromName($name){
		$fileDataArray 	= explode(".", $name);
		$fileExt 		= end($fileDataArray);		
		return $fileExt;
	}
	
	public static function uploadFile($file_index, $target_folder_path, $filename =''){
		$file_name = $filename != '' ? $filename : $_FILES[$file_index]['name'];
		if(isset($_FILES[$file_index]['tmp_name'])){
			return move_uploaded_file($_FILES[$file_index]['tmp_name'], $target_folder_path . '/' . $file_name);
		}else{
			return move_uploaded_file($file_index, $target_folder_path . '/' . $file_name);
		}
		
	}
	
	public static function deleteFile($target_file_path){		
		if(file_exists($target_file_path) == 1){
			unlink($target_file_path);
		}else{
			'No such file exist';			
		}
	}
	
	public static function validateFileSize($file_index, $allowedSize = 2048){
		return $_FILES[$file_index]['size'] <= $allowedSize;
	}
	
	/* 
	//	PARAMETER - All required (*)
	
	//	@param $imagePath
	//	@param $x_cood
	//	@param $y_cood
	//	@param $crop_w
	//	@param $crop_h
	//	@param $cont_w
	
	//	USAGE
	//	FileUpload::cropImage('folder/image-file-name.jpg', 12, 45, 180, 180, 500);
	//   
	*/
	
	public static function cropImage($imagePath, $x_cood, $y_cood, $crop_w, $crop_h, $cont_w){
		sleep(1);
		list($i_width, $i_height) = getimagesize($imagePath);
		$ratio 				= $cont_w / $i_width;
		
		$width 				= ($cont_w >= $i_width) ? $crop_w * $ratio : $crop_w / $ratio;
		$height 			= ($cont_w >= $i_width) ? $crop_h * $ratio : $crop_h / $ratio;
		
		$imagePathDataArray = explode('/', rtrim($imagePath, '/'));
		$dirPathDataArray 	= array_slice($imagePathDataArray, 0, count($imagePathDataArray) - 1);
		$target_folder_name = implode('/', $dirPathDataArray);
		$file_name 			= end($imagePathDataArray);
		$filename			= 'thumb_' . $file_name;
		
		// Checking if file type is an svg
		
		$fileDataArray 		= explode('.', $file_name);
		$fileExt 			= end($fileDataArray);
		
		
		if($fileExt == 'svg'){			
			$final_file_name 	= substr($file_name, 0, (strlen($file_name) - 4)). '.jpg'; 
			$imagePath 			= self::convertSVGToJPEG($imagePath, $final_file_name);
		}
		
			
		$src 				= imagecreatefromjpeg($imagePath);
		$tmp 				= imagecreatetruecolor($crop_w, $crop_h);
		
		imagecopyresampled($tmp, $src, 0, 0, $x_cood, $y_cood,  $width, $height, $width, $height);
		imagejpeg($tmp, $target_folder_name . '/' . $filename, 100);
		imagedestroy($tmp);
	}
	
	public static function createSquareImageThumb($imagePath){
		self::_init();
		sleep(1);
		self::cropImage($imagePath, self::$x , self::$y , self::$width, self::$width, self::$cont_w);
	}
	
	
	public static function fileIsUploaded($file_index){
		return isset($_FILES[$file_index]) && $_FILES[$file_index]['tmp_name'] !='';
	}
	
	public static function convertSVGToPNG($imagePath, $upload_file_name = ''){
		$im 		= new Imagick();
		$svg 		= file_get_contents($imagePath);		
		$file_name 	= $upload_file_name == '' ? md5(hash('crc32', time()) . '_' . date('Y-m-dHis')) . '.png' : $upload_file_name;
		
		$im->readImageBlob($svg);
		$im->setImageFormat('png24');
		
		$imagePathDataArray = explode('/', rtrim($imagePath, '/'));
		$dirPathDataArray 	= array_slice($imagePathDataArray, 0, count($imagePathDataArray) - 1);
		$target_folder_name = implode('/', $dirPathDataArray);
		
		$im->writeImage($target_folder_name . '/' . $file_name);
		$im->clear();
	}
	
	public static function convertSVGToJPEG($imagePath, $upload_file_name = ''){
		$im 		= new Imagick();
		$svg 		= file_get_contents($imagePath);
		$file_name 	= $upload_file_name == '' ? md5(hash('crc32', time()) . '_' . date('Y-m-dHis')) . '.png' : $upload_file_name;
		$im->readImageBlob($svg);
		$im->setImageFormat('jpg');
		
		$imagePathDataArray = explode('/', rtrim($imagePath, '/'));
		$dirPathDataArray 	= array_slice($imagePathDataArray, 0, count($imagePathDataArray) - 1);
		$target_folder_name = implode('/', $dirPathDataArray);
		
		$im->writeImage($target_folder_name . '/' . $file_name);
		$im->clear();		
	}
	
	public static function convertSVGToGIF($imagePath, $upload_file_name = ''){
		$im 		= new Imagick();
		$svg 		= file_get_contents($imagePath);
		$file_name 	= $upload_file_name == '' ? md5(hash('crc32', time()) . '_' . date('Y-m-dHis')) . '.png' : $upload_file_name;
		
		$im->readImageBlob($svg);
		$im->setImageFormat('gif');
		
		$imagePathDataArray = explode('/', rtrim($imagePath, '/'));
		$dirPathDataArray 	= array_slice($imagePathDataArray, 0, count($imagePathDataArray) - 1);
		$target_folder_name = implode('/', $dirPathDataArray);
		
		$im->writeImage($target_folder_name . '/' . $file_name);
		$im->clear();
	}
	
	public static function convertSVGToRasterImage($imagePath, $file_name, $file_type = ''){
		$allowedExt = ['png', 'jpg', 'jpeg', 'gif'];
		$im 		= new Imagick();
		$svg 		= file_get_contents($imagePath);
		
		$im->readImageBlob($svg);
		
		if($file_type != '' || in_array($file_type, $allowedExt)){
			if($file_type == 'jpg' || $file_type == 'jpeg'){
				$im->setImageFormat('jpeg');
				
			}else if($file_type == 'png'){
				$im->setImageFormat('png24');
				
			}else if($file_type == 'gif'){
				$im->setImageFormat('gif');
			}
		}else{
			$im->setImageFormat('jpeg');
		}
		
		$filename = $file_type == '' || $file_type == 'jpeg' ? $file_name . 'jpg' : $file_name . $file_type;
		
		$imagePathDataArray = explode('/', rtrim($imagePath, '/'));
		$dirPathDataArray 	= array_slice($imagePathDataArray, 0, count($imagePathDataArray) - 1);
		$target_folder_name = implode('/', $dirPathDataArray);
		
		$im->writeImage($target_folder_name . '/' . $filename);
		$im->clear();
		return $target_folder_name . '/' . $filename;
	}
	
	public static function fileExists($file_path){
		return file_exists($file_path) == 1;
	}
	
}

?>