<?php
/*
* just an extension of the mail component
* like to have this to hand to be able to resuse and modify easily
*/
App::import('Component', 'Email'); 
class MailComponent extends EmailComponent{
	function startup(){
		$this->from=Configure::read("Site.name")." <".Configure::read("Site.email").">";
		$this->sendAs="both";
	}	
}
?>
