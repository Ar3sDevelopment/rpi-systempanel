<?php /* Smarty version Smarty-3.1.15, created on 2013-11-08 01:18:38
         compiled from "./templates/swap.tpl" */ ?>
<?php /*%%SmartyHeaderCode:316357030527c2dde621f62-43412610%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '30bb32b567e818a0118649cce5bf77bbc726e32e' => 
    array (
      0 => './templates/swap.tpl',
      1 => 1383847015,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '316357030527c2dde621f62-43412610',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.15',
  'unifunc' => 'content_527c2dde641312_90635064',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_527c2dde641312_90635064')) {function content_527c2dde641312_90635064($_smarty_tpl) {?><div class="row">
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
