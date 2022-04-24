<?php

class BankingDetail extends Forms{

	public static $userId 	= "partner_id";
	public static $table 	= "partners_banking_detail";
	
	public static function postBankingDetail($userId){
		
		self::validateAjaxRequest();
		$response = [
			'status' => 'not-ok',
			'message' => 'No action performed!',
		];
		
		$accountName 	= post('account-name');
		$accountNumber 	= post('account-number');
		$accountType 	= post('account-type');
		$phone 			= post('phone-number');
		$bank 			= post('bank');
		
		if($accountName == "" || $accountNumber =="" || $bank ==""){
			$response = [
				'status' => 'not-ok',
				'message' => 'Complete all required fields!',
			];
			
		}elseif(Tables::get(self::$table)->entryExistsByColumns([
			self::$userId 		=> $userId,
			'bank' 				=> $bank,
			'account_name' 		=> $accountName,
			'account_number' 	=> $accountNumber,
		])){
			$response = [
				'status' => 'not-ok',
				'message' => 'Bank detail already exists!',
			];
			
		}else{
			
			$postData = [
				self::$userId 		=> $userId,
				'account_name' 		=> $accountName,
				'account_number' 	=> $accountNumber,
				'account_type' 		=> $accountType,
				'bank' 				=> $bank,
				'phone' 		=> $phone,
				'active_status' => 1
			];
			
			if(Tables::get(self::$table)->postEntry($postData)){
				$response = [
					'status' => 'ok',
					'message' => 'Bank detail successfully posted!',
				];
			}else{
				$response = [
					'status' => 'not-ok',
					'message' => 'Something went wrong!',
				];
			}
			
		}
		
		echo json_encode($response);
	}
	
	
	public static function updateBankingDetail($userId){
		
		self::validateAjaxRequest();
		$response = [
			'status' => 'not-ok',
			'message' => 'No action performed!',
		];
		
		$entryId 		= post('entry-id');
		$accountName 	= post('account-name');
		$accountNumber 	= post('account-number');
		$accountType 	= post('account-type');
		$phone 			= post('phone-number');
		$bank 			= post('bank');
		
		if($accountName == "" || $accountNumber =="" || $bank =="" || $phone ==""){
			$response = [
				'status' => 'not-ok',
				'message' => 'Complete all required fields!',
			];
		
		}else{
			
			$postData = [				
				'account_name' 	=> $accountName,
				'account_number' => $accountNumber,
				'account_type' 	=> $accountType,
				'bank' 			=> $bank,
				'phone' 		=> $phone,
				'active_status' => 1,
			];
			
			if(Tables::get(self::$table)->updateEntryByColumns($postData, ['id' => $entryId])){
				$response = [
					'status' => 'ok',
					'message' => 'Bank detail updated successfully!',
				];
			}else{
				$response = [
					'status' => 'not-ok',
					'message' => 'Something went wrong!',
				];
			}
			
		}
		
		echo json_encode($response);
	}
	
	
	public static function getUserBankAccount($userId){
		return Tables::get(self::$table)->getEntryByColumns([
			self::$userId 	=> $userId
		]);
	}
	
	public static function getUserBankAccounts($userId){
		return Tables::get(self::$table)->getEntriesByColumns([
			self::$userId 	=> $userId
		]);
	}
	
	public static function getBankAccounts(){
		return Tables::get(self::$table)->getEntries();
	}
	
	
	
}

?>