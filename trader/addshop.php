<?php

    // inculde database connection
    include('../db/connection.php');

    $errname = $erremail = $errcategory = $errphone = $errimage='';
    
    if(isset($_POST['addshop']))
    {
        if(empty($_POST['shopname'])){
            $errname ="Name is required";
        }
        
        if(empty($_POST['shopcategory'])){
            $errcategory ="Price is required";
        }
        
        if(empty($_POST['email'])){
            $erremail ="Category is required";
        }
        
        if(empty($_POST['phone'])){
            $errphone ="Category is required";
        }
        if(empty($_FILES["shopimage"]["name"])){
            $errimage ="Image is required";
        }

        else{
            $name = $_POST['shopname'];
            $phone = $_POST['phone'];
            $email = $_POST['email'];
            $category = $_POST['shopcategory'];
            $image = $_FILES["shopimage"]["name"];

            $utype = $_FILES['shopimage']['type'];
            $utmpname = $_FILES['shopimage']['tmp_name'];
            $usize = $_FILES['shopimage']['size'];
            $ulocation = "../db/uploads/shops/".$image;
            

                if($utype=="image/jpeg" || $utype=="image/jpg" || $utype=="image/png" || $utype=="image/gif" || $utype=="image/webp")
                {
                    $sql = "INSERT INTO shop (Name,Category,Image,Email,Phone) 
                        VALUES (:name, :category, :image, :email, :phone )";

                    $stid = oci_parse($connection,$sql);
                                    
                    oci_bind_by_name($stid ,':name',$name);
                    oci_bind_by_name($stid ,':category',$category);
                    oci_bind_by_name($stid ,':image',$image);
                    oci_bind_by_name($stid ,':email',$email);
                    oci_bind_by_name($stid ,':phone',$phone);

                    if(ocie_execute($stid)){
                        if(move_uploaded_file($utmpname,$ulocation)){
                            echo "<script>window.alert('Data Inserted Successfully!')</script>";
                            // header("location:addshop.php");
                        } 
                        else{
                            echo "Unable to insert file";
                        }     
                    }
                }
                else{
                    $errimage ="Image type doesnot match";
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
                        <input type="text" class='inputbox' name="shopcategory" placeholder="Shop Category" />
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