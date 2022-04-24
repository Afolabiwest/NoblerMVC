<?php
/* Smarty version 3.1.30, created on 2022-04-17 14:44:03
  from "C:\xampp\htdocs\westribbon\ourcda\home-views\includes\residents-dashboard-header.inc.html" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_625c19a36dd725_71442801',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'e25b968ee654d7a3641fccdfdd3a3f6fd6b78a55' => 
    array (
      0 => 'C:\\xampp\\htdocs\\westribbon\\ourcda\\home-views\\includes\\residents-dashboard-header.inc.html',
      1 => 1650203038,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_625c19a36dd725_71442801 (Smarty_Internal_Template $_smarty_tpl) {
?>
<div class="mb-3" id="header">
	<div>
		<label for="aside-checker">
			<span class="mdi mdi-menu mdi-36px"></span>
		</label>
	</div>
	<div>&nbsp;</div>
	<div>
		<span class="float-right my-3 mr-2">
			<span class="mdi mdi-account mr-1"></span>
			Hello, 
			<strong>
				<?php echo Auth::user('resident')->firstname;?>

				<?php echo Auth::user('resident')->lastname;?>

			</strong>		
			
			<span class="mx-2">|</span>					
			<a href="<?php echo route('resident.logout');?>
">
				<span class="mdi mdi-logout-variant mr-1"></span>
				Logout
			</a>
			
		</span>
	</div>
</div><?php }
}
