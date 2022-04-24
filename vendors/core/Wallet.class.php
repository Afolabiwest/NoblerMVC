<?php

class Wallet extends Forms{
	
	public static $response 				= [];
	public static $depositTable 			= "partners_wallet_deposits";
	public static $withdrawalTable 			= "partners_wallet_withdrawals";
	public static $withdrawalRequestTable 	= "partners_wallet_withdrawal_requests";
	public static $userIdColumn 			= "partner_id";
	
	public static function getBalance($userId){
		return self::getTotalDeposits($userId) - self::getTotalWithdrawals($userId);
	}
	
	public static function getTotalDeposits($userId){
		return Tables::get(self::$depositTable)->getEntriesAmountSumByColumns([
			self::$userIdColumn => $userId
		]);
	}
	
	public static function getTotalWithdrawals($userId){
		return Tables::get(self::$withdrawalTable)->getEntriesAmountSumByColumns([
			self::$userIdColumn => $userId
		]);
	}
	
	public static function deposit($userId, $amount){		
		$data = [
			self::$userIdColumn 	=> $userId,
			'amount' 		=> $amount,
			'active_status' => 1
		];
		
		if(Tables::get(self::$depositTable)->postEntry($data)){
			return true;
		}
		
		return false;
		
	}
	
	public static function withdraw($userId, $amount){		
		if(self::getBalance($userId) >= $amount){			
			$data = [			
				self::$userIdColumn 	=> $userId,
				'amount' 		=> $amount,
				'active_status' => 1
			];
			
			if(Tables::get(self::$withdrawalTable)->postEntry($data)){
				self::$response = [
					'status' => 'ok',
					'message' => 'Withdrawal successful.'
				];
				
				return true;				
			}			
		}else{
			self::$response = [
				'status' => 'not-ok',
				'message' => 'Insufficient fund.'
			];
		}
		
		return false;		
		
	}
	
	
	public static function getDeposits($userId, $order = 'id DESC', $limit = ''){
		return Tables::get(self::$depositTable)->getEntriesByColumns([
			self::$userIdColumn => $userId
		], [], $order, $limit);
	}
	
	public static function getWithdrawals($userId, $order = 'id DESC', $limit = ''){
		return Tables::get(self::$withdrawalTable)->getEntriesByColumns([
			self::$userIdColumn => $userId
		], [], $order, $limit);
	}
	
	public static function getWithdrawalRequests($userId, $order = 'id DESC', $limit = ''){
		return Tables::get(self::$withdrawalRequestTable)->getEntriesByColumns([
			self::$userIdColumn => $userId
		], [], $order, $limit);
	}
	
	
	public static function getPendingWithdrawalRequestsAmount($userId){
		return  Tables::get(self::$withdrawalRequestTable)->getEntriesAmountSumByColumns([
			self::$userIdColumn => $userId,
			'active_status' 	=> 0
		]);
	}
	
	public static function getWithdrawalRequestCounts($userId){
		return Tables::get(self::$withdrawalRequestTable)->getEntriesCountByColumns([
			self::$userIdColumn => $userId
		]);
	}
	
	public static function getWithdrawalCounts($userId){
		return Tables::get(self::$withdrawalTable)->getEntriesCountByColumns([
			self::$userIdColumn => $userId
		]);
	}
	
	
	public static function getPendingWithdrawalRequestsCount($userId){
		return  Tables::get(self::$withdrawalRequestTable)->getEntriesCountByColumns([
			self::$userIdColumn => $userId,
			'active_status' 	=> 0
		]);
	}
	
	public static function getTreatedWithdrawalRequestsAmount($userId){
		return  Tables::get(self::$withdrawalRequestTable)->getEntriesAmountSumByColumns([
			self::$userIdColumn => $userId,
			'active_status' 	=> 1
		]);
	}
	
	public static function getTreatedWithdrawalRequestsCount($userId){
		return  Tables::get(self::$withdrawalRequestTable)->getEntriesCountByColumns([
			self::$userIdColumn => $userId,
			'active_status' 	=> 1
		]);
	}
	
	public static function getProcessingWithdrawalRequestsCount($userId){
		return  Tables::get(self::$withdrawalRequestTable)->getEntriesCountByColumns([
			self::$userIdColumn => $userId,
			'active_status' 	=> 2
		]);
	}
	
	public static function getCanceledWithdrawalRequestsCount($userId){
		return  Tables::get(self::$withdrawalRequestTable)->getEntriesCountByColumns([
			self::$userIdColumn => $userId,
			'active_status' 	=> 3
		]);
	}
	
	public static function getDeclinedWithdrawalRequestsCount($userId){
		return  self::getCanceledWithdrawalRequestsCount($userId);
	}
	

	

}

?>