<?php

function smarty_function_meta_csrf(){
	return '<meta id="csrf" name="csrf-token" content="' . getSession('csrf') . '" />';
	
}