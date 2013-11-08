<?php

require_once('Smarty.class.php');
require_once('widget.php');

class Smarty_Widget extends Smarty
{
	private $widget;

	function __construct($widget)
	{
		parent::__construct();
		
		$this->setTemplateDir('widgets/templates/');
		$this->setCompileDir('widgets/templates_c/');
		$this->setConfigDir('widgets/configs/');
		$this->setCacheDir('widgets/cache/');
		$this->widget = $widget;
		$this->assign('widget', $this->widget);
	}

}
?>