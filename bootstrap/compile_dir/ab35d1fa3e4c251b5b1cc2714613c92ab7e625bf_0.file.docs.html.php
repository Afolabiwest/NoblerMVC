<?php
/* Smarty version 3.1.30, created on 2022-04-01 12:59:49
  from "C:\xampp\htdocs\nobler\views\docs.html" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_6246e935d4b559_92821848',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'ab35d1fa3e4c251b5b1cc2714613c92ab7e625bf' => 
    array (
      0 => 'C:\\xampp\\htdocs\\nobler\\views\\docs.html',
      1 => 1648814384,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:index.html' => 1,
    'file:includes/header-fluid.inc.html' => 1,
    'file:includes/doc-sidebar.inc.html' => 1,
  ),
),false)) {
function content_6246e935d4b559_92821848 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, true);
?>

<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_14860582956246e935cc2b66_03928587', 'header');
?>

<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_14540222086246e935d46657_96513182', "main");
?>
 

<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_10583016836246e935d4a324_46271109', "launch-cta");
?>
 

 <?php $_smarty_tpl->inheritance->endChild();
$_smarty_tpl->_subTemplateRender("file:index.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 2, false);
}
/* {block 'header'} */
class Block_14860582956246e935cc2b66_03928587 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

	<?php $_smarty_tpl->_subTemplateRender("file:includes/header-fluid.inc.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

<?php
}
}
/* {/block 'header'} */
/* {block "main"} */
class Block_14540222086246e935d46657_96513182 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>
  

    <div class="docs-wrapper">
	   
		<?php $_smarty_tpl->_subTemplateRender("file:includes/doc-sidebar.inc.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>


		
	    <div class="docs-content">
		    <div class="container">
			    <article class="docs-article" id="section-1">
				    <header class="docs-header">
					    <h1 class="docs-heading">
							Introduction 
							<span class="docs-time">
								Last updated: <?php echo date('Y-m-d');?>


							</span>
						</h1>
					    <section class="docs-intro">
						    <p>Section intro goes here. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque finibus condimentum nisl id vulputate. Praesent aliquet varius eros interdum suscipit. Donec eu purus sed nibh convallis bibendum quis vitae turpis. Duis vestibulum diam lorem, vitae dapibus nibh facilisis a. Fusce in malesuada odio.</p>
						</section><!--//docs-intro-->
						
						<h5>Routes:</h5>
						<div class="docs-code-block">
							<!-- ** Embed github code starts ** -->
							<?php echo '<script'; ?>
 src="https://gist.github.com/Afolabiwest/186d69db7893558ac7c8b50d3ae16924.js"><?php echo '</script'; ?>
>
							<!-- ** Embed github code ends ** -->
						</div><!--//docs-code-block-->

						<h5>Controller:</h5>
						<div class="docs-code-block">
							<!-- ** Embed github code starts ** -->
							<?php echo '<script'; ?>
 src="https://gist.github.com/Afolabiwest/f3449ae0c32ef9f3f90e2ba4fbe7e92a.js"><?php echo '</script'; ?>
>
							<!-- ** Embed github code ends ** -->
						</div><!--//docs-code-block-->


						
					     <h5>Highlight.js Example:</h5>
						<p>You can <a class="theme-link" href="https://github.com/highlightjs/highlight.js" target="_blank">embed your code snippets using highlight.js</a> It supports <a class="theme-link" href="https://highlightjs.org/static/demo/" target="_blank">185 languages and 89 styles</a>.</p>
						<p>This template uses <a class="theme-link" href="https://highlightjs.org/static/demo/" target="_blank">Atom One Dark</a> style for the code blocks: <br><code>&#x3C;link rel=&#x22;stylesheet&#x22; href=&#x22;//cdnjs.cloudflare.com/ajax/libs/highlight.js/9.15.2/styles/atom-one-dark.min.css&#x22;&#x3E;</code></p>
						<div class="docs-code-block">
							<pre class="shadow-lg rounded">
<code class="json hljs">
[
  {
    <span class="hljs-attr">"title"</span>: <span class="hljs-string">"apples"</span>,
    <span class="hljs-attr">"count"</span>: [<span class="hljs-number">12000</span>, <span class="hljs-number">20000</span>],
    <span class="hljs-attr">"description"</span>: {<span class="hljs-attr">"text"</span>: <span class="hljs-string">"..."</span>, <span class="hljs-attr">"sensitive"</span>: <span class="hljs-literal">false</span>}
  },
  {
    <span class="hljs-attr">"title"</span>: <span class="hljs-string">"oranges"</span>,
    <span class="hljs-attr">"count"</span>: [<span class="hljs-number">17500</span>, <span class="hljs-literal">null</span>],
    <span class="hljs-attr">"description"</span>: {<span class="hljs-attr">"text"</span>: <span class="hljs-string">"..."</span>, <span class="hljs-attr">"sensitive"</span>: <span class="hljs-literal">false</span>}
  }
]


</code>
  

</pre>
						</div><!--//docs-code-block-->
						
						
				    </header>
				    <section class="docs-section" id="item-1-1">
						<h2 class="section-heading">Section Item 1.1</h2>
						<p>Vivamus efficitur fringilla ullamcorper. Cras condimentum condimentum mauris, vitae facilisis leo. Aliquam sagittis purus nisi, at commodo augue convallis id. </p>
						<p>Code Example: <code>npm install &lt;package&gt;</code></p>
						<h5>Unordered List Examples:</h5>
						<ul>
						    <li><strong class="me-1">HTML5:</strong> <code>&lt;div id="foo"&gt;</code></li>
						    <li><strong class="me-1">CSS:</strong> <code>#foo { color: red }</code></li>
						    <li><strong class="me-1">JavaScript:</strong> <code>console.log(&#x27;#foo\bar&#x27;);</code></li>
						</ul>
						<h5>Ordered List Examples:</h5>
						<ol>
							<li>Download lorem ipsum dolor sit amet.</li>
							<li>Click ipsum faucibus venenatis.</li>
							<li>Configure fermentum malesuada nunc.</li>
							<li>Deploy donec non ante libero.</li>
						</ol>
                        <h5>Callout Examples:</h5>
                        <div class="callout-block callout-block-info">
                            
                            <div class="content">
                                <h4 class="callout-title">
	                                <span class="callout-icon-holder me-1">
		                                <i class="fas fa-info-circle"></i>
		                            </span><!--//icon-holder-->
	                                Note
	                            </h4>
                                <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium <code>&lt;code&gt;</code> , Nemo enim ipsam voluptatem quia voluptas <a href="#">link example</a> sit aspernatur aut odit aut fugit.</p>
                            </div><!--//content-->
                        </div><!--//callout-block-->
                        
                        <div class="callout-block callout-block-warning">
                            <div class="content">
                                <h4 class="callout-title">
	                                <span class="callout-icon-holder me-1">
		                                <i class="fas fa-bullhorn"></i>
		                            </span><!--//icon-holder-->
	                                Warning
	                            </h4>
                                <p>Nunc hendrerit odio quis dignissim efficitur. Proin ut finibus libero. Morbi posuere fringilla felis eget sagittis. Fusce sem orci, cursus in tortor <a href="#">link example</a> tellus vel diam viverra elementum.</p>
                            </div><!--//content-->
                        </div><!--//callout-block-->
                        
                        <div class="callout-block callout-block-success">
                            <div class="content">
                                <h4 class="callout-title">
	                                <span class="callout-icon-holder me-1">
		                                <i class="fas fa-thumbs-up"></i>
		                            </span><!--//icon-holder-->
	                                Tip
	                            </h4>
                                <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. <a href="#">Link example</a> aenean commodo ligula eget dolor.</p>
                            </div><!--//content-->
                        </div><!--//callout-block-->
                        
                        <div class="callout-block callout-block-danger me-1">
                            <div class="content">
                                <h4 class="callout-title">
	                                <span class="callout-icon-holder">
		                                <i class="fas fa-exclamation-triangle"></i>
		                            </span><!--//icon-holder-->
	                                Danger
	                            </h4>
                                <p>Morbi eget interdum sapien. Donec sed turpis sed nulla lacinia accumsan vitae ut tellus. Aenean vestibulum <a href="#">Link example</a> maximus ipsum vel dignissim. Morbi ornare elit sit amet massa feugiat, viverra dictum ipsum pellentesque. </p>
                            </div><!--//content-->
                        </div><!--//callout-block-->
                        
                        <h5 class="mt-5">Alert Examples:</h5>
                        <div class="alert alert-primary" role="alert">
						  This is a primary alert—check it out!
						</div>
						<div class="alert alert-secondary" role="alert">
						  This is a secondary alert—check it out!
						</div>
						<div class="alert alert-success" role="alert">
						  This is a success alert—check it out!
						</div>
						<div class="alert alert-danger" role="alert">
						  This is a danger alert—check it out!
						</div>
						<div class="alert alert-warning" role="alert">
						  This is a warning alert—check it out!
						</div>
						<div class="alert alert-info" role="alert">
						  This is a info alert—check it out!
						</div>
						<div class="alert alert-light" role="alert">
						  This is a light alert—check it out!
						</div>
						<div class="alert alert-dark" role="alert">
						  This is a dark alert—check it out!
						</div>
                        
                       
					</section><!--//section-->
					
					<section class="docs-section" id="item-1-2">
						<h2 class="section-heading">Section Item 1.2</h2>
						<p>Vivamus efficitur fringilla ullamcorper. Cras condimentum condimentum mauris, vitae facilisis leo. Aliquam sagittis purus nisi, at commodo augue convallis id. Sed interdum turpis quis felis bibendum imperdiet. Mauris pellentesque urna eu leo gravida iaculis. In fringilla odio in felis ultricies porttitor. Donec at purus libero. Vestibulum libero orci, commodo nec arcu sit amet, commodo sollicitudin est. Vestibulum ultricies malesuada tempor.</p>
						<h5 class="mt-5">Lightbox Example:</h5>
						
						<p>The example below uses the <i class="fas fa-external-link-alt"></i> <a class="theme-link" href="https://github.com/andreknieriem/simplelightbox" target="_blank">simplelightbox plugin</a>. </p>
						
						<div class="simplelightbox-gallery row mb-3">
							<div class="col-12 col-md-4 mb-3">
						        <a href="assets/images/coderpro-home.png"><img class="figure-img img-fluid shadow rounded" src="assets/images/coderpro-home-thumb.png" alt="" title="CoderPro Home Page"/></a>
							</div>
							<div class="col-12 col-md-4 mb-3">
						        <a href="assets/images/coderpro-features.png"><img class="figure-img img-fluid shadow rounded" src="assets/images/coderpro-features-thumb.png" alt="" title="CoderPro Features Page"/></a>
							</div><!--//col-->
							<div class="col-12 col-md-4 mb-3">
						        <a href="assets/images/coderpro-pricing.png"><img class="figure-img img-fluid shadow rounded" src="assets/images/coderpro-pricing-thumb.png" alt="" title="CoderPro Pricing Page"/></a>
							</div><!--//col-->
							
						</div><!--//gallery-->
						
						<h5>Custom Table:</h5>
						<div class="table-responsive my-4">
							<table class="table table-bordered">
								<tbody>
								    <tr>
									    <th class="theme-bg-light"><a class="theme-link" href="#">Option 1</a></th>
									    <td>Option 1 desc lorem ipsum dolor sit amet, consectetur adipiscing elit. </td>
									</tr>
									<tr>
									      <th class="theme-bg-light"><a class="theme-link" href="#">Option 2</a></th>
									      <td>Option 2 desc lorem ipsum dolor sit amet, consectetur adipiscing elit. </td>
									</tr>
									
									<tr>
									    <th class="theme-bg-light"><a class="theme-link" href="#">Option 3</a></th>
									    <td>Option 3 desc lorem ipsum dolor sit amet, consectetur adipiscing elit. </td>
									</tr>
									
									<tr>
									    <th class="theme-bg-light"><a class="theme-link" href="#">Option 4</a></th>
									    <td>Option 4 desc lorem ipsum dolor sit amet, consectetur adipiscing elit. </td>
									</tr>
								</tbody>
							</table>
						</div><!--//table-responsive-->
						<h5>Stripped Table:</h5>
						<div class="table-responsive my-4">
							<table class="table table-striped">
								<thead>
									<tr>
										<th scope="col">#</th>
										<th scope="col">First</th>
										<th scope="col">Last</th>
										<th scope="col">Handle</th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<th scope="row">1</th>
										<td>Mark</td>
										<td>Otto</td>
										<td>@mdo</td>
									</tr>
									<tr>
										<th scope="row">2</th>
										<td>Jacob</td>
										<td>Thornton</td>
										<td>@fat</td>
									</tr>
									<tr>
										<th scope="row">3</th>
										<td>Larry</td>
										<td>the Bird</td>
										<td>@twitter</td>
									</tr>
								</tbody>
							</table>
						</div><!--//table-responsive-->
						<h5>Bordered Dark Table:</h5>
						<div class="table-responsive my-4">
							<table class="table table-bordered table-dark">
								<thead>
									<tr>
										<th scope="col">#</th>
										<th scope="col">First</th>
										<th scope="col">Last</th>
										<th scope="col">Handle</th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<th scope="row">1</th>
										<td>Mark</td>
										<td>Otto</td>
										<td>@mdo</td>
									</tr>
									<tr>
										<th scope="row">2</th>
										<td>Jacob</td>
										<td>Thornton</td>
										<td>@fat</td>
									</tr>
									<tr>
										<th scope="row">3</th>
										<td>Larry</td>
										<td>the Bird</td>
										<td>@twitter</td>
									</tr>
								</tbody>
							</table>
						</div><!--//table-responsive-->
						
						
					</section><!--//section-->
					
					<section class="docs-section" id="item-1-3">
						<h2 class="section-heading">Section Item 1.3</h2>
						<p>Vivamus efficitur fringilla ullamcorper. Cras condimentum condimentum mauris, vitae facilisis leo. Aliquam sagittis purus nisi, at commodo augue convallis id. Sed interdum turpis quis felis bibendum imperdiet. Mauris pellentesque urna eu leo gravida iaculis. In fringilla odio in felis ultricies porttitor. Donec at purus libero. Vestibulum libero orci, commodo nec arcu sit amet, commodo sollicitudin est. Vestibulum ultricies malesuada tempor.</p>
						<h5>Badges Examples:</h5>
						<div class="my-4">
						    <span class="badge badge-primary">Primary</span>
							<span class="badge badge-secondary">Secondary</span>
							<span class="badge badge-success">Success</span>
							<span class="badge badge-danger">Danger</span>
							<span class="badge badge-warning">Warning</span>
							<span class="badge badge-info">Info</span>
							<span class="badge badge-light">Light</span>
							<span class="badge badge-dark">Dark</span>
						</div>
						<h5>Button Examples:</h5>
						<div class="row my-3">
                        <div class="col-md-6 col-12">
                                <ul class="list list-unstyled pl-0">
                                    <li><a href="#" class="btn btn-primary">Primary Button</a></li>
                                    <li><a href="#" class="btn btn-secondary">Secondary Button</a></li>
                                    <li><a href="#" class="btn btn-light">Light Button</a></li>
                                    <li><a href="#" class="btn btn-success">Succcess Button</a></li>
                                    <li><a href="#" class="btn btn-info">Info Button</a></li>
                                    <li><a href="#" class="btn btn-warning">Warning Button</a></li>
                                    <li><a href="#" class="btn btn-danger">Danger Button</a></li>
                                </ul>
                            </div>
                            <div class="col-md-6 col-12">
                                <ul class="list list-unstyled pl-0">
                                    <li><a href="#" class="btn btn-primary"><i class="fas fa-download me-2"></i> Download Now</a></li>
                                    <li><a href="#" class="btn btn-secondary"><i class="fas fa-book me-2"></i> View Docs</a></li>
                                    <li><a href="#" class="btn btn-light"><i class="fas fa-arrow-alt-circle-right me-2"></i> View Features</a></li>
                                    <li><a href="#" class="btn btn-success"><i class="fas fa-code-branch me-2"></i> Fork Now</a></li>
                                    <li><a href="#" class="btn btn-info"><i class="fas fa-play-circle me-2"></i> Find Out Now</a></li>
                                    <li><a href="#" class="btn btn-warning"><i class="fas fa-bug me-2"></i> Report Bugs</a></li>
                                    <li><a href="#" class="btn btn-danger"><i class="fas fa-exclamation-circle me-2"></i> Submit Issues</a></li>
                                </ul>
                            </div>
                        </div><!--//row-->
                        
                        <h5>Progress Examples:</h5>
                        <div class="my-4">
	                        <div class="progress my-4">
								<div class="progress-bar bg-success" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
							</div>
							<div class="progress my-4">
							    <div class="progress-bar bg-info" role="progressbar" style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
							</div>
							<div class="progress my-4">
							    <div class="progress-bar bg-warning" role="progressbar" style="width: 75%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
							</div>
							<div class="progress my-4">
							    <div class="progress-bar bg-danger" role="progressbar" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
							</div>
                        </div>
					</section><!--//section-->
					
					<section class="docs-section" id="item-1-4">
						<h2 class="section-heading">Section Item 1.4</h2>
						<p>Vivamus efficitur fringilla ullamcorper. Cras condimentum condimentum mauris, vitae facilisis leo. Aliquam sagittis purus nisi, at commodo augue convallis id. Sed interdum turpis quis felis bibendum imperdiet. Mauris pellentesque urna eu leo gravida iaculis. In fringilla odio in felis ultricies porttitor. Donec at purus libero. Vestibulum libero orci, commodo nec arcu sit amet, commodo sollicitudin est. Vestibulum ultricies malesuada tempor.</p>
						
						
						<h5>Pagination Example:</h5>
						<nav aria-label="Page navigation example">
						    <ul class="pagination pl-0">
							    <li class="page-item disabled"><a class="page-link" href="#">Previous</a></li>
							    <li class="page-item active"><a class="page-link" href="#">1</a></li>
							    <li class="page-item"><a class="page-link" href="#">2</a></li>
							    <li class="page-item"><a class="page-link" href="#">3</a></li>
							    <li class="page-item"><a class="page-link" href="#">Next</a></li>
						    </ul>
						</nav>
						
						<p>Vivamus efficitur fringilla ullamcorper. Cras condimentum condimentum mauris, vitae facilisis leo. Aliquam sagittis purus nisi, at commodo augue convallis id. Sed interdum turpis quis felis bibendum imperdiet. Mauris pellentesque urna eu leo gravida iaculis. In fringilla odio in felis ultricies porttitor. Donec at purus libero. Vestibulum libero orci, commodo nec arcu sit amet, commodo sollicitudin est. Vestibulum ultricies malesuada tempor.</p>
						
					</section><!--//section-->
					<section class="docs-section" id="item-1-5">
						<h2 class="section-heading">Section Item 1.5</h2>
						<p>Vivamus efficitur fringilla ullamcorper. Cras condimentum condimentum mauris, vitae facilisis leo. Aliquam sagittis purus nisi, at commodo augue convallis id. Sed interdum turpis quis felis bibendum imperdiet. Mauris pellentesque urna eu leo gravida iaculis. In fringilla odio in felis ultricies porttitor. Donec at purus libero. Vestibulum libero orci, commodo nec arcu sit amet, commodo sollicitudin est. Vestibulum ultricies malesuada tempor.</p>
					</section><!--//section-->
					<section class="docs-section" id="item-1-6">
						<h2 class="section-heading">Section Item 1.6</h2>
						<p>Vivamus efficitur fringilla ullamcorper. Cras condimentum condimentum mauris, vitae facilisis leo. Aliquam sagittis purus nisi, at commodo augue convallis id. Sed interdum turpis quis felis bibendum imperdiet. Mauris pellentesque urna eu leo gravida iaculis. In fringilla odio in felis ultricies porttitor. Donec at purus libero. Vestibulum libero orci, commodo nec arcu sit amet, commodo sollicitudin est. Vestibulum ultricies malesuada tempor.</p>
					</section><!--//section-->
					
			    </article>
			    
			    <article class="docs-article" id="section-2">
				    <header class="docs-header">
					    <h1 class="docs-heading">Installation</h1>
					    <section class="docs-intro">
						    <p>Section intro goes here. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque finibus condimentum nisl id vulputate. Praesent aliquet varius eros interdum suscipit. Donec eu purus sed nibh convallis bibendum quis vitae turpis. Duis vestibulum diam lorem, vitae dapibus nibh facilisis a. Fusce in malesuada odio.</p>
						</section><!--//docs-intro-->
				    </header>
				     <section class="docs-section" id="item-2-1">
						<h2 class="section-heading">Section Item 2.1</h2>
						<p>Vivamus efficitur fringilla ullamcorper. Cras condimentum condimentum mauris, vitae facilisis leo. Aliquam sagittis purus nisi, at commodo augue convallis id. Sed interdum turpis quis felis bibendum imperdiet. Mauris pellentesque urna eu leo gravida iaculis. In fringilla odio in felis ultricies porttitor. Donec at purus libero. Vestibulum libero orci, commodo nec arcu sit amet, commodo sollicitudin est. Vestibulum ultricies malesuada tempor.</p>
					</section><!--//section-->
					
					<section class="docs-section" id="item-2-2">
						<h2 class="section-heading">Section Item 2.2</h2>
						<p>Vivamus efficitur fringilla ullamcorper. Cras condimentum condimentum mauris, vitae facilisis leo. Aliquam sagittis purus nisi, at commodo augue convallis id. Sed interdum turpis quis felis bibendum imperdiet. Mauris pellentesque urna eu leo gravida iaculis. In fringilla odio in felis ultricies porttitor. Donec at purus libero. Vestibulum libero orci, commodo nec arcu sit amet, commodo sollicitudin est. Vestibulum ultricies malesuada tempor.</p>
					</section><!--//section-->
					
					<section class="docs-section" id="item-2-3">
						<h2 class="section-heading">Section Item 2.3</h2>
						<p>Vivamus efficitur fringilla ullamcorper. Cras condimentum condimentum mauris, vitae facilisis leo. Aliquam sagittis purus nisi, at commodo augue convallis id. Sed interdum turpis quis felis bibendum imperdiet. Mauris pellentesque urna eu leo gravida iaculis. In fringilla odio in felis ultricies porttitor. Donec at purus libero. Vestibulum libero orci, commodo nec arcu sit amet, commodo sollicitudin est. Vestibulum ultricies malesuada tempor.</p>
					</section><!--//section-->
			    </article><!--//docs-article-->
			    
			    
			    <article class="docs-article" id="section-3">
				    <header class="docs-header">
					    <h1 class="docs-heading">APIs</h1>
					    <section class="docs-intro">
						    <p>Section intro goes here. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque finibus condimentum nisl id vulputate. Praesent aliquet varius eros interdum suscipit. Donec eu purus sed nibh convallis bibendum quis vitae turpis. Duis vestibulum diam lorem, vitae dapibus nibh facilisis a. Fusce in malesuada odio.</p>
						</section><!--//docs-intro-->
				    </header>
				     <section class="docs-section" id="item-3-1">
						<h2 class="section-heading">Section Item 3.1</h2>
						<p>Vivamus efficitur fringilla ullamcorper. Cras condimentum condimentum mauris, vitae facilisis leo. Aliquam sagittis purus nisi, at commodo augue convallis id. Sed interdum turpis quis felis bibendum imperdiet. Mauris pellentesque urna eu leo gravida iaculis. In fringilla odio in felis ultricies porttitor. Donec at purus libero. Vestibulum libero orci, commodo nec arcu sit amet, commodo sollicitudin est. Vestibulum ultricies malesuada tempor.</p>
					</section><!--//section-->
					
					<section class="docs-section" id="item-3-2">
						<h2 class="section-heading">Section Item 3.2</h2>
						<p>Vivamus efficitur fringilla ullamcorper. Cras condimentum condimentum mauris, vitae facilisis leo. Aliquam sagittis purus nisi, at commodo augue convallis id. Sed interdum turpis quis felis bibendum imperdiet. Mauris pellentesque urna eu leo gravida iaculis. In fringilla odio in felis ultricies porttitor. Donec at purus libero. Vestibulum libero orci, commodo nec arcu sit amet, commodo sollicitudin est. Vestibulum ultricies malesuada tempor.</p>
					</section><!--//section-->
					
					<section class="docs-section" id="item-3-3">
						<h2 class="section-heading">Section Item 3.3</h2>
						<p>Vivamus efficitur fringilla ullamcorper. Cras condimentum condimentum mauris, vitae facilisis leo. Aliquam sagittis purus nisi, at commodo augue convallis id. Sed interdum turpis quis felis bibendum imperdiet. Mauris pellentesque urna eu leo gravida iaculis. In fringilla odio in felis ultricies porttitor. Donec at purus libero. Vestibulum libero orci, commodo nec arcu sit amet, commodo sollicitudin est. Vestibulum ultricies malesuada tempor.</p>
					</section><!--//section-->
			    </article><!--//docs-article-->
			    
			    <article class="docs-article" id="section-4">
				    <header class="docs-header">
					    <h1 class="docs-heading">Intergrations</h1>
					    <section class="docs-intro">
						    <p>Section intro goes here. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque finibus condimentum nisl id vulputate. Praesent aliquet varius eros interdum suscipit. Donec eu purus sed nibh convallis bibendum quis vitae turpis. Duis vestibulum diam lorem, vitae dapibus nibh facilisis a. Fusce in malesuada odio.</p>
						</section><!--//docs-intro-->
				    </header>
				     <section class="docs-section" id="item-4-1">
						<h2 class="section-heading">Section Item 4.1</h2>
						<p>Vivamus efficitur fringilla ullamcorper. Cras condimentum condimentum mauris, vitae facilisis leo. Aliquam sagittis purus nisi, at commodo augue convallis id. Sed interdum turpis quis felis bibendum imperdiet. Mauris pellentesque urna eu leo gravida iaculis. In fringilla odio in felis ultricies porttitor. Donec at purus libero. Vestibulum libero orci, commodo nec arcu sit amet, commodo sollicitudin est. Vestibulum ultricies malesuada tempor.</p>
					</section><!--//section-->
					
					<section class="docs-section" id="item-4-2">
						<h2 class="section-heading">Section Item 4.2</h2>
						<p>Vivamus efficitur fringilla ullamcorper. Cras condimentum condimentum mauris, vitae facilisis leo. Aliquam sagittis purus nisi, at commodo augue convallis id. Sed interdum turpis quis felis bibendum imperdiet. Mauris pellentesque urna eu leo gravida iaculis. In fringilla odio in felis ultricies porttitor. Donec at purus libero. Vestibulum libero orci, commodo nec arcu sit amet, commodo sollicitudin est. Vestibulum ultricies malesuada tempor.</p>
					</section><!--//section-->
					
					<section class="docs-section" id="item-4-3">
						<h2 class="section-heading">Section Item 4.3</h2>
						<p>Vivamus efficitur fringilla ullamcorper. Cras condimentum condimentum mauris, vitae facilisis leo. Aliquam sagittis purus nisi, at commodo augue convallis id. Sed interdum turpis quis felis bibendum imperdiet. Mauris pellentesque urna eu leo gravida iaculis. In fringilla odio in felis ultricies porttitor. Donec at purus libero. Vestibulum libero orci, commodo nec arcu sit amet, commodo sollicitudin est. Vestibulum ultricies malesuada tempor.</p>
					</section><!--//section-->
			    </article><!--//docs-article-->
			    
			    <article class="docs-article" id="section-5">
				    <header class="docs-header">
					    <h1 class="docs-heading">Utilities</h1>
					    <section class="docs-intro">
						    <p>Section intro goes here. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque finibus condimentum nisl id vulputate. Praesent aliquet varius eros interdum suscipit. Donec eu purus sed nibh convallis bibendum quis vitae turpis. Duis vestibulum diam lorem, vitae dapibus nibh facilisis a. Fusce in malesuada odio.</p>
						</section><!--//docs-intro-->
				    </header>
				     <section class="docs-section" id="item-5-1">
						<h2 class="section-heading">Section Item 5.1</h2>
						<p>Vivamus efficitur fringilla ullamcorper. Cras condimentum condimentum mauris, vitae facilisis leo. Aliquam sagittis purus nisi, at commodo augue convallis id. Sed interdum turpis quis felis bibendum imperdiet. Mauris pellentesque urna eu leo gravida iaculis. In fringilla odio in felis ultricies porttitor. Donec at purus libero. Vestibulum libero orci, commodo nec arcu sit amet, commodo sollicitudin est. Vestibulum ultricies malesuada tempor.</p>
					</section><!--//section-->
					
					<section class="docs-section" id="item-5-2">
						<h2 class="section-heading">Section Item 5.2</h2>
						<p>Vivamus efficitur fringilla ullamcorper. Cras condimentum condimentum mauris, vitae facilisis leo. Aliquam sagittis purus nisi, at commodo augue convallis id. Sed interdum turpis quis felis bibendum imperdiet. Mauris pellentesque urna eu leo gravida iaculis. In fringilla odio in felis ultricies porttitor. Donec at purus libero. Vestibulum libero orci, commodo nec arcu sit amet, commodo sollicitudin est. Vestibulum ultricies malesuada tempor.</p>
					</section><!--//section-->
					
					<section class="docs-section" id="item-5-3">
							<h2 class="section-heading">Section Item 5.3</h2>
						<p>Vivamus efficitur fringilla ullamcorper. Cras condimentum condimentum mauris, vitae facilisis leo. Aliquam sagittis purus nisi, at commodo augue convallis id. Sed interdum turpis quis felis bibendum imperdiet. Mauris pellentesque urna eu leo gravida iaculis. In fringilla odio in felis ultricies porttitor. Donec at purus libero. Vestibulum libero orci, commodo nec arcu sit amet, commodo sollicitudin est. Vestibulum ultricies malesuada tempor.</p>
					</section><!--//section-->
			    </article><!--//docs-article-->
			    
			    
		        <article class="docs-article" id="section-6">
				    <header class="docs-header">
					    <h1 class="docs-heading">Web</h1>
					    <section class="docs-intro">
						    <p>Section intro goes here. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque finibus condimentum nisl id vulputate. Praesent aliquet varius eros interdum suscipit. Donec eu purus sed nibh convallis bibendum quis vitae turpis. Duis vestibulum diam lorem, vitae dapibus nibh facilisis a. Fusce in malesuada odio.</p>
						</section><!--//docs-intro-->
				    </header>
				     <section class="docs-section" id="item-6-1">
						<h2 class="section-heading">Section Item 6.1</h2>
						<p>Vivamus efficitur fringilla ullamcorper. Cras condimentum condimentum mauris, vitae facilisis leo. Aliquam sagittis purus nisi, at commodo augue convallis id. Sed interdum turpis quis felis bibendum imperdiet. Mauris pellentesque urna eu leo gravida iaculis. In fringilla odio in felis ultricies porttitor. Donec at purus libero. Vestibulum libero orci, commodo nec arcu sit amet, commodo sollicitudin est. Vestibulum ultricies malesuada tempor.</p>
					</section><!--//section-->
					
					<section class="docs-section" id="item-6-2">
						<h2 class="section-heading">Section Item 6.2</h2>
						<p>Vivamus efficitur fringilla ullamcorper. Cras condimentum condimentum mauris, vitae facilisis leo. Aliquam sagittis purus nisi, at commodo augue convallis id. Sed interdum turpis quis felis bibendum imperdiet. Mauris pellentesque urna eu leo gravida iaculis. In fringilla odio in felis ultricies porttitor. Donec at purus libero. Vestibulum libero orci, commodo nec arcu sit amet, commodo sollicitudin est. Vestibulum ultricies malesuada tempor.</p>
					</section><!--//section-->
					
					<section class="docs-section" id="item-6-3">
							<h2 class="section-heading">Section Item 6.3</h2>
						<p>Vivamus efficitur fringilla ullamcorper. Cras condimentum condimentum mauris, vitae facilisis leo. Aliquam sagittis purus nisi, at commodo augue convallis id. Sed interdum turpis quis felis bibendum imperdiet. Mauris pellentesque urna eu leo gravida iaculis. In fringilla odio in felis ultricies porttitor. Donec at purus libero. Vestibulum libero orci, commodo nec arcu sit amet, commodo sollicitudin est. Vestibulum ultricies malesuada tempor.</p>
					</section><!--//section-->
			    </article><!--//docs-article-->
			    
			    
			    <article class="docs-article" id="section-7">
				    <header class="docs-header">
					    <h1 class="docs-heading">Mobile</h1>
					    <section class="docs-intro">
						    <p>Section intro goes here. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque finibus condimentum nisl id vulputate. Praesent aliquet varius eros interdum suscipit. Donec eu purus sed nibh convallis bibendum quis vitae turpis. Duis vestibulum diam lorem, vitae dapibus nibh facilisis a. Fusce in malesuada odio.</p>
						</section><!--//docs-intro-->
				    </header>
				     <section class="docs-section" id="item-7-1">
						<h2 class="section-heading">Section Item 7.1</h2>
						<p>Vivamus efficitur fringilla ullamcorper. Cras condimentum condimentum mauris, vitae facilisis leo. Aliquam sagittis purus nisi, at commodo augue convallis id. Sed interdum turpis quis felis bibendum imperdiet. Mauris pellentesque urna eu leo gravida iaculis. In fringilla odio in felis ultricies porttitor. Donec at purus libero. Vestibulum libero orci, commodo nec arcu sit amet, commodo sollicitudin est. Vestibulum ultricies malesuada tempor.</p>
					</section><!--//section-->
					
					<section class="docs-section" id="item-7-2">
						<h2 class="section-heading">Section Item 7.2</h2>
						<p>Vivamus efficitur fringilla ullamcorper. Cras condimentum condimentum mauris, vitae facilisis leo. Aliquam sagittis purus nisi, at commodo augue convallis id. Sed interdum turpis quis felis bibendum imperdiet. Mauris pellentesque urna eu leo gravida iaculis. In fringilla odio in felis ultricies porttitor. Donec at purus libero. Vestibulum libero orci, commodo nec arcu sit amet, commodo sollicitudin est. Vestibulum ultricies malesuada tempor.</p>
					</section><!--//section-->
					
					<section class="docs-section" id="item-7-3">
							<h2 class="section-heading">Section Item 7.3</h2>
						<p>Vivamus efficitur fringilla ullamcorper. Cras condimentum condimentum mauris, vitae facilisis leo. Aliquam sagittis purus nisi, at commodo augue convallis id. Sed interdum turpis quis felis bibendum imperdiet. Mauris pellentesque urna eu leo gravida iaculis. In fringilla odio in felis ultricies porttitor. Donec at purus libero. Vestibulum libero orci, commodo nec arcu sit amet, commodo sollicitudin est. Vestibulum ultricies malesuada tempor.</p>
					</section><!--//section-->
			    </article><!--//docs-article-->
			    
			    
			    <article class="docs-article" id="section-8">
				    <header class="docs-header">
					    <h1 class="docs-heading">Resources</h1>
					    <section class="docs-intro">
						    <p>Section intro goes here. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque finibus condimentum nisl id vulputate. Praesent aliquet varius eros interdum suscipit. Donec eu purus sed nibh convallis bibendum quis vitae turpis. Duis vestibulum diam lorem, vitae dapibus nibh facilisis a. Fusce in malesuada odio.</p>
						</section><!--//docs-intro-->
				    </header>
				     <section class="docs-section" id="item-8-1">
						<h2 class="section-heading">Section Item 8.1</h2>
						<p>Vivamus efficitur fringilla ullamcorper. Cras condimentum condimentum mauris, vitae facilisis leo. Aliquam sagittis purus nisi, at commodo augue convallis id. Sed interdum turpis quis felis bibendum imperdiet. Mauris pellentesque urna eu leo gravida iaculis. In fringilla odio in felis ultricies porttitor. Donec at purus libero. Vestibulum libero orci, commodo nec arcu sit amet, commodo sollicitudin est. Vestibulum ultricies malesuada tempor.</p>
					</section><!--//section-->
					
					<section class="docs-section" id="item-8-2">
						<h2 class="section-heading">Section Item 8.2</h2>
						<p>Vivamus efficitur fringilla ullamcorper. Cras condimentum condimentum mauris, vitae facilisis leo. Aliquam sagittis purus nisi, at commodo augue convallis id. Sed interdum turpis quis felis bibendum imperdiet. Mauris pellentesque urna eu leo gravida iaculis. In fringilla odio in felis ultricies porttitor. Donec at purus libero. Vestibulum libero orci, commodo nec arcu sit amet, commodo sollicitudin est. Vestibulum ultricies malesuada tempor.</p>
					</section><!--//section-->
					
					<section class="docs-section" id="item-8-3">
							<h2 class="section-heading">Section Item 8.3</h2>
						<p>Vivamus efficitur fringilla ullamcorper. Cras condimentum condimentum mauris, vitae facilisis leo. Aliquam sagittis purus nisi, at commodo augue convallis id. Sed interdum turpis quis felis bibendum imperdiet. Mauris pellentesque urna eu leo gravida iaculis. In fringilla odio in felis ultricies porttitor. Donec at purus libero. Vestibulum libero orci, commodo nec arcu sit amet, commodo sollicitudin est. Vestibulum ultricies malesuada tempor.</p>
					</section><!--//section-->
			    </article><!--//docs-article-->
			    
			    
			    <article class="docs-article" id="section-9">
				    <header class="docs-header">
					    <h1 class="docs-heading">FAQs</h1>
					    <section class="docs-intro">
						    <p>Section intro goes here. You can list all your FAQs using the format below.</p>
						</section><!--//docs-intro-->
				    </header>
				     <section class="docs-section" id="item-9-1">
						<h2 class="section-heading">Section Item 9.1 <small>(FAQ Category One)</small></h2>
						<h5 class="pt-3"><i class="fas fa-question-circle me-1"></i>What's sit amet quam eget lacinia?</h5>
						<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium.</p>
						<h5 class="pt-3"><i class="fas fa-question-circle me-1"></i>How to ipsum dolor sit amet quam tortor?</h5>
						<p>Donec sodales sagittis magna. Sed consequat, leo eget bibendum sodales, augue velit cursus nunc, quis gravida magna mi a libero. Fusce vulputate eleifend sapien. Vestibulum purus quam, scelerisque ut, mollis sed, nonummy id, metus. Nullam accumsan lorem in dui. </p>
						<h5 class="pt-3"><i class="fas fa-question-circle me-1"></i>Can I  bibendum sodales?</h5>
						<p>Fusce vulputate eleifend sapien. Vestibulum purus quam, scelerisque ut, mollis sed, nonummy id, metus. Nullam accumsan lorem in dui. </p>
						<h5 class="pt-3"><i class="fas fa-question-circle me-1"></i>Where arcu sed urna gravida?</h5>
						<p>Aenean et sodales nisi, vel efficitur sapien. Quisque molestie diam libero, et elementum diam mollis ac. In dignissim aliquam est eget ullamcorper. Sed id sodales tortor, eu finibus leo. Vivamus dapibus sollicitudin justo vel fermentum. Curabitur nec arcu sed urna gravida lobortis. Donec lectus est, imperdiet eu viverra viverra, ultricies nec urna. </p>
					</section><!--//section-->
					
					<section class="docs-section" id="item-9-2">
						<h2 class="section-heading">Section Item 9.2 <small>(FAQ Category Two)</small></h2>
						<h5 class="pt-3"><i class="fas fa-question-circle me-1"></i>What's sit amet quam eget lacinia?</h5>
						<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium.</p>
						<h5 class="pt-3"><i class="fas fa-question-circle me-1"></i>How to ipsum dolor sit amet quam tortor?</h5>
						<p>Donec sodales sagittis magna. Sed consequat, leo eget bibendum sodales, augue velit cursus nunc, quis gravida magna mi a libero. Fusce vulputate eleifend sapien. Vestibulum purus quam, scelerisque ut, mollis sed, nonummy id, metus. Nullam accumsan lorem in dui. </p>
						<h5 class="pt-3"><i class="fas fa-question-circle me-1"></i>Can I  bibendum sodales?</h5>
						<p>Fusce vulputate eleifend sapien. Vestibulum purus quam, scelerisque ut, mollis sed, nonummy id, metus. Nullam accumsan lorem in dui. </p>
						<h5 class="pt-3"><i class="fas fa-question-circle me-1"></i>Where arcu sed urna gravida?</h5>
						<p>Aenean et sodales nisi, vel efficitur sapien. Quisque molestie diam libero, et elementum diam mollis ac. In dignissim aliquam est eget ullamcorper. Sed id sodales tortor, eu finibus leo. Vivamus dapibus sollicitudin justo vel fermentum. Curabitur nec arcu sed urna gravida lobortis. Donec lectus est, imperdiet eu viverra viverra, ultricies nec urna. </p>
					</section><!--//section-->
					
					<section class="docs-section" id="item-9-3">
							<h2 class="section-heading">Section Item 9.3 <small>(FAQ Category Three)</small></h2>
						    <h5 class="pt-3"><i class="fas fa-question-circle me-1"></i>How to dapibus sollicitudin justo vel fermentum?</h5>
							<p>Donec sodales sagittis magna. Sed consequat, leo eget bibendum sodales, augue velit cursus nunc, quis gravida magna mi a libero. Fusce vulputate eleifend sapien. Vestibulum purus quam, scelerisque ut, mollis sed, nonummy id, metus. Nullam accumsan lorem in dui. </p>
							<h5 class="pt-3"><i class="fas fa-question-circle me-1"></i>How long bibendum sodales?</h5>
							<p>Fusce vulputate eleifend sapien. Vestibulum purus quam, scelerisque ut, mollis sed, nonummy id, metus. Nullam accumsan lorem in dui. </p>
							<h5 class="pt-3"><i class="fas fa-question-circle me-1"></i>Where dapibus sollicitudin?</h5>
							<p>Aenean et sodales nisi, vel efficitur sapien. Quisque molestie diam libero, et elementum diam mollis ac. In dignissim aliquam est eget ullamcorper. Sed id sodales tortor, eu finibus leo. Vivamus dapibus sollicitudin justo vel fermentum. Curabitur nec arcu sed urna gravida lobortis. Donec lectus est, imperdiet eu viverra viverra, ultricies nec urna. </p>
					</section><!--//section-->
			    </article><!--//docs-article-->


		    </div> 
	    </div>
	
    </div><!--//docs-wrapper-->
   
   
<?php
}
}
/* {/block "main"} */
/* {block "launch-cta"} */
class Block_10583016836246e935d4a324_46271109 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
}
}
/* {/block "launch-cta"} */
}
