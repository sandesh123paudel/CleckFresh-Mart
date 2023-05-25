<!-- Validation Handling in Login using php -->
<?php
// include connection
session_start();
include('db/connection.php');

// for login purpose
$err = $erremail = $errpassword  = '';

if (isset($_POST['sublogin'])) {
    if (empty($_POST['email'])) {
        $erremail = "Email is required";
    }
    if (empty($_POST['password'])) {
        $errpassword = "Password is required";
    }
    // if(empty($_POST['role'])){
    //     $errrole="User Type is required";
    // }
    else {
        $email = $_POST['email'];
        $password = md5(trim($_POST['password']));
        $remember = $_POST['remember'];
        $password = (string)$password;

        // setting the cookie if remember is clicked
        if (!empty($remember)) { 
            setcookie("email", $email, time() + 60 * 60 * 24 * 15, "/");
            setcookie("password", $password, time() + 60 * 60 * 24 * 15, "/");
            setcookie("role", $role, time() + 60 * 60 * 24 * 15, "/");
        }

        // for user
        $verify = 'verified';
        $sql = "SELECT * FROM USER_I WHERE EMAIL = :email AND PASSWORD = :pass AND VERIFY = :verify";

        // query from the database
        $stid = oci_parse($connection, $sql);

        oci_bind_by_name($stid, ':email', $email);
        oci_bind_by_name($stid, ':pass', $password);
        oci_bind_by_name($stid, ':verify', $verify);
        oci_execute($stid);

        // unset session variable
        unset($_SESSION['token']);
        unset($_SESSION['ID']);
        unset($_SESSION['error']);

        // generate token

        if ($data = oci_fetch_array($stid, OCI_ASSOC)) {
            $_SESSION['ID'] = $data;
            header("location:session.php");
        } else {
            $_SESSION['error'] = 'Email and Password is Invalid!!';
            header("location:login.php");
        }
        oci_free_statement($stid);
        oci_close($connection);
    }
}

if (isset($_SESSION['error'])) {
    $err = $_SESSION['error'];
}

if (isset($_POST['sendemail'])) {
    // unset session variable
    unset($_SESSION['email']);
    unset($_SESSION['otp']);

    $femail = $_POST['email'];
    $_SESSION['email'] = $femail;

    $sql = "SELECT EMAIL FROM USER_I WHERE EMAIL = :email";
    $stid = oci_parse($connection, $sql);
    oci_bind_by_name($stid, ":email", $femail);

    $page = 'login';

    $otp_number = rand(100000, 999999);

    $sub = "Verify Your Email address ";
    $message = "Dear User, Your Verification Code is: " . $otp_number . " to reset your password.";
    include_once('sendmail.php');

    if (oci_execute($stid)) {
        $_SESSION['otp'] = $otp_number;
        header("location:verifyotp.php?page=$page");
    } else {
        $err = "Please type Registered Email to reset your password";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CleckFreshMart Login</title>
    <link rel="icon" href="assets/logo.png" type="image/x-icon">
    <link rel='stylesheet' href='customer/css/login.css' />
</head>

<body>

    <div class="cont">
        <div class='login-container' id='login-cont'>
            <!-- part 1 -->
            <div class='part1'>
                <div class='logo'>
                    <a href='customer/homepage.php'><img src='assets/logo.png' alt='CheckFreshMart' /></a>
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
                        <label>Email <span class='error'> * <?php echo $erremail; ?> </span></label>
                        <input type='email' class='inputbox' placeholder='Email Address' name='email' />
                    </div>

                    <div class='form-data'>
                        <label>Password <span class='error'> * <?php echo $errpassword; ?> </span></label>
                        <input type='password' class='inputbox' placeholder='Password' name='password' />

                    </div>

                    <div class='forget-link'>
                        <div>
                            <input type='checkbox' name='remember' />
                            <label>Remember me.</label>
                        </div>
                        <label onclick='otpPass()'>Forget Password?</label>
                    </div>

                    <input type='submit' id='logbtn' class='login-btn inputbox' name='sublogin' value='Login   >>' />
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
            <p>Please type registered email to receive an OTP.</p>

            <form method="POST" action=''>
                <div class="numbers">
                    <input type="email" name="email" placeholder="Enter your email" />
                </div>
                <p></p>
                <input class="verify-btn" type="submit" name="sendemail" value="Send  >>" />
            </form>
        </div>

        <script>
            function otpPass() {
                document.getElementById('show').style.display = "block";
                document.getElementById('login-cont').style.opacity = '0.4';
                document.getElementById('logbtn').disabled = true;
            }

            function closeBtn() {
                document.getElementById('show').style.display = 'none';
                document.getElementById('login-cont').style.opacity = '1';
                document.getElementById('logbtn').disabled = false;
            }
        </script>
</body>

</html>