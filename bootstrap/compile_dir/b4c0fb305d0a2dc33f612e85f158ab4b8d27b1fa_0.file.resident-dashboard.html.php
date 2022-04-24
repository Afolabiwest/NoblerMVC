<?php
/* Smarty version 3.1.30, created on 2022-04-19 04:01:08
  from "C:\xampp\htdocs\westribbon\ourcda\home-views\residents\resident-dashboard.html" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_625e25f4f38424_70548278',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'b4c0fb305d0a2dc33f612e85f158ab4b8d27b1fa' => 
    array (
      0 => 'C:\\xampp\\htdocs\\westribbon\\ourcda\\home-views\\residents\\resident-dashboard.html',
      1 => 1650337262,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:dashboard_partial.html' => 1,
    'file:includes/residents-dashboard-header.inc.html' => 1,
  ),
),false)) {
function content_625e25f4f38424_70548278 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, true);
?>

<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_1365000576625e25f49a5ed6_04730992', "title");
?>

<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_2078339253625e25f49aa975_45332070', "header");
?>

<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_659522391625e25f4f36993_90774608', "main-content");
$_smarty_tpl->inheritance->endChild();
$_smarty_tpl->_subTemplateRender("file:dashboard_partial.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 2, false);
}
/* {block "title"} */
class Block_1365000576625e25f49a5ed6_04730992 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

	Parent Dashboard
<?php
}
}
/* {/block "title"} */
/* {block "header"} */
class Block_2078339253625e25f49aa975_45332070 extends Smarty_Internal_Block
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
class Block_659522391625e25f4f36993_90774608 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

	
	
		<div class="">
			<div class="row mx-2 my-3">
				<div class="col-md-12">
					<h3>Resident CDA Dashboard</h3>
				</div>
			</div>
			<div class="row mx-2  mb-4">
				<div class="col-md-3">
					<div class="my-card p-3">
						<div>
							<h3>
								<?php echo $_smarty_tpl->tpl_vars['dashboard_data']->value['cdas_count'];?>

							</h3>
							<small>
								<a href="<?php echo route('residents.cdas');?>
">CDAs</a>
							</small>
						</div>
						<span class="mdi mdi-account-multiple"></span>
					</div>
				</div>
				
				<div class="col-md-3">
					<div class="my-card p-3">
						<div>
							<h3>
								&#8358;
								<?php echo number_format($_smarty_tpl->tpl_vars['dashboard_data']->value['settled_bills_amount'],2);?>

							</h3>
							<small>
								<a href="<?php echo route('residents.bills');?>
">Settled Bills</a>
							</small>
						</div>
						<span class="mdi mdi-cash-check"></span>
					</div>
				</div>
				
				<div class="col-md-3">
					<div class="my-card p-3">
						<div>
							<h3>
								&#8358;
								<?php echo number_format($_smarty_tpl->tpl_vars['dashboard_data']->value['unsettled_bills_amount'],2);?>

							</h3>
							<small>
								<a href="<?php echo route('residents.bills');?>
">Unsettled Bills</a>
							</small>
						</div>
						<span class="mdi mdi-cash-multiple"></span>
					</div>
				</div>
				
				<div class="col-md-3">
					<div class="my-card p-3">
						<div>
							<h3>
								Profile
							</h3>
							<small>
								<a href="<?php echo route('residents.profile');?>
">See Settings</a>
							</small>
						</div>
						<span class="mdi mdi-cog-outline"></span>
					</div>
				</div>
				
				
			</div>
				
			<hr>
			
			<div class="row mx-2 my-3">
				<div class="col-md-9">
					
					<h5 class="mb-3">
						Settled Bills
							
						<a href="<?php echo route('resident.settled-bills');?>
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
											Date Due
										</span>	
									</th>
								</tr>
							</thead>
							
							<tbody>
								<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['dashboard_data']->value['settled_bills'], 'item');
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
										<?php echo $_smarty_tpl->tpl_vars['item']->value['description'];?>
 
									</td>
									<td>
										&#8358; <?php echo $_smarty_tpl->tpl_vars['item']->value['amount'];?>
											
									</td>
									<td align="right">
										<?php echo $_smarty_tpl->tpl_vars['item']->value['created_at'];?>
									
									</td>										
								</tr>
								<?php
$_smarty_tpl->tpl_vars['item'] = $__foreach_item_0_saved;
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>

								
								<!-- <tr>
									<td>2.</td>										
									<td>
										Security Bill Dated July 2021 
									</td>
									<td>
										&#8358; 1,000.00											
									</td>
									<td align="right">
										01/07/2021										
									</td>										
								</tr>
								
								<tr>
									<td>3.</td>										
									<td>
										Security Bill Dated August 2021 
									</td>
									<td>
										&#8358; 1,000.00											
									</td>
									<td align="right">
										01/08/2021										
									</td>										
								</tr>
								
								<tr>
									<td>4.</td>										
									<td>
										Security Bill Dated September 2021 
									</td>
									<td>
										&#8358; 1,000.00											
									</td>
									<td align="right">
										01/09/2021										
									</td>										
								</tr>
								
								
								<tr>
									<td>5.</td>										
									<td>
										Security Bill Dated October 2021 
									</td>
									<td>
										&#8358; 1,000.00											
									</td>
									<td align="right">
										01/10/2021										
									</td>										
								</tr>
								 -->
								
								
							</tbody>
							
							
						</table>
					</div>
					
					<hr>
					
					<h5 class="mb-3">
						Unsettled Bills
						<a href="<?php echo route('resident.settled-bills');?>
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
											Date Due
										</span>	
									</th>
								</tr>
							</thead>
							
							<tbody>
							
								<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['dashboard_data']->value['unsettled_bills'], 'item');
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
										<?php echo $_smarty_tpl->tpl_vars['item']->value['description'];?>
 
									</td>
									<td>
										&#8358; <?php echo $_smarty_tpl->tpl_vars['item']->value['amount'];?>
											
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

								<!-- 
								<tr>
									<td>1.</td>										
									<td>
										Security Bill Dated May 2021 
									</td>
									<td>
										&#8358; 1,000.00											
									</td>
									<td align="right">
										01/05/2021										
									</td>										
								</tr>
								
								<tr>
									<td>2.</td>										
									<td>
										Security Bill Dated April 2021 
									</td>
									<td>
										&#8358; 1,000.00											
									</td>
									<td align="right">
										01/04/2021										
									</td>										
								</tr>
								
								<tr>
									<td>3.</td>										
									<td>
										Security Bill Dated March 2021 
									</td>
									<td>
										&#8358; 1,000.00											
									</td>
									<td align="right">
										01/03/2021										
									</td>										
								</tr>
								
								<tr>
									<td>4.</td>										
									<td>
										Security Bill Dated February 2021 
									</td>
									<td>
										&#8358; 1,000.00											
									</td>
									<td align="right">
										01/02/2021										
									</td>										
								</tr>
								
								
								<tr>
									<td>5.</td>										
									<td>
										Security Bill Dated January 2021 
									</td>
									<td>
										&#8358; 1,000.00											
									</td>
									<td align="right">
										01/01/2021										
									</td>										
								</tr>
								
								 -->
								
							</tbody>
							
							
						</table>
					</div>
					
					
					
				</div>
				
				<div class="col-md-3">
					
					<h5 class="mb-3">Next Meeting Days</h5>
					<div class="card p-3 mb-5">
						<ul class="meeting-day-list">
							<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['dashboard_data']->value['next_meetings'], 'item');
$_smarty_tpl->tpl_vars['item']->index = -1;
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['item']->value) {
$_smarty_tpl->tpl_vars['item']->index++;
$__foreach_item_2_saved = $_smarty_tpl->tpl_vars['item'];
?>
								<li><?php echo $_smarty_tpl->tpl_vars['item']->value['meeting_date_string'];?>
 </li>
							<?php
$_smarty_tpl->tpl_vars['item'] = $__foreach_item_2_saved;
}
} else {
?>
	
								<li>No meeting dates found </li>
							<?php
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
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['dashboard_data']->value['previous_meetings'], 'item');
$_smarty_tpl->tpl_vars['item']->index = -1;
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['item']->value) {
$_smarty_tpl->tpl_vars['item']->index++;
$__foreach_item_3_saved = $_smarty_tpl->tpl_vars['item'];
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
$_smarty_tpl->tpl_vars['item'] = $__foreach_item_3_saved;
}
} else {
?>
	
								<li>No meeting dates found </li>
							<?php
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
