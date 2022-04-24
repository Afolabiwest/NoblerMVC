<?php
/* Smarty version 3.1.30, created on 2022-04-12 17:33:39
  from "C:\xampp\htdocs\westribbon\schoolhub\home-views\teachers\dashboard.html" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_6255a9e3b74af3_39255695',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '249eb6a7376848a77fd4bddca1c2d2fb7d9e290e' => 
    array (
      0 => 'C:\\xampp\\htdocs\\westribbon\\schoolhub\\home-views\\teachers\\dashboard.html',
      1 => 1649781216,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:master.html' => 1,
  ),
),false)) {
function content_6255a9e3b74af3_39255695 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, true);
?>

<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_3027557366255a9e3b73344_55822317', "main");
$_smarty_tpl->inheritance->endChild();
$_smarty_tpl->_subTemplateRender("file:master.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 2, false);
}
/* {block "main"} */
class Block_3027557366255a9e3b73344_55822317 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

	
	<h2>Welcome to Teachers Dashboard</h2>

<?php
}
}
/* {/block "main"} */
}
