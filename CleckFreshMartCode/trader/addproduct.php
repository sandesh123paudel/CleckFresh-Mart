<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="addproduct.css" />
</head>
<body>
    <div class="product-container">
        <h2>ADD NEW PRODUCT</h2>
        <!-- form to add products -->
        <form method="POST" enctype="multipart/form-data">
            <!-- Part 1 -->
            <div class="product-part1">
                <!-- Image upload -->
                <div class="image-file">
                    <label>Product Images</label>
                    <p>Upload Image</p>
                    <input type="file" class='inputbox' name="productimage" placeholder="UploadImage"/>
                </div>
                <!--  -->
                    <div class="info1">
                        <h3>Product Information</h3>
                        <p>Please Provide detailed Information</p>
                    </div>
                    
                    <div class="info2">
                        <label>Product Name</label>
                        <input type="text" class='inputbox' name="productname" placeholder="Product Name"/>
                    </div>

                    <div class="info2">
                        <label>Product Category</label>
                        <input type="text" class='inputbox' name="productcategory" placeholder="Product Category" />
                    </div>
                    
                    <div class="info2">
                        <label>Description</label>
                        <input type="text" class='inputbox desc' name="description" placeholder="Provide Product descriptions.." />
                    </div>

                    
                    <div class="info2">
                        <label>Shop Name</label>
                        <input type="text" class='inputbox' name="productcategory" placeholder="Shop Name" />
                    </div> 
            </div>
            <!-- part 2 -->
            <div class="product-part2">
                <div class="part2-info">
                    <h3>Pricing</h3>
                    <p>Please provide detailed information</p>
                </div>

                <div class="info2">
                        <label>Base Price</label>
                        <input type="text" class='inputbox' name="productprice"  placeholder="Base Price"/>
                </div> 

                <div class="info2">
                    <label>Offer Type</label>
                    <select class='inputbox' name="offer">
                        <option>Choose Offer Type</option>
                        <option>Offer 1</option>
                        <option>Offer 2</option>
                        <option>Offer 3</option>
                    </select>
                </div> 
                <div class="info2">
                    <label>Quantity</label>
                    <select class='inputbox' name="quantity">
                        <option>Please Select Quantity</option>
                        <option>10</option>
                        <option>20</option>
                        <option>30</option>
                    </select>
            </div>
            <div class="info2">
                <label>Stock</label>
                <input type="text" class='inputbox' name="productprice" placeholder="Product Stock" />
            </div>
            </div>
            
            <div class="add-product">
                <input type="submit" name="addProduct" value="Add Product +" class="addbtn" />
            </div>
        </form>
    </div>
</body>
</html>