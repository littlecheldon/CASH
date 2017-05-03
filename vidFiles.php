<?php
	$index = 0;
	$fileArr = array();
	$vidDirectory = '/var/www/html/savedvids';
	$it = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($vidDirectory));

	$it->rewind();
	while($it->valid()) {

		if (!$it->isDot()) {
			$fileArr[$index] = $it -> getSubPathName();
			$index++;
		}

		$it->next();
	}
	$returnStr = json_encode($fileArr);
	echo($returnStr);
	
?>
