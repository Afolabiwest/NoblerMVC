<?php
/* Smarty version 3.1.30, created on 2022-04-15 11:01:43
  from "C:\xampp\htdocs\westribbon\schoolhub\home-views\includes\parents-dashboard-header.inc.html" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_625942879b4c25_89441397',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '16e774025c3e72087db4c51c54986b8e1f9161c7' => 
    array (
      0 => 'C:\\xampp\\htdocs\\westribbon\\schoolhub\\home-views\\includes\\parents-dashboard-header.inc.html',
      1 => 1650016899,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_625942879b4c25_89441397 (Smarty_Internal_Template $_smarty_tpl) {
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
				<?php echo Auth::user('parent')->firstname;?>

				<?php echo Auth::user('parent')->lastname;?>

			</strong>		
			
			<span class="mx-2">|</span>					
			<a href="<?php echo route('parent.logout');?>
">
				<span class="mdi mdi-logout-variant mr-1"></span>
				Logout
			</a>
			
		</span>
	</div>
</div><?php }
}
