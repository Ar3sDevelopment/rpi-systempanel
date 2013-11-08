<?php /* Smarty version Smarty-3.1.15, created on 2013-11-08 02:19:02
         compiled from "./templates/index.tpl" */ ?>
<?php /*%%SmartyHeaderCode:2019220078527c2dddc849a9-84417907%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'c0360d049dff10f364dfc53ba2cc3958abf6ee6d' => 
    array (
      0 => './templates/index.tpl',
      1 => 1383873479,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2019220078527c2dddc849a9-84417907',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.15',
  'unifunc' => 'content_527c2dde214122_97732998',
  'variables' => 
  array (
    'widget_count' => 0,
    'c' => 0,
    'widgets' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_527c2dde214122_97732998')) {function content_527c2dde214122_97732998($_smarty_tpl) {?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>System Info Panel</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="apple-mobile-web-app-capable" content="yes">
	<link href="css/bootstrap/bootstrap.min.css" rel="stylesheet" type="text/css" />
	<link href="css/style.css" rel="stylesheet" type="text/css" />
	<script type="text/javascript" src="js/jquery/jquery-2.0.3.min.js"></script>
	<script type="text/javascript" src="js/bootstrap/bootstrap.min.js"></script>
	<script type="text/javascript" src="js/system.js"></script>
	<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
		<script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
	    <![endif]-->
</head>
<body>
	<div class="container">
		<nav class="navbar navbar-default navbar-fixed-top">
			<ul class="nav navbar-nav navbar-right">
				<li><a href="javascript:updateSingle();"><span class="glyphicon glyphicon-refresh"></span></a></li>
			</ul>
		</nav>
		<?php $_smarty_tpl->tpl_vars['c'] = new Smarty_Variable;$_smarty_tpl->tpl_vars['c']->step = 2;$_smarty_tpl->tpl_vars['c']->total = (int) ceil(($_smarty_tpl->tpl_vars['c']->step > 0 ? $_smarty_tpl->tpl_vars['widget_count']->value-1+1 - (0) : 0-($_smarty_tpl->tpl_vars['widget_count']->value-1)+1)/abs($_smarty_tpl->tpl_vars['c']->step));
if ($_smarty_tpl->tpl_vars['c']->total > 0) {
for ($_smarty_tpl->tpl_vars['c']->value = 0, $_smarty_tpl->tpl_vars['c']->iteration = 1;$_smarty_tpl->tpl_vars['c']->iteration <= $_smarty_tpl->tpl_vars['c']->total;$_smarty_tpl->tpl_vars['c']->value += $_smarty_tpl->tpl_vars['c']->step, $_smarty_tpl->tpl_vars['c']->iteration++) {
$_smarty_tpl->tpl_vars['c']->first = $_smarty_tpl->tpl_vars['c']->iteration == 1;$_smarty_tpl->tpl_vars['c']->last = $_smarty_tpl->tpl_vars['c']->iteration == $_smarty_tpl->tpl_vars['c']->total;?>
		<div class="row">
			<?php if (!$_smarty_tpl->tpl_vars['widgets']->value[$_smarty_tpl->tpl_vars['c']->value]->visible) {?>
			<div class="col-md-6" style="display: none;">
			<?php } else { ?>
			<div class="col-md-6">
			<?php }?>
				<?php echo $_smarty_tpl->getSubTemplate ("widget.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('widget'=>$_smarty_tpl->tpl_vars['widgets']->value[$_smarty_tpl->tpl_vars['c']->value]), 0);?>

			</div>
			<?php if (($_smarty_tpl->tpl_vars['c']->value+1)<($_smarty_tpl->tpl_vars['widget_count']->value-1)) {?>
				<?php if (!$_smarty_tpl->tpl_vars['widgets']->value[$_smarty_tpl->tpl_vars['c']->value+1]->visible) {?>
			<div class="col-md-6" style="display: none;">
				<?php } else { ?>
			<div class="col-md-6">
				<?php }?>
				<?php echo $_smarty_tpl->getSubTemplate ("widget.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('widget'=>$_smarty_tpl->tpl_vars['widgets']->value[$_smarty_tpl->tpl_vars['c']->value+1]), 0);?>

			</div>
			<?php }?>
		</div>
		<?php }} ?>
	</div>
</body>
</html>
<?php }} ?>
