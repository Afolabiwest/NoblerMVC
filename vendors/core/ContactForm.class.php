<?php

class ContactForm extends Forms{
	public static $firstname, $lastname, $email, $phone, $message, $subject, $response;
	
	public static function sendGuestMessage($setup){
		
		self::validateAjaxRequest();
		
		self::$firstname 	= post('firstname'); 
		self::$lastname 	= post('lastname'); 
		self::$subject 		= post('subject'); 
		self::$email 		= post('email'); 
		self::$phone 		= post('phone'); 
		self::$message 		= post('message');
		
		if(self::$firstname == "" || self::$email == "" || self::$subject == "" || self::$message == ""){
			self::$response = Utilities::message('Complete all required field as highlighted.');
		
		}else{
			
			$data = [
				'firstname' => self::$firstname, 
				'lastname' 	=> self::$lastname, 
				'fullname' 	=> self::$firstname . ' ' . self::$lastname, 
				'email' 	=> self::$email, 
				'phone' 	=> self::$phone, 
				'message' 	=> self::$message, 
				'subject' 	=> self::$subject
			];
			
			self::$response = Utilities::message('Thanks for contacting us. We will treat your message and get to back you asap.', 'success');			
			
			self::$response .= '<script>document.querySelector("#guest-contact-form").reset();</script>';			
			self::$response .= '<script>document.querySelector("#guest-contact-form").style.display = "none"; </script>';			
			
			$setup->assign('page_data', $data);
			$mail_content = $setup->fetch("mail/guest-message-notification-mail.html");			
			Utilities::initConfigData(App::$configFile);		
			Utilities::sendMail(Utilities::$configData['infoMail'], "Administrator", $data['subject'], $mail_content);
		
		}
		
		echo self::$response;
		
	}
	
	
	public static function sendMessage(){
		
		self::validateAjaxRequest();
		
		$response = [
			'status' => 'not-ok',
			'message' => 'No action performed!',
		];
		
		$fullname 	= post('fullname');
		$email 		= post('email'); 
		$phone 		= post('phone'); 
		$message 	= post('message');
		
		if($fullname == "" || $email == "" || $message == ""){
			$response = [
				'status' => 'not-ok',
				'message' => 'Complete all required fields as highlighted red.',
			];
		
		}else{
			
			$data = [
				'fullname' => $fullname, 
				'email' 	=> $email, 
				'phone' 	=> $phone, 
				'message' 	=> $message, 
			];
			
			
			$mail_content = fetch($data,  "mails/contact-message-mail.html");
			Tools::sendMail(Tools::getConfigData('info_mail'), "Administrator", "Contact Message", $mail_content);
			
			$response = [
				'status' => 'ok',
				'message' => 'Thanks for contacting us. We will treat your message and get to back you asap.',
			];			
					
			
			
		}
		
		self::$response = $response;
		echo Tools::beepJSON(self::$response);
		
	}
	
	

}

?>