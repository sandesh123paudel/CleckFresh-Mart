<?php
    include("../db/connection.php");


        echo "<div class='user-container'>";
        echo "<table>";
        echo "<tr>
        <th>Id</th>
        <th>Image</th>
        <th>Name</th>
        <th>Offer</th>
        <th>Price</th>
        </tr>";

        $sql = "SELECT wp.*,p.*
        FROM WISHLIST w 
        JOIN WISHLIST_PRODUCT wp ON w.WISHLIST_ID = wp.WISHLIST_ID
        JOIN PRODUCT p ON p.PRODUCT_ID = wp.PRODUCT_ID
        WHERE w.WISHLIST_ID = :wishlist_id"; // selecting the all data from the user
        $stid = oci_parse($connection,$sql);
        oci_bind_by_name($stid,":wishlist_id" ,$_GET['wishlist_id']);
        oci_execute($stid);

        while($row = oci_fetch_array($stid,OCI_ASSOC)){
            $product_id = $row['PRODUCT_ID'];
            $product_price = $row['PRODUCT_PRICE'];

            echo "<tr>";
            echo "<td>".$product_id."</td>";
            echo "<td class='imgs'><img src=\"../db/uploads/products/" . $row['PRODUCT_IMAGE'] . "\" alt=" . $row['PRODUCT_NAME'] . " ></td>";
            echo "<td>".ucfirst($row['PRODUCT_NAME'])."</td>";
            
            if(!empty($row['OFFER_ID'])){
                echo "<td>Yes</td>";
            }
            else{
                echo "<td>No</td>";
            }

            echo "<td><b>&pound;".$product_price."</b></td>";
            echo "</tr>";
            
        }

        echo "</table>";

        echo "</div>";
    ?>