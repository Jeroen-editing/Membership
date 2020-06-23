<?php
/* Smarty version 3.1.31, created on 2020-06-22 20:00:43
  from "/Applications/MAMP/htdocs/ledenadministratie 01/smarty/templates/ledenadmin.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.31',
  'unifunc' => 'content_5ef10deb2f2545_79833518',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '04dc4cae0c2b5591584142f377ad9c6e327f3f0a' => 
    array (
      0 => '/Applications/MAMP/htdocs/ledenadministratie 01/smarty/templates/ledenadmin.tpl',
      1 => 1592698929,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5ef10deb2f2545_79833518 (Smarty_Internal_Template $_smarty_tpl) {
?>
<!doctype html>
<html>
	<head>
		<meta charset="UTF-8">
		<link href="../css/ledenadmin.css" rel="stylesheet" type="text/css">
		<link href="../css/select.css" rel="stylesheet" type="text/css">
		<link href="https://fonts.googleapis.com/css2?family=Exo+2:wght@100;200;300;400;500;600;700;800;900&family=Montserrat:wght@100;200;300;400;500;600;700;800;900&family=Roboto:wght@100;300;400;500;700;900&display=swap" rel="stylesheet"> 
		 <link href="https://fonts.googleapis.com/css2?family=Baloo+2:wght@400;500;600;700;800&family=Capriola&family=Delius&family=Exo+2:wght@100;200;300;400;500;600;700;800;900&family=Montserrat:wght@100;200;300;400;500;600;700;800;900&family=Roboto:wght@100;300;400;500;700;900&display=swap" rel="stylesheet"> 
		<?php echo '<script'; ?>
 type="text/javascript" src="../js_lib/copyright.js"><?php echo '</script'; ?>
>

		<title>Leden administratie</title>
	</head>

	<body>
		<div id="mainbox">
			<header>
				<img src="../images/web-development.png" alt="webontwikkeling"/>
				<h2>- ontwikkeling</h2>
			</header>

			<nav>
				<ul>
				<?php
$__section_teller_0_saved = isset($_smarty_tpl->tpl_vars['__smarty_section_teller']) ? $_smarty_tpl->tpl_vars['__smarty_section_teller'] : false;
$__section_teller_0_loop = (is_array(@$_loop=$_smarty_tpl->tpl_vars['menu']->value) ? count($_loop) : max(0, (int) $_loop));
$__section_teller_0_total = $__section_teller_0_loop;
$_smarty_tpl->tpl_vars['__smarty_section_teller'] = new Smarty_Variable(array());
if ($__section_teller_0_total != 0) {
for ($__section_teller_0_iteration = 1, $_smarty_tpl->tpl_vars['__smarty_section_teller']->value['index'] = 0; $__section_teller_0_iteration <= $__section_teller_0_total; $__section_teller_0_iteration++, $_smarty_tpl->tpl_vars['__smarty_section_teller']->value['index']++){
?>
					<li><a href="<?php echo $_smarty_tpl->tpl_vars['menu']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_teller']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_teller']->value['index'] : null)]['d_link'];?>
"><?php echo $_smarty_tpl->tpl_vars['menu']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_teller']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_teller']->value['index'] : null)]['d_item'];?>

						</a>
					</li>
				<?php
}
}
if ($__section_teller_0_saved) {
$_smarty_tpl->tpl_vars['__smarty_section_teller'] = $__section_teller_0_saved;
}
?>
				</ul> 
			</nav>
		
			<main>
				<article id="artleft">
					<?php echo (($tmp = @$_smarty_tpl->tpl_vars['commentaar']->value)===null||$tmp==='' ? "<h1>leden-admin</h1>" : $tmp);?>

				</article>

				<article id="artright">
					<?php echo $_smarty_tpl->tpl_vars['inhoud']->value;?>

				</article>
			</main>
		
			<footer>
				<div class="copyright"> 
					<?php echo '<script'; ?>
>
						document.write(copyRight());
					<?php echo '</script'; ?>
>
				</div>	
			</footer>		
		</div>
	</body>
</html>
<?php }
}
