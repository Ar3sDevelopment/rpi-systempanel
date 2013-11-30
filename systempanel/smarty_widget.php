<?php

require_once('../framework/Smarty/Smarty.class.php');
require_once('../framework/widget.inc.php');

class Smarty_Widget extends Smarty
{
	function __construct()
	{
		parent::__construct();
		
		$this->setTemplateDir('widgets/templates/');
		$this->setCompileDir('widgets/templates_c/');
		$this->setConfigDir('widgets/configs/');
		$this->setCacheDir('widgets/cache/');
	}
}
?>