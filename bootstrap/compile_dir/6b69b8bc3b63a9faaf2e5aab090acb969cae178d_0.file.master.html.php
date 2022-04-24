<?php
/* Smarty version 3.1.30, created on 2022-04-15 11:52:20
  from "C:\xampp\htdocs\westribbon\ourcda\home-views\master.html" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_62594e642ca1d4_81153036',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '6b69b8bc3b63a9faaf2e5aab090acb969cae178d' => 
    array (
      0 => 'C:\\xampp\\htdocs\\westribbon\\ourcda\\home-views\\master.html',
      1 => 1649933750,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_62594e642ca1d4_81153036 (Smarty_Internal_Template $_smarty_tpl) {
if (!is_callable('smarty_function_base_url')) require_once 'C:\\xampp\\htdocs\\westribbon\\ourcda\\app\\vendors\\Smarty\\plugins\\function.base_url.php';
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
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_15693313762594e6415c992_20568699', "title");
?>

		
		<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_163237657162594e6415f767_50466867', "meta");
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
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_118700878162594e642ab706_03255123', "css");
?>

		
		<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_117295299862594e642b3ea8_23975592', "style");
?>

	</head>

	<body>
		<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_28569962362594e642b8b93_04665240', "main");
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
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_174999410862594e642c5a45_65635131', "script");
?>

		
		
		<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_9323830062594e642c8346_24910014', "javascript");
?>

		
	</body>
</html><?php }
/* {block "title"} */
class Block_15693313762594e6415c992_20568699 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

			<title>Welcome to SchoolHub</title>
		<?php
}
}
/* {/block "title"} */
/* {block "meta"} */
class Block_163237657162594e6415f767_50466867 extends Smarty_Internal_Block
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
class Block_118700878162594e642ab706_03255123 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
}
}
/* {/block "css"} */
/* {block "style"} */
class Block_117295299862594e642b3ea8_23975592 extends Smarty_Internal_Block
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
class Block_28569962362594e642b8b93_04665240 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

		
		
		<?php
}
}
/* {/block "main"} */
/* {block "script"} */
class Block_174999410862594e642c5a45_65635131 extends Smarty_Internal_Block
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
class Block_9323830062594e642c8346_24910014 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
}
}
/* {/block "javascript"} */
}
