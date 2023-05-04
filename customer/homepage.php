<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel='stylesheet' href="css/indexs.css" />
</head>
<body>
    <div class='nav-bar'>
        <?php
            require('navbar.php');
        ?>
    </div> 
    <!-- including the image slider -->
    <?php
        require('imageslider.php');
        
    ?>
    <?php
        require('homes.php');
    ?>
    
    <?php
        require('footer.php');
    ?>

</body>
</html>