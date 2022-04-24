<?php

/*
//
//	STEPS for PIN Transactions:
//	1. Call payviacard/payViaCard/pay_via_card to initialize card payment
//	2. Next -> call validatePaymentPIN after you have to collect PIN form 
//	   user to validate payment
//	3. Next -> call validatePaymentOTP after you have to collect PIN form 
//	   user to verify and finalize payment payment


//	NOTE: 
//	Call verifyPayment immediately after every successful transaction to 
//	ensure there is nothing fishy
//	When you call verifyPayment, you get the charge token stored in 
//		self::$cardData
//	Call ChargeWithToken for recurrent billing;  Aka charge with Token. 
//		Docs Url -> https://developer.flutterwave.com/reference#charge-with-token
//		API Endpoint Url -> https://api.ravepay.co/flwv3-pug/getpaidx/api/tokenized/charge
//	Call refund for payment refund. 
//		Docs Url -> https://developer.flutterwave.com/reference#refundpost
//		API Endpoint Url -> https://api.ravepay.co/gpx/merchant/transactions/refund
//
*/

$sandbox_endpoint 	= 'https://ravesandboxapi.flutterwave.com';
$live_endpoint 		= 'https://api.ravepay.co';

define('LIVE_PUBLIC_KEY', 'FLWPUBK-5d037e99b1b4c09e37a50fa7255e93bc-X');
define('LIVE_SECRET_KEY', 'FLWSECK-7ddb8ceb87b5b4f480799b151c8af300-X');
define('LIVE_ENCRIPTION_KEY', '7ddb8ceb87b59c9df928c23d');

define('TEST_PUBLIC_KEY', 'FLWPUBK_TEST-b7ae4e86927d43f4f5d28a110ff48d34-X');
define('TEST_SECRET_KEY', 'FLWSECK_TEST-7b0631858baef789e7dddcbc121f70ec-X');
define('TEST_ENCRIPTION_KEY', 'FLWSECK_TEST8596fa284ba7');




define('LIVE_CARD_PAYMENT_ENDPOINT', $live_endpoint  . '/flwv3-pug/getpaidx/api/charge');
define('TEST_CARD_PAYMENT_ENDPOINT', $sandbox_endpoint . '/flwv3-pug/getpaidx/api/charge');

define('TEST_CHARGE_VALIDATION_ENDPOINT', $sandbox_endpoint  . '/flwv3-pug/getpaidx/api/validatecharge');
define('LIVE_CHARGE_VALIDATION_ENDPOINT', $live_endpoint  . '/flwv3-pug/getpaidx/api/validatecharge');


define('RAVE_FEE_ENDPOINT', $live_endpoint  . '/flwv3-pug/getpaidx/api/fee');

define('TEST_PAYMENT_VERIFICATION_ENDPOINT', $sandbox_endpoint  . '/flwv3-pug/getpaidx/api/v2/verify');
define('LIVE_PAYMENT_VERIFICATION_ENDPOINT', $live_endpoint  . '/flwv3-pug/getpaidx/api/v2/verify');

define('LIVE_TOKENIZED_CHARGE_ENDPOINT', $live_endpoint  . '/flwv3-pug/getpaidx/api/tokenized/charge');
define('TEST_TOKENIZED_CHARGE_ENDPOINT', $sandbox_endpoint  . '/flwv3-pug/getpaidx/api/tokenized/charge');

define('LIVE_REFUND_ENDPOINT', $live_endpoint  . '/gpx/merchant/transactions/refund');
define('TEST_REFUND_ENDPOINT', $sandbox_endpoint  . '/gpx/merchant/transactions/refund');


define('LIVE_TOKENIZED_PREAUTH_CHARGE_ENDPOINT', $live_endpoint  . '/flwv3-pug/getpaidx/api/tokenized/preauth_charge');
define('TEST_TOKENIZED_PREAUTH_CHARGE_ENDPOINT', $sandbox_endpoint  . '/flwv3-pug/getpaidx/api/tokenized/preauth_charge');

define('LIVE_PAYMENT_PLAN_ENDPOINT', $live_endpoint  . '/v2/gpx/paymentplans/create');
define('TEST_PAYMENT_PLAN_ENDPOINT', $sandbox_endpoint  . '/v2/gpx/paymentplans/create');


define('LIVE_TOKEN_EMAIL_UPDATE_ENDPOINT', $live_endpoint  . '/v2/gpx/tokens/embed_token/update_customer');
define('TEST_TOKEN_EMAIL_UPDATE_ENDPOINT', $sandbox_endpoint  . '/v2/gpx/tokens/embed_token/update_customer');

define('ACCOUNT_VERIFICATION_ENDPOINT', $live_endpoint  . '/flwv3-pug/getpaidx/api/resolve_account');




class FlutterwaveRave{
	public static $mode 			= 'test';
	public static $currency 		= 'NGN';
	public static $country 			= 'NG';	
	public static $redirectUrl 		= '';	
	public static $txRef 			= '';	
	public static $chargeType 		= '';	
	public static $deviceFingerprint= '';	
	public static $paymentPlan 		= '';	
	public static $subaccounts 		= [];	
	public static $card6 			= '';	
	public static $ptype 			= '';	
	public static $data 			= [];
	public static $cardData 		= [];
	public static $tokenCargeFee 	= 50;
	public static $meta 			= '';
	
	public static function _payViaCard($firstname, $lastname, $phonenumber, $cardno, $cvv, $amount, $expiryyear, $expirymonth, $email, $success_callback = '', $error_callback = ''){
		self::payviacard($firstname, $lastname, $phonenumber, $cardno, $cvv, $amount, $expiryyear, $expirymonth, $email, $success_callback, $error_callback);	
	}
	
	public static function pay_via_card($firstname, $lastname, $phonenumber, $cardno, $cvv, $amount, $expiryyear, $expirymonth, $email, $success_callback = '', $error_callback = ''){
		self::payviacard($firstname, $lastname, $phonenumber, $cardno, $cvv, $amount, $expiryyear, $expirymonth, $email, $success_callback, $error_callback);	
	}
	
	public static function payviacard($firstname, $lastname, $phonenumber, $cardno, $cvv, $amount, $expiryyear, $expirymonth, $email, $success_callback = '', $error_callback = ''){ // set up a function to test card payment.
		
		error_reporting(E_ALL);
		ini_set('display_errors',1);
		
		$tx_ref = self::getTransactionRef();		
		$pubKey = self::$mode == 'test' ? TEST_PUBLIC_KEY : LIVE_PUBLIC_KEY;
		
		self::$data = [
			'PBFPubKey'   => $pubKey,
			'cardno' 	  => $cardno,
			'currency' 	  => self::$currency,
			'country' 	  => self::$country,
			'cvv' 		  => $cvv,
			'amount' 	  => $amount,
			'expiryyear'  => $expiryyear,
			'expirymonth' => $expirymonth,	
			'firstname'   => $firstname,
			'lastname' 	  => $lastname,
			'phonenumber' => $phonenumber,
			'email' 	  => $email,
			'IP' 		  => Utilities::getUserIp(),
			'txRef' 	  => $tx_ref
		];
		
		if(self::$chargeType != ''){
			self::$data['charge_type'] = self::$chargeType;
		}
		
		if(count(self::$subaccounts) > 0){
			self::$data['subaccounts'] = self::$subaccounts;
		}
		
		if(self::$deviceFingerprint != ''){
			self::$data['device_fingerprint'] = self::$deviceFingerprint;
		}
		
		if(self::$paymentPlan != ''){
			self::$data['payment_plan'] = self::$paymentPlan;
		}
		
		$SecKey  = self::$mode == 'test' ? TEST_SECRET_KEY : LIVE_SECRET_KEY;		
		$key 	 = self::getKey($SecKey);		
		$dataReq = json_encode(self::$data);		
		$post_enc = self::encrypt3Des( $dataReq, $key );

		// var_dump($dataReq);
		
		$postdata = [
			'PBFPubKey'  => $pubKey,
			'client' 	 => $post_enc,
			'alg' 		 => '3DES-24'
		];
		
		$ch 		= curl_init();
		$end_point 	= self::$mode == 'test' ? TEST_CARD_PAYMENT_ENDPOINT : LIVE_CARD_PAYMENT_ENDPOINT;
		curl_setopt($ch, CURLOPT_URL, $end_point);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($postdata)); //Post Fields
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 200);
		curl_setopt($ch, CURLOPT_TIMEOUT, 200);
		
		
		$headers = array('Content-Type: application/json');		
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);		
		$request 	= curl_exec($ch);
		$curl_error = curl_error($ch);
		$curl_errno = curl_errno($ch);
		curl_close($ch);
		
		if($request){
			$request = json_decode($request, true);
			if($success_callback != ''){
				call_user_func($success_callback, $request);
				
			}else{
				echo '<pre>';
				print_r($request);
				echo '</pre>';				
			}
			
		}else{
			
			if($curl_errno > 0){
				if($error_callback != ''){
					call_user_func($error_callback, $curl_errno);
				}else{
					echo self::getCurlErrorCodes($curl_errno);
				}
			}
		}
		
	}
	
	/*
	//	@param $accountbank_code
	//	At the moment, banks available for USSD payments (and their numeric codes) are: 
	//		Fidelity Bank (070), 
	//		Guaranty Trust Bank (058), 
	//		Keystone Bank (082), 
	//		Sterling Bank (232), 
	//		United Bank for Africa (033), 
	//		Unity Bank (215), 
	//		and Zenith Bank (057).
	//
	*/
	
	
	public static function payViaUSSD($accountbank_code, $amount, $email, $phonenumber, $firstname, $lastname, $success_callback = '', $error_callback = ''){ 
		
		error_reporting(E_ALL);
		ini_set('display_errors',1);
		
		$tx_ref = self::getTransactionRef();		
		$pubKey = self::$mode == 'test' ? TEST_PUBLIC_KEY : LIVE_PUBLIC_KEY;
		
		
		
		self::$data = [
		
			"PBFPubKey" 	=> $pubKey,
			"accountbank" 	=> $accountbank_code,
			"currency" 		=> self::$currency,
			"country" 		=> self::$country,
			"amount" 		=> $amount,
			"email" 		=> $email,
			"phonenumber" 	=> $phonenumber,
			"firstname" 	=> $firstname,
			"lastname" 		=> lastname,
			"IP" 			=> Utilities::getUserIp(),
			"is_ussd" 		=> 1,
			"payment_type" 	=> "USSD",
			"txRef" 		=> $tx_ref,
			"orderRef" 		=> $tx_ref . '_' . mt_rand(100000, 999999)
			
		];
		
		
		
		
		if(self::$deviceFingerprint != ''){
			self::$data['device_fingerprint'] = self::$deviceFingerprint;
		}
		
		if(self::$meta != ''){
			self::$data['meta'] = self::$meta;
		}
		
		$SecKey  = self::$mode == 'test' ? TEST_SECRET_KEY : LIVE_SECRET_KEY;		
		$key 	 = self::getKey($SecKey);		
		$dataReq = json_encode(self::$data);		
		$post_enc = self::encrypt3Des( $dataReq, $key );

		// var_dump($dataReq);
		
		$postdata = [
			'PBFPubKey'  => $pubKey,
			'client' 	 => $post_enc,
			'alg' 		 => '3DES-24'
		];
		
		$ch 		= curl_init();
		$end_point 	= self::$mode == 'test' ? TEST_CARD_PAYMENT_ENDPOINT : LIVE_CARD_PAYMENT_ENDPOINT;
		curl_setopt($ch, CURLOPT_URL, $end_point);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($postdata)); //Post Fields
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 200);
		curl_setopt($ch, CURLOPT_TIMEOUT, 200);
		
		
		$headers = array('Content-Type: application/json');		
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);		
		$request 	= curl_exec($ch);
		$curl_error = curl_error($ch);
		$curl_errno = curl_errno($ch);
		curl_close($ch);
		
		if($request){
			$request = json_decode($request, true);
			if($success_callback != ''){
				call_user_func($success_callback, $request);
				
			}else{
				echo '<pre>';
				print_r($request);
				echo '</pre>';				
			}
			
		}else{
			
			if($curl_errno > 0){
				if($error_callback != ''){
					call_user_func($error_callback, $curl_errno);
				}else{
					echo self::getCurlErrorCodes($curl_errno);
				}
			}
		}
		
	}
	
	
	
	
	public static function validatePaymentPIN($pin, $data, $success_callback = '', $error_callback = ''){ // set up a function to test card payment.
			
		$payload_data = $data ;
		$payload_data['suggested_auth'] = 'PIN' ;
		$payload_data['pin'] = $pin ;
		$payload_data['merchantbearsfee'] = 0 ;
		
		
			
		$SecKey  = self::$mode == 'test' ? TEST_SECRET_KEY : LIVE_SECRET_KEY;
		$pubKey  = self::$mode == 'test' ? TEST_PUBLIC_KEY : LIVE_PUBLIC_KEY;
		$key 	 = self::getKey($SecKey);		
		$dataReq = json_encode($payload_data);
		
		$post_enc = self::encrypt3Des( $dataReq, $key );
		
		$postdata = [
			'PBFPubKey'  => $pubKey,
			'client' 	 => $post_enc,
			'alg' 		 => '3DES-24'
		];
		
		$ch 		= curl_init();
		$end_point 	= self::$mode == 'test' ? TEST_CARD_PAYMENT_ENDPOINT : LIVE_CARD_PAYMENT_ENDPOINT;
		curl_setopt($ch, CURLOPT_URL, $end_point);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($postdata));
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 200);
		curl_setopt($ch, CURLOPT_TIMEOUT, 200);
		
		
		$headers = array('Content-Type: application/json');		
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);		
		$request 	= curl_exec($ch);
		$curl_errno = curl_errno($ch);
		curl_close($ch);
		
		if($request){
			$request = json_decode($request, true);
			if($success_callback != ''){
				call_user_func($success_callback, $request);
				
			}else{
				echo '<pre>';
				print_r($request);
				echo '</pre>';				
			}
			
		}else{
			
			if($curl_errno > 0){
				if($error_callback != ''){
					call_user_func($error_callback, $curl_errno);
				}else{
					echo self::getCurlErrorCodes($curl_errno);
				}
			}
		}
		
		
		
	}
	
	
	
	public static function validatePaymentOTP($otp, $transaction_reference, $success_callback = '', $error_callback = ''){ // set up a function to test card payment.
			
		$SecKey  = self::$mode == 'test' ? TEST_SECRET_KEY : LIVE_SECRET_KEY;
		$pubKey  = self::$mode == 'test' ? TEST_PUBLIC_KEY : LIVE_PUBLIC_KEY;
		$key 	 = self::getKey($SecKey);		
		
		
		$postdata = [
			'PBFPubKey'  			=> $pubKey,
			'transaction_reference' => $transaction_reference,
			'otp' 		 			=> $otp
		];
		
		
		
		$ch 		= curl_init();
		$end_point 	= self::$mode == 'test' ? TEST_CHARGE_VALIDATION_ENDPOINT : LIVE_CHARGE_VALIDATION_ENDPOINT;
		curl_setopt($ch, CURLOPT_URL, $end_point);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($postdata)); 
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 200);
		curl_setopt($ch, CURLOPT_TIMEOUT, 200);
		
		
		$headers = array('Content-Type: application/json');		
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);		
		$request 	= curl_exec($ch);
		$curlError 	= curl_error($ch);
		$curl_errno = curl_errno($ch);
		curl_close($ch);
		// Utilities::debug_array($request);
		if($request){
			$request = json_decode($request, true);
			if($success_callback != ''){
				call_user_func($success_callback, $request);
				
			}
			
		}else{
			if($curl_errno > 0){
				if($error_callback != ''){
					call_user_func($error_callback, $curl_errno);
				}else{
					echo self::getCurlErrorCodes($curl_errno);
				}
			}
		}
		
	}
	
	
	public static function processValidatedCardData($gatewayresponse, $success_callback, $error_callback){
		$gateway_response = json_decode($gatewayresponse);
		
		if($gateway_response->status != 'error'){
			call_user_func($success_callback, $gateway_response);
			
		}else{
			call_user_func($error_callback, $gateway_response);
			
		}		
	}
	
	
	
	
	
	
	public static function payViaAVSCard($data, $success_callback = '', $error_callback = ''){ // set up a function to test card payment.
			
		$SecKey  = self::$mode == 'test' ? TEST_SECRET_KEY : LIVE_SECRET_KEY;
		$pubKey  = self::$mode == 'test' ? TEST_PUBLIC_KEY : LIVE_PUBLIC_KEY;
		$key 	 = self::getKey($SecKey);		
		$dataReq = json_encode($data);
		
		$post_enc = self::encrypt3Des( $dataReq, $key );
		
		$postdata = [
			'PBFPubKey'  			=> $pubKey,
			'transaction_reference' => $transaction_reference,
			'otp' 		 			=> $otp
		];
		
		$ch 		= curl_init();
		$end_point 	= self::$mode == 'test' ? TEST_CARD_PAYMENT_ENDPOINT : LIVE_CARD_PAYMENT_ENDPOINT;
		
		curl_setopt($ch, CURLOPT_URL, $end_point);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($postdata)); 
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 200);
		curl_setopt($ch, CURLOPT_TIMEOUT, 200);
		
		
		$headers = array('Content-Type: application/json');		
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);		
		$request = curl_exec($ch);
		$curl_errno = curl_errno($ch);
		curl_close($ch);
		
		if($request){
			$request = json_decode($request, true);
			if($success_callback != ''){
				call_user_func($success_callback, $request);
				
			}else{
				echo '<pre>';
				print_r($request);
				echo '</pre>';				
			}
			
		}else{
			if($curl_errno > 0){
				if($error_callback != ''){
					call_user_func($error_callback, $curl_errno);
				}else{
					echo self::getCurlErrorCodes($curl_errno);
				}
			}
		}
		
	}
	
	
	
	
	
	public static function getChargeAmount($amount){
		$ch = curl_init(RAVE_FEE_ENDPOINT);
		
		$data = [
			'amount' 	=> $amount,
			'PBFPubKey' => LIVE_PUBLIC_KEY,
			'currency' 	=> self::$currency
		];
		
		if(self::$card6 != ''){
			self::$data['card6'] = self::$card6;
		}
		
		if(self::$ptype != ''){
			self::$data['ptype'] = self::$ptype;
		}
		
		$payload = json_encode(array("user" => $data));
		curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('content-type: application/json'));
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$result = curl_exec($ch);
		curl_close($ch);
		
		$jsonDecoded = json_encode($result);
		if($jsonDecoded != false){
			return $jsonDecoded;
		}
		return false;
		
	}
	
	
	public static function verifyPayment($txRef, $amount, $success_callback = '', $error_callback = ''){
		
		$SecKey  	= self::$mode == 'test' ? TEST_SECRET_KEY : LIVE_SECRET_KEY;
		$url  		= self::$mode == 'test' ? TEST_PAYMENT_VERIFICATION_ENDPOINT : LIVE_PAYMENT_VERIFICATION_ENDPOINT;
		
		$ref 		= $txRef; // Self generated transaction ref during payment initialization
		$amount 	= $amount; 
		$currency 	= self::$currency;

		$query = [
			"SECKEY" => $SecKey,
			"txref"  => $ref
		];

		$data_string 	= json_encode($query);		
		$ch 			= curl_init($url); 
		
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
		curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);                                              
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
		
		
		$response 		= curl_exec($ch);

		$header_size 	= curl_getinfo($ch, CURLINFO_HEADER_SIZE);
		$header 		= substr($response, 0, $header_size);
		$body 			= substr($response, $header_size);

		$curl_error 	= curl_error($ch);
		$curl_errno 	= curl_errno($ch);
		
		curl_close($ch);

		$resp = json_decode($response, true);
		
		$paymentData = [
			'payment_status' 	=> $resp['data']['status'],
			'charge_code' 		=> $resp['data']['chargecode'],
			'charge_amount' 	=> $resp['data']['amount'],
			'currency' 			=> $resp['data']['currency'],
		];
		

		if (($paymentData['charge_code'] == "00" || $paymentData['charge_code'] == "0") && ($paymentData['amount'] == $amount)  && ($paymentData['currency'] == $currency)) {
			
			self::$cardData 				= $resp['data']['card'];
			self::$cardData['payment_data'] = $paymentData;
			
			if($success_callback != ''){
				call_user_func($success_callback, $response);			
			}
				
			return true;
			
			
		} else {
			
			if($curl_errno > 0 && $error_callback != ''){
				call_user_func($error_callback, $response);
			}
			
			return false;
		
			
		}
		
	}
	
	// @$param $token -> "embedtoken": "flw-t0-f6f915f53a094671d98560272572993e-m03k"
	public static function chargeWithToken($token, $amount, $email, $txRef, $narration = '', $meta = '', $success_callback = '', $error_callback = ''){		
		
		$seckey  	= self::$mode == 'test' ? TEST_SECRET_KEY : LIVE_SECRET_KEY;
		$url  		= self::$mode == 'test' ? TEST_TOKENIZED_CHARGE_ENDPOINT : LIVE_TOKENIZED_CHARGE_ENDPOINT;		
		
		$query 		= [
		
			'SECKEY' 	=> $seckey,
			'token' 	=> $token,
			'currency' 	=> self::$currency,
			'amount' 	=> $amount + self::$tokenCargeFee,
			'email' 	=> $email,
			'txRef' 	=> $txRef,
			'meta' 		=> $meta, 	
			'narration' => $narration //	Payment Description
			
		];
		
		$data_string 	= json_encode($query);		
		$ch 			= curl_init($url); 
		
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
		curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);                                              
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
		
		
		$response 		= curl_exec($ch);
		$header_size 	= curl_getinfo($ch, CURLINFO_HEADER_SIZE);
		$header 		= substr($response, 0, $header_size);
		$body 			= substr($response, $header_size);

		$curl_error 	= curl_error($ch);
		$curl_errno 	= curl_errno($ch);
		
		curl_close($ch);
		$resp 			= json_decode($response, true);

		//	if ($resp['status'] == "success" ) {
		if ($resp->status == "success" ) {
			
			if($success_callback != ''){
				call_user_func($success_callback, $response);
			
			}else{
				return true;
			}
			
		} else {
			
			if($curl_errno > 0 && $error_callback != ''){
				call_user_func($error_callback, $curl_error, $response);
				
			}else{
				return false;
			}			
		}
		
	}
	
	// @$param $token -> "embedtoken": "flw-t0-f6f915f53a094671d98560272572993e-m03k"
	
	public static function chargeTokenizedPreAuthourizedCard($token, $amount, $email, $firstname, $lastname, $txRef, $narration = '', $meta = '', $success_callback = '', $error_callback = ''){		
		
		$SecKey  	= self::$mode == 'test' ? TEST_SECRET_KEY : LIVE_SECRET_KEY;
		$url  		= self::$mode == 'test' ? TEST_TOKENIZED_PREAUTH_CHARGE_ENDPOINT : LIVE_TOKENIZED_PREAUTH_CHARGE_ENDPOINT;		
		
		$query 		= [
		
			"SECKEY" 	=> $SecKey,
			"token" 	=> $token, // i.e. "flw-t1nf-404dff6823ff91ce154f04dd40085b9e-m03k"
			"currency" 	=> self::$currency,
			"country" 	=> self::$country,
			"amount" 	=> $amount,
			"email" 	=> $email,
			"firstname" => $firstname,
			"lastname" 	=> $lastname,
			"IP" 		=> Utilities::getUserIp(),
			"narration" => $narration,
			"txRef" 	=> $txRef,
			"meta" 		=> $meta
			
		];
		
		$data_string 	= json_encode($query);		
		$ch 			= curl_init($url); 
		
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
		curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);                                              
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
		
		
		$response 		= curl_exec($ch);
		$header_size 	= curl_getinfo($ch, CURLINFO_HEADER_SIZE);
		$header 		= substr($response, 0, $header_size);
		$body 			= substr($response, $header_size);

		$curl_error 	= curl_error($ch);
		$curl_errno 	= curl_errno($ch);
		
		curl_close($ch);
		$resp 			= json_decode($response, true);

		//	if ($resp['status'] == "success" ) {
		if ($resp->status == "success" ) {
			
			if($success_callback != ''){
				call_user_func($success_callback, $response);
			
			}else{
				return true;
			}
			
		} else {
			
			if($curl_errno > 0 && $error_callback != ''){
				call_user_func($error_callback, $curl_error, $response);
				
			}else{
				return false;
			}	
			
		}
		
		
	}
	
	public static function refund($flwRef, $amount, $success_callback = '', $error_callback = ''){
		$seckey  	= self::$mode == 'test' ? TEST_SECRET_KEY : LIVE_SECRET_KEY;
		$url  		= self::$mode == 'test' ? TEST_REFUND_ENDPOINT : LIVE_REFUND_ENDPOINT;		
		$query 		= [		
			'ref' 		=> $flwRef,
			'seckey' 	=> $seckey,
			'amount' 	=> $amount			
		];
		
		$data_string 	= json_encode($query);		
		$ch 			= curl_init($url); 
		
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
		curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);                                              
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);		
		
		$response 		= curl_exec($ch);
		$header_size 	= curl_getinfo($ch, CURLINFO_HEADER_SIZE);
		$header 		= substr($response, 0, $header_size);
		$body 			= substr($response, $header_size);

		$curl_error 	= curl_error($ch);
		$curl_errno 	= curl_errno($ch);
		
		curl_close($ch);
		$resp 			= json_decode($response, true);

		//	if ($resp['status'] == "success" ) {
		if ($resp->status == "success") {
			
			if($success_callback != ''){
				call_user_func($success_callback, $response);
			
			}else{
				return true;
			}
			
		} else {
			
			if($curl_errno > 0 && $error_callback != ''){
				call_user_func($error_callback, $curl_error, $response);
				
			}else{
				return false;
			}			
		}
		
	}
	
	
	public static function updateEmailWithToken($token, $secretKey, $new_email, $fullname = '', $phonenumber = '', $success_callback = '', $error_callback = ''){
		$seckey  	= self::$mode == 'test' ? TEST_SECRET_KEY : LIVE_SECRET_KEY;
		$url  		= self::$mode == 'test' ? TEST_TOKEN_EMAIL_UPDATE_ENDPOINT : LIVE_TOKEN_EMAIL_UPDATE_ENDPOINT;	
	
		$query 		= [		
			'ref' 			=> $flwRef,
			'secret_key'	=> $seckey,
			'email' 		=> $new_email			
		];
		
		if($fullname != ''){
			$query['fullname'] = $fullname;
		}
		
		if($phonenumber != ''){
			$query['phonenumber'] = $phonenumber;
		}
		
		$data_string 	= json_encode($query);		
		$ch 			= curl_init($url); 
		
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
		curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);                                              
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);		
		
		$response 		= curl_exec($ch);
		$header_size 	= curl_getinfo($ch, CURLINFO_HEADER_SIZE);
		$header 		= substr($response, 0, $header_size);
		$body 			= substr($response, $header_size);

		$curl_error 	= curl_error($ch);
		$curl_errno 	= curl_errno($ch);
		
		curl_close($ch);
		$resp 			= json_decode($response, true);

		//	if ($resp['status'] == "success") {
		if ($resp->status == "success") {
			
			if($success_callback != ''){
				call_user_func($success_callback, $response);
			
			}else{
				return true;
			}
			
		} else {
			
			if($curl_errno > 0 && $error_callback != ''){
				call_user_func($error_callback, $curl_error, $response);
				
			}else{
				return false;
			}			
		}
		
	}
	
	/*
	//
	//	@param $interval
	//		daily;
	//		weekly;
	//		monthly;
	//		yearly;
	//		quarterly;
	//		bi-anually;
	//		every 2 days;
	//		every 90 days;
	//		every 5 weeks;
	//		every 12 months;
	//		every 6 years;
	//		every x y (where x is a number and y is the period e.g. every 5 months)
	//		e.g. interval: "daily"
	//
	//
	//	@param $duration
	//		This is the frequency, it is numeric, e.g. if set to 5 and intervals is 
	//		set to monthly you would be charged 5 months, and then the subscription 
	//		stops.
	//
	*/
	
	public static function createPaymentPlan($amount, $name, $interval = 'monthly', $duration = ''){
		$seckey  	= self::$mode == 'test' ? TEST_SECRET_KEY : LIVE_SECRET_KEY;
		$url  		= self::$mode == 'test' ? TEST_PAYMENT_PLAN_ENDPOINT : LIVE_PAYMENT_PLAN_ENDPOINT;	
	
		$query 		= [		
			'amount' 	=> $amount,
			'name'		=> $name,
			'interval' 	=> $interval,			
			'duration' 	=> $duration,			
			'seckey' 	=> $seckey		
		];
		
		if($fullname != ''){
			$query['fullname'] = $fullname;
		}
		
		if($phonenumber != ''){
			$query['phonenumber'] = $phonenumber;
		}
		
		$data_string 	= json_encode($query);		
		$ch 			= curl_init($url); 
		
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
		curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);                                              
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);		
		
		$response 		= curl_exec($ch);
		$header_size 	= curl_getinfo($ch, CURLINFO_HEADER_SIZE);
		$header 		= substr($response, 0, $header_size);
		$body 			= substr($response, $header_size);

		$curl_error 	= curl_error($ch);
		$curl_errno 	= curl_errno($ch);
		
		curl_close($ch);
		$resp 			= json_decode($response, true);

		//	if ($resp['status'] == "success") {
		if ($resp->status == "success") {
			
			if($success_callback != ''){
				call_user_func($success_callback, $response);
			
			}else{
				return true;
			}
			
		} else {
			
			if($curl_errno > 0 && $error_callback != ''){
				call_user_func($error_callback, $curl_error, $response);
				
			}else{
				return false;
			}			
		}
	}
	
	
	public static function chargeSubscription($cardno, $cvv, $expirymonth, $expiryyear, $payment_plan, $amount, $email, $phonenumber, $firstname, $lastname, $success_callback = '', $error_callback = ''){
		$seckey  	= self::$mode == 'test' ? TEST_SECRET_KEY : LIVE_SECRET_KEY;
		$url  		= self::$mode == 'test' ? TEST_CARD_PAYMENT_ENDPOINT : LIVE_CARD_PAYMENT_ENDPOINT;	
		$pubKey  	= self::$mode == 'test' ? TEST_PUBLIC_KEY : LIVE_PUBLIC_KEY;
		
		$tx_ref 	= self::getTransactionRef();
		
		self::$data = [
		
			"PBFPubKey" 	=> $pubKey,
			"cardno" 		=> $cardno,
			"cvv" 			=> $cvv,
			"expirymonth" 	=> $expirymonth,
			"expiryyear" 	=> $expiryyear,
			"currency" 		=> self::$currency,
			"country" 		=> self::$country,
			"payment_plan" 	=> $payment_plan,
			"amount" 		=> $amount,
			"email" 		=> $email,
			"phonenumber" 	=> $phonenumber,
			"firstname" 	=> $firstname,
			"lastname" 		=> $lastname,
			"IP" 			=> Utilities::getUserIp(),
			"txRef"			=> $tx_ref
			
		];
		
		
		if(self::$meta != ''){
			//	Example -> [{metaname: "flightID", metavalue: "123949494DC"}]
			self::$data['meta'] = self::$meta;
		}
		
		if(self::$redirectUrl != ''){
			self::$data['redirect_url'] = self::$redirectUrl;
		}
		
		if(self::$deviceFingerprint != ''){
			self::$data['device_fingerprint'] = self::$deviceFingerprint;
		}
		
		
		
		$key 	  = self::getKey($seckey);
		$dataReq  = json_encode(self::$data);		
		$post_enc = self::encrypt3Des( $dataReq, $key );

		
		
		$postdata = [
			'PBFPubKey'  => $pubKey,
			'client' 	 => $post_enc,
			'alg' 		 => '3DES-24'
		];
		
		$ch 		= curl_init();
		
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($postdata)); //Post Fields
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 200);
		curl_setopt($ch, CURLOPT_TIMEOUT, 200);
		
		
		$headers = array('Content-Type: application/json');		
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);		
		$request 	= curl_exec($ch);
		$curl_error = curl_error($ch);
		$curl_errno = curl_errno($ch);
		curl_close($ch);
		
		if($request){
			$request = json_decode($request, true);
			if($success_callback != ''){
				call_user_func($success_callback, $request);
				
			}else{
				echo '<pre>';
				print_r($request);
				echo '</pre>';				
			}
			
		}else{
			
			if($curl_errno > 0){
				if($error_callback != ''){
					call_user_func($error_callback, $curl_errno);
				}else{
					echo self::getCurlErrorCodes($curl_errno);
				}
			}
		}
	}
	
	public static function webhook($success_callback = '', $error_callback = ''){
		$seckey  	= self::$mode == 'test' ? TEST_SECRET_KEY : LIVE_SECRET_KEY;
		$body 		= @file_get_contents("php://input");		
		$signature 	= (isset($_SERVER['HTTP_VERIF_HASH']) ? $_SERVER['HTTP_VERIF_HASH'] : '');


		if (!$signature) {			
			exit();
		}		
		
		if( $signature !== $seckey ){
		  exit();
		}

		http_response_code(200); // PHP 5.4 or greater
		
		$response = json_decode($body);
		if ($response->status == 'successful') {			
			if($success_callback != ''){
				call_user_func($success_callback, $body);
				
			}
			
		}else{
			if($error_callback != ''){
				call_user_func($error_callback, $body);
			}
			
		}
		exit();
	}
	
	
	public static function getKey($seckey){
		
		$hashedkey 				= md5($seckey);
		$hashedkeylast12 		= substr($hashedkey, -12);
		$seckeyadjusted 		= str_replace("FLWSECK-", "", $seckey);
		$seckeyadjustedfirst12 	= substr($seckeyadjusted, 0, 12);
		$encryptionkey 			= $seckeyadjustedfirst12.$hashedkeylast12;
		
		return $encryptionkey;

	}


	public static function encrypt3Des($data, $key) {
		$encData = openssl_encrypt($data, 'DES-EDE3', $key, OPENSSL_RAW_DATA);
		return base64_encode($encData);
	}

	
	
	public static function setTransactionRef() {
		self::$txRef = strtoupper(hash('crc32', time()));
	}

	
	public static function getTransactionRef() {
		self::setTransactionRef();
		return self::$txRef;
	}

	
	public static function setRedirectUrl($redirectUrl = '') {
		self::$redirectUrl = $redirectUrl != '' ? $redirectUrl : '/';		
	}

	public static function getRedirectUrl($redirectUrl = '') {
		self::setRedirectUrl($redirectUrl);
		return self::$redirectUrl;		
	}
	
	
	public static function getCurlErrorCodes($codeNumber){
		$curl_error_codes 	 = [];
		$curl_error_codes[1] = 'CURLE_UNSUPPORTED_PROTOCOL';
		$curl_error_codes[2] = 'CURLE_FAILED_INIT';
		$curl_error_codes[3] = 'CURLE_URL_MALFORMAT';
		$curl_error_codes[4] = 'CURLE_URL_MALFORMAT_USER';
		$curl_error_codes[5] = 'CURLE_COULDNT_RESOLVE_PROXY';
		$curl_error_codes[6] = 'CURLE_COULDNT_RESOLVE_HOST';
		$curl_error_codes[7] = 'CURLE_COULDNT_CONNECT';
		$curl_error_codes[8] = 'CURLE_FTP_WEIRD_SERVER_REPLY';
		$curl_error_codes[9] = 'CURLE_REMOTE_ACCESS_DENIED';
		$curl_error_codes[11] = 'CURLE_FTP_WEIRD_PASS_REPLY';
		$curl_error_codes[13] = 'CURLE_FTP_WEIRD_PASV_REPLY';
		$curl_error_codes[14]='CURLE_FTP_WEIRD_227_FORMAT';
		$curl_error_codes[15] = 'CURLE_FTP_CANT_GET_HOST';
		$curl_error_codes[17] = 'CURLE_FTP_COULDNT_SET_TYPE';
		$curl_error_codes[18] = 'CURLE_PARTIAL_FILE';
		$curl_error_codes[19] = 'CURLE_FTP_COULDNT_RETR_FILE';
		$curl_error_codes[21] = 'CURLE_QUOTE_ERROR';
		$curl_error_codes[22] = 'CURLE_HTTP_RETURNED_ERROR';
		$curl_error_codes[23] = 'CURLE_WRITE_ERROR';
		$curl_error_codes[25] = 'CURLE_UPLOAD_FAILED';
		$curl_error_codes[26] = 'CURLE_READ_ERROR';
		$curl_error_codes[27] = 'CURLE_OUT_OF_MEMORY';
		$curl_error_codes[28] = 'CURLE_OPERATION_TIMEDOUT';
		$curl_error_codes[30] = 'CURLE_FTP_PORT_FAILED';
		$curl_error_codes[31] = 'CURLE_FTP_COULDNT_USE_REST';
		$curl_error_codes[33] = 'CURLE_RANGE_ERROR';
		$curl_error_codes[34] = 'CURLE_HTTP_POST_ERROR';
		$curl_error_codes[35] = 'CURLE_SSL_CONNECT_ERROR';
		$curl_error_codes[36] = 'CURLE_BAD_DOWNLOAD_RESUME';
		$curl_error_codes[37] = 'CURLE_FILE_COULDNT_READ_FILE';
		$curl_error_codes[38] = 'CURLE_LDAP_CANNOT_BIND';
		$curl_error_codes[39] = 'CURLE_LDAP_SEARCH_FAILED';
		$curl_error_codes[41] = 'CURLE_FUNCTION_NOT_FOUND';
		$curl_error_codes[42] = 'CURLE_ABORTED_BY_CALLBACK';
		$curl_error_codes[43] = 'CURLE_BAD_FUNCTION_ARGUMENT';
		$curl_error_codes[45] = 'CURLE_INTERFACE_FAILED';
		$curl_error_codes[47] = 'CURLE_TOO_MANY_REDIRECTS';
		$curl_error_codes[48] = 'CURLE_UNKNOWN_TELNET_OPTION';
		$curl_error_codes[49] = 'CURLE_TELNET_OPTION_SYNTAX';
		$curl_error_codes[51] = 'CURLE_PEER_FAILED_VERIFICATION';
		$curl_error_codes[52] = 'CURLE_GOT_NOTHING';
		$curl_error_codes[53] = 'CURLE_SSL_ENGINE_NOTFOUND';
		$curl_error_codes[54] = 'CURLE_SSL_ENGINE_SETFAILED';
		$curl_error_codes[55] = 'CURLE_SEND_ERROR';
		$curl_error_codes[56] = 'CURLE_RECV_ERROR';
		$curl_error_codes[58] = 'CURLE_SSL_CERTPROBLEM';
		$curl_error_codes[59] = 'CURLE_SSL_CIPHER';
		$curl_error_codes[60] = 'CURLE_SSL_CACERT';
		$curl_error_codes[61] = 'CURLE_BAD_CONTENT_ENCODING';
		$curl_error_codes[62] = 'CURLE_LDAP_INVALID_URL';
		$curl_error_codes[63] = 'CURLE_FILESIZE_EXCEEDED';
		$curl_error_codes[64] = 'CURLE_USE_SSL_FAILED';
		$curl_error_codes[65] = 'CURLE_SEND_FAIL_REWIND';
		$curl_error_codes[66] = 'CURLE_SSL_ENGINE_INITFAILED';
		$curl_error_codes[67] = 'CURLE_LOGIN_DENIED';
		$curl_error_codes[68] = 'CURLE_TFTP_NOTFOUND';
		$curl_error_codes[69] = 'CURLE_TFTP_PERM';
		$curl_error_codes[70] = 'CURLE_REMOTE_DISK_FULL';
		$curl_error_codes[71] = 'CURLE_TFTP_ILLEGAL';
		$curl_error_codes[72] = 'CURLE_TFTP_UNKNOWNID';
		$curl_error_codes[73] = 'CURLE_REMOTE_FILE_EXISTS';
		$curl_error_codes[74] = 'CURLE_TFTP_NOSUCHUSER';
		$curl_error_codes[75] = 'CURLE_CONV_FAILED';
		$curl_error_codes[76] = 'CURLE_CONV_REQD';
		$curl_error_codes[77] = 'CURLE_SSL_CACERT_BADFILE';
		$curl_error_codes[78] = 'CURLE_REMOTE_FILE_NOT_FOUND';
		$curl_error_codes[79] = 'CURLE_SSH';
		$curl_error_codes[80] = 'CURLE_SSL_SHUTDOWN_FAILED';
		$curl_error_codes[81] = 'CURLE_AGAIN';
		$curl_error_codes[82] = 'CURLE_SSL_CRL_BADFILE';
		$curl_error_codes[83] = 'CURLE_SSL_ISSUER_ERROR';
		$curl_error_codes[84] = 'CURLE_FTP_PRET_FAILED';
		$curl_error_codes[84] = 'CURLE_FTP_PRET_FAILED';
		$curl_error_codes[85] = 'CURLE_RTSP_CSEQ_ERROR';
		$curl_error_codes[86] = 'CURLE_RTSP_SESSION_ERROR';
		$curl_error_codes[87] = 'CURLE_FTP_BAD_FILE_LIST';
		$curl_error_codes[88] = 'CURLE_CHUNK_FAILED';
		
		return $curl_error_codes[$codeNumber];
	}
	
	
	public static function verifyBankAcount($recipientaccount, $destbankcode, $success = '', $error = ''){
		
		//	$PBFPubKey  = self::$mode == 'test' ? TEST_PUBLIC_KEY : LIVE_PUBLIC_KEY;
		$PBFPubKey  = LIVE_PUBLIC_KEY;
		$url  		= ACCOUNT_VERIFICATION_ENDPOINT;	
	
		$query 		= [	
		
			'recipientaccount' 	=> $recipientaccount,
			'destbankcode'		=> $destbankcode,
			'PBFPubKey' 		=> $PBFPubKey,			
			'currency' 			=> self::$currency,			
			'country' 			=> self::$country
			
		];
		
		
		$data_string 	= json_encode($query);		
		$ch 			= curl_init($url); 
		
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
		curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);                                              
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);		
		
		$response 		= curl_exec($ch);
		$header_size 	= curl_getinfo($ch, CURLINFO_HEADER_SIZE);
		$header 		= substr($response, 0, $header_size);
		$body 			= substr($response, $header_size);

		$curl_error 	= curl_error($ch);
		$curl_errno 	= curl_errno($ch);
		
		curl_close($ch);
		
		$resp 			= json_decode($response);
		
		//	Utilities::debug_array($resp);
		
		if ($resp->status == "success" && ($resp->data->data->responsecode != "RN0" || $resp->data->data->accountnumber != "null" || $resp->data->data->accountname != "null")) {
				
			$callResponse = [
				'responsecode' 	=> $resp->data->data->responsecode,  
				'accountnumber' => $resp->data->data->accountnumber,  
				'accountname' 	=> $resp->data->data->accountname,  
			];
			
			$callResponse = json_encode($callResponse);
			
			if($success != ''){
				call_user_func($success, $callResponse);
			
			}
			
			return $callResponse;
			
			
			
		} else {
			
			if($curl_errno > 0 && $error != ''){
				call_user_func($error, $curl_error);
				
			}
			
			return false;
			
			
		}
		
		
		/*
		
		SAMPLE SUCCESSFUL RESPONSE
		{
			"status": "success",
			"message": "ACCOUNT RESOLVED",
			"data": {
				"data": {
					"responsecode": "00",
					"accountnumber": "0690000034",
					"accountname": " EZE EKENE",
					"responsemessage": "Approved Or Completed Successfully",
					"phonenumber": null,
					"uniquereference": "1583918729383-254",
					"internalreference": null
				},
				"status": "success"
			}
		}
		
		
		SAMPLE FAILED RESPONSE
		
		{
			"status": "success",
			"message": "ACCOUNT RESOLVED",
			"data": {
				"data": {
					"responsecode": "RN0",
					"accountnumber": null,
					"accountname": null,
					"responsemessage": "Error/Invalid Account!",
					"phonenumber": null,
					"uniquereference": "1583918466533-202",
					"internalreference": null
				},
				"status": "success"
			}
		}
		
		
		
		*/
	}
	
	
	public static function  preAuth($token, $amount, $email, $firstname, $lastname, $success_callback = '', $error_callback = ''){
		
		$txRef 	= self::setTransactionRef();
		$secKey = self::$mode == 'test' ? TEST_SECRET_KEY : LIVE_SECRET_KEY;
		$url  	= self::$mode == 'test' ? TEST_TOKENIZED_PREAUTH_CHARGE_ENDPOINT : LIVE_TOKENIZED_PREAUTH_CHARGE_ENDPOINT;		
		
		$data = [
			'currency' 	=> self::$currency,
			'SECKEY' 	=> $secKey,
			'token' 	=> $token,
			'country' 	=> self::$country,
			'amount' 	=> $amount,
			'email' 	=> $email,
			'firstname' => $firstname,
			'lastname' 	=> $lastname,
			'IP' 		=> Utilities::getUserIp(),
			'txRef' 	=> $txRef
		];
		
		$data 			= json_encode($data);;		
		$ch 			= curl_init($url); 
		
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
		curl_setopt($ch, CURLOPT_POSTFIELDS, $data);                                              
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);		
		
		$response 		= curl_exec($ch);
		$header_size 	= curl_getinfo($ch, CURLINFO_HEADER_SIZE);
		$header 		= substr($response, 0, $header_size);
		$body 			= substr($response, $header_size);

		$curl_error 	= curl_error($ch);
		$curl_errno 	= curl_errno($ch);
		
		curl_close($ch);		
		$resp 			= json_decode($response);
		
		if ($resp->status == "success" ) {
			if(self::verifyPreAuthCharge($txRef, $amount)){
				
				if($success_callback != ''){
					call_user_func($success_callback, $response);				
				}				
				return true;
				
			}
			
			return false;
			
			
		} else {
			
			if($curl_errno > 0 && $error_callback != ''){
				call_user_func($error_callback, $curl_error, $response);				
			}
			
			return false;
			
		}
		
	}
	
	
	public static function verifyPreAuthCharge($txref, $amount){
		
		$secKey  	= self::$mode == 'test' ? TEST_SECRET_KEY : LIVE_SECRET_KEY;
		$url  		= self::$mode == 'test' ? TEST_PAYMENT_VERIFICATION_ENDPOINT : LIVE_PAYMENT_VERIFICATION_ENDPOINT;
		

		$result = [];
		$postdata =  [
			'txref'  => $txref,
			'SECKEY' => $secKey,
		];

		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($postdata));  //Post Fields
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

		$headers = [
		  'Content-Type: application/json',
		];

		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

		$request = curl_exec ($ch);
		$err = curl_error($ch);

		if($err){
			// there was an error contacting rave
		  die('Curl returned error: ' . $err);
		}


		curl_close ($ch);
		$result = json_decode($request, true);

		if('error' == $result->status){
		  // there was an error from the API
		  die('API returned error: ' . $result->message);
		}

		if('successful' == $result->data->status && '00' == $result->data->chargecode && $amount == $result->data->amount){
		  // transaction was successful...
		  // please check other things like whether you already gave value for this ref
		  // If the amount and currency matches the expected amount and currency etc.
		  // if the email matches the customer who owns the product etc
		  // Give value	
		  
		  return true;
		  
		}
		
		return false;
		
	}



}




?>