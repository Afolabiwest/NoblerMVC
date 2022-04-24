<?php

include_once( dirname( __FILE__ ) . '/autoload.php');
 
Route::domain( 'http://ourcda.loc', function(){
	
	Route::add( '/', 'HomeController@home' )->name( 'home.page' )->middleware( function(){ /* echo "Hello! I'm home page middleware 1<br>"; */ } ) ;
	Route::add( '/home', 'HomeController@home' )->name( 'home.page' )->middleware( function(){ /* echo "Hello! I'm home page middleware 2<br>"; */ } ) ;
	Route::add( '/about/', 'HomeController@about' )->name( 'home.about.page' )->middleware( function(){ /* echo "Hello! I'm home page middleware 2<br>"; */ } ) ;
	Route::add( '/contact/', 'HomeController@contact' )->name( 'home.contact.page' )->middleware( function(){ /* echo "Hello! I'm home page middleware 2<br>"; */ } ) ;
	Route::post( '/post-contact-message/', 'HomeController@post_contact_message' )->name( 'post.contact.message' )->middleware( function(){ /* echo "Hello! I'm home page middleware 2<br>"; */ } ) ;
	Route::post( '/register-new-user-account/', 'HomeController@register_new_user_account' )->name( 'register.user' )->middleware( function(){ /* echo "Hello! I'm home page middleware 2<br>"; */ } ) ;
	Route::post( '/login-user-account/', 'HomeController@login_user_account' )->name( 'login.user' )->middleware( function(){ /* echo "Hello! I'm home page middleware 2<br>"; */ } ) ;
	Route::get( '/create-account/', 'HomeController@create_account' )->name( 'create.account' )->middleware( function(){ /* echo "Hello! I'm home page middleware 2<br>"; */ } ) ;
	Route::get( '/resident-registration-status/', 'HomeController@resident_registration_status' )->name( 'resident.registration.status' ) ;
	Route::get( '/resident-dashboard/', 'ResidentsController@resident_dashboard' )->name( 'residents.dashboard' );
	Route::get( '/resident-cdas/', 'ResidentsController@resident_cdas' )->name( 'residents.cdas' );
	Route::get( '/resident-bills/', 'ResidentsController@resident_bills' )->name( 'residents.bills' );
	Route::get( '/resident-profile/', 'ResidentsController@resident_profile' )->name( 'residents.profile' );
	Route::get( '/cda-dashboard/{ref}', 'ResidentsController@cda_dashboard' )->name( 'cda.dashboard' );
	Route::get( '/new-cda-form', 'ResidentsController@new_cda_form' )->name( 'new.cda.form' );
	Route::get( '/new-cda-resident-form', 'ResidentsController@new_cda_resident_form' )->name( 'new.cda.resident.form' );
	Route::post( '/post-new-cda', 'ResidentsController@post_new_cda' )->name( 'post.new.cda' );
	Route::post( '/post-cda-resident-search', 'ResidentsController@post_cda_resident_search' )->name( 'post.cda.resident.search' );
	Route::get( '/resident/logout/', 'ResidentsController@resident_logout' )->name( 'resident.logout' );
	Route::get( '/cda/meetings/{ref}/', 'ResidentsController@cda_meetings' )->name( 'cda.meetings' );	
	Route::get( '/resident-settled-bills/', 'ResidentsController@resident_settled_bills' )->name( 'resident.settled-bills' );	
	Route::get( '/resident-unsettled-bills/', 'ResidentsController@resident_unsettled_bills' )->name( 'resident.unsettled-bills' );	
	
	
	
	

	Route::get( '/cda-residents/{ref}/', 'ResidentsController@cda_residents' )->name( 'cda.residents' );	
	Route::get( '/cda-committees/{ref}/', 'ResidentsController@cda_committees' )->name( 'cda.committees' );	
	Route::get( '/cda-assets/{ref}/', 'ResidentsController@cda_assets' )->name( 'cda.assets' );	
	Route::get( '/cda-liabilities/{ref}/', 'ResidentsController@cda_liabilities' )->name( 'cda.liabilities' );	
	Route::get( '/cda-revenues/{ref}/', 'ResidentsController@cda_revenues' )->name( 'cda.revenues' );	
	Route::get( '/cda-expenditures/{ref}/', 'ResidentsController@cda_expenditures' )->name( 'cda.expenditures' );	
	Route::get( '/cda-reserves/{ref}/', 'ResidentsController@cda_reserves' )->name( 'cda.reserves' );	
	Route::get( '/cda-bills/{ref}/', 'ResidentsController@cda_bills' )->name( 'cda.bills' );	
	
	
	
	
} );

/* 
Route::group( function(){
	
	//	Execute numbers of line of codes here before actually setting your routes
	//	Execute numbers of line of codes here before actually setting your routes
	//	What this means is that the codes will be executed before any matched route
	//	in the block
	
	#/main/bullpointa/
	Route::add( '/main/bullpointa/', 'ResidentsController@bullpointa' )->name( 'bullpointa.link' );
	#/main/bullpointb/
	Route::add( '/main/bullpointb/', 'ResidentsController@bullpointb' )->name( 'bullpointb.link' );
	#/main/bullpointc/
	Route::add( '/main/bullpointc/', 'ResidentsController@bullpointc' )->name( 'bullpointc.link' );
	
} );


Route::prefix( "{adminxyz}" )->suffix( '{desk}', function(){	
	
	#/{adminxyz}/main/bullpoint/{desk}/	
	Route::add( '/main/bullpoint/', 'ResidentsController@bullpoint' )->name( 'bullpoint.link' );
	
} );



Route::prefix( "adminxyz" )->suffix( 'desk', function(){	
	
	#/adminxyz/main/bullpoint/desk/	
	Route::add( '/main/bullpoint/', 'ResidentsController@bullpoint' )->name( 'bullpoint.link' );
	
} );


Route::domain( 'http://admin.ourcda.loc', function(){
	
	Route::add( '/', 'HomeController@home' )->name( 'home.page' ) ;
	Route::add( '/home', 'HomeController@home' )->name( 'home.page' );
	Route::add( '/about/', 'HomeController@about' )->name( 'home.about.page' );
	Route::add( '/contact/', 'HomeController@contact' )->name( 'home.contact.page' );
	Route::post( '/post-contact-message/', 'HomeController@post_contact_message' );
	Route::post( '/register-new-user-account/', 'HomeController@register_new_user_account' );
	Route::post( '/login-user-account/', 'HomeController@login_user_account' )->name( 'login.user' );
	Route::get( '/create-account/', 'HomeController@create_account' )->name( 'create.account' );
	Route::get( '/resident-dashboard/', 'ResidentsController@resident_dashboard' )->name( 'residents.dashboard' );
	Route::get( '/resident-bills/', 'ResidentsController@resident_bills' )->name( 'residents.bills' );
	Route::get( '/resident-profile/', 'ResidentsController@resident_profile' )->name( 'residents.profile' );
	Route::get( '/cda-dashboard/', 'ResidentsController@cda_dashboard' )->name( 'cda.dashboard' );
	Route::get( '/resident/logout/', 'ResidentsController@resident_logout' )->name( 'resident.logout' );
	Route::get( '/cda/meetings/{ref}/', 'ResidentsController@cda_meetings' )->name( 'cda.meetings' );	
	
} );

*/


#	Route::domain( 'http://www.ourcda.loc', function(){
	
	/* 
	
	#/admin/bullpoint/{ref}/
	Route::prefix( 'admin', function(){		
		Route::add( '/bullpoint/{ref}/', 'ResidentsController@cda_meetings' )->name( 'bullpoint.meetings' );
	} );
	
	#/admin1/bullpoint-xx/client/
	Route::prefix( 'admin1', function(){	
		Route::suffix( 'client', function(){		
			Route::add( '/bullpoint-xx/', 'ResidentsController@cda_meetings' )->name( 'bullpoint.meetings' );
		} );		
	} );


	#/client/bullpoint/client/
	Route::prefix( 'client', function(){		
		Route::add( '/bullpoint/', 'ResidentsController@cda_meetings' )->name( 'bullpoint.meetings' );
	} );


	#/main/bullpoint/desk/
	Route::suffix( 'desk', function(){		
		Route::add( '/main/bullpoint/', 'ResidentsController@cda_meetings' )->name( 'bullpoint.meetings' );
	} );


	#/main/bullpoint/{ref}/pager/ 
	Route::suffix( 'pager', function(){		
		Route::add( '/main/bullpoint/{ref}/', 'ResidentsController@cda_meetings' )->name( 'bullpoint.meetings' );
	} ); 
	
	#*/
	

#	} );


?>