<?php

  // session_start();
  include('../db/connection.php');
  
  if(isset($_SESSION['userID'])){
    $firstname =  $lastname =  $role= $gender =  $contact =  $email =$dob=''; 

    $sql = "SELECT * FROM USER_I WHERE USER_ID = :id ";
    $stid= oci_parse($connection,$sql);

    oci_bind_by_name($stid, ':id' , $_SESSION['userID'] );
    
    oci_execute($stid);

    while($row = oci_fetch_array($stid,OCI_ASSOC)){
      $firstname = $row['FIRST_NAME'];
      $lastname = $row['LAST_NAME'];
      $gender = $row['GENDER'];
      $contact = $row['CONTACT'];
      $email = $row['EMAIL'];
      $role = $row['ROLE'];
      $dob = $row['DATE_OF_BIRTH'];
    }
  }

  
  if(isset($_POST['updateprofile'])){
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $uemail = $_POST['email'];
    $birth = $_POST['dob'];
    $ugender = $_POST['gender'];
    $contact = $_POST['phone'];

    $sql = "UPDATE USER_I SET FIRST_NAME= :fname,LAST_NAME= :lname,GENDER= :gender,CONTACT= :contact,EMAIL = :email,DATE_OF_BIRTH= :dob WHERE USER_ID= :id ";
    $stid= oci_parse($connection,$sql);

    oci_bind_by_name($stid, ':id' , $_SESSION['userID']);
    oci_bind_by_name($stid, ':fname', $fname);
    oci_bind_by_name($stid, ':lname', $lname);
    oci_bind_by_name($stid, ':gender', $gender);
    oci_bind_by_name($stid, ':contact', $contact);
    oci_bind_by_name($stid, ':email', $uemail);
    oci_bind_by_name($stid, ':dob', $birth);

    if(oci_execute($stid)){
      if($_SESSION['role'] == 'trader'){
        header("location:../trader/traderdashboard.php?cat=Profile&name=Home");      
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
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <style>
       
      :root {
          --yellow:rgb(255, 179, 1);
      }
     
      .profile-container{
          margin-inline: 5%;
          margin-block: 5%;
          display: flex;
          flex-direction: column;
          gap: 1rem;
          flex-wrap: wrap;
      }

      .profile-container header{
          display: flex;
          justify-content: space-between;
      }
      .profile-container header h3{
          padding-block: 5px;
      }

      .profile-container header a{
          padding-top: 1rem;
          padding-block: 5px;
      }
      .profile-container header a span{
          padding-block: 5px;
      }
      .line{
          height: 2px;
          background-color:lightgray;
      }
      .profile-info{
          display: flex;
          flex-direction: column;
          gap: 1rem;
      }
      .profile-info .info2{
          margin-block:10px;
          display: flex;
          flex-wrap: wrap;
          flex-direction:column;
      }

      .profile-info .info2 input{
        padding-left:10px;
        padding:5px;
        border-radius:5px;

      }

      .profile-info .info2 label{
          padding-block: 5px;
      }

      .change-btn{
          text-decoration: none;
          background-color: var(--yellow);
          width: 200px;
          text-align: center;
          padding-block: 5px;
          color: white;
          border-radius:5px;
          border:none;
          outline:none;
      }
  </style>
  </head>
  <body>  

    <div class="profile-container">
      <header>
       <h3>Update 
        <?php 
          if($role == 'customer'){
            echo "Customer";
          }
          if($role == 'trader'){
            echo 'Trader';
          }
          else{
            echo 'Admin';
          }
          ?> Information
      </h3>
      </header>    

      <div class="line"></div>

      <div class="profile-info">
        
        <form action="" methot='POST'>

          <div class="info2">
            <label>First Name</label>
            <input type="text" class="inputbox"  name="fname"  placeholder="First Name" value='<?php echo $firstname; ?>' />
          </div>
            
          <div class="info2">
            <label>Last Name</label>
            <input type="text" class="inputbox"  name="lname"  placeholder="Last Name" value='<?php echo $lastname; ?>' />
          </div>


          <div class="info2">
            <label>Email</label>
            <input type="email" class="inputbox"  name="email"  placeholder="Email" value='<?php echo $email; ?>' />
          </div>

          <div class="info2">
            <label>Phone Number</label>
            <input type="number" class="inputbox"  name="phone"  placeholder="Phone Number" value='<?php echo $contact; ?>' />
          </div>

          <div class="info2">
            <label>Date of Birth</label>
            <input type="date" class="inputbox"  name="dob"  placeholder="Date of Birth" value='<?php echo $dob; ?>' />
          </div>

          <div class="info2">
            <label>Gender</label>
            <input type="text" class="inputbox"  name="gender"  placeholder="Gender" value='<?php echo $gender; ?>' />
          </div>

          <div class="line"></div>

          <input type='submit' name='updateprofile' value='Update'  class="change-btn" />
          
        </form>  
        
      </div>   
    </div>
 
  </body>
</html>
