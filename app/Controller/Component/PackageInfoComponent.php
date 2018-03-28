<?php
/*
 *
 * */
class PackageInfoComponent extends Component
{
	var $controller;

    public $components = array('Session');
	var $_errorMsg = null;



	function startup(Controller $controller)
	{
		$this->controller = $controller;

	}



}