<?php

require_once('../framework/Smarty/Smarty.class.php');
require_once('../framework/widget.inc.php');

class Smarty_Widget extends Smarty
{
	function __construct($folder)
	{
		parent::__construct();
		
		$this->setTemplateDir("../panelwidgets/$folder/templates/");
		$this->setCompileDir("../panelwidgets/$folder/templates_c/");
		$this->setConfigDir("../panelwidgets/$folder/configs/");
		$this->setCacheDir("../panelwidgets/$folder/cache/");
	}
}
?>