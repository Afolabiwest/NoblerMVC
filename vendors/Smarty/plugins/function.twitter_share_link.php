<?php

function smarty_function_twitter_share_link(){
	return 'https://twitter.com/share?url=' . $_SERVER['REQUEST_SCHEME'] . "://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
}