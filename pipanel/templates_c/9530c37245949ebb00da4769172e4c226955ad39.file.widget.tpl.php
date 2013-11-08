<?php /* Smarty version Smarty-3.1.15, created on 2013-11-08 02:22:29
         compiled from "./templates/widget.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1039520802527c2dde241da6-25283690%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '9530c37245949ebb00da4769172e4c226955ad39' => 
    array (
      0 => './templates/widget.tpl',
      1 => 1383873746,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1039520802527c2dde241da6-25283690',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.15',
  'unifunc' => 'content_527c2dde578616_63257432',
  'variables' => 
  array (
    'widget' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_527c2dde578616_63257432')) {function content_527c2dde578616_63257432($_smarty_tpl) {?><div class="panel panel-primary">
	<div class="panel-heading">
		<button type="button" class="btn btn-link" data-toggle="hide" data-target="#<?php echo $_smarty_tpl->tpl_vars['widget']->value->id;?>
"><?php echo $_smarty_tpl->tpl_vars['widget']->value->title;?>
</button>
		<button type="button" class="btn btn-link" data-toggle="collapse" data-target="#<?php echo $_smarty_tpl->tpl_vars['widget']->value->id;?>
">Collapse</button>
	</div>
	<div class="panel-body collapse in" id="<?php echo $_smarty_tpl->tpl_vars['widget']->value->id;?>
">
		<?php if ((($tmp = @$_smarty_tpl->tpl_vars['widget']->value->templatefile)===null||$tmp==='' ? false : $tmp)) {?>
			<?php echo $_smarty_tpl->getSubTemplate (("widgets/templates/").($_smarty_tpl->tpl_vars['widget']->value->templatefile), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

		<?php }?>
	</div>
</div><?php }} ?>
