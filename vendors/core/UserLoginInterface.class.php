<?php

interface UserLoginInterface{

	public function requiredLoginFieldsExists();
	public function isActivated();
	public function passwordIsCorrect();
	public function loginUser();
	
}


?>