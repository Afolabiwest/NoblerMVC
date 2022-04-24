<?php
/* Smarty version 3.1.30, created on 2022-04-22 09:40:54
  from "C:\xampp\htdocs\westribbon\ourcda\home-views\residents\cda-residents.html" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_62626a169271e5_26839362',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'ce220560abc2ad076d7bec2a8e04b87dcb95f197' => 
    array (
      0 => 'C:\\xampp\\htdocs\\westribbon\\ourcda\\home-views\\residents\\cda-residents.html',
      1 => 1650616843,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:dashboard_partial.html' => 1,
    'file:includes/residents-dashboard-header.inc.html' => 1,
    'file:includes/cda-aside.inc.html' => 1,
  ),
),false)) {
function content_62626a169271e5_26839362 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, true);
?>

<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_197735710462626a162e5c55_86569959', "title");
?>

<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_102878799962626a162ebbb5_36104101', "header");
?>


<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_16615974062626a1630f973_06225728', "sidebar");
?>


<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_103145119062626a169254b1_63390294', "main-content");
$_smarty_tpl->inheritance->endChild();
$_smarty_tpl->_subTemplateRender("file:dashboard_partial.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 2, false);
}
/* {block "title"} */
class Block_197735710462626a162e5c55_86569959 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

	Parent Dashboard
<?php
}
}
/* {/block "title"} */
/* {block "header"} */
class Block_102878799962626a162ebbb5_36104101 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

	<?php $_smarty_tpl->_subTemplateRender("file:includes/residents-dashboard-header.inc.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

<?php
}
}
/* {/block "header"} */
/* {block "sidebar"} */
class Block_16615974062626a1630f973_06225728 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

	<?php $_smarty_tpl->_subTemplateRender("file:includes/cda-aside.inc.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
	
<?php
}
}
/* {/block "sidebar"} */
/* {block "main-content"} */
class Block_103145119062626a169254b1_63390294 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

	
	
		<div class="">
			<div class="row mx-2 my-3">
				<div class="col-md-12">
					<h3>
						<?php echo $_smarty_tpl->tpl_vars['cda']->value['cda_name'];?>
 CDA Residents
						
					</h3>
					<p>
						<small>
							<a href="#" onclick="window.history.back(); return false;">
								<i class="mdi mdi-chevron-left"></i>
								Back
							</a>
						</small>						
					</p>
				</div>
			</div>
			
			
			<div class="row mx-2 my-3">
				<div class="col-md-12">
				
					<h5 class="mb-3">
						Residents
						<span class="float-right">
							<a href="<?php echo route('new.cda.resident.form');?>
">
								<i class="mdi mdi-plus-box-outline"></i>
							</a>
						</span>	
					</h5>					
					<div class="card p-3 mb-5">
						<table  class="table data-table mt-3">
							<thead>
								<tr>
									<th>Sn</th>
									<th>Resident</th>
									<th>House Address</th>
									<th>Amount</th>
									<th>
										<span class="float-right">
											Date
										</span>	
									</th>
								</tr>
							</thead>
							
							<tbody>
								
							</tbody>
							
							
						</table>
					</div>

				</div>
			</div>
			
		</div>

<?php
}
}
/* {/block "main-content"} */
}
