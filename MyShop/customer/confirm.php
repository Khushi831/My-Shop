<?php
session_start();
include 'includes/db.php';

if(isset($_GET['order_id'])){

    $order_id=$_GET['order_id'];
}


?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="content-type" content="text/html; charset=utf-8">
        <title>My Shop </title>

       
    </head>
    <body>
        <form action="confirm.php?update_id=<?php echo $order_id; ?>" method="post">
            <table width="500" align="center" border="1" bgcolor="">
                <tr>
                    <td><h2>Please Confirm Your Order </h2></td>
                </tr>
                <tr>
                    <td align="right">Invoice No</td>
                    <td><input type="text" name="invoice no" /></td>
                </tr>
                <tr>
                    <td align="right">Select Payment Mode:</td>
                    <td>
                        <select name="payment_method">
                            <option>Select Payment</option>
                            <option>Bank Transfer</option>
                            <option>Easypaisa/UBL omni</option>
                            <option>Western Union</option>
                            <option>Paypal</option>

                        </select>
                    </td>
                </tr>
                <tr>
                    <td align="right">Transaction/Refference ID:</td>
                    <td><input type="text" name="tr" /></td>
                </tr>
                <tr>
                    <td align="right">Easypaisa/UBLOMNI code:</td>
                    <td><input type="text" name="code " /></td>
                </tr>
                <tr>
                    <td align="right">Payment Date</td>
                    <td><input type="text" name="date" /></td>
                </tr>
                <tr>
                    <td><input type="submit" name="confirm" /></td>
                </tr>
                


            </table>
        </form>
    </body>
</html>

<?php

    if(isset($_POST['confirm'])){

        $invoice=$_POST['invoice_no'];
        $amount=$_POST['amount'];
        $payment_method=$_POST['payment_method'];
        $ref_no=$_POST['tr'];
        $code=$_POST['code'];
        $date=$_POST['date'];

        $insert_payment="INSERT INTO payments (invoice_no,amount,payment_mode,ref_no,code,payment_date) 
        VALUES ('$invoice_no','$amount','$payment_method','$ref_no','$code','$date')";

        $run_payment =mysqli_query($con,$insert_payment);
        
        if($run_payment){
            echo "<h2 style='text-align:center;color:white;'>Payment Received, Your order will be completed within 24 hours</h2>";
        }

        $update_order="UPDATE customer_orders SET order_status='Complete' WHERE order_id='$order_id'";

        $run_order =mysqli_query($con,$update_order);

        
    }

?>