<?php

trait FlutterwaveRaveStandard{
	
	public static $payerEmail; 
	public static $amount;	
	public static $txref;
	
	public static $PBFPubKey;
	public static $PBFPrivKey;
	public static $redirectUrl;		
	public static $paymentPlan;
	public static $currency 	= 'NGN'; 
	
	public static function setRedirectUrl($url){
		self::$redirectUrl = $url;
	}
	
	public static function setPayementPlan($plan){
		self::$paymentPlan = $plan;
	}

	public static function instantPay($amount, $payerEmail, $txref, $callback_function = ''){
		self::$amount 		= $amount;
		self::$payerEmail 	= $payerEmail;
		self::$txref 		= $txref;
		
		$curl = curl_init();
		curl_setopt_array($curl, array(
		
			CURLOPT_URL => "https://api.ravepay.co/flwv3-pug/getpaidx/api/v2/hosted/pay",
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_CUSTOMREQUEST => "POST",
			
			CURLOPT_POSTFIELDS => json_encode([
				'amount'		=> self::$amount,
				'customer_email'=> self::$payerEmail,
				'currency'		=> self::$currency,
				'txref'			=> self::$txref,
				'PBFPubKey'		=> $PBFPubKey,
				'redirect_url'	=> self::$redirect_url,
				'payment_plan'	=> self::$payment_plan
			]),
			
			CURLOPT_HTTPHEADER => [
				"content-type: application/json",
				"cache-control: no-cache"
			],
			
		));

		$response = curl_exec($curl);
		$err 	  = curl_error($curl);
		
		if($callback_function !='' && !$err){
			call_user_func($callback_function, json_decode($response));
		}

		if($err){
		  // there was an error contacting the rave API
		  Utilities::debug_array($err);
		  return false;
		  
		}else{
			return json_decode($response);
		
		}

	}
	
	public static function init_webhook($callback_function =''){
		//	putenv('SECRET_HASH', self::$PBFPrivKey);
		$_SERVER['SECRET_HASH'] = self::$PBFPrivKey;
		$body = @file_get_contents("php://input");
		$signature = (isset($_SERVER['verif-hash']) ? $_SERVER['verif-hash'] : '');
		if (!$signature) {			
			exit();
		}

		//	$local_signature = getenv('SECRET_HASH');
		$local_signature = $_SERVER['SECRET_HASH'];

		
		if( $signature !== $local_signature ){    
		  exit();
		}

		http_response_code(200);
		$response = json_decode($body);
		
		if ($response->body->status == 'successful') {
			# code...
			// TIP: you may still verify the transaction
					// before giving value.
			if($callback_function !=''){
				call_user_func($callback_function, $response);
			}

		}
		exit();


	}
}




?>