<?php
/* Smarty version 3.1.30, created on 2022-04-20 15:40:39
  from "C:\xampp\htdocs\westribbon\ourcda\home-views\residents\cda-dashboard.html" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_62601b673bdae3_05729350',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '8b2976d7ab471ac5e93358a82ce2ce326073f3ec' => 
    array (
      0 => 'C:\\xampp\\htdocs\\westribbon\\ourcda\\home-views\\residents\\cda-dashboard.html',
      1 => 1650465634,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:dashboard_partial.html' => 1,
    'file:includes/residents-dashboard-header.inc.html' => 1,
    'file:includes/cda-aside.inc.html' => 1,
  ),
),false)) {
function content_62601b673bdae3_05729350 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, true);
?>

<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_53036874162601b67285b83_51425232', "title");
?>

<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_171268045062601b6728b786_80705812', "header");
?>


<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_37488636162601b67290684_60558195', "sidebar");
?>


<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_148972759762601b673bb917_74904326', "main-content");
$_smarty_tpl->inheritance->endChild();
$_smarty_tpl->_subTemplateRender("file:dashboard_partial.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 2, false);
}
/* {block "title"} */
class Block_53036874162601b67285b83_51425232 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

	Parent Dashboard
<?php
}
}
/* {/block "title"} */
/* {block "header"} */
class Block_171268045062601b6728b786_80705812 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

	<?php $_smarty_tpl->_subTemplateRender("file:includes/residents-dashboard-header.inc.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

<?php
}
}
/* {/block "header"} */
/* {block "sidebar"} */
class Block_37488636162601b67290684_60558195 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

	<?php $_smarty_tpl->_subTemplateRender("file:includes/cda-aside.inc.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
	
<?php
}
}
/* {/block "sidebar"} */
/* {block "main-content"} */
class Block_148972759762601b673bb917_74904326 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

	
	
		<div class="">
			<div class="row mx-2 my-3">
				<div class="col-md-12">
					<h3><?php echo $_smarty_tpl->tpl_vars['cda_data']->value['cda_name'];?>
 CDA Dashboard</h3>
					<p>
						<small>
							<a href="#" onclick="window.history.back(); return false;">
								<i class="mdi mdi-chevron-left"></i>
								Back
							</a>
						</small>						
					</p>
				</div>
			</div>
			
			
			<div class="row mx-2  mb-4">
				<div class="col-md-4">
					<div class="my-card p-3">
						<div>
							<h3><?php echo $_smarty_tpl->tpl_vars['cda_resident_count']->value;?>
</h3>
							<small>
								<a href="<?php echo route('cda.residents',array('ref'=>$_smarty_tpl->tpl_vars['ref']->value));?>
">
									CDA Residents
								</a>
							</small>
						</div>
						<span class="mdi mdi-account-multiple"></span>
					</div>
				</div>
				
				<div class="col-md-4">
					<div class="my-card p-3">
						<div>
							<h3>
								<?php echo $_smarty_tpl->tpl_vars['cda_committee_count']->value;?>

							</h3>
							<small>
								<a href="<?php echo route('cda.committees',array('ref'=>$_smarty_tpl->tpl_vars['ref']->value));?>
">
									Committees
								</a>
							</small>
						</div>
						<span class="mdi mdi-account-multiple-outline"></span>
						
					</div>
				</div>
				
				<div class="col-md-4">
					<div class="my-card p-3">
						<div>
							<h3>
								&#8358;
								<?php echo number_format($_smarty_tpl->tpl_vars['assets_worth']->value,2);?>

							</h3>
							<small>
								<a href="<?php echo route('cda.assets',array('ref'=>$_smarty_tpl->tpl_vars['ref']->value));?>
">
									Assets
								</a>
							</small>
						</div>
						<span class="mdi mdi-receipt"></span>
					</div>
				</div>
				
				
				
				
			</div>
			
			
				
			<div class="row mx-2 mb-4">	
			
				<div class="col-md-4">
					<div class="my-card p-3">
						<div>
							<h3>
								&#8358;
								<?php echo number_format($_smarty_tpl->tpl_vars['liabilities_worth']->value,2);?>

							</h3>
							<small>
								<a href="<?php echo route('cda.liabilities',array('ref'=>$_smarty_tpl->tpl_vars['ref']->value));?>
">
									Liabilities
								</a>
							</small>
						</div>
						<span class="mdi mdi-receipt"></span>
					</div>
				</div>
			
				<div class="col-md-4">
					<div class="my-card p-3">
						<div>
							<h3>
								&#8358;
								<?php echo number_format($_smarty_tpl->tpl_vars['receipts_worth']->value,2);?>

							</h3>
							<small>
								<a href="<?php echo route('cda.revenues',array('ref'=>$_smarty_tpl->tpl_vars['ref']->value));?>
">
									Revenues
								</a>
							</small>
						</div>
						<span class="mdi mdi-wallet-plus"></span>
					</div>
				</div>
				
				<div class="col-md-4">
					<div class="my-card p-3">
						<div>
							<h3>
								&#8358;
								<?php echo number_format($_smarty_tpl->tpl_vars['expenses_worth']->value,2);?>

							</h3>
							<small>
								<a href="<?php echo route('cda.expenditures',array('ref'=>$_smarty_tpl->tpl_vars['ref']->value));?>
">
									Expenditure
								</a>
							</small>
						</div>
						<span class="mdi mdi-wallet-outline"></span>
					</div>
				</div>
				
				
			</div>
			
			<div class="row mx-2 mb-4">	

				<div class="col-md-4">
					<div class="my-card p-3">
						<div>
							<h3>
								&#8358;
								<?php echo number_format($_smarty_tpl->tpl_vars['reserves_worth']->value,2);?>

							</h3>
							<small>
								<a href="<?php echo route('cda.reserves',array('ref'=>$_smarty_tpl->tpl_vars['ref']->value));?>
">
									Reserve
								</a>
							</small>
						</div>
						<span class="mdi mdi-package-variant-closed"></span>
					</div>
				</div>
				
				<div class="col-md-8">
					<div class="my-card p-3">
						<div>
							<h3>
								&#8358;
								<?php echo number_format($_smarty_tpl->tpl_vars['all_bills_worth']->value,2);?>
 
								<small style="font-size:12px !important;">
									/ Settled CDA Bills: &#8358; <?php echo number_format($_smarty_tpl->tpl_vars['settled_bills_worth']->value,2);?>
 
								</small>
							</h3>
							<small>
								<a href="<?php echo route('cda.bills',array('ref'=>$_smarty_tpl->tpl_vars['ref']->value));?>
">
									CDA Bills
								</a>
								
							</small>
						</div>
						<span class="mdi mdi-cash-multiple"></span>
					</div>
				</div>
				
				
			</div>
			
			<hr>
			
			<div class="row mx-2 my-3">
				<div class="col-md-9">
					
					<h5 class="mb-3">
						Latest CDA Revenues
						<a href="<?php echo route('cda.revenues');?>
" class="title-more-btn float-right">
							See all<i class="mdi mdi-chevron-right"></i>
						</a>
					</h5>					
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
								
								<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['revenues']->value, 'item');
$_smarty_tpl->tpl_vars['item']->index = -1;
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['item']->value) {
$_smarty_tpl->tpl_vars['item']->index++;
$__foreach_item_0_saved = $_smarty_tpl->tpl_vars['item'];
?>
									<tr>
										<td><?php echo $_smarty_tpl->tpl_vars['item']->index+1;?>
.</td>										
										<td>
											
											<?php echo $_smarty_tpl->tpl_vars['item']->value['resident']['firstname'];?>

											<?php echo $_smarty_tpl->tpl_vars['item']->value['resident']['middlename'];?>

											<?php echo $_smarty_tpl->tpl_vars['item']->value['resident']['lastname'];?>
 
											
										</td>
										<td>123, Ige Street</td>
										<td align="right">
											&#8358; 3,000.00											
										</td>
										<td align="right">
											24/03/2022										
										</td>										
									</tr>
								<?php
$_smarty_tpl->tpl_vars['item'] = $__foreach_item_0_saved;
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>

								
								
								
							</tbody>
							
							
						</table>
					</div>
					
					<hr>
					<h5 class="mb-3">
						Latest CDA Expenses
						<a href="<?php echo route('cda.expenditures');?>
" class="title-more-btn float-right">
							See all<i class="mdi mdi-chevron-right"></i>
						</a>
					</h5>
					<div class="card p-3 mb-5">
						<table  class="table data-table mt-3">
							<thead>
								<tr>
									<th>Sn</th>
									<th>Description</th>
									<th>Amount</th>
									<th>
										<span class="float-right">
											Date
										</span>	
									</th>
								</tr>
							</thead>
							
							<tbody>
								<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['expenses']->value, 'item');
$_smarty_tpl->tpl_vars['item']->index = -1;
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['item']->value) {
$_smarty_tpl->tpl_vars['item']->index++;
$__foreach_item_1_saved = $_smarty_tpl->tpl_vars['item'];
?>
									<tr>
										<td><?php echo $_smarty_tpl->tpl_vars['item']->index+1;?>
.</td>										
										<td>
											<?php echo $_smarty_tpl->tpl_vars['item']->value['expense'];?>

										</td>
										<td>
											&#8358; <?php echo number_format($_smarty_tpl->tpl_vars['item']->value['amount'],2);?>
											
										</td>
										<td align="right">
											<?php echo $_smarty_tpl->tpl_vars['item']->value['created_at'];?>
									
										</td>										
									</tr>
								<?php
$_smarty_tpl->tpl_vars['item'] = $__foreach_item_1_saved;
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>

								
								
								
								
							</tbody>
							
							
						</table>
					</div>
					
					
					
				</div>
				
				<div class="col-md-3">
					
					<h5 class="mb-3">Next Meeting Days</h5>
					<div class="card p-3 mb-5">
						<ul class="meeting-day-list">
							<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['meetings']->value['next_meetings'], 'item');
$_smarty_tpl->tpl_vars['item']->index = -1;
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['item']->value) {
$_smarty_tpl->tpl_vars['item']->index++;
$__foreach_item_2_saved = $_smarty_tpl->tpl_vars['item'];
?>
								<li>
									<a href="<?php ob_start();
echo $_smarty_tpl->tpl_vars['item']->value['ref'];
$_prefixVariable1=ob_get_clean();
echo route('cda.meetings',array('ref'=>$_prefixVariable1));?>
">
										<?php echo $_smarty_tpl->tpl_vars['item']->value['meeting_date_string'];?>

										<i class="mdi mdi-chevron-right float-right"></i>
									</a> 
								</li>
							<?php
$_smarty_tpl->tpl_vars['item'] = $__foreach_item_2_saved;
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>

							
							
						</ul>
					</div>
					
					<hr>
					
					<h5 class="mb-3">Previous Meeting Days</h5>
					<div class="card p-3 mb-5">
						<ul class="meeting-day-list">
							<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['meetings']->value['previous_meetings'], 'item');
$_smarty_tpl->tpl_vars['item']->index = -1;
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['item']->value) {
$_smarty_tpl->tpl_vars['item']->index++;
$__foreach_item_3_saved = $_smarty_tpl->tpl_vars['item'];
?>
								<li>
									<a href="<?php ob_start();
echo $_smarty_tpl->tpl_vars['item']->value['ref'];
$_prefixVariable2=ob_get_clean();
echo route('cda.meetings',array('ref'=>$_prefixVariable2));?>
">
										<?php echo $_smarty_tpl->tpl_vars['item']->value['meeting_date_string'];?>

										<i class="mdi mdi-chevron-right float-right"></i>
									</a> 
								</li>
							<?php
$_smarty_tpl->tpl_vars['item'] = $__foreach_item_3_saved;
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>

							
							
							
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
