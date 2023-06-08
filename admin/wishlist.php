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

        //writing the sql query
        $sql = "SELECT u.*,w.* 
        FROM USER_I u
        JOIN WISHLIST w ON u.USER_ID = w.USER_ID"; // selecting the all data from the user
        $stid = oci_parse($connection,$sql);
        oci_execute($stid);

        while($row = oci_fetch_array($stid,OCI_ASSOC)){
            $wishlist_id = $row['WISHLIST_ID'];
            $user_name = $row['FIRST_NAME'] . " " . $row['LAST_NAME'];
            
            $ssql = "SELECT COUNT(*) as item FROM WISHLIST_PRODUCT WHERE WISHLIST_ID = :wishlist_id";
            $stmt = oci_parse($connection,$ssql);
            oci_bind_by_name($stmt , ":wishlist_id" , $wishlist_id);
            oci_execute($stmt);
            $data = oci_fetch_assoc($stmt);
            $items = $data['ITEM'];

            echo "<tr>";
            echo "<td>".$wishlist_id."</td>";
            echo "<td>".ucfirst($user_name)."</td>";
            echo "<td>".$items."</td>";
            echo "<td></span></a><a href='dashboard.php?cat=Wishlist Details&wishlist_id=$wishlist_id' ><span class='material-symbols-outlined p-1 ' >
            visibility
            </span></a></td>";
            echo "</tr>";
            
        }
        echo "</table>";

        echo "</div>";
    ?>