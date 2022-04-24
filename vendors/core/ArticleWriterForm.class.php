<?php
class ArticleWriterForm{
	public static $firstname, $lastname, $email, $phone, $password, $subject;
	public function __construct(){
		
	}
	
	public static function postWriterData(){
		
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
			
			$firstname		= post('firstname'); 
			$lastname		= post('lastname'); 
			$email			= post('email'); 
			$phone			= post('phone'); 
			$address		= post('address'); 
			$remarks		= post('remarks'); 
			$activeStatus	= post('active-status');
			$friendlyUrl	= preg_replace('/[^a-zA-Z0-9]/', '-', strtolower($firstname . '-' . $lastname));
			$fileName		= md5(hash('crc32', time()) . '_' . date('Y-m-dHis')) . '.jpg';		
			$password		= hash('crc32', time());		
			$encPassword	= Utilities::encript_password($password);
			
			self::$firstname	= $firstname; 
			self::$lastname		= $lastname; 
			self::$email		= $email; 
			self::$phone		= $phone; 
			self::$password		= $encPassword; 
		}
		
		if(!$firstname || !$email || !$phone){			
			$response['status'] 	= 'not-ok';
			$response['message'] 	= Utilities::message("Complete all required fields.");
			
		}else if(!FileUpload::fileIsUploaded('caption')){			
			$response['status'] = 'not-ok';
			$response['message'] = Utilities::message("Please, browse phoyograph file for upload.");
			
		}else{			
			
			$writerData = [
				'firstname' 	=> $firstname,
				'lastname' 		=> $lastname,
				'email' 		=> $email,
				'phone' 		=> $phone,
				'photograph' 	=> $fileName,
				'password' 		=> $encPassword,
				'remarks' 		=> $remarks,
				'address' 		=> $address,
				'active_status' => 1
			];
			
			if(ArticleWriters::addNewWriter($writerData)){
				if(FileUpload::uploadFile('caption', '../public_html/images/writers/', $fileName)){
					FileUpload::cropImage('../public_html/images/writers/'. $fileName, $x, $y, $width, $height, $cont_w);					
					$response['status'] 	= 'ok';
					$response['message'] 	= Utilities::message("Writer data saved successfully!", 'success');
					
				}else{
					
					$response['status'] = 'not-ok';
					$response['message'] = Utilities::message("Sorry! Writer data could not be uploaded");
				}
				
			}else{				
				$response['status'] = 'not-ok';
				$response['message'] = Utilities::message("Sorry! Writer data could not be saved.");
			}
		}
		
		echo json_encode($response);
	}
	
	public static function updateWriterData(){
		
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
			
			$writerId 		= post('writer-id'); 
			$firstname		= post('firstname'); 
			$lastname		= post('lastname');  
			$email			= post('email'); 
			$phone			= post('phone'); 
			$address		= post('address'); 
			$remarks		= post('remarks'); 
			$activeStatus	= post('active-status');
			$fileName		= md5(hash('crc32', time()) . '_' . date('Y-m-dHis')) . '.jpg';	

			self::$firstname	= $firstname; 
			self::$lastname		= $lastname; 
			self::$email		= $email; 
			self::$phone		= $phone;
		
		}
		
		
		if(!$firstname || !$email || !$phone){			
			$response['status'] 	= 'not-ok';
			$response['message'] 	= Utilities::message("Complete all required fields!");
			
		}else{
			
			if(FileUpload::fileIsUploaded('caption')){
				// Delete old caption and thumbnail	
				$writerCurrPhoto = ArticleWriters::getWriterPhotographById($writerId);
				if(FileUpload::fileExists('../public_html/images/writers/'. $writerCurrPhoto)){	
					FileUpload::deleteFile('../public_html/images/writers/'. $writerCurrPhoto);
					FileUpload::deleteFile('../public_html/images/writers/thumb_'. $writerCurrPhoto);
				}
				
				
				$writerData = [
					'firstname' 	=> $firstname,
					'lastname' 		=> $lastname,
					'email' 		=> $email,
					'phone' 		=> $phone,
					'photograph' 	=> $fileName,
					'remarks' 		=> $remarks,
					'address' 		=> $address,
					'active_status' => 1
				];
				
				if(ArticleWriters::updateWriterAccountById($writerId, $writerData)){					
					
					if(FileUpload::uploadFile('caption', '../public_html/images/writers/', $fileName)){						
						FileUpload::cropImage('../public_html/images/writers/'. $fileName, $x, $y, $width, $height, $cont_w);
						$response['status'] 	= 'ok';
						$response['message'] 	= Utilities::message("Article Writer data updated successfully!", 'success');
					
					}else{
						
						$response['status'] = 'not-ok';
						$response['message'] = Utilities::message("Sorry! Writer photograph could not be uploaded");
					}
				}else{				
					$response['status'] = 'not-ok';
					$response['message'] = Utilities::message("Sorry! Writer photograph could not be saved.");
				}
				
			}else{
				
				$writerData = [
					'firstname' 	=> $firstname,
					'lastname' 		=> $lastname,
					'email' 		=> $email,
					'phone' 		=> $phone,
					'remarks' 		=> $remarks,
					'address' 		=> $address,
					'active_status' => 1
				];			
				
				if(ArticleWriters::updateWriterAccountById($writerId, $writerData)){
					$response['status'] 	= 'ok';					
					$response['message'] 	= Utilities::message("Article Writer updated successfully!", 'success');					
					
				}else{				
					$response['status'] = 'not-ok';
					$response['message'] = Utilities::message("Sorry! Article Writer could not be saved.");					
				}				
			}
		}
		
		
		echo json_encode($response);
	}
	
	public static function postRegisterationMail($email, $fullname, $subject, $mail_content, $alt_content = ''){
		Utilities::sendMail($email, $fullname, $subject, $mail_content, $alt_content);
	}
}




?>