<?php
    include("../db/connection.php");

        echo "<div class='user-container'>";
        echo "<table>";
        echo "<tr>
        <th>Id</th>
        <th>Name</th>
        <th>No of Items</th>
        <th>Action</th>
        </tr>";

        $sql = "SELECT u.*,c.* 
        FROM USER_I u
        JOIN CART c ON u.USER_ID = c.USER_ID"; // selecting the all data from the user
        $stid = oci_parse($connection,$sql);
        oci_execute($stid);

        while($row = oci_fetch_array($stid,OCI_ASSOC)){
            $cart_id = $row['CART_ID'];
            $user_name = $row['FIRST_NAME'] . " " . $row['LAST_NAME'];
            
            $ssql = "SELECT COUNT(*) as item FROM CART_PRODUCT WHERE CART_ID = :cart_id";
            $stmt = oci_parse($connection,$ssql);
            oci_bind_by_name($stmt , ":cart_id" , $cart_id);
            oci_execute($stmt);
            $data = oci_fetch_assoc($stmt);
            $items = $data['ITEM'];

            echo "<tr>";
            echo "<td>".$cart_id."</td>";
            echo "<td>".ucfirst($user_name)."</td>";
            echo "<td>".$items."</td>";
            echo "<td></span></a><a href='dashboard.php?cat=Cart Details&cart_id=$cart_id' ><span class='material-symbols-outlined p-1 ' >
            visibility
            </span></a></td>";
            echo "</tr>";
            
        }

        echo "</table>";

        echo "</div>";
    ?>