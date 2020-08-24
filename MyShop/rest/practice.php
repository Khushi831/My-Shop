<?php

include 'includes/db.php';
include 'functions/functions.php';

if(isset($_SESSION['customer_email'])){

    echo "<b>Welcome:" . "</b>" . "<b style='color:yellow;'>" . $_SESSION['customer_email'] . "</b>";
}

?>

<?php 

 if(!isset($_SESSION['customer_email'])){

    echo "<a href='checkout.php' style='color:#F93;'>Login</a>";

    echo "<a href='logout.php' style='color:#F93;'>Logout</a>";
 }

?>