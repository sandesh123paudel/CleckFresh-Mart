<?php
    include_once("../db/connection.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/foot.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
</head>
<body>
    
    <div class="footer">
 
        <div class="footer-container">
            <div class="foot-container">
                <h3> OverView</h3>
                <div class="footer-links">
                    <a href="aboutus.php">About us</a>
                    <a href="contactus.php">Contact us</a>
                    <a href="policyPrivacy.php">Privacy Policy</a>
                    <a href="terms&condition.php">Terms & Conditions</a>
                    <a href="faq.php">FAQs</a>
                </div>
            </div>

            <div class="foot-container">
                <h3>Available Shops</h3>
                <div class="footer-links">
                    <?php
                        $sql = "SELECT * FROM SHOP WHERE ROWNUM <= 5";
                        $stmt = oci_parse($connection,$sql);
                        oci_execute($stmt);
                        while($row=oci_fetch_array($stmt,OCI_ASSOC)){
                            $shop_name=$row['SHOP_NAME'];
                            $shop_id = $row['SHOP_ID'];
                            echo "<a href='products.php?s_name=$shop_name&s_id=$shop_id'>$shop_name</a>";
                        }
                    ?>
                    

                </div>
            </div>       
            
            <div class="foot-container" id="fot">
                <h3>Shop by Category</h3>
                <div class="footer-links">
                <?php
                        $sql = "SELECT * FROM CATEGORY WHERE ROWNUM <= 5";
                        $stmt = oci_parse($connection,$sql);
                        oci_execute($stmt);
                        while($row=oci_fetch_array($stmt,OCI_ASSOC)){
                            $cat_name=$row['CATEGORY_NAME'];
                            $cat_id = $row['CATEGORY_ID'];
                            echo "<a href='products.php?cat_id=$cat_id'>$cat_name</a>";
                        }
                    ?>
                    
                </div>
            </div>

            <div class="foot-container">
                <h3>Contact Us</h3>
                <div class="footer-links">
                    <a href="#">+977-9821479918</a>
                    <a href="#">info@cleckfreshmart.com</a>
                    <a href="#">CleckFreshMart, UK</a>
                </div>

                <h3>Social</h3>
                <div class="social-links">
                    <a href="#"><img src="../assets/facebook.png" alt="facebook"/></a>
                    <a href="#"><img src="../assets/instagram.png" alt="facebook"/></a>
                    <a href="#"><img src="../assets/twitter.png" id="twiter" alt="facebook"/></a>
                </div>
            </div>
        </div>

        <div class="line"></div>
        <p>	&#169; 2023 - CleckFreshMart All Rights Reserved.</p>

    </div>
</body>
</html>