<?php
$middleware = [];
$middleware['system'] = [
	'auth' => \App\Auth\Authentication::class,
];

$middleware['user'] = [
	'auth.user' => \App\Auth\UserAuthentication::class,
];

return $middleware;



?>