<?php

function smarty_function_facebook_share_link(){
	return 'https://www.facebook.com/sharer/sharer.php?u=' . $_SERVER['REQUEST_SCHEME'] . "://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
}