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

                        if(isset($_GET['serach'])){

                            $user_keyword= $_GET['user_query'];
                    
                    $get_products ="SELECT * FROM products WHERE product_keywords like '%$user_keywords%' ";
    
                    $run_products = mysqli_query($con ,$get_products);
            
                    while($row_products=mysqli_fetch_array($run_products)){
            
                        $pro_id= $row_products['product_id'];
                        $pro_title= $row_products['product_title'];
                        $pro_cat= $row_products['cat_id'];
                        $pro_brand= $row_products['brand_id'];
                         $pro_desc= $row_products['product_desc'];
                        $pro_price= $row_products['product_price'];
                        $pro_image= $row_products['product_img1'];
            
                        echo "
                             <div id='single_product'>
                            <h3>$pro_title</h3>
            
                            <img src='admin/product_images/$pro_image' width='180' height='180'/></br>
                            <p><b>Price: $pro_price</b></p>
                            <a href='details.php?$pro_id' style='float:left;'>Details</a>
                            <a href='index.php?add_cart=$pro_id'><button style='float:right;'>Add Cart</button></a>
            
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
