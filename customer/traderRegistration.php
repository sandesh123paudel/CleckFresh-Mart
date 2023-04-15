<!-- registration validation  -->
<?php
    session_start();
    include('../db/connection.php');
    $errfname =$errlname = $erremail=$errDOB = $errgender = $errPhone =$errcategory=$errpassword =$errCpassword=$errremember='';
    $errcount = 0;
    
    $sfname = $slname = $semail= $sDOB = $sgender = $sPhone = $scategory ='';

    if(isset($_POST['subtrader'])){
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
        if(empty($_POST['category'])){
            $errcategory='Category is required';
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

            $fname = $sfname = trim($_POST['fname']);
            $lname = $slname = trim($_POST['lname']);
            $email = $semail= $_POST['email'];
            $dob = $sDOB = $_POST['birthday'];
            $gender = $sgender= $_POST['gender'];
            $phone = $sPhone= $_POST['phone'];
            $category = $scategory = $_POST['category'];
            $password = $_POST['password'];
            $cpassword = $_POST['cpassword'];
            $remember = $_POST['remember'];


            // email verification
            $femail = filter_var($email,FILTER_SANITIZE_EMAIL);           
            $uppercase = preg_match('@[A-Z]@',$password);
            $lowercase = preg_match('@[a-z]@',$password);
            $number = preg_match('@[0-9]@',$password);
            $specialChars = preg_match('@[^\w]@',$password);

            // error validation
           
            if(strlen(trim($fname)) != strlen($fname)){
                $errcount+=1;
                $errfname="You cannot input space as a first name";
            }
            if(strlen(trim($lname)) != strlen($lname)){
                $errcount+=1;
                $errlname="You cannot input space as a first name";
            }
            if(strlen(trim($phone)) != strlen($phone)){
                $errcount+=1;
                $errPhone='You cannot input space as a phone number';
            }
            if(strlen(trim($category)) != strlen($category)){
                $errcount+=1;
                $errPhone='You cannot input space as a Category';
            }
            if(!preg_match('/^[a-zA-Z]*$/',$fname)){
                $errcount+=1;
                $errfname = "Only letters allowed";
            }
            
            if(!preg_match('/^[a-zA-Z]*$/',$lname)){
                $errcount+=1;
                $errlname = "Only letters allowed";
            }

            // email validation
            if(!filter_var($femail,FILTER_VALIDATE_EMAIL)){
                $errcount+=1;
                $erremail = "Email you entered is invalid";
            }
            
            // phone number validation
            if(strlen($phone) < 10 || strlen($phone) > 10){
                $errcount+=1;
                $errPhone = "Phone number length should be 10";
            }
            if(!preg_match("/^9[0-9]{9}$/", $phone)){
                $errcount+=1;
                $errPhone = "Phone number is not valid. Please enter a valid Phone number";
            }
 
            $age = date_diff(date_create($dob), date_create('now'))->y;

            if($age < 20) {
                $errcount+=1;
                $errDOB = "Age should be more than 20";
            }

            // password confirmation and validation
            if($password == $cpassword){
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

                $contact = (int)$phone;
                $sql = "SELECT * FROM USER_I WHERE EMAIL = :demail OR CONTACT = : dcontact OR CATEGORY = :dcategory ";

                $stid1 = oci_parse($connection, $sql);
                oci_bind_by_name($stid1,':demail' ,$femail);
                oci_bind_by_name($stid1, ':dcontact' ,$contact);
                oci_bind_by_name($stid1,':dcategory',$category);
                oci_execute($stid1);

                $vemail=$vcontact=$vcategory='';

                while($row = oci_fetch_array($stid1,OCI_ASSOC)){
                    $vemail = $row['EMAIL'];
                    $vcontact = (int)$row['CONTACT'];
                    if($row['CATEGORY'] == true){
                        $vcategory = $row['CATEGORY'];
                    }  
                }

                if($vemail === $femail){
                    $errcount+=1;
                    $erremail="Email is already Exists";
                }
                if($vcontact === $contact){
                    $errcount+=1;
                    $errPhone="Phone number is already Exists";
                }
                if($vcategory === $category){
                    $errcount+=1;
                    $errcategory="Trader Category is already Exists";
                }
                if($errcount == 0){
                    $fpassword = md5($password);
                    $role = 'trader';
                        
                    $sql1 = "INSERT INTO USER_I (USER_ID,FIRST_NAME,LAST_NAME,GENDER,CONTACT,EMAIL,DATE_OF_BIRTH,ROLE,CATEGORY,PASSWORD) 
                    VALUES(:user_id,:fname,:lname,:gender,:contact,:email,:dob,:role,:category,:password)";
                        
                    $stid = oci_parse($connection,$sql1);
                    // bind_by_name to convert php variable to insert into database
                    oci_bind_by_name($stid, ':user_id', $user_id);
                    oci_bind_by_name($stid, ':fname', $fname);
                    oci_bind_by_name($stid, ':lname', $lname);
                    oci_bind_by_name($stid, ':gender', $gender);
                    oci_bind_by_name($stid, ':contact', $contact);
                    oci_bind_by_name($stid, ':email', $femail);
                    oci_bind_by_name($stid, ':dob', $dob);
                    oci_bind_by_name($stid, ':role', $role);
                    oci_bind_by_name($stid, ':category', $category);
                    oci_bind_by_name($stid, ':password', $fpassword);

                    if(oci_execute($stid))
                    {
                        $_SESSION['category'] = $category;
                        header("location:category.php");
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
                <p>Start supplying products for users and<br>support local shops</p>
            </div>

        </div>
        <!-- part 2 -->
        <div class='part2'>
            <h1>Create Trader Account</h1>
            <form method='Post' action=''>

                <div class='input-name'>
                    <div class='form-data'>
                        <label>First Name <span class='error'> * <?php echo $errfname; ?> </span></label>
                        <input type='text' class='inputbox' placeholder='First Name' name='fname' value='<?php echo $sfname; ?>' />
                    </div>

                    <div class='form-data'>
                        <label>Last Name <span class='error'> * <?php echo $errlname; ?> </span></label>
                        <input type='text' class='inputbox' placeholder='Last Name' name='lname'  value='<?php echo $slname; ?>' />
                    </div>          
                </div>

                <div class='form-data'>
                    <label>Email <span class='error'> * <?php echo $erremail; ?> </span></label>
                    <input type='email' class='inputbox' placeholder='Email Address' name='email' value='<?php echo $semail; ?>' />
                </div> 
                    
                <div class='input-name'>
                    <div class='form-data'>
                        <label>Date of Birth <span class='error'> * <?php echo $errDOB; ?> </span></label>
                        <input type='date' class='inputbox' name='birthday' id="birthday"  />
                    </div> 
                    <div class='form-data'>
                        <label>Gender <span class='error'> * <?php echo $errgender; ?> </span></label>
                        <select class='inputbox optionbox' name='gender' >
                            <option value=''>Select Gender</option>
                            <option value='Male'>Male</option>
                            <option value='Female'>Female</option>
                            <option value='Other'>Other</option>
                        </select>  
                    </div> 
                </div>
                
                <div class='form-data'>
                    <label>Phone Number <span class='error'> * <?php echo $errPhone; ?> </span></label>
                    <input type='number' class='inputbox' placeholder='9......' maxlength='10' name='phone' value='<?php echo $sPhone; ?>' />
                </div> 

                <div class='form-data'>
                    <label>Category <span class='error'> * <?php echo $errcategory; ?> </span></label>
                    <input type='text' class='inputbox' placeholder='Category'  name='category' value='<?php echo $scategory; ?>' />
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
                    <input type='checkbox' name='remember'/> 
                    <p><a href="#">Terms and Conditions</a> <span class='error'> * <?php echo $errremember; ?> </span> </p>
                </div>

                <input type='submit' onclick='otpPass()' class='login-btn inputbox' name='subtrader' value='Create a new account  >>' />
            </form>

            <p>Or Sign Up with</p>
        
            <div class='login-social'>
                <h2 class='facebook'>f</h2>
                <h2 class='google'>G</h2>
            </div>

            <div class='create-link'>
                <p>Already have an account? </p>
                 <a href='login.php'>Login.</a>
                 <a class='backbtn' href="homepage.php">Go To Home</a>
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