<?php

$valveid=$_POST['valveid'];
$valvestatus=$_POST['valvestatus'];
$lastcheck=$_POST['lastcheck'];



$con=mysql_connect("localhost", "1608275", "k20omV0Y8HTfpGSs");
if(!$con)
	(
die('Could not connect:'.mysql_error());
)

mysql_select_db ("db1608275", $con);

$query= "INSERT INTO valves(Valve_ID, Valve_Status, Last_Check)
VALUES('$valveid','$valvestatus','$lastcheck')";
if(!mysql_query($query, $con))
	(
die('Error in inserting records'. mysql_error);
) else
	(
echo "Data Inserted";
)
?>

