<?php
session_start();
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
            <?php cart(); ?>

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

                    <span>- Total Items:<?php items(); ?> - Total Price:<?php total_price(); ?> <a href="index.php" style="color:yellow;">Home</a> </span>

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
                    <form action="cart.php" method="post" enctype="multipart/form-data">

                        <table width="600" align="center" bgcolor="lightseagreen">

                            <tr>
                                <td>Remove</td>
                                <td>Product($)</td>
                                <td>Quantity</td>
                                <td>Total Price</td>
                            </tr>

                                                 

                                     <?php

                                        $ip_add= getRealIpAddr();

                                        global $db;

                                        $total=0;

                                        $sel_price="SELECT * FROM cart WHERE ip_add='$ip_add' ";

                                        $run_price= mysqli_query($con,$sel_price);

                                        while($record=mysqli_fetch_array($run_price)){

                                            $pro_id=$record['p_id'];

                                            $pro_price="SELECT * FROM  products WHERE product_id='$pro_id' ";

                                            $run_pro_price=mysqli_query($con,$pro_price);

                                            while($p_price=mysqli_fetch_array($run_pro_price)){

                                                $product_price=array($p_price['product_price']);

                                                $product_title= $p_price['product_title'];

                                                $product_image=$p_price['product_img1'];

                                                $value=array_sum($product_price);   

                                                $total += $value;                                                        


                                             }
                                        }

                                                echo "$" . $total;
                                        

                                    ?>
                            <tr>  
                                <td><input type="checkbox" name="remove[]" value="<?php echo $pro_id; ?> " ></td>
                                <td><?php $product_title; ?><br><img src="admin/product_images/<?php echo $product_images; ?>" height="80"  width="80"></td>
              
                                
              
                                <td><input type="text" name="qty" value="1" size="3" /></td>
                               
                                <?php

                                    if(isset($_POST['update'])){

                                        $qty=$_POST['qty'];

                                        $insert_qty="UPDATE SET qty='$qty' WHERE ip_add='$ip_add'";

                                        $run_qty=mysqli_query($con,$insert_qty);
    
                                        $total=$total*$qty;

                                    }

                                ?>
                               
                                <td><?php $only_price; ?></td>
                           </tr>
                                    
                           <tr>
                           
                                <td colspan="3" align="right"><b>Sub Total:</b></td>
                                <td><b><?php echo "$" . $total; ?></b></td>
                           
                           </tr>
                            <tr></tr>
                           <tr>
                           
                                <td colspan="2"><input type="submit" name="update" value="Update Cart" /></td>
                                <td><input  type="submit" name="continue" value="Continue Shopping" /></td>
                                <td><button><a href="checkout.php" style="text-decoration:none; color:black;">Checkout</a></button></td>

                           </tr>


                        </table>


                    </form>

                    <?php
                     function updatecart() {
                         global $con;

                        if(isset($_POST['update'])){

                            foreach($_POST['remove'] as $remove_id){

                                $delete_products="delete from cart where p_id='$remove_id'";

                                $run_delete=mysqli_query($con,$delete_products);

                                if($run_delete){
                                    echo "<script>window.open('cart.php','_self')</script>";
                                }

                            }
                        }



                        if(isset($_POST['continue'])){

                                echo "<script>window.open('index.php','_self')/script>";
                        }
                        
                    }
                       echo @$up_cart=updatecart() ;                   
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
