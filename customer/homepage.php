<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel='stylesheet' href="css/indexs.css" />
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">

    <!-- owl-crosal -->
    <link rel="stylesheet" href="owlcarousel/owl.carousel.min.css">
    <link rel="stylesheet" href="owlcarousel/owl.theme.default.min.css">
</head>

<body>
    <div class='nav-bar'>
        <?php
        require('navbar.php');
        ?>
    </div>

    <!-- including the image slider -->
    <div class="image-slider">
        <img class='mySlides w3-animate-opacity' src="../assets/image3.jpeg"  alt="image" />
        <img class='mySlides w3-animate-opacity' src="../assets/image2.jpg"  alt="image" />
        <img class='mySlides w3-animate-opacity' src="../assets/image4.jpg"  alt="image"/>
        <img class='mySlides w3-animate-opacity' src="../assets/image6.jpg"  alt="image"/>
        <img class='mySlides w3-animate-opacity' src="../assets/image5.jpg"  alt="image"/>
        <img class='mySlides w3-animate-opacity' src="../assets/image7.png"  alt="image"/>
    </div>
    
    <div class="image-header">
        <h2>BUY PRODUCTS FROM US AND START SUPPORTING LOCAL TRADERS</h2>
    </div>

  
    <?php
    require('homes.php');
    ?>

    <?php
    require('footer.php');
    ?>


 
<script src="addremove.js"></script>
<script>
        var myIndex = 0;
        carousel();

        function carousel() {
            var i;
            var slides = document.getElementsByClassName('mySlides');
            for(i =0 ; i < slides.length ; i++){
                slides[i].style.display='none';
            }
            myIndex++;
            if(myIndex > slides.length) {
                myIndex = 1;
            }
            
            slides[myIndex-1].style.display='block';
            setTimeout(carousel,4500);
        } 

    </script>

</body>

</html>