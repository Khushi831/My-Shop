<form action="" method="post">
    <table width="500" align="center">
        <tr align="center">
            <td colspan="4"><h2>Change Your Password:</h2></td>
        </tr>

        <tr>
            <td align="right">Enter Current Password:</td>
            <td><input type="password" name="old_pass" required /></td>
        </tr>

        <tr>
            <td align="right">Enter New Password:</td>
            <td><input type="password" name="new_pass" required /></td>
        </tr>

        <tr>
            <td align="right">Enter New Password Again:</td>
            <td><input type="password" name="new_pass_again" required /></td>
        </tr>

        <tr align="center">
            <td colspan="4"><input type="submit" name="change_pass" value="Change Password"  /></td>
        </tr>
    </table>
</form>

<?php

    include ("includes/db.php");

    $c =$_SESSION['customer_email'];

    if(isset($_POST['change_pass'])){

        $old_pass=$_POST['old_pass'];
        $new_pass=$_POST['new_pass'];
        $new_pass_again=$_POST['new_pass_again'];

        $get_real_pass="SELECT * FROM customers WHERE customer_pass='$old_pass'";

        $run_real_pass =mysqli_query($con,$get_real_pass);

        $check_pass=mysqli_num_rows($run_real_pass);

        if($check_pass==0){

            echo "<script>alert('Your Current password is not valid,try again!')</script>";
            exit();
        }
        if($new_pass!=$new_pass_again){
            echo "<script>alert('New password did not match, try again!')</script>";
            exit();
        }
        else{
            $update_pass="UPDATE customers SET customer_pass='$new_pass' WHERE customer_email='$c'";
            $run_real_pass =mysqli_query($con,$get_real_pass);

            echo "<script>alert('Your password has been successfully changed!')</script>";
            echo "<script>window.open('my_account.php','_self')</script>";
            
        }

    }

?>