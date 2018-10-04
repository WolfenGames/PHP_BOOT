<?php
	if (($_SERVER['PHP_AUTH_USER'] != "zaz") || ($_SERVER['PHP_AUTH_PW'] != "jaimelespetitsponeys")) {
		header ('HTTP/1.0 401 Unauthorized');
		header ('WWW-Authenticate: Basic realm =\'\'Members Area\'\'');
		echo  "<html><body>This field is only accessible to site members</body></html>\n";
	} else {
		$file = file_get_contents('../img/42.png');
		echo "<html><body>\nHi Zaz<br/>\n<img src='data:image/png; base64, " . base64_encode($file) . "'>\n</body></html>\n" ;
	}
?>