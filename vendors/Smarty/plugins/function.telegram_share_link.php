<?php

function smarty_function_telegram_share_link(){
	return 'https://telegram.me/share/url?url=' . $_SERVER['REQUEST_SCHEME'] . "://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
}