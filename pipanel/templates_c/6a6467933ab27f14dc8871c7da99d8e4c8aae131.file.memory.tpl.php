<?php /* Smarty version Smarty-3.1.15, created on 2013-11-08 01:18:38
         compiled from "./templates/memory.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1918982964527c2dde5dd8d6-87856071%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '6a6467933ab27f14dc8871c7da99d8e4c8aae131' => 
    array (
      0 => './templates/memory.tpl',
      1 => 1383847015,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1918982964527c2dde5dd8d6-87856071',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.15',
  'unifunc' => 'content_527c2dde5fc062_92154340',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_527c2dde5fc062_92154340')) {function content_527c2dde5fc062_92154340($_smarty_tpl) {?><div class="row">
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
</div><?php }} ?>
