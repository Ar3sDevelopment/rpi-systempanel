<?php /* Smarty version Smarty-3.1.15, created on 2013-11-08 03:02:28
         compiled from "widgets/templates/memory.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1708809101527c3cd64f9459-11051111%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'b2c9523ed21709a0853244daf72f705a6ec578d4' => 
    array (
      0 => 'widgets/templates/memory.tpl',
      1 => 1383876146,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1708809101527c3cd64f9459-11051111',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.15',
  'unifunc' => 'content_527c3cd6517303_62499131',
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_527c3cd6517303_62499131')) {function content_527c3cd6517303_62499131($_smarty_tpl) {?><div class="row">
	<div class="col-xs-3">Memory</div>
	<div class="col-xs-3 text-right" id="total_mem"></div>
	<div class="col-xs-6">&nbsp;</div>
</div>
<div class="row">
	<div class="col-xs-3">Used</div>
	<div class="col-xs-3 text-right" id="used_mem"></div>
	<div class="col-xs-3">
		<div class="progress">
			<div id="bar1" class="progress-bar progress-bar-danger" role="progressbar" aria-valuemin="0" aria-valuemax="100"></div>
		</div>
	</div>
	<div class="col-xs-3 text-right" id="percent_used"></div>
</div>
<div class="row">
	<div class="col-xs-3">Free</div>
	<div class="col-xs-3 text-right" id="free_mem"></div>
	<div class="col-xs-3">
		<div class="progress">
			<div id="bar2" class="progress-bar progress-bar-success" role="progressbar" aria-valuemin="0" aria-valuemax="100"></div>
		</div>
	</div>
	<div class="col-xs-3 text-right" id="percent_free"></div>
</div>
<div class="row">
	<div class="col-xs-3">Buffered</div>
	<div class="col-xs-3 text-right" id="buffer_mem"></div>
	<div class="col-xs-3">
		<div class="progress">
			<div id="bar3" class="progress-bar progress-bar-warning" role="progressbar" aria-valuemin="0" aria-valuemax="100"></div>
		</div>
	</div>
	<div class="col-xs-3 text-right" id="percent_buff"></div>
</div>
<div class="row">
	<div class="col-xs-3">Cached</div>
	<div class="col-xs-3 text-right" id="cache_mem"></div>
	<div class="col-xs-3">
		<div class="progress">
			<div id="bar4" class="progress-bar progress-bar-info" role="progressbar" aria-valuemin="0" aria-valuemax="100"></div>
		</div>
	</div>
	<div class="col-xs-3 text-right" id="percent_cach"></div>
</div>
<div class="row">
	<div class="col-xs-12">&nbsp;</div>
</div>
<div class="row">
	<div class="col-xs-3">Swap</div>
	<div class="col-xs-3 text-right" id="total_swap"></div>
	<div class="col-xs-6">&nbsp;</div>
</div>
<div class="row">
	<div class="col-xs-3">Used</div>
	<div class="col-xs-3 text-right" id="used_swap"></div>
	<div class="col-xs-3">
		<div class="progress">
			<div id="bar5" class="progress-bar progress-bar-danger" role="progressbar" aria-valuemin="0" aria-valuemax="100"></div>
		</div>
	</div>
	<div class="col-xs-3 text-right" id="percent_swap"></div>
</div>
<div class="row">
	<div class="col-xs-3">Free</div>
	<div class="col-xs-3 text-right" id="free_swap"></div>
	<div class="col-xs-3">
		<div class="progress">
			<div id="bar6" class="progress-bar progress-bar-success" role="progressbar" aria-valuemin="0" aria-valuemax="100"></div>
		</div>
	</div>
	<div class="col-xs-3 text-right" id="percent_swap_free"></div>
</div><?php }} ?>
