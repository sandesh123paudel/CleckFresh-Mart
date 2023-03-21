<!-- registration validation  -->
<?php
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
            $fname=trim($_POST['fname']);
            $lname = trim($_POST['lname']);
            $email = $_POST['email'];
            $birthday = $_POST['birthday'];
            $gender = $_POST['gender'];
            $phone=$_POST['phone'];
            $password = $_POST['password'];
            $cpassword = $_POST['cpassword'];
            $remember = $_POST['remember'];

            // email verification
            $femail = filter_var($email,FILTER_SANITIZE_EMAIL);
            $uppercase = preg_match('@[A-Z]@',$password);
            $lowercase = preg_match('@[a-z]@',$password);
            $number = preg_match('@[0-9]@',$password);
            $specialChars = preg_match('@[^\w]@',$password);

            $phonelength = strlen($phone);

            // email validation
            if(!filter_var($femail,FILTER_VALIDATE_EMAIL)){
                $erremail = "Email you entered is invalid";
            }
            
            // phone number validation
            if($phonelength < 10 && $phonelength > 10){
                $errPhone = "10 digits is required.";
            }

            // password confirmation and validation
            if($password == $cpassword){
                if(!$uppercase || !$lowercase || !$number || !$specialChars || strlen($password) < 8){
                    $errpassword = "Password is not strong Enough!";
                }
                else{
                    $fpassword = md5($password);
                    $sql = "INSERT INTO customer (Fname,Lname,Email,DOB,Gender,Phone,Password) 
                            VALUES('$fname','$lname','$femail','$birthday','$gender','$phone','$fpassword')";
                    include('connection.php');
                    
                    $qry = mysqli_query($connection,$sql) or die(mysqli_error($connection));

                    if($qry){
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
    <link rel='stylesheet' href='registers.css' />
</head>
<body>
  
    <div class='login-container'>
        <!-- part 1 -->
        <div class='part1'>
            <div class='logo'>
                <a href='homepage.php'><img src='logo/logo.png' alt='CheckFreshMart' /></a>
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
                            <option value='Male'>Male</option>
                            <option value='Female'>Female</option>
                        </select>  
                    </div> 
                </div>
                
                <div class='form-data'>
                    <label>Phone Number <span class='error'> * <?php echo $errPhone; ?> </span></label>
                    <input type='number' class='inputbox' placeholder='Phone Number' maxlength='10' name='phone' />
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

                <input type='submit' class='login-btn inputbox' name='subCustomer' value='Create a new account  >>' />
            </form>

            <p>Or Sign Up with</p>
        
            <div class='login-social'>
                <h2 class='facebook'>f</h2>
                <h2 class='google'>G</h2>
            </div>

            <div class='create-link'>
                <p>Already have an account? </p>
                 <a href='login.php'>Login.</a>
            </div>
            
        </div>
    </div>



</body>
</html>