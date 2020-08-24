<?php

include 'includes/db.php';
include 'functions/functions.php';

//Get customer id

if(isset($_GET['c_id'])){

    $ip_add= getRealIpAddr();

    $total=0;

    $sel_price="SELECT * FROM cart WHERE ip_add='$ip_add' ";

    $run_price= mysqli_query($db,$sel_price);

    $status='Pending';

    $invoice_no=mt_rand();

    while($record=mysqli_fetch_array($run_price)){

        $pro_id=$record['p_id'];

         $pro_price="SELECT * FROM  products WHERE product_id='$pro_id' ";

         $run_pro_price=mysqli_query($db,$pro_price);

         while($p_price=mysqli_fetch_array($run_pro_price)){

            $product_price=array($p_price['product_price']);

            $value=array_sum($product_price);

            $total +=$value;


         }
    }


    //getting quentity from cart

    $get_cart="SELECT * FROM cart ";

    $run_cart=mysqli_query($con,$get_cart);

    $get_qty=mysqli_fetch_array($run_cart);

    $qty=$get_qty['qty'];


    if($qty==0){

        $qty=1;

        $sub_total=$total;

    }
    else{
        $qty=$qty;

        $sub_total=$total*$qty;

    }

    $insert_order="INSERT INTO customer_orders (,customer_id,due_amount,invoice_no.,total_product,order_date,order_status) 
    VALUE ('$customer_id','$sub_total','$invoice_no.','$count_pro','NOW()','$status') ";

    $run_order=mysqli_query($con,$insert_order);

    if($run_order){
        echo "<script>alert('Order Successfully Submitted , Thankyou!')</script>";

        echo "<script>window.open('customer/my_account.php','_self')</script>";

        $empty_cart="DELETE FROM cart WHERE ip_add='$ip_add'";

        $run_empty=mysqli_query($con,$empty_cart);

        $insert_to_pending_orders="INSERT INTO pending_orders (customer_id,invoice_no.,product_id,qty,order_status) VALUE ('$customer_id','$invoice_no.','$pro_id','$qty','$status')";

        $run_pending_order-mysqli_query($con,$insert_to_pending_order);
    }
}

?>