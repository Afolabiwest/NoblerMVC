<?php

function smarty_function_base_url(){
	return $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST'];
} 