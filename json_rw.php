<?php
error_reporting(E_ALL);
$readRequest = $_POST["readRequest"];
$writeRequest = $_POST["writeRequest"];
$msg = $_POST["jsonToSend"];

if(isset($readRequest)){
	if ($readRequest == "weather"){
		//read PiWeather.json
		$handle = @fopen("/var/www/html/cash_json/PiWeather.json", "r");
	} else if($readRequest == "lights"){
		//read PiLights.json
		$handle = @fopen("/var/www/html/cash_json/PiLights.json", "r");
	} else if ($readRequest == "sensor"){
		
		$handle = @fopen("/var/www/html/cash_json/PiSensor.json", "r");
	} else if ($readRequest == "alarm"){
		//read PiAlarm.json
		$handle = @fopen("/var/www/html/cash_json/PiAlarm.json", "r");
	}
	if($handle) {
		while (($buf = fgets($handle)) !== false){
			echo "$buf";
		}
		if (!feof($handle)){
			echo "Error: fgets() fail\n";
		}
		fclose($handle);
	}

}

if(isset($msg) && isset($writeRequest)){
	if($writeRequest == "lights"){
		$handle = fopen("/var/www/html/cash_json/WebLights.json", "w");
	} else if ($writeRequest == "alarm"){
		$handle = fopen("/var/www/html/cash_json/WebAlarm.json", "w");
	}
	if($handle){
		fwrite($handle, $msg);
		fclose($handle);
	}
}
?>

