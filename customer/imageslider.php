<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">

    <!-- owl-crosal -->

    <link rel="stylesheet" href="owlcarousel/owl.carousel.min.css">
    <link rel="stylesheet" href="owlcarousel/owl.theme.default.min.css">
    <style>
        .image-slider{
            max-width: 100%;
        }
        .image-slider img{
            width: 100%;
            height: 70vh;
            object-fit:cover;
            filter: brightness(70%);
            background-image: linear-gradient(180deg, rgba(255,0,0,0), rgba(255,0,0,1));
        }
        .image-header{
            position: absolute;
            top: 20%;
            display:flex;
            width: 100%;
            color: orange;
            justify-content: left;
            padding-inline: 10%;
        }
        .image-header h2{
            margin-top:4rem;
            padding-block:10px;
            font-size: 40px;
            font-weight: 800;
            width: 500px;
            word-wrap: break-word;
        }
        @media  screen and (max-width:420px) {
            .image-slider img{
                height: 40vh;
            }
            .image-header{
                padding-inline: 2rem;
            }
            .image-header h2{
                margin-top:unset;
                padding-block:5px;
                font-size: 30px;
                font-weight: 800;
                width: 370px;
                word-wrap: break-word;
            }
        }
        
    </style>
</head>
<body>

    <div class="image-slider">
        <img class='mySlides w3-animate-opacity' src="../logo/imgeslider.png"  alt="image" />
        <img class='mySlides w3-animate-opacity' src="../logo/mac.jpg"  alt="image" />
        <img class='mySlides w3-animate-opacity' src="../logo/salmon.jpg"  alt="image"/>
        <img class='mySlides w3-animate-opacity' src="../logo/veg.jpg"  alt="image"/>
        <img class='mySlides w3-animate-opacity' src="../logo/wine.png"  alt="image"/>
    </div>
    
    <div class="image-header">
        <h2>BUY PRODUCTS FROM US AND START SUPPORTING LOCAL TRADERS</h2>
    </div>

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