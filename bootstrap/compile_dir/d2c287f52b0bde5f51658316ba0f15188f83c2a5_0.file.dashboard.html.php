<?php
/* Smarty version 3.1.30, created on 2022-04-15 11:04:33
  from "C:\xampp\htdocs\westribbon\schoolhub\home-views\parents\dashboard.html" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_62594331757441_41565662',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'd2c287f52b0bde5f51658316ba0f15188f83c2a5' => 
    array (
      0 => 'C:\\xampp\\htdocs\\westribbon\\schoolhub\\home-views\\parents\\dashboard.html',
      1 => 1650017010,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:dashboard_partial.html' => 1,
    'file:includes/parents-dashboard-header.inc.html' => 1,
  ),
),false)) {
function content_62594331757441_41565662 (Smarty_Internal_Template $_smarty_tpl) {
if (!is_callable('smarty_function_base_url')) require_once 'C:\\xampp\\htdocs\\westribbon\\schoolhub\\app\\vendors\\Smarty\\plugins\\function.base_url.php';
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, true);
?>

<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_746737831625943316b9b15_79957974', "title");
?>

<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_570948643625943316cf709_58443800', "header");
?>

<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_121819063562594331755f22_15818893', "main-content");
$_smarty_tpl->inheritance->endChild();
$_smarty_tpl->_subTemplateRender("file:dashboard_partial.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 2, false);
}
/* {block "title"} */
class Block_746737831625943316b9b15_79957974 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

	Parent Dashboard
<?php
}
}
/* {/block "title"} */
/* {block "header"} */
class Block_570948643625943316cf709_58443800 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

	<?php $_smarty_tpl->_subTemplateRender("file:includes/parents-dashboard-header.inc.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

<?php
}
}
/* {/block "header"} */
/* {block "main-content"} */
class Block_121819063562594331755f22_15818893 extends Smarty_Internal_Block
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
}
