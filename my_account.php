<?php
session_start();
include ("functions/function.php");

?>
<!DOCTYPE html>


<html>
<head>
  <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
	<title>Sai Krishna Laser</title>
	<link rel="stylesheet" type="text/css" href="styles/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="styles/">
	<style type="text/css">
  #badg {
     background-color: #0000FF;
    vertical-align: top;
    }
  body{
    background-color: #eee;
		#badg {
     background-color: #0000FF;
    vertical-align: top;
    }
	</style>

</head>
<body >
<div class="container-fluid" style="font-size:1.2em;">
<!--navbar starts -->
<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a style="font-size:1.25em;" class="navbar-brand" href="index.php">SAI KRISHNA LASER</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs">
      <ul class="nav navbar-nav">
        
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Awards<span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="results.php?user_search=acrylic+award&search=search">Acrylic Awards</a></li>
            <li><a href="results.php?user_search=wood+award&search=search">Wooden Awards</a></li>
            <li><a href="results.php?user_search=color+award&search=search">Multi Color Awards</a></li>
          </ul>
        </li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Momento<span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="results.php?user_search=acrylic+momento&search=search">Acrylic Momento</a></li>
            <li><a href="results.php?user_search=wood+momento&search=search">Wooden Momento</a></li>
            <li><a href="results.php?user_search=color+momento&search=search">Multi Color Momento</a></li>
          </ul>
        </li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Trophy<span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="results.php?user_search=acrylic+trophy&search=search">Acrylic Trophy</a></li>
            <li><a href="results.php?user_search=wood+trophy&search=search">Wooden Trophy</a></li>
          </ul>
        </li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Medals<span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="results.php?user_search=award+medal&search=search">Award Medals</a></li> 
            <li><a href="results.php?user_search=engraved+medal&search=search">Engraved Medals</a></li>
          </ul>
        </li>
        <li><a href="results.php?user_search=shield&search=search">Shields</a></li>

        
        <li><?php cart(); ?> <a href="cart.php"><span class="glyphicon glyphicon-shopping-cart"><span id="badg" class="badge badge-warning"><?php total_items();  ?> </span></span></a></li>
        
        <?php 
        if (!isset($_SESSION['customer_email'])) {
          echo "<li><a href='checkout.php'>Welcome Guest:<?php ?></a></li>";
          echo "<li><a href='checkout.php'>Login||Register <?php ?></a></li>";
        } else {
          $c_email = $_SESSION['customer_email'];
          $get_name = "select * from customers where customer_email ='$c_email' ";
          $run_get_name = mysqli_query($con , $get_name);
          $row_get_name = mysqli_fetch_array($run_get_name);
          $name = $row_get_name['customer_name'];
          echo "<li><a disabled>Welcome : $name</a></li>";
          echo "<li class='dropdown'>
          <a href='#' class='dropdown-toggle' data-toggle='dropdown' role='button' aria-haspopup='true' aria-expanded='false'><span class='glyphicon glyphicon-user'></span></a>
          <ul class='dropdown-menu'>
            <li><a href='my_account.php'>My Account</a></li>
            <li><a href='logout.php'>Logout</a></li>
          </ul>
        </li>";
        }
        

        ?>
        
      </ul>
      <?php 
if (isset($_POST['btn-sig'])){
  $ip = getIp();
  $customer_id  = $_GET['c_id'];
  $c_name =  $_POST['c_name'];
  $c_contact = $_POST['c_cont'];
  $c_email =  $_POST['c_email'];
 
  $update_c = "update customers set customer_name='$c_name' , customer_email='$c_email', customer_contact='$c_contact' where customer_id ='$customer_id' ";
  $run_update = mysqli_query($con,$update_c);
  if ($run_update) {
    $_SESSION['customer_email']= $c_email;
    echo "<script>alert('Your account successfully updated')</script>";
     echo "<script>window.open('my_account.php','_self')</script> ";
  }
  
}
if (isset($_POST['change_pas'])) {
  $user = $_SESSION['customer_email'];
  $current_pass =$_POST['current_pass'];
  $new_pass= $_POST['new_pass'];
  $new_pass_again = $_POST['new_pass_again'];
  $sel_pass= " select * from customers where customer_pass = '$current_pass' AND customer_email = '$user' ";
  $run_pass = mysqli_query($con , $sel_pass);
  $check_pass = mysqli_num_rows($run_pass);
  if ($check_pass == 0) {
    echo "<script>alert('Your Current Password is Wrong')</script> ";
    echo "<script>window.open('my_account.php?change_pass','_self')</script> ";

  }else{
  if ($new_pass != $new_pass_again) {
    echo "<script>alert('Password doesn\'t match')</script> ";
    echo "<script>window.open('my_account.php?change_pass','_self')</script> ";
  }else{
    $update_pass = "update customers set customer_pass ='$new_pass' where customer_email = '$user' ";
    $run_update = mysqli_query($con,$update_pass);
    echo "<script> alert('You Password has been changed successfully!')</script> ";
 }

}//end of else block of check_pass
} // end of change pass
 $user = $_SESSION['customer_email'];
 if (isset($_POST['yes'])) {
   $delete_customer = "delete from customers where customer_email ='$user' ";
   $run_customer = mysqli_query($con , $delete_customer);
   echo "<script>alert('We are really sorry ,your account has been deleted !')</script> ";
   session_destroy('customer_email');
   echo "<script>window.open('index.php','_self')</script> ";

 }
 if (isset($_POST['no'])){
  echo "<script>window.open('my_account.php','_self') </script> ";
 }


?>















      <form action="results.php" class="navbar-form navbar-right">
        <div class="form-group">
          <input type="text" name="user_search" class="form-control" placeholder="Search">
        </div>
        <button type="submit" name="search" class="btn btn-default" value="search">Search</button>
      </form>
      
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
</div>	
<!--navbar ends -->
<div class="container"
<div>

	<div class="row">
      <div class=" col-xs-8 col-sm-3 col-md-3">
              <div class="col-md-2"></div>
              <div class="col-md-10">
                   <h3><p>  Products</p></h3>
                    <div class="list-group text-center">
                      <h4>
                        <?php  getCats();?>
                      </h4>
                    </div>
                    <h3><p>  Brands</p></h3>
                    <div class="list-group text-center">
                      <h4>
                        <?php getBrands(); ?>
                      </h4>
                    </div>
                </div> <!-- col-md-10 -->
        </div>
  
      <?php
                   $user = $_SESSION['customer_email'];
                   $get_user = "select * from customers where customer_email ='$user' ";
                   $run_get_user = mysqli_query($con,$get_user);
                   $row_get_user = mysqli_fetch_array($run_get_user);
                   $c_name = $row_get_user['customer_name'];
                   

                    ?>

      <div class="col-xs-12 col-sm-6 col-md-6">
          <h2 class="text-center" >Welcome <?php echo $c_name; ?></h2><br>
          <?php 
          if (!isset($_GET['my_orders'])) {
               if (!isset($_GET['edit_account'])) {
                   if (!isset($_GET['change_pass'])) {
                       if (!isset($_GET['delete_account'])) {
                        echo "<b>You Can see you orders :</b>";
                       }
                    }
               }               
          }

          ?>
          <?php 
          if (isset($_GET['edit_account'])) {
            include ("customer/edit_account.php");
          }
          if (isset($_GET['change_pass'])) {
            include ("customer/change_pass.php");
          }
          if (isset($_GET['delete_account'])) {
            include ("customer/delete_account.php");
          }
          ?>
          
      </div>
      <div class="col-xs-12 col-sm-3 col-md-3">
                 <div class="col-md-10">
                 <h3><p>My Account</p></h3>
                   <ul class="list-group">

                     <li class="list-group-item"><a style="text-decoration: none;" href="my_account.php?my_orders">My Orders</a></li>
                     <li class="list-group-item"><a style="text-decoration: none;"  href="my_account.php?edit_account">Edit Account</a></li>
                     <li class="list-group-item"><a style="text-decoration: none;"  href="my_account.php?change_pass">Change Password</a></li>
                     <li class="list-group-item"><a  style="text-decoration: none;" href="my_account.php?delete_account">Delete Account</a></li>
                     <li class="list-group-item"><a  style="text-decoration: none;" href="logout.php">Logout</a></li>
                    </ul>
                 </div>
                 <div class="col-md-2"></div>
      </div>


        </div>
    </div>
</div>

<script type="text/javascript" src="js/jquery-2.1.4.min.js" ></script>
<script type="text/javascript" src="js/bootstrap.min.js" ></script>

<script type="text/javascript" src="js/script.js" ></script>
</div>
</body>
</html>