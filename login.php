<!-- Validation Handling in Login using php -->
<?php
    // include connection
    session_start();
    include('db/connection.php');

    // for login purpose
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
            $password = md5(trim($_POST['password']));
            $role = strtolower($_POST['role']);
            $remember = $_POST['remember'];
            
            $password = (string)$password;
            
            // setting the cookie if remember is clicked
            if(!empty($remember)){
                setcookie("email" , $email , time() + 60*60*24*15, "/");
                setcookie("password" , $password , time() + 60*60*24*15, "/");
                setcookie("role" , $role , time() + 60*60*24*15, "/");
            }

            // for user
            $sql = "SELECT * FROM USER_I WHERE EMAIL = :email AND PASSWORD = :pass AND ROLE = :u_role ";

            // query from the database
            $stid = oci_parse($connection,$sql);

            oci_bind_by_name($stid , ':email' , $email);
            oci_bind_by_name($stid , ':pass' ,$password);
            oci_bind_by_name($stid , ':u_role' ,$role);

            oci_execute($stid);

            if($data = oci_fetch_array($stid, OCI_ASSOC)) 
            {
                $_SESSION['ID'] = $data; 
                header("location:session.php");
  
            }
            else{
                $_SESSION['error']= 'User not recognised';
                header("location:login.php");
            }
            oci_free_statement($stid);
            oci_close($connection);
        }
    }

    if(isset($_SESSION['error'])){
        $err = $_SESSION['error'];
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel='stylesheet' href='customer/css/login.css' />
</head>
<body>

<div class="cont">
    <div class='login-container' id='login-cont'>
        <!-- part 1 -->
        <div class='part1'>
            <div class='logo'>
                <a href='customer/homepage.php'><img src='logo/logo.png' alt='CheckFreshMart' /></a>
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
                <div class='error'><?php echo $err; ?></div>
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
                        <option value='customer'>Customer</option>
                        <option value='trader'>Trader</option>
                        <option value='admin'>Admin</option>
                    </select>
                </div> 
                
                <div class='forget-link'>
                    <div>
                        <input type='checkbox' name='remember' />
                        <label>Remember me.</label>
                    </div>
                    <label  onclick='otpPass()'>Forget Password?</label>
                </div>

                <input type='submit'  class='login-btn inputbox' name='sublogin' value='Login   >>' />
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

    <!-- email for forget password -->
    <div class="otp-container" id='show'>
      <span class="closebtn" id='close-btn' onclick="closeBtn()">&times;</span>
      <h1>Get Your OTP</h1>
      <p>Please type registered email to receive an otp.</p>
      
      <form method="POST" action=''>
        <div class="numbers">
          <input type="email" name="email"  placeholder="Enter your email" />
        </div>
        <p></p>
            <input
                class="verify-btn"
                type="submit"
                name="sendemail"
                value="Send  >>"
            />
      </form>
    </div>

    <?php
        if(isset($_POST['sendemail']))
        {
            $email = $_POST['email'];
            
            $sql = "SELECT * from USER_I WHERE EMAIL = :email";
            $stid = oci_parse($connection,$stid);
            oci_execute($stid);
            while($row = oci_fetch_array($stid,OCI_ASSOC))
            {
                $id = $row['USER_ID'];
            }
        
        }
    ?>

    <!-- otp from email -->
    <div class="otp-container" id='show-otp'>
            <span class="closebtn" onclick="closeBtn()">&times;</span>
            <h1>Verify Your OTP code</h1>
            <p>Please type the OTP code sent to your registered email.</p>
            
            <form method="post">
                <div class="numbers">
                    <input type="text" name="num1" maxlength="1" placeholder="-" />
                    <input type="text" name="num2" maxlength="1" placeholder="-" />
                    <input type="text" name="num3" maxlength="1" placeholder="-" />
                    <input type="text" name="num4" maxlength="1" placeholder="-" />
                    <input type="text" name="num5" maxlength="1" placeholder="-" />
                    <input type="text" name="num6" maxlength="1" placeholder="-" />
                </div>
                <p>
                Don't receive the OTP?<input
                    class="resend"
                    type="submit"
                    name="resendOTP"
                    value="Resend OTP"
                />
                </p>
                <input
                    class="verify-btn"
                    type="submit"
                    name="verifyotp"
                    value="Verify  >>"    
                />
            </form>
        </div>

        <!-- Set New password -->
        <div class="otp-container" id='show-new'>
            <span class="closebtn" id='close-btn' onclick="closeBtn()">&times;</span>
            
            <h1>Generate Password</h1>
            <p>Please type New Password.</p>
            
            <form method="post">
                <p>New Password</p>
                <div class="numbers">
                <input type="password" name="email"  placeholder="Enter New Password" />
                </div>
                
                <p>Re Type Password</p>
                <div class="numbers">
                <input type="email" name="email"  placeholder="Enter Confirm Password" />
                </div>

                    <input
                        class="verify-btn"
                        type="submit"
                        name="newpassword"
                        value="Confirm  >>"
                    />
            </form>
        </div>

    <script>
        function otpPass(){
            document.getElementById('show-otp').style.display='none';
            document.getElementById('show').style.display="block";
            document.getElementById('show-new').style.display="none";
            document.getElementById('login-cont').style.opacity='0.4';   
        }
        function closeBtn(){
            document.getElementById('show').style.display='none';
            document.getElementById('show-otp').style.display='none';
            document.getElementById('show-new').style.display="none";
            document.getElementById('login-cont').style.opacity='1';   
        }
        function forgetemail(){
            document.getElementById('show-otp').style.display='block';
            document.getElementById('show').style.display="none";
            document.getElementById('show-new').style.display="none";
            document.getElementById('login-cont').style.opacity='0.4';   
        }

        function newpass(){
            document.getElementById('show-otp').style.display='none';
            document.getElementById('show').style.display="none";
            document.getElementById('show-new').style.display="block";
            document.getElementById('login-cont').style.opacity='0.4';   
        }

    </script>
</body>
</html>