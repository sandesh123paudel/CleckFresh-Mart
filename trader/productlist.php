<?php
include('../db/connection.php');

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/list.css">
    <!--jquery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>

    <script>
        $(document).ready(function() {
            $("#filter").change(function() {
                var shop_id = $("#filter").val();
                // alert("YOur filter id is : " + shop_id);
                document.location.href = "traderdashboard.php?cat=Productlist&name=Products&s_id=" + shop_id;
            });
        });
    </script>
</head>

<body>
    <div class="shop-container">
        <div class="shop_header">
            <h3>Products Lists</h3>
            <div class="search-box">

                <div class="search">
                    <form>
                        <input type="text" id='searchproduct' placeholder="Search...">
                        <span class='searchbtn' onclick="searchItem()">
                            <i class="fa fa-search"></i>
                        </span>
                    </form>
                </div>


                <select id='filter' name='filter'>
                    <option value="all">All</option>
                    <?php
                    $sql = "SELECT * FROM SHOP WHERE SHOP_TYPE = :s_cat";
                    $stid = oci_parse($connection, $sql);
                    oci_bind_by_name($stid, ':s_cat', $_SESSION['type']);
                    oci_execute($stid);

                    while ($row = oci_fetch_array($stid, OCI_ASSOC)) {
                        // session unset
                        unset($_SESSION['shopid']);

                        $s_id = $row['SHOP_ID'];
                        $s_name = $row['SHOP_NAME'];
                        $_SESSION['shopid'] = $s_id;
                        echo "<option value='$s_id' >" . $s_name . "</option>";
                    }
                    ?>
                </select>
            </div>

        </div>


        <div class="shopitems">
            <?php
            // selecting all items from product

            if (isset($_GET['product_name'])) {
                $sql = "SELECT * FROM PRODUCT WHERE PRODUCT_NAME= :p_name AND PRODUCT_TYPE = :product_cat";
                $stid = oci_parse($connection, $sql);
                oci_bind_by_name($stid, ':p_name', $_GET['product_name']);
                oci_bind_by_name($stid, ':product_cat', $_SESSION['type']);
            } else if (isset($_GET['s_id'])) {
                $sql = "SELECT * FROM PRODUCT WHERE SHOP_ID = :s_id AND PRODUCT_TYPE = :product_cat";
                $stid = oci_parse($connection, $sql);
                oci_bind_by_name($stid, ':s_id', $_GET['s_id']);
                oci_bind_by_name($stid, ':product_cat', $_SESSION['type']);
            } else {
                $sql = "SELECT * FROM PRODUCT WHERE PRODUCT_TYPE = :product_cat";
                $stid = oci_parse($connection, $sql);
                oci_bind_by_name($stid, ':product_cat', $_SESSION['type']);
            }

            oci_execute($stid);

            while ($row = oci_fetch_array($stid, OCI_ASSOC)) {
                $pid = $row['PRODUCT_ID'];
                $s_id = $row['SHOP_ID'];

                $sql1 = "SELECT SHOP_NAME AS SHOPNAME FROM SHOP WHERE SHOP_ID = :s_id ";
                $stid1 = oci_parse($connection, $sql1);
                oci_bind_by_name($stid1, ':s_id', $s_id);

                oci_define_by_name($stid1, 'SHOPNAME', $shopname);
                oci_execute($stid1);

                if (oci_fetch($stid1)) {
                    echo "<div class='card'>";
                    echo "<div class='card-info'>";
                    echo "<div class='card-details'>";
                    echo "<label>P_ID :  " . $row['PRODUCT_ID'] . "</label>";
                    echo "<label>Name:  " . substr($row['PRODUCT_NAME'], 0, 25) . "</label>";

                    echo "<label>Shop Name:  " . substr($shopname, 0, 25) . "</label>";

                    echo "<label>Price:  <span> &pound; " . $row['PRODUCT_PRICE'] . "<span></label>";
                    echo "<label>Stock : " . $row['STOCK_NUMBER'] . "</label>";
                    echo "</div>";

                    echo "<div class='image'>";
                    echo "<img src=\"../db/uploads/products/" . $row['PRODUCT_IMAGE'] . "\" alt=" . $row['PRODUCT_NAME'] . " >";
                    echo "</div>";
                    echo "</div>";

                    echo "<div class='btns'>";
                    echo "<a href='traderdashboard.php?cat=EditProduct&id=$pid&action=edit&name=Products' id='edit'>Edit</a>";
                    echo "<a href='deleteproduct.php?&id=$pid&action=delete' id='delete'>Delete</a>";
                    echo "</div>";

                    echo "</div>";
                }
            }


            ?>

        </div>
    </div>


    <script>
        function searchItem() {
            var product_name = document.getElementById('searchproduct').value;
            var url = "traderdashboard.php?cat=Productlist&name=Products&product_name=" + encodeURIComponent(product_name); // Use encodeURIComponent to properly encode the URL parameter
            document.location.href = url;
        }
    </script>

</body>

</html>