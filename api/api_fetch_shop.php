<?php
header('Content-Type: application/json');
header('Acess-Control-Allow-Origin: *');

include("connection.php");
$sql = "SELECT * FROM SHOP ORDER BY dbms_random.value";
$result = oci_parse($conn, $sql);

if (oci_execute($result)) {

    $output = oci_fetch_all($result, $data, null, null, OCI_FETCHSTATEMENT_BY_ROW);
    exit(json_encode($data));
} else {
    exit(json_encode(array('message' => 'No record Found', 'status' => false)));
}
