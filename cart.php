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
    .button {
    background-color: #4CAF50; /* Green */
    border: none;
    color: white;
    padding: 16px 32px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 16px;
    margin: 4px 2px;
    -webkit-transition-duration: 0.4s; /* Safari */
    transition-duration: 0.4s;
    cursor: pointer;

    background-color: white;
    color: black;
    border: 2px solid #4CAF50;
}

.button:hover {
    background-color: #4CAF50;
    color: white;
}
body{
    background-color: #eee;
    }
	</style>
  <script>
function myFunction() {
    var x = document.getElementById("mySelect").value;
    document.getElementById("demo").innerHTML = "<input type="submit" name="ad" value="save">";
}
</script>

</head>
<body>
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
  <br><br>
  <div style="padding:10px; " >
  
            <table class="table table-hover">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>Image</th>
                    <th>Product(s)</th>
                    <th>Quantity</th>
                    <th>Total Price</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $total = 0;
                global $con ;
                $ip = getIp();
                $select_price = "select * from cart where ip_add='$ip' ";
                $run_price_query = mysqli_query($con,$select_price);
                while ($p_price = mysqli_fetch_array($run_price_query)) {
                  $pro_id = $p_price['p_id'];
                  $quantity = $p_price['qty'];
                  $qty = $p_price['qty'];
                  $pro_price ="select * from products where product_id='$pro_id' ";
                  $run_pro_price = mysqli_query($con,$pro_price);
                  if ($pp_price = mysqli_fetch_array($run_pro_price)) {
                    $product_price = $pp_price['product_price'];
                    $product_title = $pp_price['product_title'];
                    $product_image = $pp_price['product_image'];

                    $product_id = $pp_price['product_id'];
                    
           
   ?>
              <tr><form action="cart.php" enctype="multipart/form-data" >
                <td><input type="hidden" name="fd" value="<?php echo  $product_id; ?>">  </td>
                <td><img src="admin_area/product_images/<?php echo $product_image; ?> " width="65" height="65" ></td>
                <td><?php echo $product_title ; ?><br><a href="cart.php?del=<?php echo $product_id; ?>">delete</a> </td>
                <td> <input type="number" size="" value="" id="mySelect" onchange="myFunction()" name="qty" min="1" max="999" ><input type="submit" name="ad" value="save"></td>
                  <?php     
                  if (isset($_GET['ad'])   ) {
                    $qty=$_GET['qty'];
                    $fd = $_GET['fd'];
                    
                    $update_qty = "update cart set qty ='$qty' where p_id= '$fd' ";
                    $run_qty = mysqli_query($con , $update_qty);
                  }  ?>
                

               
                <td><?php 

                $q_qty= "select * from cart where ip_add='$ip' AND p_id = '$product_id' ";
                $run_q_qty= mysqli_query($con,$q_qty);
                if ($row_qty = mysqli_fetch_array($run_q_qty)) {
                  $qty = $row_qty['qty'];
                }

                $total= $total + ($product_price*$qty);
                echo '&#8377;'.$product_price.'x';
                echo $qty.'<br>'; ?></td>
              </tr>
              </form>
              <?php  }

                } ?>
                <tr >
                <td></td>
                <td></td>
                <td></td>
                  <td ><b>Sub Total :</b></td>
                  <td > <?php 
                  
                  echo '&#8377;'.$total; ?> </td>
                </tr>
                </tbody>
              </table>
              <div class="pull-right" style="margin-right: 40px;" >
               
              <button class="" ><a style="text-decoration: none; color: inherit;" href="index.php">Continue to Shopping</a></button>
              <button class="" ><a style="text-decoration: none; color: inherit;" href="checkout.php">Checkout</a></button>
              </div>
  
    <?php 

    $ip = getIp();
    if (isset($_GET['del']) ) {
        $remove_id=$_GET['del'];
        echo $remove_id;
        $delete_product = "delete from cart where p_id ='$remove_id' AND ip_add='$ip' ";
        $run_delete = mysqli_query($con,$delete_product);
        
      
      if ($run_delete) {
        echo "<script>window.open('cart.php','_self')</script> ";
      }
    }
      
    ?>
</div>







          </div>
        </div>
    </div>
</div>
<script>
function myFunction() {
    document.getElementById("demo").HTML = " ";
}
</script>

<script type="text/javascript" src="js/jquery-2.1.4.min.js" ></script>
<script type="text/javascript" src="js/bootstrap.min.js" ></script>

<script type="text/javascript" src="js/script.js" ></script>
</div>
</body>
</html>