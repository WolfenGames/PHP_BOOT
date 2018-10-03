#!/usr/bin/php
<?php

	function download_image1($str){
		global $host;
		$name = preg_replace("/http[s]{0,1}:\/\//", "", $host);
		$host = trim($host, "/");
		$host .= "/";
		var_dump($name);
		if (preg_match("/http[s]{0,1}:\/\//", $host))
			$image_url = $host.trim($str[2], "/");
		else
			$image_url = $str[2];
		var_dump($image_url);
		$image_file = "images " . $str[2];
		$image_file = preg_replace("/\//", " ", $image_file);
		@mkdir($name);
		@touch($name.'/'.$image_file);
		$fp = fopen ($name.'/'.$image_file, 'wb');
		$ch = curl_init($image_url);
		curl_setopt($ch, CURLOPT_FILE, $fp);
		curl_setopt($ch, CURLOPT_HEADER, 0);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
		curl_exec($ch);
		curl_close($ch);
		fclose($fp);
	}

	$host = $argv[1];
	$result = file_get_contents($host."/");

	preg_replace_callback('/(<img.*src=\")(.*)(\".*>)/Uis', download_image1, $result);
?>