<?php

function smarty_function_linkedin_share_link(){
	return 'https://www.linkedin.com/shareArticle?mini=true&url=' . $_SERVER['REQUEST_SCHEME'] . "://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
}