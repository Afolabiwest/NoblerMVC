<?php
/* Smarty version 3.1.30, created on 2022-04-16 16:46:50
  from "C:\xampp\htdocs\westribbon\ourcda\home-views\includes\cda-aside.inc.html" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_625ae4ea930796_98523072',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'ba0bae8133be541669839d7081ba1f69ff4e7b7b' => 
    array (
      0 => 'C:\\xampp\\htdocs\\westribbon\\ourcda\\home-views\\includes\\cda-aside.inc.html',
      1 => 1650124007,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_625ae4ea930796_98523072 (Smarty_Internal_Template $_smarty_tpl) {
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
				<label>Resident Dashboard</label>
			</a>				
		</li>
		
		<li>
			<a href="<?php echo route('cda.dashboard');?>
">
				<span class="mdi mdi-view-dashboard-outline"></span>
				<label>CDA Dashboard</label>
			</a>				
		</li>
		
		<li>
			<a href="<?php echo route('residents.dashboard');?>
">
				<span class="mdi mdi-account-multiple"></span>
				<label>CDA Residents</label>
			</a>				
		</li>
		
		<li>
			<a href="<?php echo route('cda.committees');?>
">
				<span class="mdi mdi-account-multiple-outline"></span>
				<label>Committees</label>
			</a>				
		</li>
		
		<li>
			<a href="<?php echo route('cda.bills');?>
">
				<span class="mdi mdi-receipt"></span>
				<label>CDA Bills</label>
			</a>				
		</li>
		
		<li>
			<a href="<?php echo route('cda.expenses');?>
">
				<span class="mdi mdi-receipt"></span>
				<label>Expenses</label>
			</a>				
		</li>
		
		<li>
			<a href="<?php echo route('cda.revenue');?>
">
				<span class="mdi mdi-receipt"></span>
				<label>Revenue</label>
			</a>				
		</li>
		
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
