<?php
class IndexPageSessionComponent extends Object{
	var $components=array("Session");
	function initialize(&$controller, $settings = array()) {
		$this->controller =& $controller;
		if(empty($settings['actions'])) $settings['actions']=array("admin_index");
		$this->settings=$settings;
	}
	
	function startup(&$controller){
		if(in_array($controller->params['action'],$this->settings['actions'])){
			$sessionName=$this->_sessionName();
			$this->Session->write($sessionName, $this->controller->here);
		}
	}
	function index($controllerName=null){
		if(!$controllerName) $controllerName=$this->controller->params['controller'];
		$sessionName=$this->_sessionName($controllerName);
		$location=$this->Session->read($sessionName);
		if(!$location){
			$location=array("controller"=>$controllerName, 
							"action"=>"index");
			if(!empty($this->controller->params['prefix'])) $location[$this->controller->params['prefix']]=true;
		}
		$this->controller->redirect($location);

	}
	function _sessionName($controllerName=null){
		if(!$controllerName) $controllerName=$this->controller->params['controller'];
		return 	"IndexPageSessionComponent-".
				(!empty($this->controller->params['prefix'])?$this->controller->params['prefix']:"").
				"-".
				$controllerName;
	}
}