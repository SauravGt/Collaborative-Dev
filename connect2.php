<?php
$Valve_ID = filter_input(INPUT_POST, 'Valve_ID');
$Valve_Status = filter_input(INPUT_POST, 'Valve_Status');
$Last_Check = filter_input(INPUT_POST, 'Last_Check');
if (!empty($Valve_ID)){
if (!empty($Valve_Status)){

	$host = "localhost";
	$dbusername = "1608275";
	$dbpassword = "";
	$dbname = "1608275db";
//creating connection
$conn = new mysqli ($host, $dbusername, $dbpassword, $dbname);

if (mysqli_connect_error()){
	die('Connect Error ('. mysqli_connect_errno() .')'
	.mysqli_connect_error());
}
else {
	$sql = "INSERT INTO Valves ( Valve_ID, Valve_Status, Last_Check)
	values ('$Valve_ID' , '$Valve_Status' , '$Last_Check')";
	if ($conn->query($sql)){
		echo "New Record is inserted";
	}
	else{
		echo "Error:". $sql ."<br>". $conn->error;
	}
	$conn->close();
}
}
else{
echo " Valve ID should not be empty";
die();
}
}
else{
echo "Valve Status should not be empty";
die();
}
?>