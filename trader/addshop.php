<?php

    // inculde database connection
    include('../db/connection.php');

    $errname =$errlogo = $erremail = $errcategory = $errphone = $errimage='';
    $errcount = 0;
    
    if(isset($_POST['addshop']))
    {
        if(empty($_POST['shopname'])){
            $errname ="Name is required";
        }
        
        if(empty($_POST['shopcategory'])){
            $errcategory ="Category is required";
        }
        
        if(empty($_POST['email'])){
            $erremail ="Email is required";
        }
        
        if(empty($_POST['phone'])){
            $errphone ="Phone number is required";
        }
        if(empty($_FILES["shopimage"]["name"])){
            $errimage ="Shop Image is required";
        }
        if(empty($_FILES["shoplogo"]["name"])){
            $errlogo ="Shop Logo is required";
        }

        else{
            $name = $_POST['shopname'];
            $phone = $_POST['phone'];
            $email = $_POST['email'];
            $category = $_POST['shopcategory'];
            $image = $_FILES["shopimage"]["name"];
            $logo = $_FILES['shoplogo']['name'];

            $utype = $_FILES['shopimage']['type'];

            $utmpname = $_FILES['shopimage']['tmp_name'];
            $utmplogo = $_FILES['shoplogo']['tmp_name'];
            
            $usize = $_FILES['shopimage']['size'];
            $ulocation = "../db/uploads/shops/".$image;
            $ulocationlogo = "../db/uploads/shops/".$logo;

            $femail = filter_var($email,FILTER_SANITIZE_EMAIL);           

            if(strlen($phone) < 10 || strlen($phone) > 10){
                $errcount+=1;
                $errPhone = "Phone number length should be 10";
            }

            if(!preg_match("/^9[0-9]{9}$/", $phone)){
                $errcount+=1;
                $errPhone = "Phone number is not valid. Please enter a valid Phone number";
            }
            if(!filter_var($femail,FILTER_VALIDATE_EMAIL)){
                $errcount+=1;
                $erremail = "Email you entered is invalid";
            }

            $sql = "SELECT * FROM SHOP WHERE SHOP_NAME= :s_name";
            $stid1 = oci_parse($connection,$sql);
            oci_bind_by_name($stid1 , ":s_name" , $name);

            oci_execute($stid1);
            $p_name ='';
            while($row = oci_fetch_array($stid1,OCI_ASSOC)){
              $p_name = $row['SHOP_NAME'];
            }

            if($p_name == $name){
              $errcount+=1;
              $errname="Product Name is Already exists";
            }

            $contact = $phone;

            if($errcount == 0)
            {
                // if($utype=="image/jpeg" || $utype=="image/jpg" || $utype=="image/png" || $utype=="image/gif" || $utype=="image/webp")
                // {
                    $sql = "INSERT INTO SHOP (SHOP_ID,USER_ID,SHOP_NAME,SHOP_TYPE,SHOP_IMAGE,CONTACT,EMAIL,SHOP_LOGO) 
                        VALUES (:shop_id,:user_id,:name, :category, :image,:phone,:email,:logo )";

                    $stid = oci_parse($connection,$sql);
                    oci_bind_by_name($stid ,':shop_id',$shop_id);  
                    oci_bind_by_name($stid, ':user_id', $_SESSION['userID']);            
                    oci_bind_by_name($stid ,':name',$name);
                    oci_bind_by_name($stid ,':category',$category);
                    oci_bind_by_name($stid ,':image',$image);
                    oci_bind_by_name($stid ,':logo',$logo);
                    oci_bind_by_name($stid ,':email',$femail);
                    oci_bind_by_name($stid ,':phone',$contact);

                    if(oci_execute($stid)){

                        if(move_uploaded_file($utmpname,$ulocation) && move_uploaded_file($utmplogo,$ulocationlogo)  ){
                            echo "<script>window.alert('Data Inserted Successfully!')</script>";
                            // header("location:addshop.php");
                        } 
                        else{
                            echo "Unable to insert file";
                        }     
                    }
                // }
                // else{
                    // $errimage ="Image type doesnot match";
                // }
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
    <link rel="stylesheet" href="css/add.css" />
</head>
<body>
    <div class="product-container">
        <h2>ADD SHOP</h2>
        <!-- form to add products -->
        <form method="POST" enctype="multipart/form-data">
            <!-- Part 1 -->
            <div class="product-part1">
                <!-- Image upload -->
                <div class="image-file">
                    <label>Shop Images</label>
                    <p>Upload Image <span class="error"> * <?php echo $errimage; ?> </p>
                    <input type="file" class='inputbox' name="shopimage" placeholder="UploadImage"/>
                </div>

                <!-- show logo -->
                <div class="image-file">
                    <label>Shop Logo</label>
                    <p>Upload Logo <span class="error"> * <?php echo $errlogo; ?> </p>
                    <input type="file" class='inputbox' name="shoplogo" placeholder="UploadLogo"/>
                </div>
                <!--  -->
                    <div class="info1">
                        <h3>Shop Information</h3>
                        <p>Please Provide detailed Information</p>
                    </div>
                    
                    <div class="info2">
                        <label>Shop Name <span class="error"> * <?php echo $errname; ?> </label>
                        <input type="text" class='inputbox' name="shopname" placeholder="Shop Name"/>
                    </div>

                    <div class="info2">
                        <label>Shop Category <span class="error"> * <?php echo $errcategory; ?> </label>
                        <!-- <input type="text" class='inputbox' name="shopcategory" placeholder="Shop Category" value="<?php echo $_SESSION['type']; ?>" /> -->
                        <select class="inputbox" name="shopcategory">
                            <option value="<?php echo $_SESSION['type']; ?>"><?php echo $_SESSION['type']; ?></option>
                        </select>
                    </div>
                    
                    <div class="info2">
                        <label>Email <span class="error"> * <?php echo $erremail; ?> </label>
                        <input type="email" class='inputbox' name="email" placeholder="Email" />
                    </div>

                    
                    <div class="info2">
                        <label>Phone Number <span class="error"> * <?php echo $errphone; ?> </label>
                        <input type="number" class='inputbox' name="phone" maxlength="10" placeholder="Phone Number" />
                    </div> 
            </div>
            <div class="add-product">
                <input type="submit" name="addshop" value="Add Shop +" class="addbtn" />
            </div>
        </form>
    </div>
</body>
</html>