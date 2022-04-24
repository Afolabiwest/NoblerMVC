<?php
class ArticleForm{
	public $category, $x, $y, $width, $height, $cont_w, $cont_h;
	public $articleId, $title, $friendlyUrl, $keywords, $description, $content, $fileName, $response;
	public function __construct(){
		if(isset($_POST['x'])){
			$this->articleId 	= post('article-id'); 
			$this->category 	= post('category'); 
			$this->x 			= post('x'); 
			$this->y 			= post('y');  
			$this->width 		= post('width');  
			$this->height 		= post('height');  
			$this->cont_w 		= post('container-width'); 
			$this->cont_h 		= post('container-height'); 
			$this->title		= post('title'); 
			$this->keywords		= post('keyword'); 
			$this->description	= post('description'); 
			$this->content		= post('content');
			$this->activeStatus	= post('active-status');
			$this->friendlyUrl	= preg_replace('/[^a-zA-Z0-9]/', '-', strtolower($this->title));
			$this->fileName		= md5(hash('crc32', time()) . '_' . date('Y-m-dHis')) . '.jpg';
			
			/* 
			echo '<pre>';
			print_r($_POST);
			echo '</pre>'; 
			*/
			
		}
	}
	
	public function postArticle(){		
		$response = [];
		$response['status'] = '';
		$response['message'] = '';
		if(!$this->category || !$this->title || !$this->content){			
			$response['status'] = 'not-ok';
			$response['message'] = "Complete all required fields as highlighted.";
			
			
		}else if(!FileUpload::fileIsUploaded('caption')){
			
			$response['status'] = 'not-ok';
			$response['message'] = "Please, browse caption image for upload.";
			
		}else{
			$currFriendlyUrl 		= "";
			$main_friendly_url_str 	= "";
			
			if(Articles::articleExistByUrl($this->friendlyUrl)){
				$currFriendlyUrl 			= $this->friendlyUrl;
				$url_last_char 				= substr($currFriendlyUrl, - 1);
				$main_friendly_url_str 		= '';
				if(preg_match('/([0-9]+)/', $url_last_char)){
					$url_last_char 			= is_numeric($url_last_char)? $url_last_char + 1: 1;
					$main_friendly_url_str 	= substr($currFriendlyUrl, 0, (strlen($currFriendlyUrl) - 1)) . $url_last_char;
				}
			}else{
				$main_friendly_url_str 		= $this->friendlyUrl;
			}
			
			$articleData = [
				'writer_id' 	=>	1, 
				'category_id' 	=>	$this->category, 
				'title' 		=>	$this->title, 
				'friendly_url' 	=>	$main_friendly_url_str, 
				'caption' 		=>	$this->fileName, 
				'keywords' 		=>	$this->keywords,
				'description' 	=>	$this->description,
				'content' 		=>	$this->content				
			];
			
			if(Articles::postNewArticle($articleData)){
				if(FileUpload::uploadFile('caption', '../public_html/images/blog/', $this->fileName)){
					FileUpload::cropImage('../public_html/images/blog/'. $this->fileName, $this->x, $this->y, $this->width, $this->height, $this->cont_w);					
					$response['status'] 	= 'ok';
					// $response['url'] 		= $main_friendly_url_str;
					$response['message'] 	= "Article saved successfully!";
					
				}else{
					
					$response['status'] = 'not-ok';
					$response['message'] = "Sorry! Article caption could not be uploaded";
				}
			}else{				
				$response['status'] = 'not-ok';
				$response['message'] = "Sorry! Article could not saved.";
			}
		}
		
		echo json_encode($response);
	}
	
	public function updateArticle(){		
		$response = [];
		$response['status'] = '';
		$response['message'] = '';
		if(!$this->category || !$this->title || !$this->content){			
			$response['status'] = 'not-ok';
			$response['message'] = "Complete all required fields as highlighted.";
			
		
			
		}else{
			$currFriendlyUrl 		= "";
			$main_friendly_url_str 	= "";
			if(FileUpload::fileIsUploaded('caption')){
				FileUpload::deleteFile('../public_html/images/blog/'. Articles::getArticleCaptionById($this->articleId));
				FileUpload::deleteFile('../public_html/images/blog/thumb_'. Articles::getArticleCaptionById($this->articleId));
					
				if(Articles::articleExistByUrlTwice($this->friendlyUrl)){
					$currFriendlyUrl 			= $this->friendlyUrl;
					$url_last_char 				= substr($currFriendlyUrl, - 1);
					$main_friendly_url_str 		= '';
					if(preg_match('/([0-9]+)/', $url_last_char)){
						$url_last_char 			= is_numeric($url_last_char)? $url_last_char + 1: 1;
						$main_friendly_url_str 	= substr($currFriendlyUrl, 0, (strlen($currFriendlyUrl) - 1)) . $url_last_char;
					}
				}else{
					$main_friendly_url_str 		= $this->friendlyUrl;
				}
				
				$articleData = [
					'writer_id' 	=>	1,
					'category_id' 	=>	$this->category, 
					'title' 		=>	$this->title, 
					'friendly_url' 	=>	$main_friendly_url_str, 
					'caption' 		=>	$this->fileName, 
					'keywords' 		=>	$this->keywords,
					'description' 	=>	$this->description,
					'content' 		=>	$this->content,
					'active_status' =>	$this->activeStatus
				];
				
				if(Articles::updateArticleById($this->articleId, $articleData)){
					// Delete old caption and thumbnail					
					
					
					if(FileUpload::uploadFile('caption', '../public_html/images/blog/', $this->fileName)){
						
						FileUpload::cropImage('../public_html/images/blog/'. $this->fileName, $this->x, $this->y, $this->width, $this->height, $this->cont_w);
						$response['status'] 	= 'ok';
						$response['url'] 		= $main_friendly_url_str;
						$response['message'] 	= "Article updated successfully!";
					
					}else{
						
						$response['status'] = 'not-ok';
						$response['message'] = "Sorry! Article caption could not be uploaded";
					}
				}else{				
					$response['status'] = 'not-ok';
					$response['message'] = "Sorry! Article could not saved.";
				}
				
			}else{
				
				if(Articles::articleExistByUrlTwice($this->friendlyUrl)){
					$currFriendlyUrl 			= $this->friendlyUrl;
					$url_last_char 				= substr($currFriendlyUrl, - 1);
					$main_friendly_url_str 		= '';
					if(preg_match('/([0-9]+)/', $url_last_char)){
						$url_last_char 			= is_numeric($url_last_char)? $url_last_char + 1: 1;
						$main_friendly_url_str 	= substr($currFriendlyUrl, 0, (strlen($currFriendlyUrl) - 1)) . $url_last_char;
					}
				}else{
					$main_friendly_url_str 		= $this->friendlyUrl;
				}
				
				$articleData = [
					'writer_id' 	=>	1,
					'category_id' 	=>	$this->category, 
					'title' 		=>	$this->title, 
					'friendly_url' 	=>	$main_friendly_url_str, 
					'keywords' 		=>	$this->keywords,
					'description' 	=>	$this->description,
					'content' 		=>	$this->content,
					'active_status' =>	$this->activeStatus
				];
				
				if(Articles::updateArticleById($this->articleId, $articleData)){
					$response['status'] 	= 'ok';					
					$response['message'] 	= "Article updated successfully!";
					//	$response['message'] 	= $main_friendly_url_str . 'xxx';
					
				}else{				
					$response['status'] = 'not-ok';
					$response['message'] = "Sorry! Article could not saved.");
					
				}				
			}
		}
		
		echo json_encode($response);
	}
}




?>