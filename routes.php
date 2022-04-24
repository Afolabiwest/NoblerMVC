<?php

include_once( dirname( __FILE__ ) . '/autoload.php');
 
# DOMAIN GROUPING 
Route::domain( 'https://business.com', function(){
	
	Route::add( '/', 'HomeController@home' )->name( 'home.page' )->middleware( function(){ /* echo "Hello! I'm home page middleware! "; */ } ) ;
	Route::add( '/home', 'HomeController@home' )->name( 'home.page' ) ;
	Route::add( '/about/', 'HomeController@about' )->name( 'home.about.page' );
	Route::add( '/contact/', 'HomeController@contact' )->name( 'home.contact.page' );
	Route::post( '/post-contact-message/', 'HomeController@post_contact_message' )->name( 'post.contact.message' );
	Route::post( '/register-new-user-account/', 'HomeController@register_new_user_account' )->name( 'register.user' ) ;
	Route::post( '/login-user-account/', 'HomeController@login_user_account' )->name( 'login.user' );
	Route::get( '/create-account/', 'HomeController@create_account' )->name( 'create.account' );	

	Route::get( '/business-customers/{ref}/', 'ResidentsController@business_customers' )->name( 'business.customers' );	
	Route::get( '/business-assets/{ref}/', 'ResidentsController@business_assets' )->name( 'business.assets' );	
	Route::get( '/business-liabilities/{ref}/', 'ResidentsController@business_liabilities' )->name( 'business.liabilities' );	
	Route::get( '/business-revenues/{ref}/', 'ResidentsController@cda_revenues' )->name( 'business.revenues' );	
	Route::get( '/business-expenditures/{ref}/', 'ResidentsController@business_expenditures' )->name( 'business.expenditures' );	
	Route::get( '/business-reserves/{ref}/', 'ResidentsController@business_reserves' )->name( 'business.reserves' );	
	Route::get( '/business-bills/{ref}/', 'ResidentsController@business_bills' )->name( 'business.bills' );
	
} );


Route::domain( 'https://admin.business.com', function(){
	
	Route::add( '/', 'AdminController@home' )->name( 'admin.home.page' ) ;
	Route::get( '/admin/logout/', 'AdminController@admin_logout' )->name( 'admin.logout' );	
	
} );


# GENERAL GROUPING 
Route::group( function(){
	
	//	Execute numbers of line of codes here before actually setting your routes
	//	Execute numbers of line of codes here before actually setting your routes
	//	What this means is that the codes will be executed before any matched route
	//	in the block
	
	#/main/bullpointa/
	Route::add( '/main/bullpointa/', 'AppController@bullpointa' )->name( 'bullpointa.link' );
	#/main/bullpointb/
	Route::add( '/main/bullpointb/', 'AppController@bullpointb' )->name( 'bullpointb.link' );
	#/main/bullpointc/
	Route::add( '/main/bullpointc/', 'AppController@bullpointc' )->name( 'bullpointc.link' );
	
} );

# PREFIX GROUPING 
Route::prefix( "{adminxyz}", function(){	
	
	#/{adminxyz}/main/bullpoint/
	Route::add( '/main/bullpoint/', 'AppController@bullpoint' )->name( 'bullpoint.link' );
	
} );



# SUFFIX GROUPING 
Route::suffix( 'desk', function(){
	
	#/main/bullpoint/desk/	
	Route::add( '/main/bullpoint/', 'AppController@bullpoint' )->name( 'bullpoint.link' );
	
} );


# PREFIX AND SUFFIX GROUPING 
Route::prefix( "{adminxyz}" )->suffix( '{desk}', function(){	
	
	#/{adminxyz}/main/bullpoint/{desk}/	
	Route::add( '/main/bullpoint/', 'AppController@bullpoint' )->name( 'bullpoint.link' );
	
} );







?>