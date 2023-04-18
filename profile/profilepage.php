<?php
  // session_start();

  include('../db/connection.php');
  
  $firstname =  $lastname =   $gender =  $contact = $role= $email =$dob=''; 

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
    $dob = $row['DATE_OF_BIRTH'];
    $role = $row['ROLE'];
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
          margin-top: 5%;
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
      .profile-info .info{
          display: flex;
          flex-wrap: wrap;
          gap: 1rem;
      }
      .profile-info .info span{
          width: 110px;
          font-weight: bold;
      }
      .profile-info .info label{
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
      }
  </style>
  </head>
  <body>  

    <div class="profile-container">
      <header>
        <h3><?php 
          if($role == 'customer'){
            echo "Customer";
          }
          if($role == 'trader'){
            echo 'Trader';
          }
          else{
            echo 'Admin';
          }
          ?> Information</h3>
          <a href="../trader/traderdashboard.php?cat=UpdateProfile&name=Home"> <span class="material-symbols-outlined">
            edit
            </span></a>
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
     
      <a href="" class="change-btn">Change Password</a>
    </div>
 
  </body>
</html>
