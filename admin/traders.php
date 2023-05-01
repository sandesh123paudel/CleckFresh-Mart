<?php

    include("../db/connection.php");
    
    $role = 'trader';
    $verify = 'verified';
    $sql = "SELECT * FROM USER_I WHERE ROLE= :urole AND VERIFY = :verify ";
    $stid = oci_parse($connection,$sql);
    oci_bind_by_name($stid, ':urole' ,$role);
    oci_bind_by_name($stid, ':verify' ,$verify);

    oci_execute($stid);
    oci_fetch($stid);
    

    echo "<div class='trader-report-info'>";
    
    while($row=oci_fetch_array($stid,OCI_ASSOC)){
        $fname = $row['FIRST_NAME'];
        $lname = $row['LAST_NAME'];
        $category = strtoupper($row['CATEGORY']);

        echo "
            <div class='report-trader'>
            <div class='report-info'>
                <h3>"
                .$fname." ".$lname."
                </h3>
            <p>$category</p>
            </div>
            <div class='icon'>
                <span class='material-symbols-outlined'>
                    person
                </span>
            </div>
            </div>
        ";
    }
    echo "</div>";

?>

