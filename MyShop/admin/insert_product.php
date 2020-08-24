<?php
include ('includes/db.php') ;
session_start();

?>


<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="content-type" content="text/html; charset=utf-8">
        <title>Insert Product</title>
        <script src="//tinymce.cachefly.net/4.0/tinymce.min.js" ></script>
        <script>tinymce.init({selector:'textarea'});</script>
    </head>
    <body bgcolor="grey">

            <form method="post" action="insert_product.php" enctype="multipart/form-data">
                
                <table width="700" align="center" border="1" bgcolor="lightblue">

                    <tr align="center">
                        <td colspan="2"><h1>Insert New Product</h1></td>
                    </tr>

                    <tr>
                        <td  align="right"><b>Product Title</b></td>
                        <td><input type="text" name="product_title" size="50" /></td>

                    </tr>
                    
                    <tr>

                        
                        <td  align="right"><b>Product Category</b></td>
                        <td>
                            <select name="product_cat">
                                <option>Select a Category</option>

                                <?php

                                $get_cats="SELECT * FROM categories";
                                $run_cats=mysqli_query($con,$get_cats);
        
                                while ($row_cats=mysqli_fetch_array($run_cats)){
        
                                        $cat_id=$row_cats['cat_id'];
                                        $cat_title=$row_cats['cat_title'];
        
                                echo"<option value='$cat_id'>$cat_title</option>";
                                }
                               ?> 
                            </select>
                        </td>

                    </tr>

                    <tr>

                        
                        <td align="right"><b>Product Brand</b></td>
                        <td>
                            <select name="product_brand">
                                <option>Select Brand</option>
                                <?php

                                    $get_brands="SELECT * FROM brands";
                                    $run_brands=mysqli_query($con,$get_brands);

                                    while ($row_brands=mysqli_fetch_array($run_brands)){

                                         $brand_id=$row_brands['brand_id'];
                                         $brand_title=$row_brands['brand_title'];

                                            echo"<option value='$brand_id'>$brand_title</option>";
                                    }
                                ?> 
                            </select>
                        </td>

                    </tr>

                    <tr>
                    <td align="right"><b>Product Image 1</b></td>
                        <td><input type="file" name="product_img1" /></td>

                    </tr>

                    <tr>
                    <td align="right"><b>Product Image 2</b></td>
                        <td><input type="file" name="product_img2" /></td>

                    </tr>

                    <tr>
                    <td align="right"><b>Product Image 3</b></td>
                        <td><input type="file" name="product_img3" /></td>

                    </tr>

                    <tr>
                    <td align="right"><b>Product Price</b></td>
                        <td><input type="text" name="product_price" /></td>

                    </tr>

                    <tr>
                    <td align="right"><b>Product Description</b></td>
                        <td><textarea name="product_desc" cols="35" rows="10"></textarea></td>
                   </tr>

                    <tr>
                    <td align="right"><b>Product Keywords</b></td>
                        <td><input type="text" name="product_keywords" size="50" /></td>

                    </tr>

                    <tr align="center">

                        <td colspan="2"><input type="submit" name="submit" /></td>

                    </tr>




                </table>

            </form>
    </body>
</html>


<?php

if (isset($_POST['insert_products'])){

    //text data variables//
    $product_title = $_POST['product_title'];
    $product_cat = $_POST['product_cat'];
    $product_brand = $_POST['product_brand'];
    $product_price = $_POST['product_price'];
    $product_desc = $_POST['product_desc'];
    $status='on';
    $product_keywords = $_POST['product_keywords'];

    //image name//

    $product_img1= $_FILES['product_img1'];
    $product_img2= $_FILES['product_img2'];
    $product_img3= $_FILES['product_img3'];

    //image temp names//


    $product_img1_tmp= $_FILES['product_img1'] ['tmp_name'];
    $product_img2_tmp= $_FILES['product_img2'] ['tmp_name'];
    $product_img3_tmp= $_FILES['product_img3'] ['tmp_name'];

    if($product_title=='' OR $product_cat=='' OR $product_brand=='' OR $product_price=='' OR $product_desc=='' OR $product_keywords=='' OR $product_img1==''){
        
        echo "<script>alert('Please fill all feids!')</script>";
        exit();
    }

    else{
        //uploading images to its folder//

        move_uploaded_file($product_img1_tmp,"product_images/$product_img1");
        move_uploaded_file($product_img2_tmp,"product_images/$product_img2");
        move_uploaded_file($product_img3_tmp,"product_images/$product_img3");

        $insert_products ="INSERT INTO `products`( `cat_id`, `brand_id`, `date`, `product_title`, `product_img1`, `product_img2`, `product_img3`, `product_price`, `product_desc`,`product_keyword`, `status`) 
         VALUES ('$product_cat','$product_brand',Now(),'$product_title','$product_img1','$product_img2','$product_img3','$product_price','$product_desc','$product_keywords','$status')";

            $run_products= mysqli_query($con, $insert_products);

            if($run_products ){
                echo "<script> alert('Inserted successfully!') </script>";
            }
    }

}

?>