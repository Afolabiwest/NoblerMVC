<?php
/* Smarty version 3.1.30, created on 2022-04-22 10:26:00
  from "C:\xampp\htdocs\westribbon\ourcda\home-views\residents\new-cda-resident-form.html" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_626274a8a3f3f4_47767608',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'b5b924713df4a54b076d2647cb3882dbe79c11d6' => 
    array (
      0 => 'C:\\xampp\\htdocs\\westribbon\\ourcda\\home-views\\residents\\new-cda-resident-form.html',
      1 => 1650619556,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:dashboard_partial.html' => 1,
    'file:includes/residents-dashboard-header.inc.html' => 1,
  ),
),false)) {
function content_626274a8a3f3f4_47767608 (Smarty_Internal_Template $_smarty_tpl) {
if (!is_callable('smarty_function_csrf_token')) require_once 'C:\\xampp\\htdocs\\westribbon\\ourcda\\app\\vendors\\Smarty\\plugins\\function.csrf_token.php';
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, true);
?>

<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_1880389350626274a898fa25_25569273', "title");
?>

<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_1311416258626274a89945c5_79172770', "header");
?>

<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_2033234181626274a8a38b27_84384113', "main-content");
?>


<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_222642043626274a8a3e370_80099838', "script");
$_smarty_tpl->inheritance->endChild();
$_smarty_tpl->_subTemplateRender("file:dashboard_partial.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 2, false);
}
/* {block "title"} */
class Block_1880389350626274a898fa25_25569273 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

	Parent Dashboard
<?php
}
}
/* {/block "title"} */
/* {block "header"} */
class Block_1311416258626274a89945c5_79172770 extends Smarty_Internal_Block
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
class Block_2033234181626274a8a38b27_84384113 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

	
	
		<div class="">
			<div class="row mx-2 my-3">
				<div class="col-md-12">
					<h4>
						New CDA Resident Form
						
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
						<form>					
							<small>Search Resident by Name or Ref. *</small>
							<div class="form-group">
								<input data-required id="resident" name="resident" type="text" class="form-control" placeholder="Enter CDA name " />
							</div>
							
						</form>					
					</div>
				</div>
			</div>
					
				<hr> 
			<div class="row mx-2  mb-4">
				<div class="col-md-12">
					<div class="my-card p-4">
					
					</div>					
				</div>				
			</div>
				
			
			
		</div>
		<span id="form-endpoint" data-csrf = "<?php echo smarty_function_csrf_token(array(),$_smarty_tpl);?>
" data-url = "<?php echo route('post.cda.resident.search');?>
"></span>

<?php
}
}
/* {/block "main-content"} */
/* {block "script"} */
class Block_222642043626274a8a3e370_80099838 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>


<?php echo '<script'; ?>
>


	let resident 		= _id('#resident');	
	let form_endpoint 	= _id('#form-endpoint');	
	
	resident.addEventListener( "change", function(){
		let data = {
			'csrf-token': form_endpoint.getAttribute( 'data-csrf' ),   
			'resident': resident.value,   
		};
		FormApp.submitPageData( data, form_endpoint.getAttribute( 'data-url' ), function(resp){	
			console.log(resp);				
			FormApp.alert(resp.message, {status:'success'});
			
		}, function(resp){
			console.log(resp);
			FormApp.alert(resp.message);
			
		} );			
	} );
	
	
<?php echo '</script'; ?>
>


<?php
}
}
/* {/block "script"} */
}
