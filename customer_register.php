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
                        <b>Welcome Guest !</b>
                        <b style="color:yellow;">Shopping Cart:</b>
                        <span>- Total Items:<?php items(); ?> - Total Price:<?php total_price(); ?> <a href="cart.php" style="color:yellow;">Go TO Cart</a> 
                        
                        &nbsp;<a href="logout.php" style="color:lightyellow;">Logout</a>

                        </span>
                    </div>
                </div>
            
            <div>

                <form action="customer_register.php" method="post" enctype="multipart/form-data"  >
                
                    <table width="700" align="center" bgcolor="lightcoral">

                        <tr align="center">
                            <td colspan="8"><h2>Creat An Account</h2></td>

                        </tr>

                        <tr>
                            <td align="right"><b>Customer Name:<b></td>
                            <td><input type="text" name="c_name" required /></td>
                        </tr>

                        <tr>
                            <td align="right"><b>Customer Email:<b></td>
                            <td><input type="text" name="c_email" required /></td>
                        </tr>

                        <tr>
                            <td align="right"><b>Customer Password:<b></td>
                            <td><input type="password" name="c_pass" required /></td>
                        </tr>

                        <tr>
                            <td align="right"><b>Customer Country:<b></td>
                            <td>
                                <select name="c_country">
                                    <option>Select a Country</option>
                                    <option>Iraq</option>
                                    <option>Thailand</option>
                                    <option>China</option>
                                    <option>Egypt</option>
                                    <option>Sri Lanka</option>
                                    <option>India</option>
                                    <option>Bagladesh</option>
                                    <option>Switzerland</option>
                                    <option>Turkey</option>
                                    <option>Nepal</option>
                                    <option>Pakistan</option>
                                    <option>Australia</option>
                                    <option>Russia</option>
                                    <option>USA</option>

                                </select>
                            </td>
                        </tr>

                        <tr>
                            <td align="right"><b>Customer City:<b></td>
                            <td><input type="text" name="c_city" required /></td>
                        </tr>

                        <tr>
                            <td align="right"><b>Customer Mobile no.:<b></td>
                            <td><input type="text" name="c_contact" required /></td>
                        </tr>

                        <tr>
                            <td align="right"><b>Customer Address:<b></td>
                            <td><input type="text" name="c_address" required /></td>
                        </tr>

                        <tr>
                            <td align="right"><b>Customer Image:<b></td>
                            <td><input type="file" name="c_image" required /></td>
                        </tr>

                        <tr align="center">
                            <td colspan="8"><input type="Submit" name="register" value="Submit" /></td>
                        </tr>
                        

                    </table>
                
                </form>    

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

<?php

    if(isset($_POST['register'])){

        $c_name= $_POST['c_name'];
        $c_email= $_POST['c_email'];
        $c_pass= $_POST['c_pass'];
        $c_country= $_POST['c_country'];
        $c_city= $_POST['c_city'];
        $c_contact= $_POST['c_contact'];
        $c_address= $_POST['c_address'];
        $c_image= $_FILES['c_image']['name'];
        $c_image_tmp= $_FILES['c_image']['tmp_name'];
        $c_ip=getRealIpAddr();

        $insert_customer="INSERT INTO customers (customer_name,customer_email,customer_pass,customer_country,
        customer_city,customer_contact,cutomer_address,customer_image,customer_ip) VALUES ('c_name','c_email','c_pass,'c_country','c_city','c_contact','c_address','c_image','c_ip',)";

        $run_customer=mysqli_query($con,$insert_customer);

        move_uploaded_file($c_image_tmp,"customer/customer_photos/$c_image");

        $sel_cart="SELECT * FROM cart WHERE ip_add='$c_ip'";

        $run_cart=mysqli_query($con,$sel_cart);

        $check_cart= mysqli_num_rows($run_cart);

        if($check_cart>0){
            $_SESSION['customer_email']=$c_email;

            echo "<script>alert('Accouct created Successfully, Thankyou !')</script>";

            echo "<script>window.open('checkout.php','_self')</script>";

        }
        else{
            $_SESSION['customer_email']=$c_email; 

            echo "<script>window.open('index.php','_self')</script>";
        }

        
    }

?>
