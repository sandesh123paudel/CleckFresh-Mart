<!-- registration validation  -->
<?php

include('../db/connection.php');

    $errfname =$errlname = $erremail=$errDOB = $errgender = $errPhone =$errpassword =$errCpassword=$errremember='';

    if(isset($_POST['subCustomer'])){
        // verifying the errors if inbox is empty
        if(empty($_POST['fname'])){
            $errfname='First Name is required';
        }
        if(empty($_POST['lname'])){
            $errlname='Last Name is required';
        }
        if(empty($_POST['email'])){
            $erremail='Email is required';
        }
        if(empty($_POST['birthday'])){
            $errDOB='DOB is required';
        }
        if(empty($_POST['gender'])){
            $errgender='Gender is required';
        }
        if(empty($_POST['phone'])){
            $errPhone='Phone Number is required';
        }
        if(empty($_POST['password'])){
            $errpassword='Password is required';
        }
        if(empty($_POST['cpassword'])){
            $errCpassword='Confirm Password is required';
        }
        if(empty($_POST['remember'])){
            $errremember='Terms & Conditions is required';
        }
        else{
            $fname=$_POST['fname'];
            $lname = $_POST['lname'];
            $email = $_POST['email'];
            $dob = date("d/m/y" , strtotime($_POST['birthday']));
            $gender = $_POST['gender'];
            $phone=$_POST['phone'];
            $password = $_POST['password'];
            $cpassword = $_POST['cpassword'];
            $remember = $_POST['remember'];

            $femail = filter_var($email,FILTER_SANITIZE_EMAIL);
            $pregmatch = (preg_match("/^[9]{1}[8]{1}[0-9]{8}$/", $_POST['phone']));
           
            $uppercase = preg_match('@[A-Z]@',$password);
            $lowercase = preg_match('@[a-z]@',$password);
            $number = preg_match('@[0-9]@',$password);
            $specialChars = preg_match('@[^\w]@',$password);

            // error validation
            if(strlen(trim($fname)) != strlen($fname)){
                $errfname="You cannot input space as a first name";
            }
            if(strlen(trim($lname)) != strlen($lname)){
                $errlname="You cannot input space as a first name";
            }
            if(strlen(trim($phone)) != strlen($phone)){
                $errPhone='You cannot input space as a phone number';
            }
            if(!preg_match('/^[a-zA-Z]*$/',$fname)){
                $errfname = "Only letters allowed";
            }
            
            if(!preg_match('/^[a-zA-Z]*$/',$lname)){
                $errlname = "Only letters allowed";
            }

            // email validation
            if(!filter_var($femail,FILTER_VALIDATE_EMAIL)){
                $erremail = "Email you entered is invalid";
            }
            
            // phone number validation
            if(!$pregmatch){
                $errPhone = "Phone number is not valid. Please enter a valid Phone number";
            }
           
            if (strtotime($dob) > time()) {
                $errDOB = "Date of birth should no be greate";
              }

            // password confirmation and validation
            if($password == $cpassword){
                if(!$uppercase){
                    $errpassword="Password should include at least one upper case letter.";
                }
                if(!$lowercase){
                    $errpassword="Password should include at least one lower case letter.";
                }
                if(!$specialChars){
                    $errpassword="Password should include at least one special character.";
                }
                if(!$number){
                    $errpassword="Password should include at least one number.";
                }
                
                else{
                    
                    $sql = "SELECT * FROM USER_I WHERE EMAIL = :demail AND CONTACT = : dcontact";

                    $fpassword = md5($password);
                    $role = 'customer';
                    $contact = (int)$phone;
                    $sql = "INSERT INTO USER_I (USER_ID,FIRST_NAME,LAST_NAME,GENDER,CONTACT,EMAIL,DATE_OF_BIRTH,ROLE,PASSWORD) VALUES(:user_id,:fname,:lname,:gender,:contact,:email,:dob,:role,:password)";
                    
                    $stid = oci_parse($connection,$sql);
                    
                    oci_bind_by_name($stid, ':user_id', $user_id);
                    oci_bind_by_name($stid, ':fname', $fname);
                    oci_bind_by_name($stid, ':lname', $lname);
                    oci_bind_by_name($stid, ':gender', $gender);
                    oci_bind_by_name($stid, ':contact', $contact);
                    oci_bind_by_name($stid, ':email', $email);
                    oci_bind_by_name($stid, ':dob', $dob);
                    oci_bind_by_name($stid, ':role', $role);
                    oci_bind_by_name($stid, ':password', $fpassword);

                    if(oci_execute($stid)){
                        header("location:login.php");
                    }
                }
            }
            else{
                $errCpassword = "Password doesnot match!";
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
    <link rel='stylesheet' href='css/registerssss.css' />
</head>
<body>
  
    <div class='login-container' id='login-cont'>
        <!-- part 1 -->
        <div class='part1'>
            <div class='logo'>
                <a href='homepage.php'><img src='../logo/logo.png' alt='CheckFreshMart' /></a>
            </div>
            <div class='login-text'>
                <div>
                    <h1>Create your<br>Cleck Fresh Account</h1>
                </div>
                <p>Start buying products from us and support <br>local products</p>
            </div>

        </div>
        <!-- part 2 -->
        <div class='part2'>
            <h1>Create Customer Account</h1>

            <form method='Post' action=''>
                <div class='input-name'>
                    <div class='form-data'>
                        <label>First Name <span class='error'> * <?php echo $errfname; ?> </span></label>
                        <input type='text' class='inputbox' placeholder='First Name' name='fname' />
                    </div>

                    <div class='form-data'>
                        <label>Last Name <span class='error'> * <?php echo $errlname; ?> </span></label>
                        <input type='text' class='inputbox' placeholder='Last Name' name='lname'  />
                    </div>          
                </div>

                <div class='form-data'>
                    <label>Email <span class='error'> * <?php echo $erremail; ?> </span></label>
                    <input type='email' class='inputbox' placeholder='Email Address' name='email'  />
                </div> 
                    
                <div class='input-name'>
                    <div class='form-data'>
                        <label>Date of Birth <span class='error'> * <?php echo $errDOB; ?> </span></label>
                        <input type='date' class='inputbox' name='birthday' id="birthday"  />
                    </div> 
                    <div class='form-data'>
                        <label>Gender <span class='error'> * <?php echo $errgender; ?> </span></label>
                        <select class='inputbox optionbox' name='gender'>
                            <option value=''>Select Gender</option>
                            <option value='M'>Male</option>
                            <option value='F'>Female</option>
                            <option value='O'>Other</option>
                        </select>  
                    </div> 
                </div>
                
                <div class='form-data'>
                    <label>Phone Number <span class='error'> * <?php echo $errPhone; ?> </span></label>
                    <input type='number' class='inputbox' placeholder='98....' maxlength='10' name='phone' />
                </div> 
                
                <div class='form-data'>
                    <label>Password <span class='error'> * <?php echo $errpassword; ?> </span></label>
                    <input type='password' class='inputbox' placeholder='Password' name='password' />
                </div> 
                <p>Include a minimum of 8 characters and at least one number and one letter. No spaces,please.</p>

                <div class='form-data'>
                    <label>Confirm Password <span class='error'> * <?php echo $errCpassword; ?> </span></label>
                    <input type='password' class='inputbox' placeholder='Confirm Password' name='cpassword' />
               </div>
                
                <div class="terms-condition">
                    <input type='checkbox'  name='remember' /> 
                    <p><a href="#">Terms and Conditions</a> <span class='error'> * <?php echo $errremember; ?> </span></p>
                </div>

                <input type='submit' onclick='otpPass()' class='login-btn inputbox' name='subCustomer' value='Create a new account  >>' />
            </form>

            <p>Or Sign Up with</p>
        
            <div class='login-social'>
                <h2 class='facebook'>f</h2>
                <h2 class='google'>G</h2>
            </div>

            <div class='create-link'>
                <p>Already have an account? </p>
                 <a href='login.php'>Login.</a>
                 <a class='backbtn' href="homepage.php">Back</a>
            </div>
            
        </div>
    </div>

     <!-- otp verification for forget password -->
     <div class="otp-container" id='show'>
      <span class="closebtn" onclick="closeBtn()">&times;</span>
      <h1>Verification code</h1>
      <p>Please type the verification code sent to your registered email.</p>
      
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
          name="verify"
          value="Verify  >>"
        />
      </form>

    </div>
    </div>
    <script>
 function otpPass(){
            document.getElementById('show').style.display="block";
            document.getElementById('login-cont').style.opacity="0.5";
        }
        function closeBtn(){
            document.getElementById('show').style.display='none';
            document.getElementById('login-cont').style.opacity='1';   
        }
    </script>


</body>
</html>