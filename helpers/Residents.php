<?php

class Residents extends Forms{
	public static $table = 'residents';
	public static $guard = 'resident';
	
	public static function register(){
		
		
		$validator = self::validate([
				'firstname' => 'required',
				'lastname' 	=> 'required',
				'email' 	=> "required|exists:" . self::$table,
				'phone' 	=> "required|exists:" . self::$table,
				'password' 	=> 'required'
			],	[
				'firstname.required'=> 'Enter first name',
				'lastname.required' => 'Enter last name',
				'email.required' 	=> 'Enter email address',
				'email.exists' 		=> 'Account with the same email address already exists. You can try to login if you own the account.',
				'phone.required' 	=> 'Enter phone number',
				'phone.exists' 		=> 'Account with the same phone number already exists. You can try to login if you own the account.',
				'password.required' => 'You must set an account password.'
			] 
		);
		
		if( !$validator ){
			echo self::json( [
				'status'  => 'not-ok',
				'message' => self::errors( 'first' ),
			] );
			return;
		}
		
		$ref = Forms::generateRef( self::$table );
		$postData 	= [
			'ref' 		=> $ref,
			'firstname' => post( 'firstname' ),
			'middlename'=> post( 'middlename' ),
			'lastname' 	=> post( 'lastname' ),
			'email' 	=> post( 'email' ),
			'phone' 	=> post( 'phone' ),
			'password' 	=> password_hash( post( 'password' ), PASSWORD_DEFAULT )
		];
		
		if( Tables::get( self::$table )->postEntry( $postData ) ){
			
			// Sending welcome mail to resident
			$fullname 						= post( 'firstname' ) . ' ' . post( 'lastname' );
			$subject 						= 'Welcome Message From ' . config( 'company_name' );
			$mail_content_data 				= $postData;
			$mail_content_data['password'] 	= post( 'password' );
			
			$mail_content 					= fetch($mail_content_data, 'mails/resident-welcome-mail.html');
			Tools::sendMail( post( 'email' ), $fullname, $subject, $mail_content );	
			
			echo self::json( [
				'status'  => 'ok',
				'message' => "Account successfully created!",
				'redirect_url' => route( 'resident.registration.status' ),
			] );
			return;	
			
		}
		
		
		echo self::json( [
			'status' 	=> 'not-ok',
			'message' 	=> "Something went wrong.",
		] );
		
		
	}
	
	 
	public static function login(){
		Forms::guard( self::$guard )->attempt_login( [ 'is_active' => 1 ], route( 'residents.dashboard' ) );	
	}
	
	
	public static function dashboardData()
	{
		
		$user 					= user( 'resident' );
		$settled_bills_amount 	= $unsettled_bills_amount = 0;
		$settled_bills 			= $unsettled_bills = [];
		$next_meetings 			= $previous_meetings = $meetings  = [];
		
		$cdas_count 	= Tables::get( 'resident_cdas' )->getEntriesCountByColumns( [
			'resident_ref' =>  $user->ref
		] );
		
		if( $cdas_count > 0 ){
			
			$default_cda = Tables::get( 'resident_cdas' )->getEntryByColumns( [
				'resident_ref' =>  $user->ref
			] );
			
			$settled_bills_amount = Tables::get( 'bills' )->getEntriesAmountSumByColumns( [
				'resident_ref' =>  $default_cda['cda_ref'],
				'is_settled' =>  1,
			] );
			
			$unsettled_bills_amount = Tables::get( 'bills' )->getEntriesAmountSumByColumns( [
				'resident_ref' =>  $default_cda['cda_ref'],
				'is_settled' =>  0,
			] );
			
			$settled_bills 	= Tables::get( 'bills' )->getEntriesByColumns( [
				'resident_ref' 	=>  $default_cda['cda_ref'],
				'is_settled' 	=>  1,
			] );
			
			$unsettled_bills 	= Tables::get( 'bills' )->getEntriesByColumns( [
				'resident_ref' 	=>  $default_cda['cda_ref'],
				'is_settled' 	=>  0,
			] );

			$meetings 		= Tables::get( 'meetings' )->getEntriesByColumns( [
				'resident_ref' 	=>  $default_cda['cda_ref']
			], [], 'id DESC', '20' );		
			
		}
		
		for( $i = 0; $i < count( $meetings ); $i++ ){
			
			$meetings[$i]['meeting_date_string'] = self::getMeetingDateString( $meetings[$i]['meeting_date'] );
			if( $meetings[$i]['is_active'] == 1 && strtotime( $meetings[$i]['meeting_date'] ) >= time() ){
				
				$next_meetings[] 	= $meetings[$i];
			}
			
			if( strtotime( $meetings[$i]['meeting_date'] ) < time() ){
				$previous_meetings[] = $meetings[$i];
			}			
			
		}
		
		return [
			'cdas_count' 			=> $cdas_count,
			'settled_bills_amount' 	=> $settled_bills_amount,
			'unsettled_bills_amount'=> $unsettled_bills_amount,
			'settled_bills' 		=> $settled_bills,
			'unsettled_bills' 		=> $unsettled_bills,
			'next_meetings' 		=> $next_meetings,
			'previous_meetings' 	=> $previous_meetings
		];	
		
		
	}
	
	public static function post_cda_resident_search(){
		
		if( empty( post('resident') ) ){
			echo self::json( [
				'status' 	=> 'not-ok',
				'message' 	=> "Enter resident name or reference number.",
				'data' 		=> [],
			] );
			return;
			
		}else{			
			$resident 	= post('resident'); 
			$results 	= Tables::query( "SELECT * FROM ".  self::$table . " WHERE ref LIKE '%" . $resident . "%' OR firstname LIKE '%" . $resident . "%' OR middlename LIKE '%" . $resident . "%' OR lastname LIKE '%" . $resident . "%' ORDER BY ref ASC" );
			
			echo self::json( [
				'status' 	=> 'ok',
				'message' 	=> "Found " . count( $results ) . " Results" ,
				'data' 	=> $results,
			] );
			return;
			
		}
		
		echo self::json( [
			'status' 	=> 'not-ok',
			'message' 	=> "Something went wrong.",
			'data' 	=> [
				'csrf' 		=> post('csrf-token'),
				'resident' 	=> post('resident'),
			],
		] );
		
	}
	
	public static function getCDAs()
	{
		$user = user( 'resident' );
		
		$resident_cdas =  Tables::get( 'resident_cdas' )->getEntriesByColumns( [
			'resident_ref' => $user->ref
		] );
		
		
		for( $i = 0; $i < count( $resident_cdas ); $i++ ){
			
			$cda = Tables::get( 'cdas' )->getEntryColumnsByColumns( [ 'cda_name', 'is_active' ], [
				'ref' => $resident_cdas[$i]['cda_ref']
			] );			
			$resident_cdas[$i]['cda'] 	= $cda['cda_name'];
			$resident_cdas[$i]['cda_is_active'] 	= $cda['is_active'];
			
			
			$community = Tables::get( 'communities' )->getEntryColumnsByColumns( ['community'], [
				'ref' => $resident_cdas[$i]['community_ref']
			] );			
			$resident_cdas[$i]['community'] = $community['community'];	
			
			
			$city	= Tables::get( 'cities' )->getEntryColumnsByColumns( ['city'], [
				'ref' => $resident_cdas[$i]['city_ref']
			] );			
			$resident_cdas[$i]['city'] 		= $city['city'];

			
			
			$state 	= Tables::get( 'states' )->getEntryColumnsByColumns( ['state'], [
				'ref' => $resident_cdas[$i]['state_ref']
			] );			
			$resident_cdas[$i]['state'] 	= $state['state'];	
			
			$country 	= Tables::get( 'countries' )->getEntryColumnsByColumns( ['country'], [
				'ref' => $resident_cdas[$i]['country_ref']
			] );			
			$resident_cdas[$i]['country'] 	= $country['country'];	
			
			
		}
		
		return array_reverse( $resident_cdas );		
		
	}
	
	
	
}

?>