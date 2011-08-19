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
    
   function _aws_ses() { 
      require_once 'AWSSDKforPHP/sdk.class.php';
      $ses = new AmazonSES(); 
      $destination = array( 
         'ToAddresses' => explode(',', $this->to),
         'CcAddresses' =>  $this->cc,
         'BccAddresses' => $this->bcc 
      ); 
      $message = array( 
         'Subject' => array( 
            'Data' => $this->subject 
         ), 
         'Body' => array() 
      ); 
      if($this->textMessage != NULL) { 
         $message['Body']['Text'] = array( 
            'Data' => $this->textMessage 
         ); 
      } 
      if($this->htmlMessage != NULL) { 
         $message['Body']['Html'] = array( 
            'Data' => $this->htmlMessage 
         ); 
      } 
       
      $response = $ses->send_email($this->from, $destination, $message); 
      $ok = $response->isOK(); 
      if(!$ok) { 
         $this->log('Error sending email from AWS SES: '.json_encode($response->body). " Message was: ".$response->header['x-aws-body'], 'error'); 
      } 
      return $ok; 
   } 
}
?>
