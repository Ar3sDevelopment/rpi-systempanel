<?php /* Smarty version Smarty-3.1.15, created on 2013-11-08 01:18:38
         compiled from "./templates/general_info.tpl" */ ?>
<?php /*%%SmartyHeaderCode:426236814527c2dde59c641-25177893%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'a0d60bcb956b3ecba02482bb34c0de7ce7937606' => 
    array (
      0 => './templates/general_info.tpl',
      1 => 1383847015,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '426236814527c2dde59c641-25177893',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.15',
  'unifunc' => 'content_527c2dde5b8779_54645859',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_527c2dde5b8779_54645859')) {function content_527c2dde5b8779_54645859($_smarty_tpl) {?><div class="row">
	<div class="col-xs-6">Hostname</div>
	<div class="col-xs-6" id="host"></div>
</div>
<div class="row">
	<div class="col-xs-6">System Time</div>
	<div class="col-xs-6" id="time"></div>
</div>
<div class="row">
	<div class="col-xs-6">Kernel</div>
	<div class="col-xs-6" id="kernel"></div>
</div>
<div class="row">
	<div class="col-xs-6">Processor</div>
	<div class="col-xs-6" id="processor"></div>
</div>
<div class="row">
	<div class="col-xs-6">CPU Frequency</div>
	<div class="col-xs-6" id="freq"></div>
</div>
<div class="row">
	<div class="col-xs-6">CPU Load</div>
	<div class="col-xs-3" id="cpuload"></div>
	<div class="col-xs-3" id="cpuload_percent">
		<div class="progress">
			<div id="bar7" class="progress-bar progress-bar-danger" role="progressbar" aria-valuemin="0" aria-valuemax="100"></div>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-xs-6">CPU Temperature</div>
	<div class="col-xs-6" id="cpu_temperature"></div>
</div>
<div class="row">
	<div class="col-xs-6">Uptime</div>
	<div class="col-xs-6" id="uptime"></div>
</div><?php }} ?>
