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

        $sql = "SELECT cp.*,p.*
        FROM CART c 
        JOIN CART_PRODUCT cp ON c.CART_ID = cp.CART_ID
        JOIN PRODUCT p ON p.PRODUCT_ID = cp.PRODUCT_ID
        WHERE c.CART_ID = :cart_id"; // selecting the all data from the user
        $stid = oci_parse($connection,$sql);
        oci_bind_by_name($stid,":cart_id" ,$_GET['cart_id']);
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