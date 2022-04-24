<?php

class TeachersController extends Controller
{	
	public function __construct()
	{
		Authentication::guard( 'teacher' )->exclude( [
			//'no_check'
		] )->validate();
	}
	
	public function home()
	{
		$data = [
		
		];
		
		display( 'home.html', $data );
		
		
	}

	public function dashboard()
	{
		$data = [
		
		];
		
		//	clearSession( 'user' );
		
		display( 'teachers/dashboard.html', $data );		
		
	}
	
	public function no_check()
	{
		echo "No Check!";	
		
	}
	
}

?>