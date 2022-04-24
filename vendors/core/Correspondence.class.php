<?php

#	include_once(str_replace("\\", "/", dirname(__DIR__)) . '/contacts.php');

class Correspondence{
	
	public $contacts	= [];
	public $subject 	= "";
	public static $configData = [];
	public function __construct($contactList = [], $subject = ""){
		$this->contacts = $contactList;	
		$this->subject 	= $subject;	
		$this->sendPersonalizedMail($subject);	
	}
	
	public function sendPersonalizedMail($subject = ""){
		$i = 1;
		foreach($this->contacts as $contact){
			//	Tools::debug_array($contact);
			
			if(strtolower(trim($contact['remarks'])) != "none"){
				echo "<p>" . ($contact['email']) . ": Sent</p>";
				$i++;
				$maildata = [
					'subject' 	=> $subject,
					'company' 	=> $contact['company'],
					'address' 	=> $contact['address'],
					'phone' 	=> $contact['phone'],
					'email' 	=> $contact['email'],
					'website' 	=> $contact['website'],
					'remarks' 	=> $contact['remarks'],
					'state' 	=> $contact['state'],
					'country' 	=> $contact['country'],
				];
				
				
				$mailTemp = fetch($maildata,  'mails/realtorian-introduction-mail.html');
				if(!preg_match("/;/", $contact['email'])){
					Correspondence::sendMail($contact['email'], $contact['company'], $subject, $mailTemp);
				}else{
					$addresses = explode(";", $contact['email']);
					for($i = 0; $i < count($addresses); $i++ ){
						Correspondence::sendMail($addresses[$i], $contact['company'], $subject, $mailTemp);
					}
				}
				
			}
		}
	}
	
	
	public static function pushMails(){
		if(Buttress::$params['username'] != "westribbon" && Buttress::$params['password'] != "ajo4realamin"){
			include_once(str_replace("\\", "/", dirname(__DIR__)) . '/contacts.php');
			$subject = "Premium Real Estate Web Content and Property Listing Solution - Westribbon Realtorian 1.0";
			new Correspondence($contacts, $subject);
		}else{
			echo "Wrong credentials";
		}
			
	}
	
		
	
	public static function sendMail($email, $fullname, $subject, $mail_content, $sender = 'realtorian@westribbon.com', $alt_content = ''){
		
		//Create a new PHPMailer instance
		self::initConfigData(Buttress::$configFile);
		
		$mail = new PHPMailer();
		

		if(preg_match("/yahoo/", $email) || preg_match("/ymail/", $email) || preg_match("/outlook/", $email)){
			
			//Tell PHPMailer to use SMTP
			$mail->isSMTP();
			//Enable SMTP debugging
			// 0 = off (for production use)
			// 1 = client messages
			// 2 = client and server messages
			$mail->SMTPDebug = 0;
			//Ask for HTML-friendly debug output
			$mail->Debugoutput = 'html';
			//Set the hostname of the mail server
			$mail->Host = self::getConfigData('mail_host');
			//Set the SMTP port number - likely to be 25, 465 or 587
			$mail->Port = self::getConfigData('mail_port');
			//Whether to use SMTP authentication
			$mail->SMTPAuth = true;
			//Username to use for SMTP authentication
			$mail->Username = $sender;
			//Password to use for SMTP authentication
			$mail->Password = "ajo4realadmin";	
		
		}
		
		//Set who the message is t be sent from
		$mail->setFrom($sender, self::getConfigData('company_name'));		
		//Set who the message is to be sent to
		$mail->addAddress($email, $fullname);		
		//Set the subject line
		$mail->isHTML(true);
		$mail->Subject 	= $subject;
		$mail->Body 	= $mail_content;
		$mail->AltBody 	= $alt_content != '' ? $alt_content : 'Use mordern browser or email client to view this mail accurately.';
		if(!$mail->send()){
			echo $mail->ErrorInfo;
			return false;
		}
		//send the message, check for errors
		
		return true;
		
		
	}
	
	
	
	public static function initConfigData(){			
		self::$configData = getConfigData()	;
	}
	
	public static function getConfigData($index){
		if(!isset(self::$configData[$index])){
			self::$configData = getConfigData()	;
		}	
		$data = isset(self::$configData[$index]) ? self::$configData[$index] : '';
		return $data;
	}
	
	


}


?>