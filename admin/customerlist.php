<?php
    include("../db/connection.php");

        //writing the sql query
        $role = 'customer';
        $sql = "SELECT * FROM USER_I WHERE ROLE = :urole"; // selecting the all data from the user
        $stid = oci_parse($connection,$sql);
        oci_bind_by_name($stid, ":urole" ,$role);
        // exeucuting the query
        oci_execute($stid);

        echo "<div class='user-container'>";
        echo "<table>";
        echo "<tr>
        <th>Id</th>
        <th>Username</th>
        <th>Email</th>
        <th>Contact</th>
        <th>Verified</th>
        <th>Status</th>
        <th>Edit</th>
        <th>Delete</th>
        </tr>";
        while($row = oci_fetch_array($stid,OCI_ASSOC)){
            $id = $row['USER_ID'];
            
            echo "<tr>";
            echo "<td>".$row['USER_ID']."</td>";
            echo "<td>".$row['FIRST_NAME']." ".$row['LAST_NAME']."</td>";
            echo "<td>".$row['EMAIL'] ."</td>";
            echo "<td>".$row['CONTACT'] ."</td>";
            echo "<td>".$row['VERIFY'] ."</td>";
            
            if(empty($row['STATUS'])){
                echo "<td id='red'>active</td>";
            }
            else{
                echo "<td id='green'>active</td>";
            }
            echo "<td>". "<a href=editUser.php?id=$id&action=edit> Edit </a>"."</td>";
            echo "<td>". "<a href=deleteUser.php?id=$id&action=delete> Delete</a>"."</td>";
            echo "</tr>";
            
        }
        echo "</table>";

        echo "</div>";
    ?>