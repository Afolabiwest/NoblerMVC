<?php
class ArticleCategoryForm{
	public $categoryId, $category, $friendlyUrl, $keywords, $description, $fileName, $response;
	public function __construct(){
		
	}
	
	public static function postCategory(){
		
		$response 				= [];
		$response['status'] 	= '';
		$response['message'] 	= '';
		
		if(isset($_POST['x'])){
			
			$x 				= post('x'); 
			$y 				= post('y');  
			$width 			= post('width');  
			$height 		= post('height');  
			$cont_w 		= post('container-width'); 
			$cont_h 		= post('container-height'); 
			
			$categoryId 	= post('category-id'); 
			$category		= post('category'); 
			$keywords		= post('keyword'); 
			$description	= post('description'); 
			$activeStatus	= post('active-status');
			$friendlyUrl	= preg_replace('/[^a-zA-Z0-9]/', '-', strtolower($category));
			$fileName		= md5(hash('crc32', time()) . '_' . date('Y-m-dHis')) . '.jpg';		
		}
		
		if(!$category){			
			$response['status'] = 'not-ok';
			$response['message'] = Utilities::message("Enter category name.");
			
		}else if(!FileUpload::fileIsUploaded('caption')){			
			$response['status'] = 'not-ok';
			$response['message'] = Utilities::message("Please, browse caption image for upload.");
			
		}else{
			$currFriendlyUrl 		= "";
			$main_friendly_url_str 	= "";
			
			if(ArticleCategories::categoryExistByUrl($friendlyUrl)){
				$currFriendlyUrl 			= $friendlyUrl;
				$url_last_char 				= substr($currFriendlyUrl, - 1);
				$main_friendly_url_str 		= '';
				
				if(preg_match('/([0-9]+)/', $url_last_char)){
					$url_last_char 			= is_numeric($url_last_char)? $url_last_char + 1: 1;
					$main_friendly_url_str 	= substr($currFriendlyUrl, 0, (strlen($currFriendlyUrl) - 1)) . $url_last_char;
				}
				
			}else{
				$main_friendly_url_str 		= $friendlyUrl;
			}
			
			$categoryData = [				
				'category' 		=>	$category, 
				'friendly_url' 	=>	$main_friendly_url_str, 
				'caption' 		=>	$fileName, 
				'keywords' 		=>	$keywords,
				'description' 	=>	$description		
			];
			
			if(ArticleCategories::postNewArticleCategory($categoryData)){
				if(FileUpload::uploadFile('caption', '../public_html/images/categories/', $fileName)){
					FileUpload::cropImage('../public_html/images/categories/'. $fileName, $x, $y, $width, $height, $cont_w);					
					$response['status'] 	= 'ok';
					$response['message'] 	= Utilities::message("Category saved successfully!", 'success');
					
				}else{
					
					$response['status'] = 'not-ok';
					$response['message'] = Utilities::message("Sorry! Category caption could not be uploaded");
				}
				
			}else{				
				$response['status'] = 'not-ok';
				$response['message'] = Utilities::message("Sorry! Category could not be saved.");
			}
		}
		
		echo json_encode($response);
	}
	
	public static function updateCategory(){
		
		$response 				= [];
		$response['status'] 	= 'ok';
		$response['message'] 	= 'processing ...';
		
		if(isset($_POST['x'])){			
			
			$x 				= post('x'); 
			$y 				= post('y');  
			$width 			= post('width');  
			$height 		= post('height');  
			$cont_w 		= post('container-width'); 
			$cont_h 		= post('container-height'); 			
			
			$categoryId 	= post('category-id'); 
			$category		= post('category'); 
			$keywords		= post('keyword'); 
			$description	= post('description'); 
			$activeStatus	= post('active-status');
			$friendlyUrl	= preg_replace('/[^a-zA-Z0-9]/', '-', strtolower($category));
			$fileName		= md5(hash('crc32', time()) . '_' . date('Y-m-dHis')) . '.jpg';
		
		}
		
		
		if(!$category){			
			$response['status'] = 'not-ok';
			$response['message'] = Utilities::message("Enter category name!");
			
		}else{
			$currFriendlyUrl 		= "";
			$main_friendly_url_str 	= "";
			if(FileUpload::fileIsUploaded('caption')){
				// Delete old caption and thumbnail					
				if(FileUpload::fileExists('../public_html/images/categories/'. ArticleCategories::getCategoryCaptionById($categoryId))){	
					FileUpload::deleteFile('../public_html/images/categories/'. ArticleCategories::getCategoryCaptionById($categoryId));
					FileUpload::deleteFile('../public_html/images/categories/thumb_'. ArticleCategories::getCategoryCaptionById($categoryId));
				}
				
				
				if(ArticleCategories::categoryExistByUrlTwice($friendlyUrl)){
					$currFriendlyUrl 			= $friendlyUrl;
					$url_last_char 				= substr($currFriendlyUrl, - 1);
					$main_friendly_url_str 		= '';
					if(preg_match('/([0-9]+)/', $url_last_char)){
						$url_last_char 			= is_numeric($url_last_char)? $url_last_char + 1: 1;
						$main_friendly_url_str 	= substr($currFriendlyUrl, 0, (strlen($currFriendlyUrl) - 1)) . $url_last_char;
					}
				}else{
					$main_friendly_url_str 		= $friendlyUrl;
				}
				
				$categoryData = [
					'category' 		=>	$category, 
					'friendly_url' 	=>	$main_friendly_url_str, 
					'caption' 		=>	$fileName, 
					'keywords' 		=>	$keywords,
					'description' 	=>	$description,
					'active_status' =>	$activeStatus
				];
				
				if(ArticleCategories::updateArticleCategoryById($categoryId, $categoryData)){					
					
					if(FileUpload::uploadFile('caption', '../public_html/images/categories/', $fileName)){						
						FileUpload::cropImage('../public_html/images/categories/'. $fileName, $x, $y, $width, $height, $cont_w);
						$response['status'] 	= 'ok';
						$response['url'] 		= $main_friendly_url_str;
						$response['message'] 	= Utilities::message("Article Category updated successfully!", 'success');
					
					}else{
						
						$response['status'] = 'not-ok';
						$response['message'] = Utilities::message("Sorry! Category caption could not be uploaded");
					}
				}else{				
					$response['status'] = 'not-ok';
					$response['message'] = Utilities::message("Sorry! Category could not be saved.");
				}
				
			}else{
				
				if(ArticleCategories::categoryExistByUrlTwice($friendlyUrl)){
					$currFriendlyUrl 			= $friendlyUrl;
					$url_last_char 				= substr($currFriendlyUrl, - 1);
					$main_friendly_url_str 		= '';
					if(preg_match('/([0-9]+)/', $url_last_char)){
						$url_last_char 			= is_numeric($url_last_char)? $url_last_char + 1: 1;
						$main_friendly_url_str 	= substr($currFriendlyUrl, 0, (strlen($currFriendlyUrl) - 1)) . $url_last_char;
					}
				}else{
					$main_friendly_url_str 		= $friendlyUrl;
				}
				
				$categoryData = [
					'category_id' 	=>	$categoryId, 
					'category' 		=>	$category, 
					'friendly_url' 	=>	$main_friendly_url_str, 
					'keywords' 		=>	$keywords,
					'description' 	=>	$description,
					'active_status' =>	$activeStatus
				];				
				
				if(ArticleCategories::updateArticleCategoryById($categoryId, $categoryData)){
					$response['status'] 	= 'ok';					
					$response['message'] 	= Utilities::message("Article Category updated successfully!", 'success');					
					
				}else{				
					$response['status'] = 'not-ok';
					$response['message'] = Utilities::message("Sorry! Article Category could not be saved.");					
				}				
			}
		}
		
		//*/
		echo json_encode($response);
	}
	
	public static function postCategoryName(){
		self::postCategory();
	}
	
	public static function updateCategoryName(){
		self::updateCategory();
	}
}




?>