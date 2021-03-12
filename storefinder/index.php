<?php
$f3=require('lib/base.php');
$f3->route('POST /',
	function() {
		ini_set("user_agent","Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.0)");
		ini_set("max_execution_time", 0);
		ini_set("memory_limit", "10000M");
		$post_url = '';
		foreach ($_POST AS $key=>$value)
			$post_url .= $key.'='.$value.'&';
		$post_url = rtrim($post_url, '&');
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL,"https://www2.itemlocator.net/ils/locatorJSON/");
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_REFERER, 'http://www.steakumm.com/');
		curl_setopt($ch, CURLOPT_POSTFIELDS, $post_url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$server_output = curl_exec($ch);
		curl_close ($ch);

		header('Content-Type: application/json');
		echo $server_output;
	}
);
$f3->run();
