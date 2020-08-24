<?php

$db =mysqli_connect("localhost","root","","myshop");


// function for getting IP Address 

function getRealIpAddr()
{
    if (!empty($_SERVER['HTTP_CLIENT_IP']))   //check ip from share internet
    {
      $ip=$_SERVER['HTTP_CLIENT_IP'];
    }
    elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))   //to check ip is pass from proxy
    {
      $ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
    }
    else
    {
      $ip=$_SERVER['REMOTE_ADDR'];
    }
    return $ip;
}




//getting the script for cart

function cart(){

    global $db;

    if(isset($_GET['add_cart'])){

        $ip_add= getRealIpAddr();

        $p_id= $_GET['add_cart'];

        $check_pro= "SELECT * FROM cart WHERE ip_add='$ip_add' AND p_id='$p_id'";

        $run_check = mysqli_query($db,$check_pro);

        if(mysqli_num_rows($run_check)>0){

            echo " ";
        
        }
        else{

            $q = "INSERT INTO cart (ip_id,ip_add) VALUES ('$p_id','$ip_add') ";

            $run_q=mysqli_query($db,$q);

          
        }
    }

}


//gettting the numbers of items from the cart

function items(){
   

    if(isset($_GET['add_cart'])){

        global $db;

        $ip_add= getRealIpAddr();

        $get_items= "SELECT * FROM cart WHERE ip_add='$ip_add'";

        $run_items=mysqli_query($db,$get_items);

        $count_items=mysqli_num_rows($run_items);

    }

    else{

        global $db;

        $ip_add= getRealIpAddr();


        $get_items= "SELECT * FROM cart WHERE ip_add='$ip_add'";

        $run_items=mysqli_query($db,$get_items);

        $count_items=mysqli_num_rows($run_items);

    }
}

//getting the total price of the items from the cart 

function total_price(){

    $ip_add= getRealIpAddr();

    global $db;

    $total=0;

    $sel_price="SELECT * FROM cart WHERE ip_add='1' ";

    $run_price= mysqli_query($db,$sel_price);

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

    echo "$" . $total;
}

// getting a product display

function getPro(){

    global $db;

    if(!isset($_GET['cat'])){

        if(!isset($_GET['brand'])) {

        $get_products ="SELECT * FROM products order by rand()  LIMIT 0,6 ";
    
        $run_products = mysqli_query($db ,$get_products);

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
                <a href='index.php?add_cart=$pro_id'><button style='float:right;'>Add Cart </button></a>

            </div>
        
            ";

        }


    }
            
 }

}


//getting category products



function getCatPro(){

    global $db;

    if(isset($_GET['cat'])){

        $cat_id=$_GET['cat'];
       
        $get_cat_pro ="SELECT * FROM products WHERE cat_id='$cat_id' ";
    
        $run_cat_pro = mysqli_query($db ,$get_cat_pro);

        $count= mysqli_num_rows($run_cat_pro);

        if($count==0){
            echo "<h2> No Product fount in this Category!<h2>";
        }

      while($row_cat_pro=mysqli_fetch_array($run_cat_pro)){

            $pro_id= $row_cat_pro['product_id'];
            $pro_title= $row_cat_pro['product_title'];
            $pro_cat= $row_cat_pro['cat_id'];
            $pro_brand= $row_cat_pro['brand_id'];
            $pro_desc= $row_cat_pro['product_desc'];
            $pro_price= $row_cat_pro['product_price'];
            $pro_image= $row_cat_pro['product_img1'];

            echo "
                 <div id='single_product'>
                <h3>$pro_title</h3>

                <img src='admin/product_images/$pro_image' width='180' height='180'/></br>
                <p><b>Price: $pro_price</b></p>
                <a href='details.php?$pro_id' style='float:left;'>Details</a>
                <a href='index.php?add_cart=$pro_id'><button style='float:right;'>Add Cart </button></a>

            </div>
        
            ";

        }

            

    }
            
} 

// getting brand products

function getBrandPro(){

    global $db;

   

        if(isset($_GET['brand'])) {

            $brand_id=$_GET['brand'];

        $get_brand_pro ="SELECT * FROM products WHERE brand_id='$brand_id' ";
    
        $run_brand_pro = mysqli_query($db ,$get_brand_pro);

        $count= mysqli_num_rows($run_brand_pro);

        if($count==0){
            echo "<h2> No Product fount in this Brands!<h2>";
        }

        while($row_brand_pro=mysqli_fetch_array($run_brand_pro)){

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
                <a href='index.php?add_cart=$pro_id'><button style='float:right;'>Add Cart </button></a>

            </div>
        
            ";

        }


    }
            
 

}


//getting branda display


function getBrands(){

    global $db;

    $get_brands="SELECT * FROM brands";
    $run_brands=mysqli_query($db,$get_brands);

    while ($row_brands=mysqli_fetch_array($run_brands)){

            $brand_id=$row_brands['brand_id'];
            $brand_title=$row_brands['brand_title'];

    echo"<li><a href='index.php?cat=$brand_id'>$brand_title</a></li>";
    }

}

//getting category display

function getCats(){
    global $db;

    $get_cats="SELECT * FROM categories";
    $run_cats=mysqli_query($db,$get_cats);

    while ($row_cats=mysqli_fetch_array($run_cats)){

            $cat_id=$row_cats['cat_id'];
            $cat_title=$row_cats['cat_title'];

    echo "<li><a href='index.php?cat=$cat_id'>$cat_title</a></li>";
    }
}









?>