<?php
class Newsletters extends Forms{	
	public static function subscribe(){
	
		$newsletterMail = "";
		$response = self::$response;
		self::validateAjaxRequest();
		if(isset($_POST['email']) && $_POST != NULL){
			$newsletterMail = post('email');		
		
			if(!$newsletterMail || $newsletterMail == ""){			
				
				$response = [
						'status' => 'not-ok',
						'message' => 'Please, enter email address.',
				];
				
			}else{
				
				if(!self::checkIfAlreadySubscribed($newsletterMail)){
					if(self::recordData($newsletterMail)){
						
						$response = [
								'status' => 'ok',
								'message' => 'You\'ve been successfully subscribed.',
						];
				
					
					}
					
				}else if(self::checkIfUnSubscribed($newsletterMail)){
					if(self::reSubscribeUser($newsletterMail)){
						$response = [
								'status' => 'ok',
								'message' => 'You\'ve been successfully re-subscribed.',
						];
					}
					
				}else{
					
					$response = [
							'status' => 'ok',
							'message' => 'You\'ve been successfully re-subscribed.',
					];
					
				}
				
			}
		
		}
		
		echo json_encode($response);
		
	}
	
	public static function recordData($newsletterMail){		
		$data = [
		   'email' 			=> $newsletterMail,
		   'date' 			=> date('Y-m-d H:i:s'),
		   'active_status' 	=> '1'					   
	    ];
		
		return Tables::get('newsletter_subscribers')->postEntry($data);
		
	}
	
	public static function checkIfAlreadySubscribed($newsletterMail){		
		$result = PDO_DB::selectOne("SELECT COUNT(id) AS count FROM newsletter_subscribers WHERE email = ? LIMIT 1", [$newsletterMail]);
		return $result['count'] > 0;
	}
	
	public static function checkIfUnSubscribed($newsletterMail){		
		$result = PDO_DB::selectOne("SELECT COUNT(id) AS count FROM newsletter_subscribers WHERE email = ? AND active_status = '0' LIMIT 1", [$newsletterMail]);
		return $result['count'] > 0;
	}
	
	
	public static function reSubscribeUser($newsletterMail){		
		return Tables::get('newsletter_subscribers')->updateEntryByColumns([
			'active_status' => 1
		], [
			'email' => $newsletterMail
		]);
	}
	
	public static function setup_table(){
		
		self::$tableSqls[] = "CREATE TABLE IF NOT EXISTS newsletter_subscribers(
			id int(18) NOT NULL auto_increment,	
			email varchar(180) NOT NULL default '0',
			day varchar(2) NULL,
			week varchar(2) NULL,
			month varchar(2) NULL,
			year varchar(4) NULL,
			active_status ENUM('0', '1') NOT NULL default '0',
			date datetime NOT NULL default '0000-00-00 00:00:00',
			
			PRIMARY KEY(id)			
		)";
		
		self::runTableSetups();
		
	}
}

?>