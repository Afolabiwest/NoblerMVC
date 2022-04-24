<?php
/* Smarty version 3.1.30, created on 2022-04-15 12:28:01
  from "C:\xampp\htdocs\westribbon\ourcda\home-views\contact.html" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_625956c1010f92_72178816',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '5041133ddb913a338c103ec2c011f1eb481507c8' => 
    array (
      0 => 'C:\\xampp\\htdocs\\westribbon\\ourcda\\home-views\\contact.html',
      1 => 1650013072,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:master.html' => 1,
  ),
),false)) {
function content_625956c1010f92_72178816 (Smarty_Internal_Template $_smarty_tpl) {
if (!is_callable('smarty_function_form_csrf')) require_once 'C:\\xampp\\htdocs\\westribbon\\ourcda\\app\\vendors\\Smarty\\plugins\\function.form_csrf.php';
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, true);
?>


<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_748209479625956c0e85536_72121808', "css");
?>

<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_2053173460625956c1006ef1_78984040', "main");
?>


<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_171079370625956c100bfc3_21517276', "javascript");
$_smarty_tpl->inheritance->endChild();
$_smarty_tpl->_subTemplateRender("file:master.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 2, false);
}
/* {block "css"} */
class Block_748209479625956c0e85536_72121808 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

	<style>
		a{
			color:#17a2b8;
		}
		#home-menu{
			margin:0px 0px 2rem 0px;
			padding:0px;
		}
		
		#home-menu > li{
			display:inline-block;
		}
		
		#home-menu > li > a{
			display:block;
			padding:0 2rem;
		}
		#home-menu > li > a:first-child{
			display:block;
			padding-left:0rem !important;
		}
		
		
	</style>
<?php
}
}
/* {/block "css"} */
/* {block "left-column"} */
class Block_927506919625956c10058f4_67244695 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

			
			<h2>Welcome to SchoolHub</h2>
			<h6>Send your your feedback to us using the form below:</h6>
			<hr>
			
			<form id="user-form" action="<?php echo route('post.contact.message');?>
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
					
				</div>
				
				<small>Email</small>
				<div class="form-group">
					<input data-required type="email" class="form-control" name="email" placeholder="Enter email address " />
				</div>
				
				<small>Message</small>
				<div class="form-group">
					<textarea data-required  class="form-control" name="email" placeholder="Compose message "></textarea>
				</div>
				
				
				<div class="form-group">
					<button type="submit" class="btn btn-info">SEND MESSAGE</button>
				</div>
				
				
			</form>
			<hr>
			
			
		
		<?php
}
}
/* {/block "left-column"} */
/* {block "main"} */
class Block_2053173460625956c1006ef1_78984040 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>


<div id="wrapper">
	<div>
		
		
		
	</div>
	
	
	
	<div>
		<ul id="home-menu">
			<li>
				<a href="<?php echo route('home.page');?>
">Home</a>
			</li>
			<li>
				<a href="<?php echo route('create.account');?>
">Create Account</a>
			</li>
			
			<li>
				<a href="<?php echo route('home.about.page',array('ref'=>'address'));?>
">Contact Us</a>
			</li>			
		</ul>
		
		<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_927506919625956c10058f4_67244695', "left-column", $this->tplIndex);
?>

	</div>
	
</div>

<span id="view-data" data-parent-route=""></span>

<?php
}
}
/* {/block "main"} */
/* {block "javascript"} */
class Block_171079370625956c100bfc3_21517276 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>


	<?php echo '<script'; ?>
>	
		FormApp.postCustomForm("#user-form", function(resp){	
			console.log(resp);
			FormApp.alert( resp.message, {status:'success'} );
			location.href = resp.redirect_url;
			
		}, function(resp){
			console.log(resp);
			FormApp.alert(resp.message, {delay:4500});
			
		});
	<?php echo '</script'; ?>
>
	
<?php
}
}
/* {/block "javascript"} */
}
