<?php
    session_start();
    include('db/connection.php');        
    $errotp ='';
    $errorcount=0;

    if(isset($_POST['newpassword'])){
        if(empty($_POST['password'])){
            $errotp ="Password Should not be empty";
        }
        if(empty($_POST['cpassword'])){
            $errotp ="Confirm Password Should not be empty";
        }
        else{

            $pass = $_POST['password'];
            $cpass = $_POST['cpassword'];

            $uppercase = preg_match('@[A-Z]@',$pass);
            $lowercase = preg_match('@[a-z]@',$pass);
            $number = preg_match('@[0-9]@',$pass);
            $specialChars = preg_match('@[^\w]@',$pass);

            if($pass == $cpass){
                if(!$uppercase){
                    $errcount+=1;
                    $errpassword="Password should include at least one upper case letter.";
                }
                if(!$lowercase){
                    $errcount+=1;
                    $errpassword="Password should include at least one lower case letter.";
                }
                if(!$specialChars){
                    $errcount+=1;
                    $errpassword="Password should include at least one special character.";
                }
                if(!$number){
                    $errcount+=1;
                    $errpassword="Password should include at least one number.";
                }
                if($errcount==0){
                    $password = md5($pass);

                    $sql = "UPDATE USER_I SET PASSWORD= :upassword WHERE EMAIL= :email";
                    $stid = oci_parse($connection,$sql);
                    oci_bind_by_name($stid , ":email" ,$_SESSION['email']);
                    oci_bind_by_name($stid , ":upassword" ,$password);

                    if(oci_execute($stid)){
                        header('location:login.php');
                    }
                }
            }
            else{
                $errotp = "Password doesnot match";
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
    <link rel='stylesheet' href='customer/css/registers.css' />

</head>
<body>

        <div class="verify-image">
            
            <?php
                if(isset($_GET['page'])){
                    $role = $_GET['page'];
                    if($role == 'login'){  
                        echo "<img src='assets/login.png'  alt='login'>";
                    }
                }
            ?>
        </div>

        <div class="otp-container">
            <?php
                    if(isset($_GET['page'])){
                        $role = $_GET['page'];
                        if($role == 'login'){  
                            echo "<a href='login.php'> 
                                <span class='closebtn'>&times;</span>
                            </a>";
                        }
                    }
                ?>
            <h1>Generate Password</h1>
            <span class='error'> <?php echo $errotp; ?> </span>
            <p>Please type New Password.</p>
            
            <form method="post" action=''>
                <p>New Password</p>
                <div class="password">
                    <input type="password" name="password"  placeholder="Enter New Password" />
                </div>
                
                <p>Re Type Password</p>
                <div class="password">
                    <input type="password" name="cpassword"  placeholder="Enter Confirm Password" />
                </div>

                    <input
                        class="verify-btn"
                        type="submit"
                        name="newpassword"
                        value="Confirm  >>"
                    />
            </form>
        </div>

</body>
</html>