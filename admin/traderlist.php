<?php
    include("../db/connection.php");

        //writing the sql query
        $role = 'trader';
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
        <th>Category</th>
        <th>Verified</th>
        <th>Status</th>
        <th>Action</th>
        </tr>";
        while($row = oci_fetch_array($stid,OCI_ASSOC)){
            $id = $row['USER_ID'];
            $verify=$row['VERIFY']; 
            $fname = $row['FIRST_NAME'];
            $lname = $row['LAST_NAME'];
            $_SESSION['email'] = $row['EMAIL'];
            $_SESSION['username'] = $fname." ".$lname;
            
            echo "<tr>";
            echo "<td>".$row['USER_ID']."</td>";
            echo "<td>".$_SESSION['username']."</td>";
            echo "<td>".$row['EMAIL'] ."</td>";
            echo "<td>".$row['CONTACT'] ."</td>";
            echo "<td>".$row['CATEGORY'] ."</td>";
            echo "<td>".$row['VERIFY'] ."</td>";
            
            if($row['STATUS'] == 'off'){
                echo "<td id='red'>offline</td>";
            }
            else if($row['STATUS'] == 'on'){
                echo "<td id='green'>online</td>";
            }
            if($verify == 'pending'){
            echo "<td> <div class='action'>".
                "<a id='approve' href=updatetrader.php?id=$id&action=verified>Approve</a>"
                .
                "<a id='decline' href=deletetrader.php?id=$id&action=decline>Remove</a>".
                
                "</div>
                </td>";
            }
            else{
                echo "<td> <div class='action'> <a href=updatetrader.php?id=$id&action=pending>Deactivate</a> </div>
                </td>";
            }    

            echo "</tr>";
            
        }
        echo "</table>";

        echo "</div>";
    ?>