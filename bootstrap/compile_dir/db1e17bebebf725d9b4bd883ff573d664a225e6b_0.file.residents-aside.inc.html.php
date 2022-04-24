<?php
/* Smarty version 3.1.30, created on 2022-04-18 23:33:24
  from "C:\xampp\htdocs\westribbon\ourcda\home-views\includes\residents-aside.inc.html" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_625de734772600_68192241',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'db1e17bebebf725d9b4bd883ff573d664a225e6b' => 
    array (
      0 => 'C:\\xampp\\htdocs\\westribbon\\ourcda\\home-views\\includes\\residents-aside.inc.html',
      1 => 1650321182,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_625de734772600_68192241 (Smarty_Internal_Template $_smarty_tpl) {
if (!is_callable('smarty_function_base_url')) require_once 'C:\\xampp\\htdocs\\westribbon\\ourcda\\app\\vendors\\Smarty\\plugins\\function.base_url.php';
?>
<input type="checkbox" id="aside-checker" name="aside-checker" />
<aside>
	<div class="px-4 py-3">
		
		<h5>				
			<span>
				<a href="<?php echo smarty_function_base_url(array(),$_smarty_tpl);?>
">
					<?php echo $_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'sitename');?>

				</a>	
			</span>
		</h5>
	</div>
	<ul class="m-4">
		<li>
			<a href="<?php echo route('residents.dashboard');?>
">
				<span class="mdi mdi-view-dashboard"></span>
				<label>Dashboard</label>
			</a>				
		</li>
		
		<li>
			<a href="<?php echo route('residents.cdas');?>
">
				<span class="mdi mdi-account-multiple-outline"></span>
				<label>CDAs</label>
			</a>				
		</li>
		
		<!-- 
		<li>
			<a href="<?php echo route('residents.bills');?>
">
				<span class="mdi mdi-receipt"></span>
				<label>Bills</label>
			</a>				
		</li>		
		 -->
		
		<li>
			<a href="<?php echo route('residents.profile');?>
">
				<span class="mdi mdi-account-outline"></span>
				<label>Profile Settings</label>
			</a>				
		</li>
		
		<li>
			<a href="<?php echo route('resident.logout');?>
">
				<span class="mdi mdi-logout-variant"></span>
				<label>Logout</label>
				
			</a>				
		</li>
		
		
	</ul>
</aside><?php }
}
