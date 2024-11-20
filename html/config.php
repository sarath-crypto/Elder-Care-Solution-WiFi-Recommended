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
	
	echo '<!DOCTYPE html><html><head><style>table,th,td{border: 1px solid white;border-collapse: collapse;}th,td{background-color: #96D4D4;}</style></head><body>';
	echo "<a href='main.php'>Back to main page</a>";

	$conn = new mysqli('localhost','userecsys','ecsys123','ecsys');
        if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
        }else{
		echo '<table><tr>';
		echo '<th style="color:blue">Network Configuration</th>';
		echo '<th style="color:blue">Mouse Configuration</th>';
		echo '<th style="color:blue">Camera Configuration</th>';
		echo '<th style="color:blue">Microphone Configuration</th>';
		echo '</tr><tr><td>';
                $sql = "SELECT name,status FROM net";
		$result = $conn->query($sql);
		if ($result->num_rows > 0) {
			echo '<table>';
			echo '<tr>';
			echo '<th>NAME</th>';
			echo '<th>STATUS</th>';
			echo '</tr>';
			while($row = $result->fetch_assoc()) {
				echo '<tr width=100%>';
				echo '<td>';
				echo $row['name'];
				echo '</td>';
				echo '<td>';
				echo $row['status'];
				echo '</td>';
				echo '</tr>';
			}
			echo '</table>';
		}
		echo '</td><td>';
		$sql = "SELECT * FROM mouse";
		$result = $conn->query($sql);
		if ($result->num_rows > 0) {
			echo '<table>';
			echo '<tr>';
			echo '<th>ID</th>';
			echo '<th>NAME</th>';
			echo '</tr>';
			while($row = $result->fetch_assoc()) {
				echo '<tr width=100%>';
				echo '<td>';
				echo $row['id'];
				echo '</td>';
				echo '<td>';
				echo $row['name'];
				echo '</tr>';
			}
			echo '</table>';
		}
		echo '</td><td>';
		$sql = "SELECT * FROM camera";
		$result = $conn->query($sql);
		if ($result->num_rows > 0) {
			echo '<table>';
			echo '<tr>';
			echo '<th>ID</th>';
			echo '<th>NAME</th>';
			echo '</tr>';
			while($row = $result->fetch_assoc()) {
				echo '<tr width=100%>';
				echo '<td>';
				echo $row['id'];
				echo '</td>';
				echo '<td>';
				echo $row['name'];
				echo '</tr>';
			}
			echo '</table>';
		}
		echo '</td><td>';
		$sql = "SELECT * FROM micro";
		$result = $conn->query($sql);
		if ($result->num_rows > 0) {
			echo '<table>';
			echo '<tr>';
			echo '<th>ID</th>';
			echo '<th>NAME</th>';
			echo '</tr>';
			while($row = $result->fetch_assoc()) {
				echo '<tr width=100%>';
				echo '<td>';
				echo $row['id'];
				echo '</td>';
				echo '<td>';
				echo $row['name'];
				echo '</tr>';
			}
			echo '</table>';
		}
		echo '</td></tr></table>';

		$sql = "SELECT * FROM cfg";
		$result = $conn->query($sql);
		if ($result->num_rows > 0) {
			echo '<table>';
			echo '<tr>';
			echo '<th style="color:blue">Application Parameters</th>';
			echo '<th>Value</th>';
			echo '<th>Comments</th>';
			echo '</tr>';
			while($row = $result->fetch_assoc()) {
				echo '<tr width=100%>';
				echo '<td>';
				echo "mouse_level";
				echo '</td>';
				echo '<td>';
				echo $row['mouse_level'];
				echo '</td>';
				echo '<td>';
				echo '0-5';
				echo '</td>';
				echo '</tr>';

				echo '<tr width=100%>';
				echo '<td>';
				echo "mouse_name";
				echo '</td>';
				echo '<td>';
				echo $row['mouse_name'];
				echo '</td>';
				echo '<td>';
				echo 'name of mouse shown by mouse configuration';
				echo '</td>';
				echo '</tr>';

				echo '<tr width=100%>';
				echo '<td>';
				echo "beacon_timeout";
				echo '</td>';
				echo '<td>';
				echo $row['beacon_timeout'];
				echo '</td>';
				echo '<td>';
				echo '0-255 Seconds';
				echo '</td>';
				echo '</tr>';
				
				echo '<tr width=100%>';
				echo '<td>';
				echo "dir_max";
				echo '</td>';
				echo '<td>';
				echo $row['dir_max'];
				echo '</td>';
				echo '<td>';
				echo '0-255 Directories';
				echo '</td>';
				echo '</tr>';

				echo '<tr width=100%>';
				echo '<td>';
				echo "camera";
				echo '</td>';
				echo '<td>';
				echo $row['camera'];
				echo '</td>';
				echo '<td>';
				echo 'no,name of the usb camera shown my camera configuration or pi_camera';
				echo '</td>';
				echo '</tr>';

				echo '<tr width=100%>';
				echo '<td>';
				echo "micro";
				echo '</td>';
				echo '<td>';
				echo $row['micro'];
				echo '</td>';
				echo '<td>';
				echo 'no,name of the microphone shown my microphone configuration';
				echo '</td>';
				echo '</tr>';

				echo '<tr width=100%>';
				echo '<td>';
				echo "voice_threshold";
				echo '</td>';
				echo '<td>';
				echo $row['voice_threshold'];
				echo '</td>';
				echo '<td>';
				echo ' < 90 ';
				echo '</td>';
				echo '</tr>';

				echo '<tr width=100%>';
				echo '<td>';
				echo "voice_start";
				echo '</td>';
				echo '<td>';
				echo $row['voice_start'];
				echo '</td>';
				echo '<td>';
				echo '0-23 Hours';
				echo '</td>';
				echo '</tr>';

				echo '<tr width=100%>';
				echo '<td>';
				echo "voice_duration";
				echo '</td>';
				echo '<td>';
				echo $row['voice_duration'];
				echo '</td>';
				echo '<td>';
				echo '0-24 Hours';
				echo '</td>';
				echo '</tr>';

				echo '<tr width=100%>';
				echo '<td>';
				echo "sec";
				echo '</td>';
				echo '<td>';
				echo $row['sec'];
				echo '</td>';
				echo '<td>';
				echo 'secret key for communicating with WiFi Alarm';
				echo '</td>';
				echo '</tr>';

				echo '<tr width=100%>';
				echo '<td>';
				echo "access";
				echo '</td>';
				echo '<td>';
				echo $row['access'];
				echo '</td>';
				echo '<td>';
				echo 'password for accessing the web';
				echo '</td>';
				echo '</tr>';
			}
			echo '</table>';
		}

		$conn->close();
	}

	echo '<br><table><tr>';
	echo '<th style="color:red">Change Application Parameters</th>';
	echo '<th style="color:red">Change Application Parameters</th>';
	echo '<th style="color:red">Change Network Configuration</th>';
	echo '</tr><tr><td>';

	echo '<form action="reconfig.php" method="POST" id="action-form">';
	echo '<table><tr>';
	echo '<tr width=100%><td>MOUSE_LEVEL</td><td><input type="number" id="mouse_level" name="mouse_level"></td></tr>';
	echo '<tr width=100%><td>MOUSE_NAME</td><td><input type="text" id="mouse_name" name="mouse_name"></td></tr>';
	echo '<tr width=100%><td>BEACON_TIMEOUT</td><td><input type="number" id="beacon_timeout" name="beacon_timeout"></td></tr>';
	echo '<tr width=100%><td>DIR_MAX</td><td><input type="number" id="dir_max" name="dir_max"></td></tr>';
	echo '<tr width=100%><td>CAMERA</td><td><input type="text" id="camera" name="camera"></td></tr>';
	echo '<tr width=100%><td>MICRO</td><td><input type="text" id="micro" name="micro"></td></tr>';
	echo '</table></td><td><table>';
	echo '<tr width=100%><td>VOICE_THRESHOLD</td><td><input type="number" id="voice_threshold" name="voice_threshold"></td></tr>';
	echo '<tr width=100%><td>VOICE_START</td><td><input type="number" id="voice_start" name="voice_start"></td></tr>';
	echo '<tr width=100%><td>VOICE_DURATION</td><td><input type="number" id="voice_duration" name="voice_duration"></td></tr>';
	echo '<tr width=100%><td>SEC</td><td><input type="text" id="sec" name="sec"></td></tr>';
	echo '<tr width=100%><td>ACCESS</td><td><input type="text" id="access" name="access"></td><td><input type="submit" value="REBOOT"></td></tr>';
	echo '</table>';
	echo '</form>';
	echo '</td><td>';
	echo '<form action="reconfig.php" method="POST" id="action-form">';
	echo '<table>';
	echo '<tr width=100%><td>SSID</td><td><input type="text" id="ssid" name="ssid"></td></tr>';
	echo '<tr width=100%><td>PASSWORD</td><td><input type="text" id="password" name="password"></td></tr>';
	echo '<tr width=100%><td>WiFi mode</td><td><select name="mode" id="mode"><option value="STA">STA</option><option value="AP">AP</option></select>';
	echo '<select name="chng" id="chng"><option value="ADD">ADD</option><option value="REMOVE">REMOVE</option></select></td><td>';
	echo '<input type="submit" value="Submit"></td></tr>';
	echo '</table>';
	echo '</form>';
	echo '</td></tr>';
	echo '</td></tr></table>';
?>
