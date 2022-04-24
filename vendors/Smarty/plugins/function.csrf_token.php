<?php

function smarty_function_csrf_token(){
	return  getSession('csrf');	
}