<?php
	session_start();

        if(!isset($_SESSION['auth'])){
                header("Location: index.php");
                exit();
        }
        if($_SESSION['auth'] == 0){
                header("Location: index.php");
                exit();
	}

	$mouse_level = 0;
	$mouse_name = 0;
	$beacon_timeout = 0;
	$dir_max = 0;
	$camera = 0;
	$micro = 0;
	$voice_threshold = 0;
	$voice_start = 0;
	$voice_duration = 0;
	$sec = 0;
	$access = 0;
	$ssid = 0;
	$password = 0;
	$mode = 0;
	$chng = 0;
	
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
		$mouse_level = htmlspecialchars($_POST['mouse_level']);
		$mouse_name = htmlspecialchars($_POST['mouse_name']);
		$beacon_timeout = htmlspecialchars($_POST['beacon_timeout']);
		$dir_max = htmlspecialchars($_POST['dir_max']);
		$camera = htmlspecialchars($_POST['camera']);
		$micro = htmlspecialchars($_POST['micro']);
		$voice_threshold = htmlspecialchars($_POST['voice_threshold']);
		$voice_start = htmlspecialchars($_POST['voice_start']);
		$voice_duration = htmlspecialchars($_POST['voice_duration']);
		$sec = htmlspecialchars($_POST['sec']);
		$access = htmlspecialchars($_POST['access']);
		$ssid = htmlspecialchars($_POST['ssid']);
		$password = htmlspecialchars($_POST['password']);
		$mode = htmlspecialchars($_POST['mode']);
		$chng =  htmlspecialchars($_POST['chng']);
	}

        if($_SESSION['auth']){
                $conn = new mysqli('localhost','userecsys','ecsys123','ecsys');
                if ($conn->connect_error) {
                        die("Connection failed: " . $conn->connect_error);
		}else{
			$sql = "UPDATE cfg SET ";
			if($mouse_level >= 0)$sql = $sql."mouse_level=".$mouse_level.",";	
			if($mouse_name)$sql = $sql."mouse_name='".$mouse_name."',";	
			if($beacon_timeout >= 0)$sql = $sql."beacon_timeout=".$beacon_timeout.",";	
			if($dir_max >= 0)$sql = $sql."dir_max=".$dir_max.",";	
			if($camera)$sql = $sql."camera='".$camera."',";	
			if($micro)$sql = $sql."micro='".$micro."',";	
			if($voice_threshold >= 0)$sql = $sql."voice_threshold=".$voice_threshold.",";	
			if($voice_start >= 0)$sql = $sql."voice_start=".$voice_start.",";	
			if($voice_duration >= 0)$sql = $sql."voice_duration=".$voice_duration.",";	
			if($sec)$sql = $sql."sec='".$sec."',";	
			if($access)$sql = $sql."access='".$access."',";	
			echo $sql;
			$sql = rtrim($sql,",");
			if($sql != "UPDATE cfg SET "){
				$result = $conn->query($sql);
				$sql = "UPDATE nbuf SET id = 2";
				$result = $conn->query($sql);
			}
			if($ssid && $password){
				$sql = "UPDATE nbuf SET id = 1,ssid='".$ssid."',password='".$password."',mode='".$mode."',chng='".$chng."'";
                        	$result = $conn->query($sql);
			}	
			sleep(5);
			header("Location: config.php");
		}
	}
?>
