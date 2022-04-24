<?php

class ResidentsController  extends Controller
{	
	public function __construct()
	{
		Authentication::guard( 'resident' )->validate( function(){
			#	echo "Hello! Here we are! Let's do stuffs.";			
		}, route( 'home.page' ) );
	}
	
	public function home()
	{
		
		$data = [];		
		display( 'home.html', $data );		
		
	}

	public function resident_dashboard()
	{
		#	self::createTables( 'sql.php' );
		
		
		$data = [
			'dashboard_data' => Residents::dashboardData()
		];		
		display( 'residents/resident-dashboard.html', $data );
		
	}
	
	public function resident_cdas()
	{
		#	dd(Residents::getCDAs());
		$data = [
			'resident_cdas' => Residents::getCDAs()
		];		
		display( 'residents/resident-cdas.html', $data );
		
	}
	
	public function new_cda_form()
	{
		$data = [
			'form_options' => CDAs::getFormOptions()
		];
		display( 'residents/new-cda-form.html', $data );
		
	}
	
	
	public function new_cda_resident_form()
	{
		$data = [
			'form_options' => CDAs::getFormOptions()
		];
		display( 'residents/new-cda-resident-form.html', $data );
		
	}
	
	
	
	public function post_new_cda()
	{
		CDAs::post_new_cda();		
	}
	
	
	public function post_cda_resident_search()
	{
		Residents::post_cda_resident_search();		
	}
	
	
	public function cda_dashboard( $ref )
	{
		#	self::createTables( 'sql.php' );
		$cdaData = CDAs::getDashboardStats( $ref );		
		
		$data = [
			'ref' 					=> $ref,
			'cda_data' 				=> $cdaData['cda_data'],
			'cda_resident_count' 	=> $cdaData['cda_resident_count'],
			'cda_committee_count' 	=> $cdaData['cda_committee_count'],
			'assets_worth' 			=> $cdaData['assets_worth'],
			'liabilities_worth' 	=> $cdaData['liabilities_worth'],
			'receipts_worth' 		=> $cdaData['receipts_worth'],
			'expenses_worth' 		=> $cdaData['expenses_worth'],
			'all_bills_worth'		=> $cdaData['all_bills_worth'],
			'settled_bills_worth' 	=> $cdaData['settled_bills_worth'],
			'reserves_worth' 		=> $cdaData['reserves_worth'],
			'revenues' 				=> $cdaData['revenues'],
			'expenses' 				=> $cdaData['expenses'],
			'meetings' 				=> $cdaData['meetings'],
		];
		
		#dd( $data );	
		
		display( 'residents/cda-dashboard.html', $data );
		
	}

	public function dashboard()
	{
		$data = [];		
		display( 'residents/dashboard.html', $data );
		
	}

	
	public function cda_residents( $ref )
	{
		$cda = Tables::get('cdas')->getEntryByColumns([
			'ref' => $ref
		]);	
		$data = [
			'cda' => $cda
		];		
		display( 'residents/cda-residents.html', $data );
	}
	
	
	public function cda_meetings()
	{
		
	}
	
	public function resident_logout()
	{
		logout( 'resident', route( 'home.page' ) );		
	}

	
}

?>