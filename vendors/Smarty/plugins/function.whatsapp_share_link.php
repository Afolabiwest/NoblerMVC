<?php

function smarty_function_whatsapp_share_link(){
	return 'https://wa.me/?text=' . $_SERVER['REQUEST_SCHEME'] . "://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
}