<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">

    <style>
        .image-slider{
            width: 100%;
            height: 500px;
        }
        .image-slider img{
            width: 100%;
            height: 100%;
            background-image: linear-gradient(180deg, rgba(255,0,0,0), rgba(255,0,0,1));
        };
        
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