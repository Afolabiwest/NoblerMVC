<?php
//	use App\Nobler\Contoller;
class HomeController extends Controller
{	
	public function __construct()
	{
		#Authentication::guard( 'admin' )->validate();
	}
	
	public function home()
	{
		
		#	self::createTables( 'sql.php' );
		echo Forms::$guard;
		
		$data = [
		
		];
		
		display( 'home.html', $data );
		
		
	}

	
	public function about()
	{
		$data = [];		
		display( 'home.html', $data );
		
	}
	
	public function contact()
	{
		$data = [];		
		display( 'contact.html', $data );
		
	}
	
	public function create_account()
	{
		
		$data = [
		
		];
		
		display( 'register.html', $data );		
		
	}
	
	public function resident_registration_status()
	{
		
		$data = [
		
		];
		
		#	display( 'register.html', $data );		
		
	}
	
	

	public function register_new_user_account()
	{	
		Residents::register();
	}

	
	public function login_user_account()
	{	
		Residents::login();	
		
	}

	
	
}

?>