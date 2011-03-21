<?php
class AutoLayoutsComponent extends Object{
	var $components=array("RequestHandler");
	var $autoErrorLayout=true;
	var $autoAjaxLayout=true;
	
	function initialize($controller){
	
	}
	
	function beforeRender ($controller) {
		if($this->autoErrorLayout)	$this->_setErrorLayout($controller);
		if($this->autoAjaxLayout)	$this->_setAjaxLayout($controller);
	}

	function _setErrorLayout($controller) {
	    if($controller->name == 'CakeError') {
	        if(is_file(APP."views".DS."layouts".DS."error.ctp"))	$controller->layout = 'error';
	    }
	}
	function _setAjaxLayout(){
		if($this->RequestHandler->isAjax()) $controller->layout="ajax";
	}	
}?>