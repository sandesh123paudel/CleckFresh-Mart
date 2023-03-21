<!-- Validation Handling in Login using php -->
<?php

    // include connection
    require('connection.php');

    $err = $erremail= $errpassword = $errrole ='';

    if(isset($_POST['sublogin'])){
        if(empty($_POST['email'])){
            $erremail = "Email is required";
        }
        if(empty($_POST['password'])){
            $errpassword = "Password is required";
        }
        if(empty($_POST['role'])){
            $errrole="User Type is required";
        }
        else{
            $email = $_POST['email'];
            $password = md5($_POST['password']);
            $roles = strtolower($_POST['role']);
            $remember = $_POST['remember'];
            
            // setting the cookie if remember is clicked
            if(!empty($remember)){
                setcookie("email" , $email , time() + 60*60*24*15, "/");
                setcookie("password" , $passsword , time() + 60*60*24*15, "/");
                setcookie("role" , $role , time() + 60*60*24*15, "/");
            }

            
            // for user
            if($roles == "user"){
                $sql = "SELECT * FROM customer WHERE Email='$email' AND Password='$password' AND Role = '$roles' ";
            }
            // for trader
            if($roles == "trader"){
                $sql = "SELECT * FROM trader WHERE Email='$email' AND password='$password' AND Role = '$roles' ";
            }
            // for admin
            if($roles == "admin"){
                $sql = "SELECT * FROM admin WHERE Email = '$email' AND password='$password' AND Role = '$role' ";
            }

            // query from the database

            $qry = mysqli_query($connection, $sql) or die(mysqli_error($connection));

            if($data = mysqli_fetch_assoc($qry)){
                if($roles == 'user'){
                    header('location:productview.php');
                    // echo "Successfully connected to user account";
                }
                if($roles  == 'trader'){
                    echo "Successfully login to trader account";
                }
                if($role  == 'admin'){
                    echo "successfully login to admin account";
                }
            }
            else{
                header("location:login.php");
                $err='Invalid Input';
            }
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel='stylesheet' href='loginsss.css' />
</head>
<body>

<!-- <div class='container'> -->
    <div class='login-container'>
        <!-- part 1 -->
        <div class='part1'>
            <div class='logo'>
                <a href='homepage.php'><img src='logo/logo.png' alt='CheckFreshMart' /></a>
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

            <form method='Post' action=''>
                <div><?php $err;?></div>
                <div class='form-data'>
                    <label>Email or Username <span class='error'> * <?php echo $erremail; ?> </span></label>
                    <input type='email' class='inputbox' placeholder='Email Address' name='email' />
                </div>      
                
                <div class='form-data'>
                    <label>Password <span class='error'> * <?php echo $errpassword; ?> </span></label>
                    <input type='password' class='inputbox' placeholder='Password' name='password' />
                
                </div> 
                
                
                <div class='form-data'>
                    <label>User Type <span class='error'> * <?php echo $errrole; ?> </span></label>
                    <select class="inputbox selectoption" name='role' >
                        <option value=''>Select Role</option>
                        <option value='user'>User</option>
                        <option value='trader'>Trader</option>
                        <option value='admin'>Admin</option>
                    </select>
                </div> 
                
                <div class='forget-link'>
                    <div>
                        <input type='checkbox' name='remember' />
                        <label>Remember me.</label>
                    </div>
                    <a href='#'>Forget Password?</a>
                </div>

                <input type='submit' class='login-btn inputbox' name='sublogin' value='Login   >>' />
            </form>

            <p>Or Log in with</p>
        
            <div class='login-social'>
                <h2 class='facebook'>f</h2>
                <h2 class='google'>G</h2>
            </div>

            <div class='create-link'>
                <p>Not Registered yet?</p>
                <a href="customerRegistration.php">Create an account?</a> 
            </div>

        </div>
    </div>
<!-- </div> -->


</body>
</html>