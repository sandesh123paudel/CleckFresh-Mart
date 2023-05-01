<?php
    session_start();
    include('db/connection.php');        
    $errotp ='';

    if(isset($_POST['verifyotp'])){
        $errotp='';
        $errcount=0;

        // $num1 = $_POST['num1'];
        // $num2 = $_POST['num2'];
        // $num3 = $_POST['num3'];
        // $num4 = $_POST['num4'];
        // $num5 = $_POST['num5'];
        // $num6 = $_POST['num6'];
        $otpnum = $_POST['number'];

        // $otpnum = $num1.''.$num2.''.$num3.''.$num4.''.$num5.''.$num6;
        // $otpnumber= (int)$otpnum;
        $otpnumber= (int)$otpnum;
        
        
        // if(empty($_POST['num1']) || empty($_POST['num2']) || empty($_POST['num3']) || empty($_POST['num4']) || empty($_POST['num5']) || empty($_POST['num6'])){
        //     $errcount+=1;
        //     $errotp ="OTP input field should not be empty";
        // }

        if(empty($_POST['number'])){
            $errotp ="OTP input field should not be empty";
        }
        else{
            if($otpnumber != $_SESSION['otp']){
                $errcount+=1;
                $errotp="OTP is INVALID";
            }
            if($errcount == 0 ){
                    $role = $_GET['page'];
    
                    if($role == 'customer'){
                        $verified = 'verified';
                        $sql = "UPDATE USER_I SET VERIFY = :verify WHERE EMAIL= :uemail";
                        $stid = oci_parse($connection,$sql);
                        oci_bind_by_name($stid, ':uemail', $_SESSION['email']);
                        oci_bind_by_name($stid, ':verify', $verified);
                        oci_bind_by_name($stid, ':urole', $role);
                        
                        unset($_SESSION['otp']);
                        if(oci_execute($stid)){
                            header('location:login.php');
                        }
                    }
    
                    else if($role == 'trader'){
                        $verified='pending';
    
                        $sql1 = "UPDATE USER_I SET VERIFY = :verify WHERE EMAIL = :uemail";
                        $stid1 = oci_parse($connection,$sql1);
                        oci_bind_by_name($stid1, ':uemail',$_SESSION['email']);
                        oci_bind_by_name($stid1, ':verify', $verified);
                        oci_bind_by_name($stid1, ':urole', $role);
    
                        unset($_SESSION['otp']);
    
                        if(oci_execute($stid1)){
                            header("location:insertcategory.php");
                        }
                    }
                    else if($role == 'login'){
                        header("location:resetpassword.php?page=$role");
                    }
            }
        }
    }

    if(isset($_POST['resendOTP'])){
        unset($_SESSION['otp']);
        
        $otp_number = rand(100000,999999);
        $femail = $_SESSION['email'];

        $sub ="Please Verify Your Email address";
        $message="Dear User, Your Verification Code is: $otp_number";            
        include_once('sendmail.php');

        $_SESSION['otp'] =$otp_number;
        
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel='stylesheet' href='customer/css/registers.css' />
</head>
<style>
      #login-cont{
        opacity: 0.5;
        }

        .otpnumber input{
            width: 90%;
            margin-left:1rem;
            padding-left:1rem;
            padding:10px;
            border:1px solid lightgray;
            outline:none;
            border-radius:5px;
        }

</style>
<body>
    
     <!-- otp verification for forget password -->
        <div class="verify-image">
            
            <?php
                if(isset($_GET['page'])){
                    $role = $_GET['page'];
                    if($role == 'customer' ){
                        echo "<img src='logo/customer.png'  alt='customer'>";
                    }

                    if($role == 'trader'){  
                        echo "<img src='logo/trader.png'  alt='trader'>";
                    }
                    
                    if($role == 'login'){  
                        echo "<img src='logo/login.png'  alt='login'>";
                    }
                }
            ?>

        </div>
         <div class='otp-container' id='show'>
            <?php
                if(isset($_GET['page'])){
                    $role = $_GET['page'];
                    if($role == 'customer' ){
                        echo "
                        <a href='customerRegistration.php'> 
                            <span class='closebtn'>&times;</span>
                        </a>";
                    }

                    if($role == 'trader'){  
                        echo "<a href='traderRegistration.php'> 
                            <span class='closebtn'>&times;</span>
                        </a>";
                    }

                    if($role == 'login'){  
                         echo "<a href='login.php'> 
                            <span class='closebtn'>&times;</span>
                        </a>";
                    }
                    
                }
            ?>

            <h1>Verification code</h1>  
            <span class='error'> <?php echo $errotp; ?> </span>
            <p>Please type the verification code sent to your registered email.</p>
                    
            <form method='post' action=''>

                <!-- <div class='numbers'>
                    <input type='text' name='num1'  maxlength='1' placeholder='-' />
                    <input type='text' name='num2'  maxlength='1' placeholder='-' />
                    <input type='text' name='num3'  maxlength='1' placeholder='-' />
                    <input type='text' name='num4'  maxlength='1' placeholder='-' />
                    <input type='text' name='num5'  maxlength='1' placeholder='-' />
                    <input type='text' name='num6'  maxlength='1' placeholder='-' />
                </div> -->

                <div class="otpnumber">
                    <input type='number' name='number'   placeholder='Please enter your otp' />
                </div>
                <p>
                    Don't receive the OTP?
                    <input
                        class='resend'
                        type='submit'
                        name='resendOTP'
                        value='Resend OTP'
                    />
                </p>
                <input
                    class='verify-btn'
                    type='submit'
                    name='verifyotp'
                    value='Verify  >>'
                />
            </form>
        </div>

        
</body>
</html>

