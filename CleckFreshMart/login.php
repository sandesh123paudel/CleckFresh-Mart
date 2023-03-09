<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel='stylesheet' href='nav.css' />
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
                    <h1>Login to your <br>Cleck Fresh Account</h1>
                </div>
                <p>Start buying products from us and support <br>local products</p>
            </div>

        </div>
        <!-- part 2 -->
        <div class='part2'>
            <h1>Log In</h1>

            <form method='post' action=''>
                <input type='email' class='inputbox' placeholder='Email Address' name='email' required />
                <input type='password' class='inputbox' placeholder='Password' name='password' required/>
                
                <div class='forget-link'>
                    <div>
                        <input type='checkbox' name='checkbox' />
                        <label>Remember me.</label>
                    </div>
                    <a href='#'>Forget Password?</a>
                </div>

                <input type='submit' class='login-btn inputbox' name='login' value='Login   >>' />
            </form>

            <p>Or Log in with</p>
        
            <div class='login-social'>
                <h2 class='facebook'>f</h2>
                <h2 class='google'>G</h2>
            </div>

            <p class='create-link'>Not Registered yet? <a href="registration.php">Create an Account</a></p>

        </div>
    </div>
</div>
</body>
</html>