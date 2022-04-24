<?php

interface UserRegistrationInterface{

	public function requiredRegistrationFieldsExists();
	public function accounExists();
	public function passwordMatched($password1, $password2);
	public function registerUser();
	public function sendWelcomeMail(Smarty $smarty);
	
}


?>