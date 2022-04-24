<?php
/* Smarty version 3.1.30, created on 2022-04-02 11:15:27
  from "C:\xampp\htdocs\nobler\views\includes\doc-sidebar.inc.html" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_6248223f073334_85619125',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'e5abd914c0a615d6025a41304f444c357c60d4f5' => 
    array (
      0 => 'C:\\xampp\\htdocs\\nobler\\views\\includes\\doc-sidebar.inc.html',
      1 => 1648894518,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_6248223f073334_85619125 (Smarty_Internal_Template $_smarty_tpl) {
?>
<div id="docs-sidebar" class="docs-sidebar">
	<div class="top-search-box d-lg-none p-3">
		<form class="search-form">
			<input type="text" placeholder="Search the docs..." name="search" class="form-control search-input">
			<button type="submit" class="btn search-btn" value="Search"><i class="fas fa-search"></i></button>
		</form>
	</div>
	<nav id="docs-nav" class="docs-nav navbar">
		<ul class="section-items list-unstyled nav flex-column pb-3">
			<li class="nav-item section-title">
				<a class="nav-link scrollto active" href="#section-1">
					<span class="theme-icon-holder me-2">
						<i class="fas fa-map-signs"></i>
					</span>
					Introduction
				</a>
			</li>

			
			<li class="nav-item">
				<a class="nav-link scrollto" href="#item-1-1">
					Setup and Installation
				</a>
			</li>
			<li class="nav-item">
				<a class="nav-link scrollto" href="#item-1-2">
					Directory Structure
				</a>
			</li>
			<li class="nav-item">
				<a class="nav-link scrollto" href="#item-1-3">
					Route
				</a>
			</li>
			<li class="nav-item">
				<a class="nav-link scrollto" href="#item-1-4">
					Controller
				</a>
			</li>
			<li class="nav-item">
				<a class="nav-link scrollto" href="#item-1-5">
					Views
				</a>
			</li>
			<li class="nav-item">
				<a class="nav-link scrollto" href="#item-1-6">
					Database
				</a>
			</li>
			<li class="nav-item">
				<a class="nav-link scrollto" href="#item-1-6">
					Helpers
				</a>
			</li>
			
			<li class="nav-item section-title mt-3">
				<a class="nav-link scrollto" href="#section-2">
					<span class="theme-icon-holder me-2">
						<i class="fas fa-arrow-down"></i>
					</span>
					Working With Forms
				</a>
			</li>

			<li class="nav-item">
				<a class="nav-link scrollto" href="#item-2-1">
					Creating Forms
				</a>
			</li>

			<li class="nav-item">
				<a class="nav-link scrollto" href="#item-2-2">
					Processing Forms
				</a>
			</li>

			<li class="nav-item">
				<a class="nav-link scrollto" href="#item-2-3">
					Form Validation
				</a>
			</li>
			


			<li class="nav-item section-title mt-3">
				<a class="nav-link scrollto" href="#section-3">
					<span class="theme-icon-holder me-2">
						<i class="fas fa-box"></i>
					</span>
					Tools APIs
				</a>
			</li>

			<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['tools']->value, 'item');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['item']->value) {
?>
				<li class="nav-item">
					<a class="nav-link scrollto" href="#item-3-1">
						<?php if ($_smarty_tpl->tpl_vars['item']->value != '__construct') {?>
							Tools::<?php echo $_smarty_tpl->tpl_vars['item']->value;?>
()
						<?php }?>
					</a>
				</li>
			<?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>

			



			

			<li class="nav-item section-title mt-3">
				<a class="nav-link scrollto" href="#section-4">
					<span class="theme-icon-holder me-2">
					<i class="fas fa-cogs"></i>
					</span>
					Database APIs
				</a>
			</li>

			<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['tables']->value, 'item');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['item']->value) {
?>
				<li class="nav-item">
					<a class="nav-link scrollto" href="#item-3-1">
						<?php if ($_smarty_tpl->tpl_vars['item']->value != '__construct') {?>
							Tables::get('table_name')-><?php echo $_smarty_tpl->tpl_vars['item']->value;?>
()
						<?php }?>
					</a>
				</li>
			<?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>


			<li class="nav-item section-title mt-3">
				<a class="nav-link scrollto" href="#section-5">
					<span class="theme-icon-holder me-2">
					<i class="fas fa-tools"></i>
					</span>
					Form Apis
				</a>
			</li>
			
			<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['forms']->value, 'item');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['item']->value) {
?>
				<li class="nav-item">
					<a class="nav-link scrollto" href="#item-3-1">
						<?php if ($_smarty_tpl->tpl_vars['item']->value != '__construct') {?>
							Forms::<?php echo $_smarty_tpl->tpl_vars['item']->value;?>
()
						<?php }?>
					</a>
				</li>
			<?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>


			<li class="nav-item section-title mt-3">
				<a class="nav-link scrollto" href="#section-6">
					<span class="theme-icon-holder me-2">
						<i class="fas fa-laptop-code"></i>
					</span>
					Newsletter
				</a>
			</li>
			<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['newsletters']->value, 'item');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['item']->value) {
?>
				<li class="nav-item">
					<a class="nav-link scrollto" href="#item-3-1">
						<?php if ($_smarty_tpl->tpl_vars['item']->value != '__construct') {?>
							Newsletters::<?php echo $_smarty_tpl->tpl_vars['item']->value;?>
()
						<?php }?>
					</a>
				</li>
			<?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>


			<li class="nav-item section-title mt-3">
				<a class="nav-link scrollto" href="#section-7">
					<span class="theme-icon-holder me-2">
						<i class="fas fa-tablet-alt"></i>
					</span>
					Wallet
				</a>
			</li>
			<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['wallet']->value, 'item');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['item']->value) {
?>
				<li class="nav-item">
					<a class="nav-link scrollto" href="#item-3-1">
						<?php if ($_smarty_tpl->tpl_vars['item']->value != '__construct') {?>
							Wallet::<?php echo $_smarty_tpl->tpl_vars['item']->value;?>
()
						<?php }?>
					</a>
				</li>
			<?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>


			<li class="nav-item section-title mt-3">
				<a class="nav-link scrollto" href="#section-8">
					<span class="theme-icon-holder me-2">
					<i class="fas fa-book-reader"></i>
					</span>
					Web Traffic Logging
				</a>
			</li>
			<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['websiteTrafficLog']->value, 'item');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['item']->value) {
?>
				<li class="nav-item">
					<a class="nav-link scrollto" href="#item-3-1">
						<?php if ($_smarty_tpl->tpl_vars['item']->value != '__construct') {?>
							WebsiteTrafficLog::<?php echo $_smarty_tpl->tpl_vars['item']->value;?>
()
						<?php }?>
					</a>
				</li>
			<?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>



			<li class="nav-item section-title mt-3">
				<a class="nav-link scrollto" href="#section-9">
					<span class="theme-icon-holder me-2">
						<i class="fas fa-lightbulb"></i>
					</span>
					FAQs
				</a>
			</li>
			<li class="nav-item"><a class="nav-link scrollto" href="#item-9-1">Section Item 9.1</a></li>
			<li class="nav-item"><a class="nav-link scrollto" href="#item-9-2">Section Item 9.2</a></li>
			<li class="nav-item"><a class="nav-link scrollto" href="#item-9-3">Section Item 9.3</a></li>
		</ul>

	</nav><!--//docs-nav-->
</div><!--//docs-sidebar-->

<?php }
}
