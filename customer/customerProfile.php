<?php

  include('../db/connection.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/profiles.css">
</head>
<body>
    <div class="profile-customer">
        <div class="menu">
            <h4>Manage Account</h4>
            <a href="#">Account Information</a>
            <a href="#">My Orders</a>
            <a href="#">Logout</a>
        </div>
        <div class="content">
            <h3>Manage My Account</h3>
            <h4>Personal Information</h4>
            
            <div class="profile-info">
                <form method='Post' action=''>
                    
                        <div class='form-data'>
                            <label>First Name</label>
                            <input type='text' class='inputbox' placeholder='First Name' name='fname' />
                        </div>
    
                        <div class='form-data'>
                            <label>Last Name</label>
                            <input type='text' class='inputbox' placeholder='Last Name' name='lname'  />
                        </div>          
                    
                        <div class='form-data'>
                            <label>Email</label>
                            <input type='email' class='inputbox' placeholder='Email Address' name='email'  />
                        </div> 

                        <div class='form-data'>
                            <label>Date of Birth </span></label>
                            <input type='date' class='inputbox optionbox' name='birthday' id="birthday"  />
                        </div> 

                        <div class='form-data'>
                            <label>Gender</label>
                            <select class='inputbox optionbox' name='gender'>
                                <option value=''>Select Gender</option>
                                <option value='Male'>Male</option>
                                <option value='Female'>Female</option>
                            </select>  
                        </div> 
                    
                    
                        <div class='form-data'>
                            <label>Phone Number</label>
                            <input type='number' class='inputbox' placeholder='Phone Number' maxlength='10' name='phone' />
                        </div> 
                        
                        <div class='form-data'>
                            <label>Password</label>
                            <input type='password' class='inputbox' placeholder='Password' name='password' />
                        </div> 
                            
                        <div class="edit-btn">
                            <input type='submit' class='update-btn inputbox' name='updaetprofile' value='Update' />
                            <input type='submit' class='update-btn inputbox' name='changePassword' value='Change Password' />
                        </div>         
                 </form>
            </div>
        </div>
    </div>
</body>
</html>