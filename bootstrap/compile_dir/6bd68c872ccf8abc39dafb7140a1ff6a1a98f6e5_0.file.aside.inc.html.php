<?php
/* Smarty version 3.1.30, created on 2022-04-15 13:03:27
  from "C:\xampp\htdocs\westribbon\ourcda\home-views\includes\aside.inc.html" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_62595f0f7d63a5_56577767',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '6bd68c872ccf8abc39dafb7140a1ff6a1a98f6e5' => 
    array (
      0 => 'C:\\xampp\\htdocs\\westribbon\\ourcda\\home-views\\includes\\aside.inc.html',
      1 => 1649938316,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_62595f0f7d63a5_56577767 (Smarty_Internal_Template $_smarty_tpl) {
if (!is_callable('smarty_function_base_url')) require_once 'C:\\xampp\\htdocs\\westribbon\\ourcda\\app\\vendors\\Smarty\\plugins\\function.base_url.php';
?>
<input type="checkbox" id="aside-checker" name="aside-checker" />
<aside>
	<div class="px-4 py-3">
		
		<h5>				
			<span>
				<a href="<?php echo smarty_function_base_url(array(),$_smarty_tpl);?>
/projects">
					<?php echo $_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'sitename');?>

				</a>	
			</span>
		</h5>
	</div>
	<ul class="m-4">
		<li>
			<a href="<?php echo smarty_function_base_url(array(),$_smarty_tpl);?>
/member-dashboard">
				<span class="mdi mdi-view-dashboard"></span>
				<label>Dashboard</label>
			</a>				
		</li>
		
		<li>
			<a href="<?php echo smarty_function_base_url(array(),$_smarty_tpl);?>
/member-offsets">
				<span class="mdi mdi-molecule-co2"></span>
				<label>Offsets</label>
			</a>				
		</li>
		
		<li>
			<a href="<?php echo smarty_function_base_url(array(),$_smarty_tpl);?>
/member-invoices">
				<span class="mdi mdi-receipt"></span>
				<label>Invoice</label>
			</a>				
		</li>
		<li>
			<a href="<?php echo smarty_function_base_url(array(),$_smarty_tpl);?>
/member-profile-settings">
				<span class="mdi mdi-account-outline"></span>
				<label>Profile Settings</label>
			</a>				
		</li>
		
		<li>
			<a href="<?php echo smarty_function_base_url(array(),$_smarty_tpl);?>
/logout">
				<span class="mdi mdi-logout-variant"></span>
				<label>Logout</label>
			</a>				
		</li>
		
		
	</ul>
</aside><?php }
}
