<?php
/* Smarty version 3.1.30, created on 2022-04-14 11:55:56
  from "C:\xampp\htdocs\westribbon\schoolhub\home-views\master.html" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_6257fdbc39b1f1_15167013',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'b257749cd621e5a4a78d4e302eea00ceefcaddeb' => 
    array (
      0 => 'C:\\xampp\\htdocs\\westribbon\\schoolhub\\home-views\\master.html',
      1 => 1649933750,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_6257fdbc39b1f1_15167013 (Smarty_Internal_Template $_smarty_tpl) {
if (!is_callable('smarty_function_base_url')) require_once 'C:\\xampp\\htdocs\\westribbon\\schoolhub\\app\\vendors\\Smarty\\plugins\\function.base_url.php';
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, false);
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<base href="/" />
		<meta charset="utf-8" />
		<meta name="author" content="Afolabi Oloruntola" />
		<meta name="viewport" content="width=device-width, initial-scale=1">
		
		<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_18963884776257fdbc317ac2_16489662', "title");
?>

		
		<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_1874956636257fdbc31ab87_31508314', "meta");
?>

		<link rel="shortcut icon" href="/favicon.png">
		<!-- Custom CSS -->
		<link href="<?php echo smarty_function_base_url(array(),$_smarty_tpl);?>
/assets/css/bootstrap.min.css" rel="stylesheet">
		<link href="<?php echo smarty_function_base_url(array(),$_smarty_tpl);?>
/assets/css/materialdesignicons.min.css" rel="stylesheet">
		<link href="<?php echo smarty_function_base_url(array(),$_smarty_tpl);?>
/assets/css/header.css" rel="stylesheet">
		<link href="<?php echo smarty_function_base_url(array(),$_smarty_tpl);?>
/assets/css/style.css" rel="stylesheet">
		<link href="<?php echo smarty_function_base_url(array(),$_smarty_tpl);?>
/assets/css/footer.css" rel="stylesheet">
		
		<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_16331655036257fdbc37b2a0_72271344', "css");
?>

		
		<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_3266488846257fdbc380d75_37720510', "style");
?>

	</head>

	<body>
		<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_14941504166257fdbc383984_31446663', "main");
?>

		
		<?php echo '<script'; ?>
 src="<?php echo smarty_function_base_url(array(),$_smarty_tpl);?>
/assets/js/jquery.min.js"><?php echo '</script'; ?>
>
		<?php echo '<script'; ?>
 src="<?php echo smarty_function_base_url(array(),$_smarty_tpl);?>
/assets/js/bootstrap.min.js"><?php echo '</script'; ?>
>
		<?php echo '<script'; ?>
 src="<?php echo smarty_function_base_url(array(),$_smarty_tpl);?>
/assets/js/search-filter.min.js"><?php echo '</script'; ?>
>
		<?php echo '<script'; ?>
 src="<?php echo smarty_function_base_url(array(),$_smarty_tpl);?>
/assets/js/form-app.js"><?php echo '</script'; ?>
>
		
		
		
		<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_463157776257fdbc395308_04922799', "script");
?>

		
		
		<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_6371942266257fdbc3999a0_19303388', "javascript");
?>

		
	</body>
</html><?php }
/* {block "title"} */
class Block_18963884776257fdbc317ac2_16489662 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

			<title>Welcome to SchoolHub</title>
		<?php
}
}
/* {/block "title"} */
/* {block "meta"} */
class Block_1874956636257fdbc31ab87_31508314 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

			<meta name="keywords" content="school, report-card">
			<meta name="description" content="Welcome to SchoolHub">
		<?php
}
}
/* {/block "meta"} */
/* {block "css"} */
class Block_16331655036257fdbc37b2a0_72271344 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
}
}
/* {/block "css"} */
/* {block "style"} */
class Block_3266488846257fdbc380d75_37720510 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

			<style>
				body{
					margin:0;
				}
				#wrapper{
					display:flex;				
				}
				
				#wrapper > div{								
					height:100vh;					
					overflow:auto;				
				}
				
				#wrapper > div:first-child{
					width:72%;	
					padding:3rem;
					background-color:#00b8ff;
					background-image:url(/assets/images/pupils.jpg);
					background-size:cover;
				}
				
				#wrapper > div:last-child{
					width:100%;	
					padding:3rem 6rem;
				}
				
				#wrapper > div:first-child h1{
					color:#ffffff;
				}
				
				@media only screen and ( max-width:900px){
					#wrapper{
						display:block !important;				
					}
					
					#wrapper > div{								
						height:auto !important;					
						overflow:auto;				
					}
					
					#wrapper > div:first-child{
						width:100% !important;	
						padding:1.5rem;
						background-color:#00b8ff;
					}
					
					#wrapper > div:last-child{
						width:100% !important;	
						padding:3rem 1.5rem;
					}
				}
				
			</style>
		<?php
}
}
/* {/block "style"} */
/* {block "main"} */
class Block_14941504166257fdbc383984_31446663 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

		
		
		<?php
}
}
/* {/block "main"} */
/* {block "script"} */
class Block_463157776257fdbc395308_04922799 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

		
		<?php echo '<script'; ?>
>

			function _id(id){
				return document.querySelector(id);
			}

			function _class(className){
				return document.querySelectorAll(className);
			}

			function _createElement(element){
				return document.createElement(element);
			}

			function _class(className){
				return document.querySelectorAll(className);
			}
			

			

			FormApp.postCustomForm("#newsletter-form", function(resp){	
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
/* {block "javascript"} */
class Block_6371942266257fdbc3999a0_19303388 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
}
}
/* {/block "javascript"} */
}
