<?php
/* Smarty version 3.1.30, created on 2022-04-15 11:04:34
  from "C:\xampp\htdocs\westribbon\schoolhub\home-views\dashboard_partial.html" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_625943320c6b92_68619350',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '3b2eca646182f6406e19b2f3cc9bd86bd0d04649' => 
    array (
      0 => 'C:\\xampp\\htdocs\\westribbon\\schoolhub\\home-views\\dashboard_partial.html',
      1 => 1650017068,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:includes/aside.inc.html' => 1,
    'file:includes/dashboard-header.inc.html' => 1,
  ),
),false)) {
function content_625943320c6b92_68619350 (Smarty_Internal_Template $_smarty_tpl) {
if (!is_callable('smarty_function_meta_csrf')) require_once 'C:\\xampp\\htdocs\\westribbon\\schoolhub\\app\\vendors\\Smarty\\plugins\\function.meta_csrf.php';
if (!is_callable('smarty_function_base_url')) require_once 'C:\\xampp\\htdocs\\westribbon\\schoolhub\\app\\vendors\\Smarty\\plugins\\function.base_url.php';
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, false);
?>
<!DOCTYPE html>
<html>
<head>
	<?php echo smarty_function_meta_csrf(array(),$_smarty_tpl);?>

	
	<title>
		<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_58256630162594332098306_65183390', "title");
?>

	</title>
	
	<link rel="shortcut icon" href="/favicon.png">
	<link href="<?php echo smarty_function_base_url(array(),$_smarty_tpl);?>
/assets/dashboard/assets/css/member-dashboard.css" type="text/css" rel="stylesheet" />
	<link href="<?php echo smarty_function_base_url(array(),$_smarty_tpl);?>
/assets/dashboard/assets/css/bootstrap.min.css" rel="stylesheet">
	<link href="<?php echo smarty_function_base_url(array(),$_smarty_tpl);?>
/assets/dashboard/assets/css/materialdesignicons.min.css" rel="stylesheet">
	<link href="<?php echo smarty_function_base_url(array(),$_smarty_tpl);?>
/assets/dashboard/assets/vendors/DataTables/datatables.min.css" rel="stylesheet" type="text/css" >
	<link href="//fonts.gstatic.com" rel="dns-prefetch" >
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
	<style type="text/css">
		a{
			text-decoration:none !important;
		}
		
		.title-links{
			display:inline-block;
			margin-top:0.3rem;
			font-size:16px;
		}
		.btn-theme{
			background-color:var(--aside-bg-color) !important;
			color:#fff !important;
		}
		
		.hide{
			display:none !important;
		}
		.inline-block{
			display:inline-block !important;
		}
		
		
	</style>
	
	<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_1705167516259433209fd77_46771232', "style");
?>


</head>
<body>
				
<section class="wrapper">
	<?php $_smarty_tpl->_subTemplateRender("file:includes/aside.inc.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
		
	<div class="main">
		
		<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_1177945045625943320a5bd9_51175678', "header");
?>

		
		<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_370313417625943320bd7f8_54362288', "main-content");
?>

	
		
	</div>
	
	

</section>


<?php echo '<script'; ?>
 src="<?php echo smarty_function_base_url(array(),$_smarty_tpl);?>
/assets/dashboard/assets/js/jquery.min.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="<?php echo smarty_function_base_url(array(),$_smarty_tpl);?>
/assets/dashboard/assets/vendors/DataTables/datatables.min.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="<?php echo smarty_function_base_url(array(),$_smarty_tpl);?>
/assets/dashboard/assets/vendors/DataTables/Buttons/js/dataTables.buttons.min.js"><?php echo '</script'; ?>
>		
<?php echo '<script'; ?>
 src="<?php echo smarty_function_base_url(array(),$_smarty_tpl);?>
/assets/dashboard/assets/js/offset-shopping-cart.js"><?php echo '</script'; ?>
>

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

<?php echo '</script'; ?>
>


<?php echo '<script'; ?>
>

	$(document).ready(function() {				
		$('table').DataTable( {
			dom: 'Bfrtip',
			buttons: [
				'copy', 'csv', 'excel', 'pdf', 'print'
			], 
			'pageLength':5	
		} );				
	} );

<?php echo '</script'; ?>
>

<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_704002366625943320c48a7_33271700', "script");
?>



</body>
</html><?php }
/* {block "title"} */
class Block_58256630162594332098306_65183390 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

			Dashboard
		<?php
}
}
/* {/block "title"} */
/* {block "style"} */
class Block_1705167516259433209fd77_46771232 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
}
}
/* {/block "style"} */
/* {block "header"} */
class Block_1177945045625943320a5bd9_51175678 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

			<?php $_smarty_tpl->_subTemplateRender("file:includes/dashboard-header.inc.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

		<?php
}
}
/* {/block "header"} */
/* {block "main-content"} */
class Block_370313417625943320bd7f8_54362288 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

		
		<div class="">
			<div class="row mx-2 my-3">
				<div class="col-md-12">
					<h3>Dashboard</h3>
				</div>
			</div>
			<div class="row mx-2">
				<div class="col-md-3">
					<div class="my-card p-3">
						<div>
							<h3>6</h3>
							<small>
								<a href="<?php echo smarty_function_base_url(array(),$_smarty_tpl);?>
/member-offsets">Offsets</a>
							</small>
						</div>
						<span class="mdi mdi-molecule-co2"></span>
					</div>
				</div>
				
				<div class="col-md-3">
					<div class="my-card p-3">
						<div>
							<h3>
								$
								14,700.00
							</h3>
							<small>
								<a href="<?php echo smarty_function_base_url(array(),$_smarty_tpl);?>
/member-offsets">Offsets Worth</a>
							</small>
						</div>
						<span class="mdi mdi-molecule-co"></span>
						
					</div>
				</div>
				
				<div class="col-md-3">
					<div class="my-card p-3">
						<div>
							<h3>7</h3>
							<small>
								<a href="<?php echo smarty_function_base_url(array(),$_smarty_tpl);?>
/member-invoices">Invoice</a>
							</small>
						</div>
						<span class="mdi mdi-receipt"></span>
					</div>
				</div>
				
				<div class="col-md-3">
					<div class="my-card p-3">
						<div>
							<h3>
								$
								0.00
							</h3>
							<small>
								<a href="#">Wallet Balance</a>
							</small>
						</div>
						<span class="mdi mdi-wallet"></span>
					</div>
				</div>
				
				
			</div>
			
			<div class="row mx-2 my-3">
				<div class="col-md-12">
					<h3>Latest Offsets</h3>
				</div>
			</div>
			
			<div class="row mx-2 my-3">
				<div class="col-md-12">
					<div class="card p-3 mb-5">
						<table  class="table data-table mt-3">
							<thead>
								<tr>
									<th>Sn</th>
									<th width="45%">Project</th>
									<th>Unit Price</th>
									<th>Tonnes</th>
									<th>
										<span class="float-right">
											Amount/Certificate
										</span>	
									</th>
								</tr>
							</thead>
							
							<tbody>
									<tr>
										<td>1.</td>
										<td>
											<a target="_blank" href="<?php echo smarty_function_base_url(array(),$_smarty_tpl);?>
/project/lorem-ipsum-dolor-sit-amet-consectetur-adipiscing-elit">
												<i class="mdi mdi-link-variant"></i>
												Lorem ipsum dolor sit amet, consectetur adipiscing elit
											</a>
											
										</td>
										<td>
											$ 420.00</td>
										<td>10,000.00</td>
										<td align="right">
											$ 4,200,000.00
											<span class="mx-1">|</span>
											<a href="<?php echo smarty_function_base_url(array(),$_smarty_tpl);?>
/member-offset-certificate/OFF45SCFHZ5">
												View Certificate
											</a>
										</td>
									</tr>
																<tr>
										<td>2.</td>
										<td>
											<a target="_blank" href="<?php echo smarty_function_base_url(array(),$_smarty_tpl);?>
/project/lorem-ipsum-dolor-sit-amet-consectetur-adipiscing-elit">
												<i class="mdi mdi-link-variant"></i>
																								Lorem ipsum dolor sit amet, consectetur adipiscing elit
																						</a>
											
										</td>
										<td>
											$ 420.00</td>
										<td>1,000.00</td>
										<td align="right">
											$ 420,000.00
											<span class="mx-1">|</span>
											<a href="<?php echo smarty_function_base_url(array(),$_smarty_tpl);?>
/member-offset-certificate/OFF45SCFHY9">
												View Certificate
											</a>
										</td>
									</tr>
																<tr>
										<td>3.</td>
										<td>
											<a target="_blank" href="<?php echo smarty_function_base_url(array(),$_smarty_tpl);?>
/project/lorem-ipsum-dolor-sit-amet-consectetur-adipiscing-elit-3">
												<i class="mdi mdi-link-variant"></i>
																								Lorem ipsum dolor sit amet, consectetur adipiscing elit
																						</a>
											
										</td>
										<td>
											$ 420.00</td>
										<td>300.00</td>
										<td align="right">
											$ 126,000.00
											<span class="mx-1">|</span>
											<a href="<?php echo smarty_function_base_url(array(),$_smarty_tpl);?>
/member-offset-certificate/OFF45SCFHY8">
												View Certificate
											</a>
										</td>
									</tr>
																<tr>
										<td>4.</td>
										<td>
											<a target="_blank" href="<?php echo smarty_function_base_url(array(),$_smarty_tpl);?>
/project/lorem-ipsum-dolor-sit-amet-consectetur-adipiscing-elit">
												<i class="mdi mdi-link-variant"></i>
																								Lorem ipsum dolor sit amet, consectetur adipiscing elit
																						</a>
											
										</td>
										<td>
											$ 420.00</td>
										<td>100.00</td>
										<td align="right">
											$ 42,000.00
											<span class="mx-1">|</span>
											<a href="<?php echo smarty_function_base_url(array(),$_smarty_tpl);?>
/member-offset-certificate/OFF45SCFHY7">
												View Certificate
											</a>
										</td>
									</tr>
																<tr>
										<td>5.</td>
										<td>
											<a target="_blank" href="<?php echo smarty_function_base_url(array(),$_smarty_tpl);?>
/project/lorem-ipsum-dolor-sit-amet-consectetur-adipiscing-elit-3">
												<i class="mdi mdi-link-variant"></i>
													Lorem ipsum dolor sit amet, consectetur adipiscing elit
											</a>
											
										</td>
										<td>
											$ 420.00</td>
										<td>700.00</td>
										<td align="right">
											$ 294,000.00
											<span class="mx-1">|</span>
											<a href="<?php echo smarty_function_base_url(array(),$_smarty_tpl);?>
/member-offset-certificate/OFF45SCFHY6">
												View Certificate
											</a>
										</td>
									</tr>
															
								
							</tbody>
							
							
						</table>
					</div>
				</div>
			</div>
			
		</div>
	
		<?php
}
}
/* {/block "main-content"} */
/* {block "script"} */
class Block_704002366625943320c48a7_33271700 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
}
}
/* {/block "script"} */
}
