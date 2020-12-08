<?php
	# user input sample:
	# Webapp url: https://www.github.com 
	# Sample wordlist: D:\newxampp\htdocs\bruteForcer\wordlist.txt
	# sample status code : 302, 200
	
	//taking input from the user
	$webUrl = (string)readline('Enter Webapp url: '); 
	$webPath = (string)readline('Enter path of containing a list of webapp paths: '); 
	$statusCode = (string)readline('Enter Success status codes by comma separated: ');
	
	$statusCode = explode(",", $statusCode);

	$paths = fopen("$webPath","r");
	
	$i = 1;
	while((! feof($paths)) && ($i < 5)){
		$path = fgets($paths);
		echo pinUrlg($webUrl."/".$path, $statusCode);
		$i++;
	}
	fclose($paths);

	//ping the URL
	function pinUrlg($url=NULL, $statusCode=NULL) { 
		if($url == NULL) return false;  
		$ch = curl_init($url);  
		curl_setopt($ch, CURLOPT_TIMEOUT, 5);  
		curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);  
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);  
		$data = curl_exec($ch);  
		$httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);  
		curl_close($ch); 

		if($httpcode == 200){  
			return $url. "[status code ". $httpcode."]".PHP_EOL;
		} else {  
			return $url. "[status code ". $statusCode[0]."]".PHP_EOL;
		}
	} 

 ?>