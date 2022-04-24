<?php

class Teachers extends Forms{
	public static $table = 'teachers';
	public static function register(){
		
		
		$validator = self::validate([
				'firstname' => 'required',
				'lastname' 	=> 'required',
				'email' 	=> 'required|exists:teachers',
				'phone' 	=> 'required|exists:teachers',
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
		
		$firstname 	= post( 'firstname' );
		$middlename = post( 'middlename' );
		$lastname 	= post( 'lastname' );
		$email 		= post( 'email' );
		$phone 		= post( 'phone' );
		$password 	= post( 'password' );
		$ref 		= self::generateRef( self::$table );
		
		if( Tables::get( self::$table )->postEntry( [
				'ref' 		=> $ref,
				'firstname' => $firstname,
				'middlename'=> $middlename,
				'lastname' 	=> $lastname,
				'email' 	=> $email,
				'phone' 	=> $phone,
				'password' 	=> password_hash( $password, PASSWORD_DEFAULT )
			] ) ){
				
			echo self::json( [
				'status'  => 'ok',
				'message' => "Account successfully created!",
			] );
			return;	
			
		}
		
		
		echo self::json( [
			'status' => 'not-ok',
			'message' => "Something went wrong.",
		] );
		
		
	}
	
	/* 
	public static function login(){
			
		$validate = Forms::validate([
			'email' 	=> 'required|not_exists:teachers',
			'password' 	=> post('password')
		],[
			'email.required' 	=> 'Enter email address.',
			'email.not_exists' 	=> 'Account does not exists in our records.',
			'password.required' => 'Enter account password.',
		]);
		
		if( !$validate ){
			echo Forms::json( [
				'status'  => 'not-ok',
				'message' => Forms::errors( 'first' ),
			] );
			return;
			
		}else{
			
			$loginData = [
				'email' 	=> post('email'),
				'password' 	=> post('password'),
				'is_active' => 1,
			];
			
			if( Authentication::guard('teacher')->login( $loginData ) ){
				echo Forms::json( [
					'status'  => 'ok',
					'message' => 'Login successful. yy',
				] );
				return;
			}
			
		}
		
	}
	
	*/
	 
	public static function login(){
		Forms::guard( 'teacher' )->attempt_login( [ 'is_active' => 1 ], route( 'teachers.dashboard' ) );	
	}
	
	
	public static function createSchool(){
		
	}
	
	public static function updateSchool(){
		
	}
	
	public static function deleteSchool(){
		
	}
	
	public static function createClass(){
		
	}
	
	public static function updateClass(){
		
	}
	
	public static function getClasses(){
		
	}
	
	public static function deleteClass(){
		
	}
	
	public static function createAttendance(){
		
	}
	
	public static function updateAttendance(){
		
	}
	
	public static function deleteAttendance(){
		
	}
	
	public static function markAttendance(){
		
	}
	
	public static function createReportCards(){
		
	}
	
	
	public static function recordScores(){
		
	}
	
	
	
	public static function deleteReportCards(){
		
	}
	
	
	
	
}

?>