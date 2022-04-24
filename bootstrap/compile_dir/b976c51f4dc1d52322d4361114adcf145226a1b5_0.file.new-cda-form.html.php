<?php
/* Smarty version 3.1.30, created on 2022-04-19 02:12:28
  from "C:\xampp\htdocs\westribbon\ourcda\home-views\residents\new-cda-form.html" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_625e0c7ccceb69_21348577',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'b976c51f4dc1d52322d4361114adcf145226a1b5' => 
    array (
      0 => 'C:\\xampp\\htdocs\\westribbon\\ourcda\\home-views\\residents\\new-cda-form.html',
      1 => 1650330744,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:dashboard_partial.html' => 1,
    'file:includes/residents-dashboard-header.inc.html' => 1,
  ),
),false)) {
function content_625e0c7ccceb69_21348577 (Smarty_Internal_Template $_smarty_tpl) {
if (!is_callable('smarty_function_form_csrf')) require_once 'C:\\xampp\\htdocs\\westribbon\\ourcda\\app\\vendors\\Smarty\\plugins\\function.form_csrf.php';
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, true);
?>

<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_1346929694625e0c7c93e7c0_21738196', "title");
?>

<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_1484724624625e0c7c943372_70037280', "header");
?>

<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_956305199625e0c7ccc4a03_53978818', "main-content");
?>


<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_20102329625e0c7cccc506_29948546', "script");
$_smarty_tpl->inheritance->endChild();
$_smarty_tpl->_subTemplateRender("file:dashboard_partial.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 2, false);
}
/* {block "title"} */
class Block_1346929694625e0c7c93e7c0_21738196 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

	Parent Dashboard
<?php
}
}
/* {/block "title"} */
/* {block "header"} */
class Block_1484724624625e0c7c943372_70037280 extends Smarty_Internal_Block
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
class Block_956305199625e0c7ccc4a03_53978818 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

	
	
		<div class="">
			<div class="row mx-2 my-3">
				<div class="col-md-12">
					<h4>
						New Resident CDA Form
						
					</h4>
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
				<div class="col-md-9">
					<div class="my-card p-4">
						
						<form id="user-form" method="post" action="<?php echo route('post.new.cda');?>
">
							<?php echo smarty_function_form_csrf(array(),$_smarty_tpl);?>

							<small>CDA Name *</small>
							<div class="form-group">
								<input data-required name="cda_name" type="text" class="form-control" placeholder="Enter CDA name " />
							</div>
							
							<div class="row">
								
								<div class="col-md-6">
									<small>Country *</small>
									<div class="form-group">
										<select data-required name="country_ref" class="form-control">
											<option value="">Select Country</option>
											<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['form_options']->value['countries'], 'item');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['item']->value) {
?>
												<option value="<?php echo $_smarty_tpl->tpl_vars['item']->value['ref'];?>
"><?php echo $_smarty_tpl->tpl_vars['item']->value['country'];?>
</option>
											<?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>

										</select>
									</div>
								</div>
								
								<div class="col-md-6">
									<small>State *</small>
									<div class="form-group">
										<select data-required name="state_ref" class="form-control">
											<option value="">Select Country</option>
											<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['form_options']->value['states'], 'item');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['item']->value) {
?>
												<option value="<?php echo $_smarty_tpl->tpl_vars['item']->value['ref'];?>
"><?php echo $_smarty_tpl->tpl_vars['item']->value['state'];?>
</option>
											<?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>

										</select>
									</div>
								</div>
							</div>
							<div class="row">	
								<div class="col-md-6">
									<small>City/Town *</small>
									<div class="form-group">
										<select data-required name="city_ref" class="form-control">
											<option value="">Select Country</option>
											<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['form_options']->value['cities'], 'item');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['item']->value) {
?>
												<option value="<?php echo $_smarty_tpl->tpl_vars['item']->value['ref'];?>
"><?php echo $_smarty_tpl->tpl_vars['item']->value['city'];?>
</option>
											<?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>

										</select>
									</div>
								</div>
								
								<div class="col-md-6">
									<small>Community *</small>
									<div class="form-group">
										<select data-required name="community_ref" class="form-control">
											<option value="">Select Country</option>
											<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['form_options']->value['communities'], 'item');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['item']->value) {
?>
												<option value="<?php echo $_smarty_tpl->tpl_vars['item']->value['ref'];?>
"><?php echo $_smarty_tpl->tpl_vars['item']->value['community'];?>
</option>
											<?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>

										</select>
									</div>
								</div>
								
								
							</div>
							<hr>
							<div class="form-group">
								<button type="submit" class="btn btn-info">CREATE CDA</button>
							</div>
						
						</form>
					</div>
				</div>
				
				
				
				
			</div>
				
			
			
		</div>

<?php
}
}
/* {/block "main-content"} */
/* {block "script"} */
class Block_20102329625e0c7cccc506_29948546 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>


<?php echo '<script'; ?>
>
	FormApp.postCustomForm("#user-form", function(resp){	
		console.log(resp);				
		FormApp.alert(resp.message, {status:'success'});
		
	}, function(resp){
		console.log(resp);
		FormApp.alert(resp.message);
		
	});
<?php echo '</script'; ?>
>


<?php
}
}
/* {/block "script"} */
}
