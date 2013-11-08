<?php /* Smarty version Smarty-3.1.15, created on 2013-11-08 02:22:30
         compiled from "widgets/templates/swap.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1712610014527c3cd653da08-51026322%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '27ba1c5fb67ead0b8ea0bbffbf172a625a1b0fe8' => 
    array (
      0 => 'widgets/templates/swap.tpl',
      1 => 1383873480,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1712610014527c3cd653da08-51026322',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.15',
  'unifunc' => 'content_527c3cd6557f47_34189693',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_527c3cd6557f47_34189693')) {function content_527c3cd6557f47_34189693($_smarty_tpl) {?><div class="row">
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
