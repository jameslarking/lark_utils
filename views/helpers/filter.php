<?php
//$paginator->options(array('url' => $this->passedArgs));
class FilterHelper extends AppHelper{
	var $helpers=array("Form", "Javascript");
	var $js;
	var $filteritems=array();
	
	
	function add($name,$options,$attributes=array()){
		if(!isset($attributes['empty'])){
			$attributes=array("empty"=>"Filter by ".Inflector::humanize($name));	
		}
		if(!isset($attributes['id'])){
			$attributes['id']="filter_".$name;		
		}
		$this->filteritems[]=$name;
		$this->js.="$('#filter_".$name."').change(function(){do_filter();});";
		return $this->Form->select($name, $options, (isset($this->params['named'][$name])?$this->params['named'][$name]:""), $attributes
		);
	}
	function search($name="search"){
		$this->filteritems[]=$name;
		echo $this->Form->input("filter_".$name,array("label"=>Inflector::humanize($name), "value"=>(isset($this->params['named'][$name])?$this->params['named'][$name]:""), "div"=>array("id"=>$name."Div")));
		echo "<div id='filter_".$name."_button_div'>";
		echo $this->Form->button(Inflector::humanize($name),array("id"=>"filter_".$name."_button", "class"=>"searchbutton"));
		echo "</div>";
		$this->js.="$('#filter_".$name."_button').click(function(){do_filter();});";
		$this->js.="$('#filter_".$name."').keyup(function(event){
			if(event.keyCode==13) do_filter();
		});";
	}
	function js($baseurl=null){
		if(!$baseurl){
			if(!empty($this->params['prefix'])){
				$baseurl=DS.$this->params['prefix'].DS.$this->params['controller'].DS.str_replace($this->params['prefix']."_","",$this->params['action']);
			}else{
				$baseurl=DS.$this->params['controller'].DS.$this->params['action'];
			}
			foreach($this->params['pass'] as $k=>$i){
				$baseurl.="/".$i;	
			}
		}
		foreach($this->params['named'] as $k=>$i){
			if(!in_array($k,$this->filteritems)) $baseurl.=DS.$k.":".$i;	
		}
		$js="$(document).ready(function(){".$this->js."});
		function do_filter(){
			var url='".$baseurl."';";
			foreach($this->filteritems as $k){
			$js.="
			url+='/".$k.":' + $('#filter_".$k."').val();";
			}
			$js.="
			location.href=url;
		}
		";
		return $this->Javascript->codeBlock($js,array("inline"=>false));
	}
}