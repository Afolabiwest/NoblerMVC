<?php

class CDAs extends Forms{
	public static $table = 'cdas';
	public static $guard = 'resident';
	
	
	
	public static function post_new_cda()
	{
		$user = user( 'resident');
		$validator = self::validate([
				'cda_name' 		=> 'required',
				'country_ref' 	=> 'required',
				'state_ref' 	=> "required",
				'city_ref' 		=> "required",
				'community_ref' => 'required'
			],	[
				'cda_name.required'			=> 'Enter CDA Name',
				'country_ref.required' 		=> 'Select Country',
				'state_ref.required' 		=> 'Select State',
				'city_ref.required' 		=> 'Select City/Town',
				'community_ref.required' 	=> 'Select Community'
			] 
		);
		
		if( !$validator ){
			echo self::json( [
				'status'  => 'not-ok',
				'message' => self::errors( 'first' ),
			] );
			return;
		}
		
		if( self::cda_exists( post( 'cda_name' ),  post( 'community_ref' ) ) ){
			echo self::json( [
				'status'  => 'not-ok',
				'message' => 'Community already exists.',
			] );
			return;
		}
		
		$cdaref = self::generateRef( self::$table );
		
		$postData = [
			'ref' 			=> $cdaref,
			'cda_name' 		=> post( 'cda_name' ),
			'country_ref' 	=> post( 'country_ref' ),
			'state_ref' 	=> post( 'state_ref' ),
			'city_ref' 		=> post( 'state_ref' ),
			'community_ref' => post( 'community_ref' )
		];
		
		// resident_cdas
		
		if( Tables::get( self::$table )->postEntry( $postData ) ){
			
			unset( $postData['cda_name'] );
			
			$postData['ref'] 			= self::generateRef( 'resident_cdas' );
			$postData['cda_ref'] 		= $cdaref;
			$postData['resident_ref'] 	= $user->ref;
			$postData['is_active'] 		= 1;
			
			Tables::get( 'resident_cdas' )->postEntry( $postData );
			
			// SEND AN INVOICE TO THE RESIDENT HERE
			
			echo self::json( [
				'status'  => 'ok',
				'message' => 'Your CDA has been successfully registered!',
			] );
			return;
			
		}
		
		echo self::json( [
			'status'  => 'not-ok',
			'message' => 'Unknown error occurred!',
		] );
		return;
		
		
	}
	
	public static function getDashboardStats( $cdaRef )
	{
		$user 		= user( 'resident');
		
		$cdaData 	= [];
		if( Tables::get( 'resident_cdas' )->entryExistsByColumns( [
			'cda_ref' 		=> $cdaRef,
			'resident_ref' 	=> $user->ref,
		] ) ){
			
			$cdaData = Tables::get( 'cdas' )->getEntryByColumns( [
				'ref' 	=> $cdaRef
			] );
			
		}else{
			header("location:/");
		}
		
		
		$cda_resident_count 	= Tables::get( 'resident_cdas' )->getEntriesCountByColumns( [
			'cda_ref' =>  $cdaData['ref']
		] );
		
		$cda_committee_count 	= Tables::get( 'committees' )->getEntriesCountByColumns( [
			'cda_ref' =>  $cdaData['ref']
		] );
		
		$assets_worth 	= Tables::get( 'assets' )->getEntriesAmountSumByColumns( [
			'cda_ref' =>  $cdaData['ref']
		] );
		
		$liabilities_worth 	= Tables::get( 'liabilities' )->getEntriesAmountSumByColumns( [
			'cda_ref' =>  $cdaData['ref']
		] );
		
		
		
		$expenses_worth 	= Tables::get( 'expenses' )->getEntriesAmountSumByColumns( [
			'cda_ref' =>  $cdaData['ref']
		] );
		
		$all_bills_worth 	= Tables::get( 'bills' )->getEntriesAmountSumByColumns( [
			'cda_ref' 		=>  $cdaData['ref']
		] );
		
		$settled_bills_worth 	= Tables::get( 'bills' )->getEntriesAmountSumByColumns( [
			'cda_ref' 		=>  $cdaData['ref'],
			'is_settled' 	=>  1,
		] );
		
		$receipts_worth 	= Tables::get( 'receipts' )->getEntriesAmountSumByColumns( [
			'cda_ref' =>  $cdaData['ref']
		] );
		
		$revenues_worth 	= Tables::get( 'bills' )->getEntriesAmountSumByColumns( [
			'cda_ref' 		=>  $cdaData['ref'],
			'is_settled' 	=>  1,
		] );
		
		$revenues_worth 	= Tables::get( 'bills' )->getEntriesAmountSumByColumns( [
			'cda_ref' 		=>  $cdaData['ref'],
			'is_settled' 	=>  1,
		] );
		
		$receipts_worth 	+= $revenues_worth;
		
		$reserves_worth 	= Tables::get( 'reserves' )->getEntriesAmountSumByColumns( [
			'cda_ref' 		=>  $cdaData['ref'],
			'is_active' 	=>  1,
		] );
		
		$revenues 	= self::getBillRevenues( $cdaData['ref'] );
		$expenses 	= self::getExpenses( $cdaData['ref'] );
		$meetings 	= self::getMeetings( $cdaData['ref'] );
		
		#	dd($revenues);
		
		return [
			'cda_data' 				=> $cdaData,
			'cda_resident_count' 	=> $cda_resident_count,
			'cda_committee_count' 	=> $cda_committee_count,
			'assets_worth' 			=> $assets_worth,
			'liabilities_worth' 	=> $liabilities_worth,
			'receipts_worth' 		=> $receipts_worth,
			'expenses_worth' 		=> $expenses_worth,
			'all_bills_worth' 		=> $all_bills_worth,
			'settled_bills_worth' 	=> $settled_bills_worth,
			'revenues_worth' 		=> $revenues_worth,
			'reserves_worth'		=> $reserves_worth,
			'revenues'				=> $revenues,
			'expenses'				=> $expenses,
			'meetings'				=> $meetings,
		];
		
	}
	
	public static function getBillRevenues( $ref )
	{
		$bills =  Tables::get( 'bills' )->getEntriesByColumns([
			'cda_ref' => $ref, 
			'is_settled' => 1, 
		]);
		
		for( $i = 0; $i < count( $bills ); $i++ ){
			$bills[$i]['resident'] = Tables::get( 'residents' )->getEntryByColumns( [
				'ref' => $bills[$i]['resident_ref']
			] );
		}
		
		return $bills;
	}
	
	public static function getExpenses( $ref )
	{
		return Tables::get( 'expenses' )->getEntriesByColumns([
			'cda_ref' => $ref, 
			'is_active' => 1, 
		]);
	}
	
	
	public static function getMeetings( $ref )
	{
		
		$next_meetings 	= $previous_meetings = $meetings  = [];
		$meetings 		= Tables::get( 'meetings' )->getEntriesByColumns( [
			'resident_ref' 	=>  $ref
		], [], 'id DESC', '20' );
		
		
		for( $i = 0; $i < count( $meetings ); $i++ ){
			
			$meetings[$i]['meeting_date_string'] = self::getMeetingDateString( $meetings[$i]['meeting_date'] );
			if( $meetings[$i]['is_active'] == 1 && strtotime( $meetings[$i]['meeting_date'] ) >= time() ){				
				$next_meetings[] 	= $meetings[$i];
			}
			
			if( $meetings[$i]['is_active'] == 0 or strtotime( $meetings[$i]['meeting_date'] ) < time() ){
				$previous_meetings[] = $meetings[$i];
			}			
			
		}
		
		return [
			'next_meetings' 	=> $next_meetings,
			'previous_meetings' => $previous_meetings,
		];		
		
	}
	
	
	
	public static function getFormOptions()
	{
		$countries 		= Tables::get( 'countries' )->entries();
		$states 		= Tables::get( 'states' )->entries();
		$cities 		= Tables::get( 'cities' )->entries();
		$communities 	= Tables::get( 'communities' )->entries();
		return [
			'countries' 	=> $countries,
			'states' 		=> $states,
			'cities' 		=> $cities,
			'communities' 	=> $communities,
		];
		
	}
	
	
	public static function cda_exists( $cdaName, $communityRef ){
		return Tables::get( self::$table )->entryExistsByColumns( [
			'cda_name' 		=> $cdaName,
			'community_ref' => $communityRef,
		] );
	}
	
	
	
	
}

?>	