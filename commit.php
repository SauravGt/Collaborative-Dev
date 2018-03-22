<?php

// Insert into several tables, rolling back the changes if an error occurs

$conn = oci_connect('OPS$1608275@ORA12C', 'P36273', 'mysql://mi-linux.wlv.ac.uk');

$stid = oci_parse($conn, "INSERT INTO valves (VALVE_ID, VALVE_STATUS, LAST_CHECK) VALUES (171, 'close',20-03-2017 )");

// The OCI_NO_AUTO_COMMIT flag tells Oracle not to commit the INSERT immediately
// Use OCI_DEFAULT as the flag for PHP <= 5.3.1.  The two flags are equivalent
$r = oci_execute($stid, OCI_NO_AUTO_COMMIT);
if (!$r) {    
    $e = oci_error($stid);
    trigger_error(htmlentities($e['message']), E_USER_ERROR);
}

$stid = oci_parse($conn, 'INSERT INTO location (NAME, VALVE_ID, LOC_ZONE) VALUES ('Tipton', 171, 'ZONE_F')');
$r = oci_execute($stid, OCI_NO_AUTO_COMMIT);
if (!$r) {    
    $e = oci_error($stid);
    oci_rollback($conn);  // rollback changes to both tables
    trigger_error(htmlentities($e['message']), E_USER_ERROR);
}

// Commit the changes to both tables
$r = oci_commit($conn);
if (!$r) {
    $e = oci_error($conn);
    trigger_error(htmlentities($e['message']), E_USER_ERROR);
}

?>