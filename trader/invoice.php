<?php
  include("../db/connection.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/invoice.css">
</head>
<body>
    
    <div class="invoice-container">
        <div class="logo">
            <h3>INVOICE</h3>
            <img src="../logo/logo.png" alt="">
        </div>
        
        
        <div class="invoice-details">
            <div class="part1">
                <h4>Bill To</h4>
                <p>John Snow</p>
                <p>The British College, Bagmati Province Kathmandu, Thapathali</p>
                <p>Neoal</p>
                <p><span>Email</span>:John315@gmail.com</p>
                <p><span>Phone</span>:9821479916</p>
            </div>
    
            <div class="part2">
                <h4>Details</h4>
                <p>Invoice ID: <span>#INV-287262</span></p>
                <p>Order ID: <span>86733</span></p>
                <p>Issued on 3/15/2023</p>
            </div>    
        </div>

        <h4>Payment Method</h4>
        <p>PayPal</p>

        <table>
                <th>
                    <tr id="heading">
                        <td>NO.</td>
                        <td>PRODUCT</td>
                        <td>QUANTITY</td>
                        <td>UNIT COST</td>
                        <td>TOTAL</td>
                    </tr>
                </th>
            

            <tr>
                <td>1</td>
                <td>Fresh Green Peas</td>
                <td>1</td>
                <td>&#163; 2000</td>
                <td>&#163; 3000</td>
            </tr>

            <tr>
                <td>2</td>
                <td>Fresh Green Peas</td>
                <td>1</td>
                <td>&#163; 2000</td>
                <td>&#163; 3000</td>
            </tr>

            <tr>
                <td>3</td>
                <td>Fresh Green Peas</td>
                <td>1</td>
                <td>&#163; 2000</td>
                <td>&#163; 3000</td>
            </tr>


            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td><b>Item Subtotal</b></td>
                <td><b>&#163; 9000</b></td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td><b>Discount</b></td>
                <td><b>&#163; 300</b></td>
            </tr>

            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td><b>Tota</b></td>
                <td><b>&#163; 8700</b></td>
            </tr>            
        </table>
        
    </div>
</body>
</html>