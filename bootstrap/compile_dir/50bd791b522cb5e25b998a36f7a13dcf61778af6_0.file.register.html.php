<?php
/* Smarty version 3.1.30, created on 2022-04-15 12:34:30
  from "C:\xampp\htdocs\westribbon\ourcda\home-views\register.html" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_625958467515d2_54117675',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '50bd791b522cb5e25b998a36f7a13dcf61778af6' => 
    array (
      0 => 'C:\\xampp\\htdocs\\westribbon\\ourcda\\home-views\\register.html',
      1 => 1650022467,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:home.html' => 1,
  ),
),false)) {
function content_625958467515d2_54117675 (Smarty_Internal_Template $_smarty_tpl) {
if (!is_callable('smarty_function_form_csrf')) require_once 'C:\\xampp\\htdocs\\westribbon\\ourcda\\app\\vendors\\Smarty\\plugins\\function.form_csrf.php';
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, true);
?>

<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_21229297416259584674fcb2_01140553', "left-column");
$_smarty_tpl->inheritance->endChild();
$_smarty_tpl->_subTemplateRender("file:home.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 2, false);
}
/* {block "left-column"} */
class Block_21229297416259584674fcb2_01140553 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

	
	<h2>Create Account</h2>
	<h6>Fill the form to begin</h6>
	<hr>
	<form id="user-form" action="<?php echo route('register.user',array('ref1'=>'ref-one','ref2'=>'ref-two'));?>
" method="post">
		<?php echo smarty_function_form_csrf(array(),$_smarty_tpl);?>

		<div class="row">
			<div class="col-md-6">
				<small>First Name</small>
				<div class="form-group">
					<input data-required type="text" class="form-control" name="firstname" placeholder="Enter first name " />
				</div>
			</div>
			
			<div class="col-md-6">
				<small>Last Name</small>
				<div class="form-group">
					<input data-required type="text" class="form-control" name="lastname" placeholder="Enter last name" />
				</div>
			</div>			
			
			<div class="col-md-6">
				<small>Middle Name</small>
				<div class="form-group">
					<input type="text" class="form-control" name="middlename" placeholder="Enter middle name" />
				</div>
			</div>	
			
				
			
		</div>
		
		<small>Email</small>
		<div class="form-group">
			<input data-required type="email" class="form-control" name="email" placeholder="Enter email address " />
		</div>
		
		<div class="row">
			<div class="col-md-6">
				<small>Phone</small>
				<div class="form-group">
					<input data-required type="tel" class="form-control" name="phone" placeholder="Enter phone number " />
				</div>
			</div>
			
			<div class="col-md-6">
				<small>Password</small>
				<div class="form-group">
					<input data-required type="password" class="form-control" name="password" placeholder="Create password " />
				</div>
				
			</div>			
			
		</div>
		
		
		
		
		<br>
		<div class="form-group">
			<button type="submit" class="btn btn-info">CREATE ACCOUNT</button>
		</div>
		<div class="form-group">
			<p>				
				<small>
					Already have an account yet? <a href="<?php echo route('home.page');?>
">Login Here</a>
				</small>
			</p>
			
			
		</div>
		
	</form>
	<hr>
<?php
}
}
/* {/block "left-column"} */
}
