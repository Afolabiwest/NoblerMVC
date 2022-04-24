<?php
/* Smarty version 3.1.30, created on 2022-04-01 12:05:53
  from "C:\xampp\htdocs\nobler\views\index.html" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_6246dc919e32b4_50765507',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'f766cd91a896c975081c7c54b739eceba8bce797' => 
    array (
      0 => 'C:\\xampp\\htdocs\\nobler\\views\\index.html',
      1 => 1648811149,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:includes/header.inc.html' => 1,
    'file:includes/launch-cta.inc.html' => 1,
    'file:includes/footer.inc.html' => 1,
  ),
),false)) {
function content_6246dc919e32b4_50765507 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, false);
?>
<!DOCTYPE html>
<html lang="en"> 
<head>
	<base href="/" />
    <title>
		Nobler MVC
	</title>
    
    <!-- Meta -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Bootstrap Documentation Template For Software Developers">
    <meta name="author" content="Xiaoying Riley at 3rd Wave Media">    
    <link rel="shortcut icon" href="favicon.ico"> 
    
    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700&display=swap" rel="stylesheet">
    
    <!-- FontAwesome JS-->
    <?php echo '<script'; ?>
 defer src="assets/fontawesome/js/all.min.js"><?php echo '</script'; ?>
>

    <!-- Theme CSS -->  
    <link id="theme-style" rel="stylesheet" href="assets/css/theme.css">

</head> 

<body>    
	<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_18586060206246dc91973ae2_63220488', 'header');
?>


    <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_20585763586246dc919d7542_00806619', "main");
?>

	<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_547566596246dc919db9a8_18398250', "launch-cta");
?>

	
	<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_14140728476246dc919dfc51_83178308', "footer");
?>



	<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_17675556696246dc919e2120_01232234', 'javascript');
?>

   

</body>
</html> 

<?php }
/* {block 'header'} */
class Block_18586060206246dc91973ae2_63220488 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

		<?php $_smarty_tpl->_subTemplateRender("file:includes/header.inc.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

    <?php
}
}
/* {/block 'header'} */
/* {block "main"} */
class Block_20585763586246dc919d7542_00806619 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>


    <div class="page-header theme-bg-dark py-5 text-center position-relative">
	    <div class="theme-bg-shapes-right"></div>
	    <div class="theme-bg-shapes-left"></div>
	    <div class="container">
		    <h1 class="page-heading single-col-max mx-auto">
				Documentation
			</h1>
		    <div class="page-intro single-col-max mx-auto">
				Everything you need to get your web solutions 
				ready with less hassles.
			</div>
		    <div class="main-search-box pt-3 d-block mx-auto">
                 <form class="search-form w-100">
		            <input type="text" placeholder="Search the docs..." name="search" class="form-control search-input">
		            <button type="submit" class="btn search-btn" value="Search"><i class="fas fa-search"></i></button>
		        </form>
             </div>
	    </div>
    </div><!--//page-header-->
   <div class="page-content">
	    <div class="container">
		    <div class="docs-overview py-5">
			    <div class="row justify-content-center">
				    
					<div class="col-12 col-lg-4 py-3">
					    <div class="card shadow-sm">
						    <div class="card-body">
							    <h5 class="card-title mb-3">
								    <span class="theme-icon-holder card-icon-holder me-2">
								        <i class="fas fa-map-signs"></i>
							        </span><!--//card-icon-holder-->
							        <span class="card-title-text">Introduction</span>
							    </h5>
							    <div class="card-text">
								    Section overview goes here. Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor.
							    </div>
							    <a class="card-link-mask" href="/docs/section-1"></a>
						    </div><!--//card-body-->
					    </div><!--//card-->
				    </div><!--//col-->

				    <div class="col-12 col-lg-4 py-3">
					    <div class="card shadow-sm">
						    <div class="card-body">
							    <h5 class="card-title mb-3">
								    <span class="theme-icon-holder card-icon-holder me-2">
								        <i class="fas fa-arrow-down"></i>
							        </span><!--//card-icon-holder-->
							        <span class="card-title-text">Installation</span>
							    </h5>
							    <div class="card-text">
								    Section overview goes here. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo.
							    </div>
							    <a class="card-link-mask" href="/docs/section-2"></a>
						    </div><!--//card-body-->
					    </div><!--//card-->
				    </div><!--//col-->


				    <div class="col-12 col-lg-4 py-3">
					    <div class="card shadow-sm">
						    <div class="card-body">
							    <h5 class="card-title mb-3">
								    <span class="theme-icon-holder card-icon-holder me-2">
								        <i class="fas fa-box fa-fw"></i>
							        </span><!--//card-icon-holder-->
							        <span class="card-title-text">APIs</span>
							    </h5>
							    <div class="card-text">
								    Section overview goes here. Aliquam lorem ante, dapibus in, viverra quis, feugiat a, tellus. Phasellus viverra nulla ut metus varius laoreet. Quisque rutrum. Aenean imperdiet.						    
								</div>
							    <a class="card-link-mask" href="/docs/section-3"></a>
						    </div><!--//card-body-->
					    </div><!--//card-->
				    </div><!--//col-->


				    <div class="col-12 col-lg-4 py-3">
					    <div class="card shadow-sm">
						    <div class="card-body">
							    <h5 class="card-title mb-3">
								    <span class="theme-icon-holder card-icon-holder me-2">
								        <i class="fas fa-cogs fa-fw"></i>
							        </span><!--//card-icon-holder-->
							        <span class="card-title-text">Integrations</span>
							    </h5>
							    <div class="card-text">
								    Section overview goes here. Aliquam lorem ante, dapibus in, viverra quis, feugiat a, tellus. Phasellus viverra nulla ut metus varius laoreet. Quisque rutrum. Aenean imperdiet.						    
								</div>
							    <a class="card-link-mask" href="/docs/section-4"></a>
						    </div><!--//card-body-->
					    </div><!--//card-->
				    </div><!--//col-->


				    <div class="col-12 col-lg-4 py-3">
					    <div class="card shadow-sm">
						    <div class="card-body">
							    <h5 class="card-title mb-3">
								    <span class="theme-icon-holder card-icon-holder me-2">
								        <i class="fas fa-tools"></i>
							        </span><!--//card-icon-holder-->
							        <span class="card-title-text">Utilities</span>
							    </h5>
							    <div class="card-text">
								    Section overview goes here. Aliquam lorem ante, dapibus in, viverra quis, feugiat a, tellus. Phasellus viverra nulla ut metus varius laoreet. Quisque rutrum. Aenean imperdiet.						    
								</div>
							    <a class="card-link-mask" href="/docs/section-5"></a>
						    </div><!--//card-body-->
					    </div><!--//card-->
				    </div><!--//col-->

				    <div class="col-12 col-lg-4 py-3">
					    <div class="card shadow-sm">
						    <div class="card-body">
							    <h5 class="card-title mb-3">
								    <span class="theme-icon-holder card-icon-holder me-2">
								        <i class="fas fa-laptop-code"></i>
							        </span><!--//card-icon-holder-->
							        <span class="card-title-text">Web</span>
							    </h5>
							    <div class="card-text">
								    Section overview goes here. Aliquam lorem ante, dapibus in, viverra quis, feugiat a, tellus. Phasellus viverra nulla ut metus varius laoreet. Quisque rutrum. Aenean imperdiet.						    
								</div>
							    <a class="card-link-mask" href="/docs/section-6"></a>
						    </div><!--//card-body-->
					    </div><!--//card-->
				    </div><!--//col-->

				    <div class="col-12 col-lg-4 py-3">
					    <div class="card shadow-sm">
						    <div class="card-body">
							    <h5 class="card-title mb-3">
								    <span class="theme-icon-holder card-icon-holder me-2">
								        <i class="fas fa-tablet-alt"></i>
							        </span><!--//card-icon-holder-->
							        <span class="card-title-text">Mobile</span>
							    </h5>
							    <div class="card-text">
								    Section overview goes here. Aliquam lorem ante, dapibus in, viverra quis, feugiat a, tellus. Phasellus viverra nulla ut metus varius laoreet. Quisque rutrum. Aenean imperdiet.						    
								</div>
							    <a class="card-link-mask" href="/docs/section-7"></a>
						    </div><!--//card-body-->
					    </div><!--//card-->
				    </div><!--//col-->

				    <div class="col-12 col-lg-4 py-3">
					    <div class="card shadow-sm">
						    <div class="card-body">
							    <h5 class="card-title mb-3">
								    <span class="theme-icon-holder card-icon-holder me-2">
								        <i class="fas fa-book-reader"></i>
							        </span><!--//card-icon-holder-->
							        <span class="card-title-text">Resources</span>
							    </h5>
							    <div class="card-text">
								    Section overview goes here. Aliquam lorem ante, dapibus in, viverra quis, feugiat a, tellus. Phasellus viverra nulla ut metus varius laoreet. Quisque rutrum. Aenean imperdiet.						    
								</div>
							    <a class="card-link-mask" href="/docs/section-8"></a>
						    </div><!--//card-body-->
					    </div><!--//card-->
				    </div><!--//col-->
				    <div class="col-12 col-lg-4 py-3">
					    <div class="card shadow-sm">
						    <div class="card-body">
							    <h5 class="card-title mb-3">
								    <span class="theme-icon-holder card-icon-holder me-2">
								        <i class="fas fa-lightbulb"></i>
							        </span><!--//card-icon-holder-->
							        <span class="card-title-text">FAQs</span>
							    </h5>
							    <div class="card-text">
								    Section overview goes here. Aliquam lorem ante, dapibus in, viverra quis, feugiat a, tellus. Phasellus viverra nulla ut metus varius laoreet. Quisque rutrum. Aenean imperdiet.						    
								</div>
							    <a class="card-link-mask" href="/docs/section-9"></a>
						    </div><!--//card-body-->
					    </div><!--//card-->
				    </div><!--//col-->
			    </div><!--//row-->
		    </div><!--//container-->
		</div><!--//container-->
    </div><!--//page-content-->

	
	<?php
}
}
/* {/block "main"} */
/* {block "launch-cta"} */
class Block_547566596246dc919db9a8_18398250 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

		<?php $_smarty_tpl->_subTemplateRender("file:includes/launch-cta.inc.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

	<?php
}
}
/* {/block "launch-cta"} */
/* {block "footer"} */
class Block_14140728476246dc919dfc51_83178308 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

		<?php $_smarty_tpl->_subTemplateRender("file:includes/footer.inc.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

	<?php
}
}
/* {/block "footer"} */
/* {block 'javascript'} */
class Block_17675556696246dc919e2120_01232234 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

	      
		<?php echo '<script'; ?>
 src="/assets/plugins/popper.min.js"><?php echo '</script'; ?>
>
		<?php echo '<script'; ?>
 src="/assets/plugins/bootstrap/js/bootstrap.min.js"><?php echo '</script'; ?>
>  
		
		<!-- Page Specific JS -->
		<?php echo '<script'; ?>
 src="/assets/plugins/smoothscroll.min.js"><?php echo '</script'; ?>
>
		<?php echo '<script'; ?>
 src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/9.15.8/highlight.min.js"><?php echo '</script'; ?>
>
		<?php echo '<script'; ?>
 src="/assets/js/highlight-custom.js"><?php echo '</script'; ?>
> 
		<?php echo '<script'; ?>
 src="/assets/plugins/simplelightbox/simple-lightbox.min.js"><?php echo '</script'; ?>
>      
		<?php echo '<script'; ?>
 src="/assets/plugins/gumshoe/gumshoe.polyfills.min.js"><?php echo '</script'; ?>
> 
		<?php echo '<script'; ?>
 src="/assets/js/docs.js"><?php echo '</script'; ?>
> 
    <?php
}
}
/* {/block 'javascript'} */
}
