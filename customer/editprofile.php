<?php

// session_start();
include('../db/connection.php');


if (isset($_SESSION['userID'])) {
  $firstname =  $lastname =  $role = $gender =  $contact =  $email = $dob = '';

  $sql = "SELECT * FROM USER_I WHERE USER_ID = :id ";
  $stid = oci_parse($connection, $sql);

  oci_bind_by_name($stid, ':id', $_SESSION['userID']);

  oci_execute($stid);

  while ($row = oci_fetch_array($stid, OCI_ASSOC)) {
    $firstname = $row['FIRST_NAME'];
    $lastname = $row['LAST_NAME'];
    $gender = $row['GENDER'];
    $contact = $row['CONTACT'];
    $email = $row['EMAIL'];
    $role = $row['ROLE'];
    $dob = $row['DATE_OF_BIRTH'];
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
</head>

<body>

  <div class="profile-container">
    <header>
      <h3>Update Customer Information</h3>
    </header>

    <div class="line"></div>

    <div class="profile-info">

      <form method='POST' action='updateprofile.php'>

        <div class="info2">
          <label>First Name</label>
          <input type="text" class="inputbox" name="fname" placeholder="First Name" value='<?php echo $firstname; ?>' />
        </div>

        <div class="info2">
          <label>Last Name</label>
          <input type="text" class="inputbox" name="lname" placeholder="Last Name" value='<?php echo $lastname; ?>' />
        </div>


        <div class="info2">
          <label>Email</label>
          <input type="email" class="inputbox" name="email" placeholder="Email" value='<?php echo $email; ?>' />
        </div>

        <div class="info2">
          <label>Phone Number</label>
          <input type="number" class="inputbox" name="phone" placeholder="Phone Number" value='<?php echo $contact; ?>' />
        </div>

        <div class="info2">
          <label>Date of Birth</label>
          <input type="date" class="inputbox" name="dob" placeholder="Date of Birth" value='<?php echo $dob; ?>' />
        </div>

        <div class="info2">
          <label>Gender</label>
          <!-- <input type="text" class="inputbox"  name="gender"  placeholder="Gender" value='<?php echo $gender; ?>' /> -->
          <!-- <label>Shop Category</label> -->
          <select class='inputbox selectbox' name='gender'>
            <option value="<?php echo $gender; ?>"><?php echo $gender; ?></option>
          </select>
        </div>

        <div class="line"></div>

        <input type='submit' name='updateprofile' value='Update' class="change-btn" />

      </form>

    </div>
  </div>

</body>

</html>