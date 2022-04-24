<?php
/* Smarty version 3.1.30, created on 2022-04-14 20:26:04
  from "C:\xampp\htdocs\westribbon\schoolhub\home-views\home.html" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_6258754ccf1533_59846485',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '117915e93141f467941da5b8228b1b95e44d7b94' => 
    array (
      0 => 'C:\\xampp\\htdocs\\westribbon\\schoolhub\\home-views\\home.html',
      1 => 1649964359,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:master.html' => 1,
  ),
),false)) {
function content_6258754ccf1533_59846485 (Smarty_Internal_Template $_smarty_tpl) {
if (!is_callable('smarty_function_form_csrf')) require_once 'C:\\xampp\\htdocs\\westribbon\\schoolhub\\app\\vendors\\Smarty\\plugins\\function.form_csrf.php';
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, true);
?>


<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_19818816046258754cbf1e42_45244251', "css");
?>

<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_4008224566258754cce8198_67525514', "main");
?>


<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_556507036258754ccecc80_61365838', "javascript");
$_smarty_tpl->inheritance->endChild();
$_smarty_tpl->_subTemplateRender("file:master.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 2, false);
}
/* {block "css"} */
class Block_19818816046258754cbf1e42_45244251 extends Smarty_Internal_Block
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
class Block_19617209716258754cce6d42_59461902 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

			<div style="max-width:360px;">
				<h2>Welcome to SchoolHub</h2>
				<h6>User Login</h6>
				<hr>
				
				<form id="user-form" action="<?php echo route('login.user');?>
" method="post">
					<?php echo smarty_function_form_csrf(array(),$_smarty_tpl);?>

					
					<small>Email</small>
					<div class="form-group">
						<input data-required type="email" class="form-control" name="email" placeholder="Enter email address " />
					</div>
					
					<small>Password</small>
					<div class="form-group">
						<input data-required type="password" class="form-control" name="password" placeholder="Enter password " />
					</div>
					
					<small>I am a</small>
					<div class="form-group">
						<select data-required class="form-control" name="account-type">
							<option value="">Select Account Type</option>
							<option value="Teacher">Teacher</option>
							<option value="Parent">Parent</option>
							
						</select>
					</div>
					
					<div class="form-group">
					
						<input id="remember" type="checkbox"  />
						<label for="remember">Remember me</label>
					</div>
					<div class="form-group">
						<button type="submit" class="btn btn-info">LOGIN</button>
					</div>
					
					
				</form>
				<hr>
				<div class="form-group">
					<p>
						<small>
							Forgot Password? <a href="<?php echo route('password.reset.request');?>
">Request Password Reset</a>
						</small>
						<br>
						<small>
							Don't have an account yet? <a href="<?php echo route('create.account');?>
">Create Account</a>
						</small>
					</p>
					
					
				</div>
			</div>
		
		<?php
}
}
/* {/block "left-column"} */
/* {block "main"} */
class Block_4008224566258754cce8198_67525514 extends Smarty_Internal_Block
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
				<a href="<?php echo route('home.contact.page');?>
">Contact Us</a>
			</li>			
		</ul>
		
		<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_19617209716258754cce6d42_59461902', "left-column", $this->tplIndex);
?>

	</div>
	
</div>

<span id="view-data" data-parent-route=""></span>

<?php
}
}
/* {/block "main"} */
/* {block "javascript"} */
class Block_556507036258754ccecc80_61365838 extends Smarty_Internal_Block
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
