<?php
    include("../db/connection.php");

        //writing the sql query
        $role = 'trader';
        $sql = "SELECT * FROM SHOP"; // selecting the all data from the user
        $stid = oci_parse($connection,$sql);
        // exeucuting the query
        oci_execute($stid);

        echo "<div class='user-container'>";
        echo "<table>";
        echo "<tr>
        <th>Id</th>
        <th>Name</th>
        <th>Category</th>
        <th>Image</th>
        <th>Email</th>
        <th>Status</th>
        <th>Action</th>
        </tr>";

        $verify ='';
        while($row = oci_fetch_array($stid,OCI_ASSOC)){
            $id = $row['SHOP_ID'];
            $shop_name = $row['SHOP_NAME'];
            $phone = $row['CONTACT'];
            $email = $row['EMAIL'];
            $status=$row['STATUS']; 
            $category = $row['SHOP_TYPE'];

            echo "<tr>";
            echo "<td>".$id."</td>";
            echo "<td>".$shop_name."</td>";
            echo "<td>".$category."</td>";
            echo "<td class='imgs'><img src=\"../db/uploads/shops/" . $row['SHOP_LOGO'] . "\" alt=" . $shop_name . " ></td>";
            echo "<td>".$email."</td>";
            echo "<td>".$status."</td>";
            
            if($status == 'pending'){
            echo "<td> <div class='action'>".
                "<a id='approve' href=updateshop.php?id=$id&action=verified&email=$email>Approve</a>"
                .
                "<a id='decline' href=deleteshop.php?id=$id&action=decline&email=$email>Remove</a>".
                
                "</div>
                </td>";
            }
            else{
                echo "<td> <div class='action'> <a href=updateshop.php?id=$id&action=pending&email=$email>Deactivate</a> </div>
                </td>";
            }    

            echo "</tr>";
            
        }
        echo "</table>";

        echo "</div>";
    ?>