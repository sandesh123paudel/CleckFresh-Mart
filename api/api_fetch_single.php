<?php
header('Content-Type: application/json');
header('Acess-Control-Allow-Origin: *');

$data = json_decode(file_get_contents("php://input"),true);

$product_id = $data['id'];

include("connection.php");

$sql = "SELECT * FROM PRODUCT WHERE PRODUCT_ID = {$product_id}";
$result = oci_parse($conn,$sql);

if(oci_execute($result)){
    $output = oci_fetch_all($result,$data,null, null, OCI_FETCHSTATEMENT_BY_ROW);
     exit(json_encode($data));
}
else{
    echo json_encode(array('message' => 'No record Found','status' => false));
}
?>