<?php

class PartnersWallet{
	
	public static $response 				= [];
	public static $depositTable 			= "partners_wallet_deposits";
	public static $withdrawalTable 			= "partners_wallet_withdrawals";
	public static $withdrawalRequestTable 	= "partners_wallet_withdrawal_requests";
	
	public static function getBalance($partnerId){
		return self::getTotalDeposits($partnerId) - self::getTotalWithdrawals($partnerId);
	}
	
	public static function getTotalDeposits($partnerId){
		return Tables::get(self::$depositTable)->getEntriesAmountSumByColumns([
			'partner_id' => $partnerId
		]);
	}
	
	public static function getTotalWithdrawals($partnerId){
		return Tables::get(self::$withdrawalTable)->getEntriesAmountSumByColumns([
			'partner_id' => $partnerId
		]);
	}
	
	public static function deposit($partnerId, $amount, $agent_id = "", $client_id = ""){
		
		$agentId = $agent_id == ""? 0 : $agent_id;
		$clientId = $client_id == ""? 0 : $client_id;
		$data = [
			'agent_id' 		=> $agentId,
			'partner_id' 	=> $partnerId,
			'client_id' 	=> $clientId,
			'amount' 		=> $amount,
			'active_status' => 1
		];
		if(Tables::get(self::$depositTable)->postEntry($data)){
			return true;
		}
		
		return false;
		
	}
	
	public static function withdraw($partnerId, $amount){		
		if(self::getBalance($partnerId) >= $amount){			
			$data = [			
				'partner_id' 	=> $partnerId,
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
	
	
	public static function getDeposits($partnerId){
		return Tables::get(self::$depositTable)->getEntriesByColumns([
			'partner_id' => $partnerId
		]);
	}
	
	public static function getWithdrawals($partnerId){
		return Tables::get(self::$withdrawalTable)->getEntriesByColumns([
			'partner_id' => $partnerId
		]);
	}
	
	public static function getWithdrawalRequests($partnerId){
		return Tables::get(self::$withdrawalRequestTable)->getEntriesByColumns([
			'partner_id' => $partnerId
		]);
	}
	

}

?>