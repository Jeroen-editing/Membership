<?php
/* Smarty version 3.1.31, created on 2020-06-04 23:20:19
  from "/Applications/MAMP/htdocs/ledenadministratie/smarty/templates/ledenadmin.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.31',
  'unifunc' => 'content_5ed981b3c408f5_06851927',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '95ae3a835f0ed9ab89e2f5a385affd748cbb7856' => 
    array (
      0 => '/Applications/MAMP/htdocs/ledenadministratie/smarty/templates/ledenadmin.tpl',
      1 => 1591270200,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5ed981b3c408f5_06851927 (Smarty_Internal_Template $_smarty_tpl) {
?>
<!doctype html>
<html>
	<head>
		<meta charset="UTF-8">
		<link href="../css/ledenadmin.css" rel="stylesheet" type="text/css">
		<?php echo '<script'; ?>
 type="text/javascript" src="../js_lib/copyright.js"><?php echo '</script'; ?>
>

		<title>Leden administratie</title>
	</head>

	<body>
		<div id="mainbox">
			<header>
				<img src="../images/webontwikkeling.jpeg"  height="100%" alt="webontwikkeling"/>
				<p>Web-ontwikkeling</p>
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
				<?php echo '<script'; ?>
 language="javascript">
					document.write(copyRight("webontwikkeling.info"));
				<?php echo '</script'; ?>
>
			</footer>		
		</div>
	</body>
</html>
<?php }
}
