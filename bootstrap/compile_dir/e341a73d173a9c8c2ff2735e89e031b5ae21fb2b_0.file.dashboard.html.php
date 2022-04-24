<?php
/* Smarty version 3.1.30, created on 2022-04-15 20:56:14
  from "C:\xampp\htdocs\westribbon\ourcda\home-views\residents\dashboard.html" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_6259cddea4a461_73907669',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'e341a73d173a9c8c2ff2735e89e031b5ae21fb2b' => 
    array (
      0 => 'C:\\xampp\\htdocs\\westribbon\\ourcda\\home-views\\residents\\dashboard.html',
      1 => 1650052568,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:dashboard_partial.html' => 1,
    'file:includes/residents-dashboard-header.inc.html' => 1,
  ),
),false)) {
function content_6259cddea4a461_73907669 (Smarty_Internal_Template $_smarty_tpl) {
if (!is_callable('smarty_function_base_url')) require_once 'C:\\xampp\\htdocs\\westribbon\\ourcda\\app\\vendors\\Smarty\\plugins\\function.base_url.php';
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, true);
?>

<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_11840587596259cdde983038_91818291', "title");
?>

<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_17050026186259cdde988433_92199282', "header");
?>

<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_15586268506259cddea47ec2_48776251', "main-content");
$_smarty_tpl->inheritance->endChild();
$_smarty_tpl->_subTemplateRender("file:dashboard_partial.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 2, false);
}
/* {block "title"} */
class Block_11840587596259cdde983038_91818291 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

	Parent Dashboard
<?php
}
}
/* {/block "title"} */
/* {block "header"} */
class Block_17050026186259cdde988433_92199282 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

	<?php $_smarty_tpl->_subTemplateRender("file:includes/residents-dashboard-header.inc.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

<?php
}
}
/* {/block "header"} */
/* {block "main-content"} */
class Block_15586268506259cddea47ec2_48776251 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

	
	
		<div class="">
			<div class="row mx-2 my-3">
				<div class="col-md-12">
					<h3>Diamond CDA Dashboard</h3>
				</div>
			</div>
			<div class="row mx-2  mb-4">
				<div class="col-md-3">
					<div class="my-card p-3">
						<div>
							<h3>100</h3>
							<small>
								<a href="<?php echo smarty_function_base_url(array(),$_smarty_tpl);?>
/member-offsets">CDA Residents</a>
							</small>
						</div>
						<span class="mdi mdi-account-multiple"></span>
					</div>
				</div>
				
				<div class="col-md-3">
					<div class="my-card p-3">
						<div>
							<h3>
								15
							</h3>
							<small>
								<a href="<?php echo smarty_function_base_url(array(),$_smarty_tpl);?>
/member-offsets">Committees</a>
							</small>
						</div>
						<span class="mdi mdi-account-multiple-outline"></span>
						
					</div>
				</div>
				
				<div class="col-md-3">
					<div class="my-card p-3">
						<div>
							<h3>
								&#8358;
								0.00
							</h3>
							<small>
								<a href="<?php echo smarty_function_base_url(array(),$_smarty_tpl);?>
/member-invoices">Assets</a>
							</small>
						</div>
						<span class="mdi mdi-receipt"></span>
					</div>
				</div>
				
				<div class="col-md-3">
					<div class="my-card p-3">
						<div>
							<h3>
								&#8358;
								0.00
							</h3>
							<small>
								<a href="<?php echo smarty_function_base_url(array(),$_smarty_tpl);?>
/member-invoices">Liabilities</a>
							</small>
						</div>
						<span class="mdi mdi-receipt"></span>
					</div>
				</div>
				
				
			</div>
				
			<div class="row mx-2 mb-4">	
				<div class="col-md-3">
					<div class="my-card p-3">
						<div>
							<h3>
								&#8358;
								0.00
							</h3>
							<small>
								<a href="#">Revenues</a>
							</small>
						</div>
						<span class="mdi mdi-wallet-plus"></span>
					</div>
				</div>
				
				<div class="col-md-3">
					<div class="my-card p-3">
						<div>
							<h3>
								&#8358;
								0.00
							</h3>
							<small>
								<a href="#">Expenditure</a>
							</small>
						</div>
						<span class="mdi mdi-wallet-outline"></span>
					</div>
				</div>
				
				<div class="col-md-3">
					<div class="my-card p-3">
						<div>
							<h3>
								&#8358;
								0.00
							</h3>
							<small>
								<a href="#">Reserve</a>
							</small>
						</div>
						<span class="mdi mdi-package-variant-closed"></span>
					</div>
				</div>
				
				<div class="col-md-3">
					<div class="my-card p-3">
						<div>
							<h3>
								&#8358;
								0.00
							</h3>
							<small>
								<a href="#">My Bills</a>
							</small>
						</div>
						<span class="mdi mdi-cash-multiple"></span>
					</div>
				</div>
				
				
			</div>
			
			<div class="row mx-2 my-3">
				<div class="col-md-9">
					
					<h5 class="mb-3">Latest CDA Revenues</h5>					
					<div class="card p-3 mb-5">
						<table  class="table data-table mt-3">
							<thead>
								<tr>
									<th>Sn</th>
									<th>Resident</th>
									<th>House Address</th>
									<th>Amount</th>
									<th>
										<span class="float-right">
											Date
										</span>	
									</th>
								</tr>
							</thead>
							
							<tbody>
								<tr>
									<td>1.</td>										
									<td>
										James Otedola
									</td>
									<td>123, Ige Street</td>
									<td align="right">
										$ 3,000.00											
									</td>
									<td align="right">
										24/03/2022										
									</td>										
								</tr>
								<tr>
									<td>2.</td>										
									<td>
										James Otedola
									</td>
									<td>123, Ige Street</td>
									<td align="right">
										$ 3,000.00											
									</td>
									<td align="right">
										24/03/2022										
									</td>										
								</tr>
								<tr>
									<td>3.</td>										
									<td>
										James Otedola
									</td>
									<td>123, Ige Street</td>
									<td align="right">
										$ 3,000.00											
									</td>
									<td align="right">
										24/03/2022										
									</td>										
								</tr>
								<tr>
									<td>4.</td>										
									<td>
										James Otedola
									</td>
									<td>123, Ige Street</td>
									<td align="right">
										$ 3,000.00											
									</td>
									<td align="right">
										24/03/2022										
									</td>										
								</tr>
								<tr>
									<td>5.</td>										
									<td>
										James Otedola
									</td>
									<td>123, Ige Street</td>
									<td align="right">
										$ 3,000.00											
									</td>
									<td align="right">
										24/03/2022										
									</td>										
								</tr>
								
								
							</tbody>
							
							
						</table>
					</div>
					
					<h5 class="mb-3">Latest CDA Expenses</h5>
					<div class="card p-3 mb-5">
						<table  class="table data-table mt-3">
							<thead>
								<tr>
									<th>Sn</th>
									<th>Resident</th>
									<th>House Address</th>
									<th>Amount</th>
									<th>
										<span class="float-right">
											Date
										</span>	
									</th>
								</tr>
							</thead>
							
							<tbody>
								<tr>
									<td>1.</td>										
									<td>
										James Otedola
									</td>
									<td>123, Ige Street</td>
									<td align="right">
										$ 3,000.00											
									</td>
									<td align="right">
										24/03/2022										
									</td>										
								</tr>
								<tr>
									<td>2.</td>										
									<td>
										James Otedola
									</td>
									<td>123, Ige Street</td>
									<td align="right">
										$ 3,000.00											
									</td>
									<td align="right">
										24/03/2022										
									</td>										
								</tr>
								<tr>
									<td>3.</td>										
									<td>
										James Otedola
									</td>
									<td>123, Ige Street</td>
									<td align="right">
										$ 3,000.00											
									</td>
									<td align="right">
										24/03/2022										
									</td>										
								</tr>
								<tr>
									<td>4.</td>										
									<td>
										James Otedola
									</td>
									<td>123, Ige Street</td>
									<td align="right">
										$ 3,000.00											
									</td>
									<td align="right">
										24/03/2022										
									</td>										
								</tr>
								<tr>
									<td>5.</td>										
									<td>
										James Otedola
									</td>
									<td>123, Ige Street</td>
									<td align="right">
										$ 3,000.00											
									</td>
									<td align="right">
										24/03/2022										
									</td>										
								</tr>
								
							</tbody>
							
							
						</table>
					</div>
					
					
					
				</div>
				
				<div class="col-md-3">
					
					<h5 class="mb-3">Next Meeting Days</h5>
					<div class="card p-3 mb-5">
						<ul class="meeting-day-list">
							<li>26Th Saturday, May, 2022 </li>
							<li>30Th Sunday, May, 2022 </li>
							<li>07Th Sunday, June, 2022 </li>
						</ul>
					</div>
					
										
					<h5 class="mb-3">Previous Meeting Days</h5>
					<div class="card p-3 mb-5">
						<ul class="meeting-day-list">
							<li>
								<a href="<?php echo route('cda.meetings',array('ref'=>100001));?>
">
									26Th Saturday, May, 2022 
									<i class="mdi mdi-chevron-right float-right"></i>
								</a> 
							</li>
							<li>
								<a href="<?php echo route('cda.meetings',array('ref'=>100002));?>
">
									30Th Sunday, May, 2022 
									<i class="mdi mdi-chevron-right float-right"></i>
								</a> 
							</li>
							<li>
								<a href="<?php echo route('cda.meetings',array('ref'=>100003));?>
">
									07Th Sunday, June, 2022 
									<i class="mdi mdi-chevron-right float-right"></i>
								</a> 
							</li>
							<li>
								<a href="<?php echo route('cda.meetings',array('ref'=>100004));?>
">
									26Th Saturday, May, 2022 
									<i class="mdi mdi-chevron-right float-right"></i>
								</a> 
							</li>
							<li>
								<a href="<?php echo route('cda.meetings',array('ref'=>100005));?>
">
									30Th Sunday, May, 2022 
									<i class="mdi mdi-chevron-right float-right"></i>
								</a> 
							</li>
							<li>
								<a href="<?php echo route('cda.meetings',array('ref'=>100006));?>
">
									07Th Sunday, June, 2022 
									<i class="mdi mdi-chevron-right float-right"></i>
								</a> 
							</li>
							<li>
								<a href="<?php echo route('cda.meetings',array('ref'=>100007));?>
">
									26Th Saturday, May, 2022 
									<i class="mdi mdi-chevron-right float-right"></i>
								</a> 
							</li>
							<li>
								<a href="<?php echo route('cda.meetings',array('ref'=>100008));?>
">
									30Th Sunday, May, 2022 
									<i class="mdi mdi-chevron-right float-right"></i>
								</a> 
							</li>
							<li>
								<a href="<?php echo route('cda.meetings',array('ref'=>100009));?>
">
									07Th Sunday, June, 2022 
									<i class="mdi mdi-chevron-right float-right"></i>
								</a> 
							</li>						
						</ul>
					</div>
					
					
					
					
				</div>
				
				
			</div>
			
		</div>

<?php
}
}
/* {/block "main-content"} */
}
