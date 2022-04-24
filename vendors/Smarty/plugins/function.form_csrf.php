<?php

function smarty_function_form_csrf(){
	return '<input type="hidden" id="csrf-token" name="csrf-token" value="' . getSession('csrf') . '" />';	
}