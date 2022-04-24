<?php

$guards =  [
	'session_key' 	=> 'user',
	'guards' 		=> [
	
		'resident' => [
			'table' => 'residents',
			'model' => 'Residents'
		],		
		
		'admin' => [
			'table' => 'admin',
			'model' => 'Admin'
		]	
		
	]
	
];


return $guards;


?>