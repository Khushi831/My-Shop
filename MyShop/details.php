<?php

include 'includes/db.php';
include 'functions/functions.php';

?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="content-type" content="text/html; charset=utf-8">
        <title>My Shop </title>

        <link rel="stylesheet"  href="styles/style.css" media="all" />
    </head>
    <body>
      
    <!--main container starts -->

    <div class="main_wrapper">

        <!-- header starts-->

        <div class="header_wrapper">
        
            <img src="images/logo1.jpg" style="float:left;width:200px;height:100px;" >
            <img src="images/logo2.jpg" style="floate:right;height:100px;">
            <img src="images/paypal.png" style="floate:right;width:400px;height:100px;">
        </div>

         <!-- header End-->

        <!--Navagation Bar starts-->

        <div class="navbar">
        
            <ul id="menu">
            
                <li><a href="index.php">Home</a></li>
                <li><a href="all_products.php">All Products</a></li>
                <li><a href="customer/my_account.php">My Account</a></li>
                <li><a href="customer_register.php">Sign up</a></li>
                <li><a href="cart.php">Shopping Cart</a></li>
                <li><a href="contact.php">Contact US</a></li>

            </ul>

            <div>
                <form  id="form" method="get" action="results.php" enctype="multipart/form-data">
                    <input type="text" name="user_query" placeholder="Search a Product">
                    <input type="submit" name="search" value="Search">
                </form>
            </div>
        
        </div>

        <!--Navagation Bar End-->

        <!--content area starts-->

        <div class="content_wrapper">

            <div id="left_sidebar">

                <div id="siderbar_title">Categories</div>

                    <ul id="cats"> 

                        <?php getCats();  ?> 
                    </ul>

                <div id="siderbar_title">Brand</div>

                    <ul id="cats"> 
                        
                    <?php getBrands(); ?> 
                        
                     </ul>

            </div>

            <div id="right_content">

                <div class="headline">
                    <div id="headline_content">
                    <?php

                        if(!isset($_SESSION['customer_email'])){

                            echo "<b>Welcome Guest!</b> <b style='color:yellow;'>Shopping Cart:</b>";
                        }
                        else{
                             echo "<b>Welcome:" . "<span style='color:lightblue;'>" . $_SESSION['customer_email'] . "</span>" . "</b>" . "<b style='color:yellow;'>Your Shopping Cart:</b>";
                            }

                    ?>

                    <span>- Total Items:<?php items(); ?> - Total Price:<?php total_price(); ?> <a href="cart.php" style="color:yellow;">Go TO Cart</a> </span>

                    &nbsp;<?php
    
                if(!isset($_SESSION['customer_email'])){
        
                     echo "<a href='checkout.php' style='color:#F93;'>Login</a>";
                }
                else{
                    echo "<a href='logout.php' style='color:#F93;'>Logout</a>";
                }
                 ?>

                    </div>
                </div>

                <div id="products_box">
                    <?php

                    if(isset($_GET['product_id'])){

                        $product_id=$_GET['product_id'];

                    $get_products ="SELECT * FROM products WHERE product_id='$product_id' ";
    
                    $run_products = mysqli_query($con ,$get_products);
        
                    while($row_products=mysqli_fetch_array($run_products)){
        
                        $product_id= $row_products['product_id'];
                        $product_title= $row_products['product_title'];
                        $product_cat= $row_products['cat_id'];
                        $product_brand= $row_products['brand_id'];
                        $product_desc= $row_products['product_desc'];
                        $product_price= $row_products['product_price'];
                        $product_image1= $row_products['product_img1'];
                        $product_image2= $row_products['product_img2'];
                        $product_image3= $row_products['product_img3'];
        
                    echo "
                         <div id='single_product'>
                        <h3>$product_title</h3>
        
                        <img src='admin/product_images/$product_image1' width='180' height='180'/>
                        <img src='admin/product_images/$product_image2' width='180' height='250'/>
                        <img src='admin/product_images/$product_image3' width='180' height='250'/></br>

                        <p><b>Price: $product_price</b></p>

                        <p>$product_desc</p>
                        <a href='index.php' style='float:left;'>Go Back</a>
                        <a href='index.php?add_cart=$product_id'><button style='float:right;'>Add Cart </button></a>
        
                    </div>
                
                    ";
        
                }
            }
                    ?>
               
                </div>

            </div>

        </div>

        <!--content area End-->

        <!--Footer Starts-->

        <div class="footer">
        
            <h1 style="color:black; padding-top:30px; text-align:center;">&copy; 2020 - By WWW.OnlineKhushi.com  </h1>
        
        </div>

        <!--Footer End-->
    </div>

    <!--main container End -->
    </body>
</html>
