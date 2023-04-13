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
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="stylesheet" href="css/shops.css">
</head>
<body>
    <div class="shop-container">
        <div class="shop_header">
            <h3>Shops Lists</h3>
            <div class="search-box">
                <div class="search">
                    <input type="text" placeholder="Search...">
                    <span class="material-symbols-outlined">
                        search
                    </span>
                </div>

                <select name="" id="">
                    <option value="">All</option>
                    <option value="">Asce</option>
                    <option value="">Desc</option>
                </select>
                
            </div>
        </div>

        
        <div class="shopitems">
            <?php
            // selecting all items from shops
                $sql = "SELECT * FROM shop";

                $qry = mysqli_query($connection,$sql) or die(mysqli_error($connection));

                // counting the records
                $count = mysqli_num_rows($qry);
                
                while($row = mysqli_fetch_array($qry)){
                    $id = $row['Id'];

                    echo "<div class='shop-item'>";
                        echo "<img src=\"../db/uploads/shops/".$row['Image']."\" alt=".$row['Name']." >";
                        echo "<h3>".$row['Name']."</h3>";
                        echo "<div class='buttons'>";
                            echo "<a href='traderdashboard.php?cat=editshop&id=$id&action=edit' id='edit'>Edit</a>";
                            echo "<a href='deleteshop.php?id=$id&action=delete' id='delete'>Delete</a>";
                        echo "</div>";
                    echo "</div>";
                }
            ?>
           
        </div>
    </div>
    
</body>
</html>