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
    <link rel="stylesheet" href="css/lists.css">

    <!--jquery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>

    <script>
        $(document).ready(function() {
            $("#searchproduct").click(function() {
                var shop_name = $("#lgsearch").val();
                document.location.href = "traderdashboard.php?cat=Shoplist&name=Shops&s_name=" + shop_name.toLowerCase();
            })
        })
    </script>

</head>

<body>
    <div class="shop-container">
        <div class="shop_header">
            <h3>Shops Lists</h3>
            <div class="search-box">
                <div class="search">
                    <form>
                        <input type="text" id='lgsearch' placeholder="Search...">

                        <span id="searchproduct" class='searchbtn'>
                            <i class="fa fa-search"></i>
                        </span>
                    </form>
                </div>

            </div>
        </div>


        <div class="shopitems">
            <?php
            
            $status = 'verified';
            // selecting all items from shops
            if (isset($_GET['s_name'])) {
                $sql = "SELECT * FROM SHOP WHERE SHOP_NAME= :sname AND SHOP_TYPE = :shop_cat AND STATUS = :verify";
                $stid = oci_parse($connection, $sql);
                oci_bind_by_name($stid, ':sname', $_GET['s_name']);
                oci_bind_by_name($stid, ':shop_cat', $_SESSION['type']);
                oci_bind_by_name($stid, ':verify', $status);
            } else {
                $sql = "SELECT * FROM SHOP WHERE SHOP_TYPE = :shop_cat AND STATUS = :verify";
                $stid = oci_parse($connection, $sql);
                oci_bind_by_name($stid, ':shop_cat', $_SESSION['type']);
                oci_bind_by_name($stid, ':verify', $status);
            }
            oci_execute($stid);

            while ($row = oci_fetch_array($stid, OCI_ASSOC)) {
                $id = $row['SHOP_ID'];

                echo "<div class='shop-item'>";
                echo "<div class='image'>";
                echo "<img src=\"../db/uploads/shops/" . $row['SHOP_LOGO'] . "\" alt=" . $row['SHOP_NAME'] . " >";
                echo "</div>";
                echo "<div class='shop-info'>";
                echo "<label>Shop ID: " . $row['SHOP_ID'] . "</label>";
                echo "<label >Shop Name: " . ucfirst(substr($row['SHOP_NAME'], 0, 25)) . "</label>";
                echo "</div>";

                echo "<div class='buttons'>";
                echo "<a href='traderdashboard.php?cat=EditShop&id=$id&action=edit&name=Shops' id='edit'>Edit</a>";
                echo "<a href='deleteshop.php?id=$id&action=delete' id='delete'>Delete</a>";
                echo "</div>";

                echo "</div>";
            }
            ?>

        </div>
    </div>

</body>

</html>