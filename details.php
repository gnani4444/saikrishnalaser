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
    .thumbnail{
        
    }

.thumbnail img {
    -webkit-transition: all 1s ease; /* Safari and Chrome */
    -moz-transition: all 1s ease; /* Firefox */
    -o-transition: all 1s ease; /* IE 9 */
    -ms-transition: all 1s ease; /* Opera */
    transition: all 1s ease;
}

.thumbnail:hover img {
    -webkit-transform:scale(1.3); /* Safari and Chrome */
    -moz-transform:scale(1.3); /* Firefox */
    -ms-transform:scale(1.3); /* IE 9 */
    -o-transform:scale(1.3); /* Opera */
     transform:scale(1.3);
}
		


    /* button css*/
    .button {
    background-color: #4CAF50; /* Green */
    border: none;
    color: white;
    padding: 15px 32px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 16px;
    margin: 4px 2px;
    cursor: pointer;
    -webkit-transition-duration: 0.4s; /* Safari */
    transition-duration: 0.4s;
    
}
.button:hover{
    box-shadow: 0 12px 16px 0 rgba(0,0,0,0.24),0 17px 50px 0 rgba(0,0,0,0.19);

}

	</style>

</head>
<body style="background-color: #eee;" >
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

        
        <li><a href="cart.php"><span class="glyphicon glyphicon-shopping-cart"><span id="badg" class="badge badge-warning"><?php 
        if (isset($_GET['add_cart'])) {
            global $con ;
            $ip = getIp();
            $pro_id=$_GET['add_cart'];
            $check_pro = "select * from cart where ip_add='$ip' AND p_id ='$pro_id' ";
            $run_check = mysqli_query($con , $check_pro);
            if (mysqli_num_rows($run_check) > 0 ) {
                echo "";
            }else {
            $insert_pro = "insert into cart (p_id,ip_add) values('$pro_id','$ip')";
            $run_pro = mysqli_query($con , $insert_pro);
            }
          }
  


//getting the total added items
  if (isset($_GET['add_cart']) ) {
    global $con ;
    $ip = getIp();
    $get_items = "select * from cart where ip_add='$ip' ";
    $run_items = mysqli_query($con,$get_items);
    $count_items = mysqli_num_rows($run_items);
  }else {
    global $con ;
    $ip = getIp();
    $get_items = "select * from cart where ip_add='$ip' ";
    $run_items = mysqli_query($con,$get_items);
    $count_items = mysqli_num_rows($run_items);
  }
  echo $count_items; 

  ?></span></span></a></li>
       <?php 
        if (!isset($_SESSION['customer_email'])) {
          echo "<li><a href='#'>Welcome Guest:<?php ?></a></li>";
           echo "<li><a href='checkout.php'>Login||Register <?php ?></a></li>";
        } else {
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
<div class="container">
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
  <div class="col-xs-12 col-sm-9 col-md-9">
  
        <?php 
        if (isset($_GET['pro_id'])|| isset($_GET['add_cart']) ) {
            if (isset($_GET['pro_id'])) {
              $product_id= $_GET['pro_id'];
            } else {
              $product_id= $_GET['add_cart'];
            }
            
                
            $get_pro ="select * from products where product_id='$product_id' ";
    $run_query_pro = mysqli_query($con,$get_pro);
    while($row_pro= mysqli_fetch_array($run_query_pro)) {

        $pro_id = $row_pro['product_id'];
        $pro_title = $row_pro['product_title'];
        $pro_price = $row_pro['product_price'];
        $pro_image = $row_pro['product_image'];
        $pro_desc = $row_pro['product_desc'];

        //echo
        echo "
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <div class='col-md-4 col-sm-6 col-xs-12'>
        <div class='thumbnail'>
                <div class=''>
                    <img class='img-responsive' src='admin_area/product_images/$pro_image'> 
                </div> 
        </div>
      </div>
      <div class='col-md-8'>
          <h4>$pro_title</h4>
          <h4 class=''>Price : &#8377; $pro_price</h4>

           <a href ='details.php?add_cart=$pro_id'><button class='button'><span class='glyphicon glyphicon-shopping-cart'></span> ADD TO CART</button></a>
          <button class='button'> BUY NOW</button>
          <p>$pro_desc</p>
      </div>


        ";




    }

            
    }
    ?>


          
        
                    


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