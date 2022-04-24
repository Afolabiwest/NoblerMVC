<?php

function smarty_function_form_radio($params = [], $template){
	 require_once(SMARTY_PLUGINS_DIR . 'shared.escape_special_chars.php');
	if(!isset($params['class'])) throw('Set attribute "class"'); 
	if(!isset($params['name'])) throw('Set attribute "name"'); 
	if(!isset($params['value'])) throw('Set attribute "value"');
	if(!isset($params['label'])) throw('Set attribute "label"');
	if(!isset($params['default'])){
		return "<div class="{$params['class']}" data-name="{$params['class']}" data-value="{$params['class']}" data-label="{$params['class']}" ></div>";
	}
	return "<div class="{$params['class']}" data-name="{$params['class']}" data-value="{$params['class']}" data-label="{$params['class']}" data-default></div>";
}