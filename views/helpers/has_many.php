<?php
class HasManyHelper extends AppHelper{
	var $helpers=array("Javascript", "Html");
		
	var $defaultOptions=array(
		"formDivId"=>"hasManyForm",
		"indexDivId"=>"hasManyTable",
		"includeJq"=>false,
		"includeJqForm"=>true
	);
	var $options=array();
	var $model;
	
	function manager($model=null,$options=array()){
		if($model) $this->model=$model;
		if($options) $this->options=$options;			
		$this->setDefaultOptions();
		$this->addForm();
		
	}
	function addForm(){
		if($this->options['includeJqForm'])	echo $this->Html->script("/has_many/js/jquery.form.js",array("inline"=>false));
		echo $this->Javascript->codeBlock("
			$(document).ready(function(){
				$('#".$this->options['formDivId']."').load('".$this->options['addURL']."', {ajax:true},function(){
					hasManyHelperAddFormJs();
				});
				$('#".$this->options['indexDivId']."').load('".$this->options['indexURL']."', {ajax:true});
				
			});
			function hasManyHelperAddFormJs(){
				$('#". $this->options['addFormId']."').ajaxForm(function(returnval){
					$('#".$this->options['formDivId']."').html(returnval);
					hasManyHelperAddFormJs();
					$('#".$this->options['indexDivId']."').load('".$this->options['indexURL']."', {ajax:true});
				});
			}
		");
	}
	function setDefaultOptions(){
		foreach($this->defaultOptions as $option=>$value){
			if(!isset($this->options[$option])) $this->options[$option]=$value;
		}	
	}
	
}?>