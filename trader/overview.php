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
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="stylesheet" href="css/over.css" />
</head>
<body>
    <div class="overview-container">
        <div class="trader">
            <div class="trader-info">
                <h2>Greeting, <label>ZAAPP</label></h2>
                <p>Here's what's happening with your store today.</p>
            </div>
            <a href="#">Add Product +</a>
        </div>
        

        <div class="trader-report">
            
            <div class="report">
                <div class="report-info">
                    <h3>300</h3>
                    <p>New orders today</p>
                </div>
                <div class="icon">
                    <span class="material-symbols-outlined" >
                        local_mall
                    </span>
                </div>
                
            </div>

            <div class="report">
                <div class="report-info">
                    <h3>275</h3>
                    <p>Total Products</p>
                </div>
                <div class="icon">
                    <span class="material-symbols-outlined">
                    work
                    </span>
                </div>
                
            </div>

            <div class="report">
                <div class="report-info">
                    <h3>Report</h3>
                    <p>View Report</p>
                </div>
                <div class="icon">
                    <span class="material-symbols-outlined">
                        analytics
                    </span>
                </div>
                
            </div>

            <div class="report">
                <div class="report-info">
                    <h3>&#163; 3000</h3>
                    <p>Total Earnings</p>
                </div>
                <div class="icon">
                    <span class="material-symbols-outlined">
                    paid
                    </span>
                </div>
                
            </div>

        </div>
    </div>
</body>
</html>