<?php
/* Smarty version 3.1.30, created on 2022-04-19 03:24:07
  from "C:\xampp\htdocs\westribbon\ourcda\home-views\residents\resident-cdas.html" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_625e1d47c06c54_16925888',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '6f0fd17c5bd27df23f5e016503d8a8566c3727a5' => 
    array (
      0 => 'C:\\xampp\\htdocs\\westribbon\\ourcda\\home-views\\residents\\resident-cdas.html',
      1 => 1650335043,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:dashboard_partial.html' => 1,
    'file:includes/residents-dashboard-header.inc.html' => 1,
  ),
),false)) {
function content_625e1d47c06c54_16925888 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, true);
?>

<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_816698011625e1d47aedff3_18717905', "title");
?>

<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_1841662774625e1d47af1552_29503402', "style");
?>

<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_657362345625e1d47af5ae0_62439184', "header");
?>

<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_374243967625e1d47c04ed2_57592633', "main-content");
$_smarty_tpl->inheritance->endChild();
$_smarty_tpl->_subTemplateRender("file:dashboard_partial.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 2, false);
}
/* {block "title"} */
class Block_816698011625e1d47aedff3_18717905 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

	Parent Dashboard
<?php
}
}
/* {/block "title"} */
/* {block "style"} */
class Block_1841662774625e1d47af1552_29503402 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

	<style>
		i.red{
			color:#ff0000 !important;
		}
	</style>
<?php
}
}
/* {/block "style"} */
/* {block "header"} */
class Block_657362345625e1d47af5ae0_62439184 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

	<?php $_smarty_tpl->_subTemplateRender("file:includes/residents-dashboard-header.inc.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

<?php
}
}
/* {/block "header"} */
/* {block "main-content"} */
class Block_374243967625e1d47c04ed2_57592633 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

	
	
		<div class="">
			<div class="row mx-2 my-3">
				<div class="col-md-12">
					<h3>
						Resident CDAs
						<span class="float-right">
							<a href="<?php echo route('new.cda.form');?>
">
								<i class="mdi mdi-plus-box-outline"></i>
							</a>
						</span>
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
			<div class="row mx-2  mb-4">
				
				<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['resident_cdas']->value, 'item');
$_smarty_tpl->tpl_vars['item']->index = -1;
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['item']->value) {
$_smarty_tpl->tpl_vars['item']->index++;
$__foreach_item_0_saved = $_smarty_tpl->tpl_vars['item'];
?>
					
					<div class="col-md-4">
						<div class="my-card p-3">
							<div>
								<h5>
									<a href="<?php echo route('cda.dashboard',array('ref'=>$_smarty_tpl->tpl_vars['item']->value['ref']));?>
">
										<?php echo $_smarty_tpl->tpl_vars['item']->value['cda'];?>
 CDA
									</a>	
								</h5>
								<small>
									<a href="<?php echo route('cda.dashboard',array('ref'=>$_smarty_tpl->tpl_vars['item']->value['ref']));?>
">
										<?php echo $_smarty_tpl->tpl_vars['item']->value['community'];?>
,
										<?php echo $_smarty_tpl->tpl_vars['item']->value['city'];?>
,
										<?php echo $_smarty_tpl->tpl_vars['item']->value['state'];?>
,
										<?php echo $_smarty_tpl->tpl_vars['item']->value['country'];?>

										
										
									</a>
								</small>
							</div>
							<i class="mdi mdi-home-city-outline" <?php if ($_smarty_tpl->tpl_vars['item']->value['cda_is_active'] == 0) {?>style="color:#ff3b00 !important;"<?php }?>></i>
						</div>
					</div>
					
					<?php if (($_smarty_tpl->tpl_vars['item']->index+1)%3 == 0) {?>
						</div>
						<div class="row mx-2  mb-4">
					<?php }?>
					
				<?php
$_smarty_tpl->tpl_vars['item'] = $__foreach_item_0_saved;
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>

				
				
				
			</div>
				
			<hr>
			
		</div>

<?php
}
}
/* {/block "main-content"} */
}
