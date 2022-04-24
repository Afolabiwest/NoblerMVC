<?php

class FlutterwaveSavedPaymentCards{
	
	use DefaultTableEntityMethods, 
		CoopDefaultMethods,
		MembersDefaultMethods;
		
	public static $table 		= 'flutterwave_saved_payment_cards'; 
	public static $page_limit 	= 2000;
	
	public static function postEntry($postedData = []){
		return self::addEntry($postedData);
	}
	
	public static function addEntry($postedData = []){
		
		$data = [
			'coop_id' 		=> setTableFieldData($postedData, 'coop_id'),					
			'member_id' 	=> setTableFieldData($postedData, 'member_id'),					
			'txid' 			=> setTableFieldData($postedData, 'txid'),					
			'token' 		=> setTableFieldData($postedData, 'token'),					
			'amount' 		=> setTableFieldData($postedData, 'amount'),					
			'custname' 		=> setTableFieldData($postedData, 'custname'),					
			'acctcontactperson' => setTableFieldData($postedData, 'acctcontactperson'),					
			'custphone' 	=> setTableFieldData($postedData, 'custphone'),					
			'custemail' 	=> setTableFieldData($postedData, 'custemail'),					
			'expirymonth' 	=> setTableFieldData($postedData, 'expirymonth'),					
			'expiryyear' 	=> setTableFieldData($postedData, 'expiryyear'),					
			'card_bin' 		=> setTableFieldData($postedData, 'card_bin'),					
			'last4digits' 	=> setTableFieldData($postedData, 'last4digits'),					
			'brand' 		=> setTableFieldData($postedData, 'brand'),					
			'card_tokens' 	=> setTableFieldData($postedData, 'card_tokens'),					
			'life_time_token' => setTableFieldData($postedData, 'life_time_token'),					
			'status' 		=> setTableFieldData($postedData, 'status'),					
			'day' 			=> date('d'),					
			'week' 			=> date('W'),					
			'month' 		=> date('m'),					
			'year' 			=> date('Y'),
			'active_status' => setTableFieldData($postedData, 'active_status', 1),					
			'date' 			=> setTableFieldData($postedData, 'date', date('Y-m-d H:i:s'))
		];
		
		return PDO_DB::insert_bulk($data, self::$table);
	}

	public static function updateEntryById($entryId, $postedData = []){		
		$currData = self::getEntryById($entryId);		
		$data = [
			'coop_id' 		=> setTableFieldData($postedData, 'coop_id', $currData['coop_id']),
			'txid' 			=> setTableFieldData($postedData, 'txid', $currData['txid']),					
			'token' 		=> setTableFieldData($postedData, 'token', $currData['token']),					
			'amount' 		=> setTableFieldData($postedData, 'amount', $currData['amount']),					
			'custname' 		=> setTableFieldData($postedData, 'custname', $currData['custname']),					
			'acctcontactperson' => setTableFieldData($postedData, 'acctcontactperson', $currData['acctcontactperson']),					
			'custphone' 	=> setTableFieldData($postedData, 'custphone', $currData['custphone']),					
			'custemail' 	=> setTableFieldData($postedData, 'custemail', $currData['custemail']),					
			'expirymonth' 	=> setTableFieldData($postedData, 'expirymonth', $currData['expirymonth']),					
			'expiryyear' 	=> setTableFieldData($postedData, 'expiryyear', $currData['expiryyear']),					
			'card_bin' 		=> setTableFieldData($postedData, 'card_bin', $currData['card_bin']),					
			'last4digits' 	=> setTableFieldData($postedData, 'last4digits', $currData['last4digits']),					
			'brand' 		=> setTableFieldData($postedData, 'brand', $currData['brand']),					
			'card_tokens' 	=> setTableFieldData($postedData, 'card_tokens', $currData['card_tokens']),					
			'life_time_token' => setTableFieldData($postedData, 'life_time_token', $currData['life_time_token']),					
			'status' 		=> setTableFieldData($postedData, 'status', $currData['status']),							
			'active_status' => setTableFieldData($postedData, 'active_status', $currData['active_status']),							
			'last_updated' 	=> setTableFieldData($postedData, 'last_updated', date('Y-m-d H:i:s'))
		];
		
		return PDO_DB::update_bulk($data, ['id' => $entryId], self::$table);
	}



}


?>