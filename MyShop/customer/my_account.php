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
        
            <img src="../images/logo1.jpg" style="float:left;width:200px;height:100px;" >
            <img src="../images/logo2.jpg" style="floate:right;height:100px;">
            <img src="../images/paypal.png" style="floate:right;width:400px;height:100px;">
        </div>

         <!-- header End-->

        <!--Navagation Bar starts-->

        <div class="navbar">
        
            <ul id="menu">
            
            <li><a href="../index.php">Home</a></li>
                <li><a href="../all_products.php">All Products</a></li>
                <li><a href="customer/my_account.php">My Account</a></li>
                <?php
                    if(isset($_SESSION['customer_email'])){
                
                        echo "<span style='display:none;'><li><a href='../user_register.php'>Sign up</a></li></span>";

                    }
                    else{
                        echo "<li><a href='../user_register.php'>Sign up</a></li>";
                    }
                ?>
                <li><a href="../cart.php">Shopping Cart</a></li>
                <li><a href="../contact.php">Contact US</a></li>
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

                <div id="siderbar_title">Manage Account</div>

                    <ul id="cats"> 
                
                    <?php

                        $customer_session=$_SESSION['customer_email'];

                        $get_customer_pic="SELECT * FROM customers WHERE customer_email='$customer_session'";

                        $run_customer = mysqli_query($con,$get_customer_pic);

                        $row_customer = mysqli_fetch_array($run_customer);

                        $customer_pic = $row_customer['customer_image'];

                        echo "<img src='customer_photos/$customer_pic' width='150' height='150'>";



                    ?>
                        <li><a href="my_account.php?my_orders">My Orders</a></li>
                        <li><a href="my_account.php?edit_account">Edit Account</a></li>
                        <li><a href="my_account.php?change_pass">Change Password</a></li>
                        <li><a href="my_account.php?delete_account">Delete Account</a></li>
                        <li><a href="../logout.php">Logout</a></li>
                       
                                               
                    </ul>

               

                    
            </div>

            <div id="right_content">
            <?php cart(); ?>

                <div class="headline">
                    <div id="headline_content">
                        <?php

                            if(isset($_SESSION['customer_email'])){

                                
                                echo "<b>Welcome:" . $_SESSION['customer_email'] .  "</b>" ;
                            }

                        ?>
                       
                      
                        &nbsp;<?php
                                
                                if(!isset($_SESSION['customer_email'])){
                                    
                                    echo "<a href='../checkout.php' style='color:#F93;'>Login</a>";
                                }
                                else{
                                    echo "<a href='../logout.php' style='color:#F93;'>Logout</a>";
                                }
                            ?>

                    </div>
                </div>
           

                <div >
                   
                   <h2 style="background-color:black;padding:20px; color:white; text-align:center; border-top:2px solid white">Manage Your Account Here </h2>
                        <?php getDefault(); ?>

                        <?php

                                if(isset($_GET['my_orders'])){
                                    include('my_orders.php');
                                }

                                if(isset($_GET['edit_account'])){
                                    include ("edit_account.php");
                                }

                                if(isset($_GET['change_pass'])){
                                    include ("change_pass.php");
                                }
                                if(isset($_GET['delete_account'])){
                                    include ("delete_account.php");
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
