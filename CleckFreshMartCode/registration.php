<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel='stylesheet' href='login.css' />
</head>
<body>
<div class='container'>
    <div class='login-container'>
        <!-- part 1 -->
        <div class='part1'>
            <div class='logo'>
                <a href='nav.php'><img src='logo/logo.png' alt='CheckFreshMart' /></a>
            </div>
            <div class='login-text'>
                <div>
                    <h1>Create your <br>Cleck Fresh Account</h1>
                </div>
                <p>Start buying products from us and support <br>local products</p>
            </div>

        </div>
        <!-- part 2 -->
        <div class='part2'>
            <h1>Create account</h1>

            <form>
                <input type='text' class='inputbox' placeholder='Full Name' name='fname' required />
                <input type='email' class='inputbox' placeholder='Email Address' name='email' required />
                <input type='text' class='inputbox' placeholder='Phone Number' name='phone' required/>
                <input type='password' class='inputbox' placeholder='Password' name='password' required/>
                <p>Include a minimum of 8 characters and at least one number and one letter. No spaces,please.</p>
                <input type='password' class='inputbox' placeholder='Confirm Password' name='cpassword' required/>

                <input type='submit' class='login-btn inputbox' name='login' value='Create a new account  >>' />
            </form>

            <p>Or Sign Up with</p>
        
            <div class='login-social'>
                <h2 class='facebook'>f</h2>
                <h2 class='google'>G</h2>
            </div>

            <!-- <p class='create-link'> <a href="login.php">Login</a></p> -->
            <div class='create-link'><p>Already have an account? </p> 
                <form method='post' action='home.php' class='login1'>
                    <input type='submit' name='login' value='Login.'/>
                </form>
            </div>
        </div>
    </div>
</div>
</body>
</html>