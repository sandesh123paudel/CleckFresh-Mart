<?php
  // session_start();

  include('../db/connection.php');
  unset($_SESSION['profile']);

  $_SESSION['profile'] = $_GET['role'];
  
  $firstname =  $lastname =   $gender =  $contact = $role= $email =$dob=''; 
  $sql = "SELECT * FROM USER_I WHERE USER_ID = :id ";
  $stid= oci_parse($connection,$sql);

  oci_bind_by_name($stid, ':id' , $_SESSION['adminID'] );

  oci_execute($stid);

  while($row = oci_fetch_array($stid,OCI_ASSOC)){
    $firstname = $row['FIRST_NAME'];
    $lastname = $row['LAST_NAME'];
    $gender = $row['GENDER'];
    $contact = $row['CONTACT'];
    $email = $row['EMAIL'];
    $dob = $row['DATE_OF_BIRTH'];
    $role = $row['ROLE'];
  }


  // change password
  
  $errcount = 0;
  $err='';

  if(isset($_POST['changepassword'])){
    $current = $_POST['currentpassword'];
    $newpass = $_POST['password'];
    $confirmpass = $_POST['cpassword'];

    if(empty($_POST['password'])){
      $err='Current Password is required';
    }
    if(empty($_POST['password'])){
      $err='Password is required';
    }
    if(empty($_POST['cpassword'])){
      $err='Confirm Password is required';
    }
    else{
        $uppercase = preg_match('@[A-Z]@',$newpass );
        $lowercase = preg_match('@[a-z]@',$newpass );
        $number = preg_match('@[0-9]@',$newpass );
        $specialChars = preg_match('@[^\w]@',$newpass);
      
        if($newpass == $confirmpass){
          if(!$uppercase){
            $errcount+=1;
            $err="Password should include at least one upper case letter.";
          }
          if(!$lowercase){
              $errcount+=1;
              $err="Password should include at least one lower case letter.";
          }
          if(!$specialChars){
              $errcount+=1;
              $err="Password should include at least one special character.";
          }
          if(!$number){
              $errcount+=1;
              $err="Password should include at least one number.";
          }

          $curpass = md5($current);

          $sql = "SELECT * FROM USER_I WHERE USER_ID = :id ";
          $stid= oci_parse($connection,$sql);

          oci_bind_by_name($stid, ':id' , $_SESSION['adminID'] );

          oci_execute($stid);

          $dbpassword='';

          while($row = oci_fetch_array($stid,OCI_ASSOC)){
            $dbpassword = $row['PASSWORD'];
          }

        if($curpass != $dbpassword){
          $errcount+=1;
          $err="Current password do not match.";
        }  

        if($errcount == 0){
          // echo "successfully password is inserted";
          $newpassword = md5($newpass);
          $sql = "UPDATE USER_I SET PASSWORD= :upassword WHERE USER_ID = :id";
          $stid = oci_parse($connection,$sql);
          oci_bind_by_name($stid, ':id' , $_SESSION['adminID'] );
          oci_bind_by_name($stid , ":upassword" ,$newpassword );

          // oci_execute($stid);
          if(oci_execute($stid)){
            // header('location:login.php');
            echo "<script>
            alert('Password Successfully Changed!!!');
            </script>";
          }
        }
      }
      else{
        $err = "Password you entered do not match.";
      }
    }
  }

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">

    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
  </head>
  <body>  

    <div class="profile-container">
      <header>
      <?php  
      echo "<h3>Admin Information</h3>";

        echo "<a href='dashboard.php?cat=UpdateProfile&name=Home&role=trader'> <span class='material-symbols-outlined'>
          edit
        </span></a>";
     
          ?>
      </header>    

      <div class="line"></div>

      <div class="profile-info">
        <div class="info"><span>Name :</span><label>
         <?php
            echo $firstname . " " . $lastname;
         ?>
        </label></div>
        <div class="info"><span>Contact :</span> <label>
          <?php
            echo $contact; 
          ?>
          </label></div>
        <div class="info"><span>Email :</span><label>
          <?php
            echo $email;
          ?>  
        </label></div>
        <div class="info"><span>Date of Birth :</span><label>
          <?php
            echo $dob;
          ?>
        </label></div>
        <div class="info"><span>Gender :</span>
        <label><?php
          echo $gender;
        ?></label></div>
      </div>
      <div class="line"></div>
     
      <a href=""  type="button" class="change-btn" data-bs-toggle="modal" data-bs-target="#exampleModal">Change Password</a>
    </div>
 
    <!-- Vertically centered modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered ">
    <div class="modal-content text-bg-secondary">
      
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Change Password </h1>
        
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class='error'><?php echo $err; ?></div>
      <form method="post" action=''>
      <div class="modal-body">
        <p>Current Password </p>
          <div class="password">
            <input type="password" name="currentpassword" class="inputbox" placeholder="Enter Current Password" />
          </div>
          <p>New Password</p>
          <div class="password">
            <input type="password" name="password" class="inputbox" placeholder="Enter New Password" />
          </div>
          <p>Re Type Password</p>
            <div class="password">
              <input type="password" name="cpassword" class="inputbox"  placeholder="Enter Confirm Password" />
            </div>
          
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancle</button>
          <input
            class="verify-btn btn-secondary btn text-warning"
            type="submit"
            name="changepassword"
            value="Confirm  >>"
          />
      </div>
      </form>
    </div>

      
  </div>
</div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js" integrity="sha384-zYPOMqeu1DAVkHiLqWBUTcbYfZ8osu1Nd6Z89ify25QV9guujx43ITvfi12/QExE" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.min.js" integrity="sha384-Y4oOpwW3duJdCWv5ly8SCFYWqFDsfob/3GkgExXKV4idmbt98QcxXYs9UoXAB7BZ" crossorigin="anonymous"></script>

  </body>
</html>


