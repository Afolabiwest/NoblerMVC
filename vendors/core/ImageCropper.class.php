<?php
class ImageCropper{
	public static $cropX = 0, $cropY = 0, $targetWidth, $targetHeight, $im1, $im2, $im3, $pathExt;	
	public function __construct($imageFilePath){
		static::init($imageFilePath);
	}
	public static function init($imageFilePath){
		$fileDataArray = explode('.', $imageFilePath);
		$fileExt = end($fileDataArray);	
		
		if($fileExt == 'jpg' || $fileExt == 'jpeg'){
			self::$im1 = imagecreatefromjpeg($imageFilePath);
		}else if($fileExt == 'png'){
			self::$im1 = imagecreatefrompng($imageFilePath);
		}else if($fileExt == 'gif'){
			self::$im1 = imagecreatefromgif($imageFilePath);
		}
	}
	
	public static function createSquaredThumbnail($imageDir, $thumbname){
		list($width, $height) = getimagesize($imageDir . $thumbname);
		if($width > $height){
			self::$targetWidth = $height;
			self::$targetHeight = $height;			
			self::$cropX = floor(($width - $height)/2);
			self::$cropY = 0;
			
		}else if($height > $width){
			self::$targetWidth = $width;
			self::$targetHeight = $width;			
			self::$cropX = 0;
			self::$cropY = floor(($height - $width)/2);
			
		}else if($width == $height){
			self::$targetWidth = $height - 6;
			self::$targetHeight = $height - 6;			
			self::$cropX = 6;
			self::$cropY = 6;	
			
		}
		
		
		self::$im2 = @imagecrop(self::$im1, ['x' => self::$cropX, 'y' => self::$cropY, 'width' => self::$targetWidth, 'height' => self::$targetHeight]);
		if(self::$im2){
			if(self::$pathExt['extension'] == 'jpg'){
				imagejpeg(self::$im2, $imageDir . '/thumb_' . $thumbname);
			}else if(self::$pathExt['extension'] == 'png'){
				imagepng(self::$im2, $imageDir . '/thumb_' . $thumbname);
			}else if(self::$pathExt['extension'] == 'gif'){
				imagegif(self::$im2, $imageDir . '/thumb_' . $thumbname);
			}
		}
		
		list($nwidth, $nheight) = getimagesize($imageDir . 'thumb_' . $thumbname);
		$image_p = imagecreatetruecolor(100, 100);
		$thumbFIleExt = end(explode('.', $imageDir . 'thumb_' . $thumbname));
		$image = "";
		if($thumbFIleExt == 'jpg'){
			$image = imagecreatefromjpeg($imageDir . 'thumb_' . $thumbname);
		}else if($thumbFIleExt == 'png'){
			$image = imagecreatefrompng($imageDir . 'thumb_' . $thumbname);
		}else if($thumbFIleExt == 'png'){
			$image = imagecreatefromgif($imageDir . 'thumb_' . $thumbname);
		}
		
		imagecopyresampled($image_p, $image, 0, 0, 0, 0, 100, 100, $nwidth, $nheight);
	}
	
	public static function createPortraitThumbnail($imageDir, $thumbname){
		list($width, $height) = getimagesize($imageDir . $thumbname);
		if($width > 300 && $height > 400 && ($width/$height) >= 0.75){
			if(($height/400) > 2){				
				self::$targetHeight = floor($height/400) * 400;
				self::$targetWidth 	= (self::$targetHeight/400) * 300;
				self::$cropX 		= floor(($width - self::$targetWidth)/2);
				self::$cropY 		= floor(($height - self::$targetHeight)/2);
			}else{
				self::$targetHeight = 400;
				self::$targetWidth 	= 300;
				self::$cropX 		= floor(($width - self::$targetWidth)/2);
				self::$cropY 		= floor(($height - self::$targetHeight)/2);
			}			
			
			self::$im2 = @imagecrop(self::$im1, ['x' => self::$cropX, 'y' => self::$cropY, 'width' => self::$targetWidth, 'height' => self::$targetHeight]);
			if(self::$im2){
				if(self::$pathExt['extension'] == 'jpg'){
					imagejpeg(self::$im2, $imageDir . '/thumb_' . $thumbname);
				}else if(self::$pathExt['extension'] == 'png'){
					imagepng(self::$im2, $imageDir . '/thumb_' . $thumbname);
				}else if(self::$pathExt['extension'] == 'gif'){
					imagegif(self::$im2, $imageDir . '/thumb_' . $thumbname);
				}
			}
			
			list($nwidth, $nheight) = getimagesize($imageDir . 'thumb_' . $thumbname);
			$image_p = imagecreatetruecolor(self::$targetWidth, self::$targetHeight);
			$thumbFIleExt = end(explode('.', $imageDir . 'thumb_' . $thumbname));
			$image = "";
			
			if($thumbFIleExt == 'jpg'){
				$image = imagecreatefromjpeg($imageDir . 'thumb_' . $thumbname);
			}else if($thumbFIleExt == 'png'){
				$image = imagecreatefrompng($imageDir . 'thumb_' . $thumbname);
			}else if($thumbFIleExt == 'png'){
				$image = imagecreatefromgif($imageDir . 'thumb_' . $thumbname);
			}
			
			imagecopyresampled($image_p, $image, 0, 0, 0, 0, self::$targetWidth, self::$targetHeight, $nwidth, $nheight);
			return true;
		
		}else{
			return false;
		}
		
		
		
	}
	
}


?>