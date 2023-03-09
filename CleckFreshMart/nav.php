<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Navbar</title>

    <!-- fonts icons -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel='stylesheet' href='nav.css' />
</head>

<body>
    <nav class='nav'>
        <!-- logo -->
        <div class='logo'>
            <a href='home.php'><img src='logo/logo.png' alt='logo' class='logo-img' /></a>
        </div>  
        
        <!-- search box -->
        <form class='search'>
            <input type='text' placeholder='Search....' />
            <span class="material-symbols-outlined search-icon">
                search
            </span>
        </form>
        
        <div class='content'><!-- Wishlist -->
            <div>
                <span class="material-symbols-outlined">
                favorite
                </span>
                <b class='number'>
                    <?php
                        $number =0;
                        echo $number;
                    ?>
                </b>
            </div>
            <!-- Cart -->
            <div>
                <span class="material-symbols-outlined">
                    shopping_cart
                </span>
                <b class='number'>
                    <?php
                        $number =0;
                        echo $number;
                    ?>
                </b>
            </div>
            <!-- login with options -->
            <label onmouseover="onMouse()">LOGIN</label>
        </div>  
    </nav>
    
    <div class='login' id="show" onmouseover="onMouse()" onmouseout="outMouse()" >
        <!-- <a href="login.php/Customer">Customer</a>
        <a href="#">Trader</a> -->
        <form method='post' action='home.php'>
            <input type='submit' name='customer' value='Customer'/>
            <input type='submit' name='trader' value='Trader'/>
        </form>
    </div>
    

    <script>
       
       function onMouse(){
            document.getElementById('show').style.visibility="visible";
        }

        function outMouse(show){
            document.getElementById('show').style.visibility="hidden";
        }

    </script>
</body>
</html>