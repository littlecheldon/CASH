<?php
error_reporting(E_ALL);
$readRequest = $_POST["readRequest"];
$writeRequest = $_POST["writeRequest"];
$writeVal = $_POST["writeValue"];
$lightId = $_POST["id"];
$handle;
$msg = "";
if(isset($readRequest)){
	if ($readRequest == "weather"){
		//read PiWeather.json
		$handle = @fopen("/var/www/html/cash_json/PiWeather.json", "r");
	} else if($readRequest == "lights"){
		//read PiLights.json
		$fileLocation = "/var/www/html/cash_json/PiLights" . $lightId . ".json";
		
		$handle = @fopen($fileLocation, "r");
	} else if ($readRequest == "sensor"){
		
		$handle = @fopen("/var/www/html/cash_json/PiSensor.json", "r");
	} else if ($readRequest == "alarm"){
		//read PiAlarm.json
		$handle = @fopen("/var/www/html/cash_json/PiAlarm.json", "r");
	}
	if($handle) {
		while (($buf = fgets($handle)) !== false){
			echo "$buf";
			//$obj = jsonDecode($wholeMessage);
		}
		if (!feof($handle)){
			echo "Error: fgets() fail\n";
		}
		fclose($handle);
	}

}

if(isset($msg) && isset($writeRequest)){
	if($writeRequest == "light"){
		$fileLocation = "/var/www/html/cash_json/WebLights" . $lightId . ".json";
		$writeVal = (int)$writeVal;
		$lightId = (int)$lightId;
		$arr = array('module' => "lights", 'id' => $lightId, 'power' => $writeVal);
		$msg = json_encode($arr);
		$handle = fopen($fileLocation, "w");
	} else if ($writeRequest == "alarm"){
		$arr = array('module' => "alarm", 'state' => $writeVal);
		$msg = json_encode($arr);
		$handle = fopen("/var/www/html/cash_json/WebAlarm.json", "w");
	}
	if($handle){
		fwrite($handle, $msg);
		fclose($handle);
	}
	echo "Wrote to " . $fileLocation . "\n";
}
?>

