<?php
header('Content-Type: application/json');
header('Acess-Control-Allow-Origin: *');

include("connection.php");


$offerSql = "SELECT * FROM OFFER";
    $stmt = oci_parse($connection, $offerSql);
    oci_execute($stmt);
    while ($row = oci_fetch_array($stmt, OCI_ASSOC)) {
      $offer_id = $row['OFFER_ID'];
      $sql = 'SELECT * FROM PRODUCT WHERE OFFER_ID= :off_id AND ROWNUM <= 8';
      $stid = oci_parse($connection, $sql);
      oci_bind_by_name($stid, ':off_id', $offer_id);
      oci_execute($stid);
// bind the offer ID parameter to the prepared statement
  // replace with the actual offer ID you want to filter on

// execute the prepared statement
    if (oci_execute($result)) {

        $output = oci_fetch_all($result, $data, null, null, OCI_FETCHSTATEMENT_BY_ROW);
        // exit(json_encode($data));
        echo json_encode($data);
    } else {
        exit(json_encode(array('message' => 'No record Found', 'status' => false)));
    }

}