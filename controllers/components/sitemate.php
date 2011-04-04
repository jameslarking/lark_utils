<?php
class SitemateComponent extends Object{
	
	function store($file,$path="",$meta=array()){
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, Configure::read("sitemate.posturl"));
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, array(
			"file"=>"@".$file,
			"apikey"=>Configure::read("sitemate.apikey"),
			"path"=>$path,
			"meta"=>$meta
		)); 
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$return=curl_exec($ch);
		$httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
		curl_close($ch);
		if($httpcode==200){
			return $return;
		}
	}
}