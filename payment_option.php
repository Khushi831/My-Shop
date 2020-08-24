<!DOCTYPE HTML>

<html>
    <head>
        <title>Payment Options</title>
    </head>
    <body>
        <?php

            include 'includes/db.php';
            include 'functions/functions.php';

        ?>
        <div align="center">
  
            <h2> Payment Option For You</h2>
            <?php

                $ip=getRealIpAddr();

                $get_customer="SELECT * FROM customers WHERE customer_ip='$ip'";

                $run_customer=mysqli_query($con,$get_customer);

                $customer=mysqli_fetch_array($run_customer);

                $customer_id= $customer['customer_id'];

            ?>

            <b>Pay With</b>&nbsp;<a href="www.paypal.com"><img src="images/paypal.png"></a><b>Or <a href="order.php?c_id=<?php echo $customer_id; ?>">Pay Offline</a></b>

            <b>If you selct "Pay Offline" option the please check your email or account to find the Invoice  No for your order</b>

        </div>
    </body>
</html>