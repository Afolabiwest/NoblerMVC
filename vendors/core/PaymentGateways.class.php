<?php
class PaymentGateways{

	public static function getRaveBvnData($bvn, $live = true){
		
		// SAMPLE RESPONSE
		
		/* 
		
		{
			"status": "success",
			"message": "BVN-DETAILS",
			"data": {
				"bvn": "12345678901",
				"first_name": "Wendy",
				"middle_name": "Chucky",
				"last_name": "Rhoades",
				"date_of_birth": "01-01-1905",
				"phone_number": "08012345678",
				"registration_date": "01-01-1921",
				"enrollment_bank": "044",
				"enrollment_branch": "Idejo"
			}
		}


		*/
		
		$test_url  = 'https://ravesandboxapi.flutterwavw.com/v2/kyc/bvn';
		$live_url  = 'https://api.ravepay.co/v2/kyc/bvn';
		$end_point =  $live ? $live_url : $test_url;
		$end_point .= '/' . $bvn . '?seckey=' . Utilities::getConfigData('rave_seckey');
		
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $end_point);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		$res = curl_exec($ch);
		curl_close($ch);		
		return json_decode($res);
	}

	public static function getPaystackBvnData($bvn, $accountNumber, $bankCode, $live = true){
		// SAMPLE RESPONSE
		
		/* 
		
		{
		  "status": true,
		  "message": "BVN lookup successful",
		  "data": {
			"bvn": "000000000000",
			"is_blacklisted": false,
			"account_number": true
		  },
		  "meta": {
			"calls_this_month": 1,
			"free_calls_left": 9
		  }
		}

		*/
		
		$ch = curl_init(); 
		$url = "https://api.paystack.co/bvn/match";
		 
		// Array with the fields names and values.
		// The field names should match the field names in the form.
		
		$headers = [
			'Content-type: application/json',
			'Authorization: Bearer ' . Utilities::getConfigData('paystack_seckey')
		];
		curl_setopt($curlHandle, $headers);
		 
		$postData = [
		  'bvn' 			=> $bvn,
		  'account_number'  => $accountNumber,
		  'bank_code'    	=> $bankCode
		];
		 
		curl_setopt_array($ch,
		  array(
			CURLOPT_URL 			=> $url,
			CURLOPT_POST       		=> true,
			CURLOPT_POSTFIELDS 		=> $postData,
			CURLOPT_RETURNTRANSFER  => true,
			CURLOPT_HTTPHEADER  	=> $headers
		  )
		);
		 
		$data = curl_exec($ch);		 
		curl_close($ch);		 
		return json_decode($data);
		
	}
	
	public static function getPaystackNigeriaBankList($live = true){
		
		// SAMPLE RESPONSE
		
		/* 
		
		{
			"status":true
			"message":"Banks retrieved"
			"data":[
				0:{
					"name":"Access Bank"
					"slug":"access-bank"
					"code":"044"
					"longcode":"044150149"
					"gateway":"emandate"
					"pay_with_bank":false
					"active":true
					"is_deleted":NULL
					"country":"Nigeria"
					"currency":"NGN"
					"type":"nuban"
					"id":1
					"createdAt":"2016-07-14T10:04:29.000Z"
					"updatedAt":"2019-06-18T10:52:46.000Z"
				},
				1:{
					"name":"Access Bank (Diamond)"
					"slug":"access-bank-diamond"
					"code":"063"
					"longcode":"063150162"
					"gateway":"ibank"
					"pay_with_bank":false
					"active":true
					"is_deleted":NULL
					"country":"Nigeria"
					"currency":"NGN"
					"type":"nuban"
					"id":3
					"createdAt":"2016-07-14T10:04:29.000Z"
					"updatedAt":"2019-05-23T12:19:02.000Z"
				},
				
				2:{
					"name":"ALAT by WEMA"
					"slug":"alat-by-wema"
					"code":"035A"
					"longcode":"035150103"
					"gateway":"emandate"
					"pay_with_bank":true
					"active":true
					"is_deleted":NULL
					"country":"Nigeria"
					"currency":"NGN"
					"type":"nuban"
					"id":27
					"createdAt":"2017-11-15T12:21:31.000Z"
					"updatedAt":"2017-11-15T12:21:31.000Z"
				}
				
				...
			]
		}
		
		*/
		
		$test_url  = '';
		$live_url  = 'https://api.paystack.co/bank';
		$end_point =  $live ? $live_url : $test_url;
		
		$headers = [
			'Authorization: Bearer ' . Utilities::getConfigData('paystack_seckey')
		];
		
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $end_point);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
		$res = curl_exec($ch);
		curl_close($ch);		
		return json_decode($res);
	}
	
	public static function getRaveNigeriaDirectDebitBankList($live = true){
		
		// SAMPLE RESPONSE		
		/* 
			[
			  {
				"bankname": "ACCESS BANK NIGERIA",
				"bankcode": "044",
				"internetbanking": false
			  },
			  {
				"bankname": "ECOBANK NIGERIA PLC",
				"bankcode": "050",
				"internetbanking": false
			  }
			  
			  ...
			]
		*/
		
		$test_url  = '';
		$live_url  = 'https://api.ravepay.co/flwv3-pug/getpaidx/api/flwpbf-banks.js?json=1';
		$end_point =  $live ? $live_url : $test_url;
		
		$headers = [
			'Content-type: application/json'
		];
		
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $end_point);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
		$res = curl_exec($ch);
		curl_close($ch);		
		return json_decode($res);
	}
	
	public static function getRaveCashTransferBankList($country = 'NG', $live = true){
		
		// REQUIRED FIELDS		
		/* 
			pass either NG, GH, KE, UG, ZA or TZ to get list of banks in Nigeria, 
			Ghana, Kenya, Uganda, South Africa or Tanzania respectively.
		*/
		
		// SAMPLE RESPONSE
		
		/* 		
			{
			  "status": "success",
			  "message": "SUCCESS",
			  "data": {
				"Banks": [
				  {
					"Id": 132,
					"Code": "560",
					"Name": "Page MFBank"
				  },
				  {
					"Id": 133,
					"Code": "304",
					"Name": "Stanbic Mobile Money"
				  },
				  {
					"Id": 134,
					"Code": "308",
					"Name": "FortisMobile"
				  },
				  {
					"Id": 135,
					"Code": "328",
					"Name": "TagPay"
				  }
				  
				  ...
				}
			}

		*/
		
		
		$test_url  = '';
		$live_url  = 'https://api.ravepay.co/v2/banks/' . $country . '?public_key=' . Utilities::getConfigData('paystack_pubkey');
		$end_point =  $live ? $live_url : $test_url;
		
		$headers = [
			'Content-type: application/json'
		];
		
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $end_point);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
		$res = curl_exec($ch);
		curl_close($ch);		
		return json_decode($res);
	}
	
}


?>