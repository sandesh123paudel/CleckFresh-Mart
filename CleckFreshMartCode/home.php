<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
        require('nav.php');
        
        if(isset($_POST['customer'])){
            require('login.php');
        }
        if(isset($_POST['trader'])){
            require('trader.php');
        }
        if(isset($_POST['create'])){
            require('registration.php');
        }
        if(isset($_POST['login'])){
            require('login.php');
        }
    ?>
    
</body>
</html>