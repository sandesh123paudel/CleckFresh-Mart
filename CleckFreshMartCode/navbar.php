<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Navbar</title>

    <!-- fonts icons -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel='stylesheet' href='navs.css' />
</head>

<body>
    <nav class='nav'>
        <!-- logo -->
        <div class='logo'>
            <a href='homepage.php'><img src='logo/logo.png' alt='logo' class='logo-img' /></a>
        </div>  
        
        <!-- search box -->
        <form class='search'>
            <input type='text' placeholder='Search by Products and more...' />
            <span class="material-symbols-outlined search-icon">
                search
            </span>
        </form>
        
        <div class="links-container">
            <!-- login and signup links -->
            <!-- <form method='post' class='links-btn' action='homepage.php'>
                <input type='submit' id='login-link' name='login' value='Login'/>
                <label onmouseover="onMouse('show')" onmouseout="outMouse('show')" id='signup-link' >Signup</label>
            </form> -->
            <div class='links-btn'>
                <a href="login.php" >Login</a>
                <label onmouseover="onMouse('show')" onmouseout="outMouse('show')" id='signup-link' >Signup</label>
                
            </div>

            
            <div class='content'><!-- Wishlist -->
                <div>
                    <b class='number'>
                        <?php
                            $number =12;
                            echo $number;
                        ?>
                        
                    </b>
                    <span class="material-symbols-outlined">
                    favorite
                    </span>
                    
                    <p>Wishlist</p>
                </div>
                <!-- Cart -->
                <div>
                    <b class='number'>
                        <?php
                            $number =0;
                            echo $number;
                        ?>
                        
                    </b>
                    <span class="material-symbols-outlined">
                        shopping_cart
                    </span>
                    <p>Cart</p>
                </div>
            </div>
        </div>  
    </nav>
    
    <!-- <div class='signup' id="show"  onmouseover="onMouse('show')" onmouseout="outMouse('show')">
        <form method='post' action='homepage.php'>
            <input type='submit' name='customer' value='Customer'/>
            <input type='submit' name='trader' value='Trader'/>
        </form>
    </div> -->

    <div class='signup' id="show"  onmouseover="onMouse('show')" onmouseout="outMouse('show')">
        <a href="customerRegistration.php" >Customer</a>
        <a href="traderRegistration.php" >Trader</a>
    </div>

    <!-- Category -->
    <div class="category">
        <!-- 1st category -->
        <div class="category-link">
            <!-- trader -->
            <!-- <form method='post' action='home.php' class="dropdown" onmouseover="onMouse('butcher')" onmouseout="outMouse('butcher')">
                <input type='submit' name='butcher' value='Butcher    ▼'/>
            </form> -->
            <div class="dropdown" onmouseover="onMouse('butcher')" onmouseout="outMouse('butcher')">
                <a href="#" >Butcher</a>
                <p>▼</p>
            </div>
            <!-- list shops -->
            <div class="dropdown-content" id="butcher" onmouseover="onMouse('butcher')" onmouseout="outMouse('butcher')">
                <!-- <form method='post' action='home.php'>
                    <input type='submit' name='shop1' value='Shop1'/>
                    <input type='submit' name='shop2' value='Shop2'/>
                </form> -->
                <div>
                    <a href="#" >Shop 1</a>
                    <a href="#" >Shop 2</a>
                </div>
            </div>
        </div>
        
        <!-- 2nd category -->
         <div class="category-link">
            <!-- trader -->
            <!-- <form method='post' action='home.php' class="dropdown" onmouseover="onMouse('green')" onmouseout="outMouse('green')">
                <input type='submit' name='greengrocer' value='GreenGrocer ▼'/>
            </form> -->
            <div class="dropdown" onmouseover="onMouse('green')" onmouseout="outMouse('green')">
                <a href="#" >GreenGrocer</a>
                <p>▼</p>
            </div>
            <!-- list shops -->
            <div class="dropdown-content" id="green" onmouseover="onMouse('green')" onmouseout="outMouse('green')">
                <!-- <form method='post' action='home.php'>
                    <input type='submit' name='shop1' value='Shop1'/>
                    <input type='submit' name='shop2' value='Shop2'/>
                </form> -->
                <div>
                    <a href="#" >Shop 1</a>
                    <a href="#" >Shop 2</a>
                </div>
            </div>
        </div>

         <!-- 3rd category -->
         <div class="category-link">
            <!-- trader -->
            <!-- <form method='post' action='home.php' class="dropdown" onmouseover="onMouse('fish')" onmouseout="outMouse('fish')" >
                <input type='submit' name='fishmonger' value='FishMonger  ▼'/>
            </form> -->
            <div class="dropdown"  onmouseover="onMouse('fish')" onmouseout="outMouse('fish')">
                <a href="#" >FishMonger</a>
                <p>▼</p>
            </div>
            <!-- list shops -->
            <div class="dropdown-content" id="fish" onmouseover="onMouse('fish')" onmouseout="outMouse('fish')">
                <!-- <form method='post' action='home.php'>
                    <input type='submit' name='shop1' value='Shop1'/>
                    <input type='submit' name='shop2' value='Shop2'/>
                </form> -->
                <div>
                    <a href="#" >Shop 1</a>
                    <a href="#" >Shop 2</a>
                </div>
            </div>
        </div>

         <!-- 4th category -->
         <div class="category-link">
            <!-- trader -->
            <!-- <form method='post' action='home.php' class="dropdown" onmouseover="onMouse('backery')" onmouseout="outMouse('backery')">
                <input type='submit' name='bakery' value='Bakery      ▼'/>
            </form> -->
            <div class="dropdown" onmouseover="onMouse('backery')" onmouseout="outMouse('backery')">
                <a href="#" >Bakery</a>
                <p>▼</p>
            </div>
            <!-- list shops -->
            <div class="dropdown-content" id="backery" onmouseover="onMouse('backery')" onmouseout="outMouse('backery')">
                <!-- <form method='post' action='home.php'>
                    <input type='submit' name='shop1' value='Shop1'/>
                    <input type='submit' name='shop2' value='Shop2'/>
                </form> -->
                <div>
                    <a href="#" >Shop 1</a>
                    <a href="#" >Shop 2</a>
                </div>
            </div>
        </div>

         <!-- 5th category -->
         <div class="category-link">
            <!-- trader -->
            <!-- <form method='post' action='home.php' class="dropdown" onmouseover="onMouse('delicates')" onmouseout="outMouse('delicates')">
                <input type='submit' name='delicatessen' value='Delicatessen ▼'/>
            </form> -->
            <div class="dropdown" onmouseover="onMouse('delicates')" onmouseout="outMouse('delicates')">
                <a href="#" >Delicatessen</a>
                <p>▼</p>
            </div>
            <!-- list shops -->
            <div class="dropdown-content" id="delicates" onmouseover="onMouse('delicates')" onmouseout="outMouse('delicates')">
                <!-- <form method='post' action='home.php'>
                    <input type='submit' name='shop1' value='Shop1'/>
                    <input type='submit' name='shop2' value='Shop2'/>
                </form> -->
                <div>
                    <a href="#" >Shop 1</a>
                    <a href="#" >Shop 2</a>
                </div>
            </div>
        </div>
    </div>


    <script>
       
       function onMouse(prop){

            if(prop == 'show'){
                document.getElementById('show').style.display="block";
            }

            if(prop == 'butcher'){
                document.getElementById('butcher').style.display="block";
            }
            
            if(prop == 'green'){
                document.getElementById('green').style.display="block";
            }
            
            if(prop == 'fish'){
                document.getElementById('fish').style.display="block";
            }
            
            if(prop == 'backery'){
                document.getElementById('backery').style.display="block";
            }
            
            if(prop == 'delicates'){
                document.getElementById('delicates').style.display="block";
            }
            
        }

        function outMouse(prop){
            if(prop == 'show'){
                document.getElementById('show').style.display="none";
            }

            if(prop == 'butcher'){
                document.getElementById('butcher').style.display="none";
            }
            
            if(prop == 'green'){
                document.getElementById('green').style.display="none";
            }
            
            if(prop == 'fish'){
                document.getElementById('fish').style.display="none";
            }
            
            if(prop == 'backery'){
                document.getElementById('backery').style.display="none";
            }
            
            if(prop == 'delicates'){
                document.getElementById('delicates').style.display="none";
            }
        }

    </script>
</body>
</html>