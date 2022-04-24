<?php
/* Smarty version 3.1.30, created on 2022-04-15 10:03:31
  from "C:\xampp\htdocs\westribbon\schoolhub\home-views\includes\dashboard-header.inc.html" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_625934e325a465_38428223',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '29ee6db221cffdb8e9514a214c307ff254056e63' => 
    array (
      0 => 'C:\\xampp\\htdocs\\westribbon\\schoolhub\\home-views\\includes\\dashboard-header.inc.html',
      1 => 1649955586,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_625934e325a465_38428223 (Smarty_Internal_Template $_smarty_tpl) {
if (!is_callable('smarty_function_base_url')) require_once 'C:\\xampp\\htdocs\\westribbon\\schoolhub\\app\\vendors\\Smarty\\plugins\\function.base_url.php';
?>
<div class="mb-3" id="header">
	<div>
		<label for="aside-checker">
			<span class="mdi mdi-menu mdi-36px"></span>
		</label>
	</div>
	<div></div>
	<div>
		<span class="float-right my-3 mr-2">
			<span class="mdi mdi-account mr-1"></span>
			Hello, <strong>Dave Maggi</strong>
			
			
			<span class="mx-2">|</span>					
			<a href="<?php echo smarty_function_base_url(array(),$_smarty_tpl);?>
/cart">
				<span class="mdi mdi-cart-outline mr-1">
					Cart - 
				</span>						
				<span id="cart-items-count">0</span>
			</a>
			
			<span class="mx-2">|</span>					
			<a href="<?php echo route('logout');?>
">
				<span class="mdi mdi-logout-variant mr-1"></span>
				Logout
			</a>
			
		</span>
	</div>
</div><?php }
}
