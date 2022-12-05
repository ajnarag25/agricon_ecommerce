<?php 
   include('../dbconn.php');
   session_start();
   if (!isset($_SESSION['data']['username'])) {
      header("Location: ../login.php");
   }
?>

<!doctype html>
<html lang="en">
   

<head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <meta name="description" content="">
      <meta name="author" content="">
      <link rel="icon" href="../images/logo.png">
      <title>AgriCon - Product Details</title>
      <!-- CSS FILES START -->
      <link href="../css/custom.css" rel="stylesheet">
      <link href="../css/color.css" rel="stylesheet">
      <link href="../css/responsive.css" rel="stylesheet">
      <link href="../css/owl.carousel.min.css" rel="stylesheet">
      <link href="../css/bootstrap.min.css" rel="stylesheet">
      <link href="../css/prettyPhoto.css" rel="stylesheet">
      <link href="../css/all.min.css" rel="stylesheet">
      <!-- CSS FILES End -->
   </head>
   <body>
      <div class="wrapper">
         <!--Header Start-->
         <header class="header-style-2">
            <nav class="navbar navbar-expand-lg">
               <a class="navbar-brand" href="home_seller.php"><img src="../images/logo.png" width="200px" alt=""></a>
               <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"> <i class="fas fa-bars"></i> </button>
               <div class="collapse navbar-collapse" id="navbarSupportedContent">
                  <ul class="navbar-nav mr-auto">
                     <li class="nav-item dropdown">
                        <a class="nav-link" href="home_seller.php" >Home</a>
                     </li>
                     <li class="nav-item"> <a class="nav-link" href="feed_seller.php">Feed</a> </li>
                     <li class="nav-item"> <a class="nav-link" href="shop_seller.php">Shops</a> </li>
                     <li class="nav-item"> <a class="nav-link" href="order_request_seller.php">Order Requests</a> </li>
                     <li class="nav-item"> <a class="nav-link" href="my_products_seller.php">My Products</a> </li>
                     <li class="nav-item"> <a class="nav-link" href="bidding_seller.php">Bidding</a> </li>
                     
                  </ul>
                  <ul class="navbar-nav mr-auto">
                    <li class="dropdown">
                        <a class="cart-icon" href="#" role="button" id="cartdropdown" data-toggle="dropdown"> <i class="fas fa-shopping-cart"></i></a>
                    </li>
                    <li class="login-reg"> <a href="my_account_seller.php">My Account</a> | <a href="../process.php?logout">Logout</a> </li>
                  </ul>
               </div>
            </nav>
         </header>
         <!--Header End--> 
         <!--Inner Header Start-->
         <section class="wf100 p100 inner-header">
            <div class="container">
               <h1>Product Details</h1>
            </div>
         </section>
         <!--Inner Header End--> 
         <!--Blog Start-->
         <section class="wf100 p80 shop">
            <div class="product-details">
               <div class="container">
               <?php 
                     $get_p_email = null;
                     $get_p_product = null;
                     $getid = $_GET["id"];

                     $query = "SELECT * FROM products WHERE  id = $getid";
                     $result = mysqli_query($conn, $query);
                     while ($row = mysqli_fetch_array($result)) {
                        
                  ?>
                  <div class="row">
                     <div class="col-md-6">
                        <div class="pro-large"><img style = "width:500px; height:500px;" src="<?php echo $row['image']?>" alt=""></div>
                     </div>
                     
                     <div class="col-md-6">
                        <div class="product-text">
                           <h2><?php echo $row['product']; $get_p_product = $row['product']?></h2>
                           <div class="pro-pricing">P<?php echo $row['price']?>.00 </div>
                           <p><?php echo $row['details'] ?></p>
                              <form action="process.php" method="POST" enctype="multipart/form-data">
                                 <input type="hidden" name = "email" value = "<?php echo $row['email'];$get_p_email =$row['email'] ?>">
                                 <input type="hidden" name = "imagee" value = "<?php echo $row['image']?>">
                                 <input type="hidden" name = "price" value = "<?php echo $row['price']?>">
                                 <input type="hidden" name = "product_id" value = "<?php echo $getid?>">
                                 <?php 
                                    $emailget = $row['email'];
                                    $query1 = "SELECT name,contact FROM shops WHERE email = '$emailget'";
                                    $result1 = mysqli_query($conn, $query1);
                                    while ($row1 = mysqli_fetch_array($result1)) {
                                 ?>
                                 <input type="hidden" name = "shop_name" value = "<?php echo $row1['name']; ?>">
                                 <input type="hidden" name = "contact" value = "<?php echo $row1['contact']; ?>">
                                 <input type="hidden" name = "user_idd" value = "<?php echo $_SESSION['data']['id'];?>">
                                 
                                 <?php 
                                    }
                                 ?>

                                 <?php 
                                    $query2 = "SELECT product FROM products WHERE  id = '$getid'";
                                    $result2 = mysqli_query($conn, $query2);
                                    while ($row2 = mysqli_fetch_array($result2)) {
                        
                                 ?>
                                 <input type="hidden" name = "product_name" value = "<?php echo $row2['product']; ?>">
                                 <?php 
                                    }
                                 ?>
                                 <div class="add-2-cart"> <strong>Quantity:</strong>
                                    <input type="number" name="quantity" value = "1" min="1" max="<?php echo $row['stock']?>">
                                    <a type="button" href="home_seller.php" class="btn btn-secondary">Back</a>
                                    <button type="submit" name="add_to_cart" class="btn btn-success">Add to Cart</button>
                                 </div>
                              </form>
                           

                        </div>
                     </div><!---end of col-md-6--->
                     <?php
                     }
                     ?>
                  </div><!----end of row--->
               </div> <!---end of container----->
            </div><!---end of product details----->
            <section class="online-shop wf100">
               <div class="container">
                  <div class="row">
                     <div class="col-md-12">
                        <h2>Related Products</h2>
                     </div>
                  </div>

                  <div class="row">
                  <?php
                  $query2 = "SELECT * FROM products WHERE  email = '$get_p_email' AND product <> '$get_p_product' LIMIT 5";
                  $result2 = mysqli_query($conn, $query2);
                  while ($row2 = mysqli_fetch_array($result2)) {
                     $getID2 = "process.php?id=". $row2["id"];
                  ?>
                     <div class="col-md-3 col-sm-6">
                        <div class="product-box">
                           <div class="pro-thumb"> <a href="<?php echo $getID2?>">Add To Cart</a> <img style= "width = 300px; height: 300px" src="<?php echo $row2['image']?>" alt=""></div>
                           <div class="pro-txt">
                              <h6><a href="<?php echo $getID2?>"><?php echo $row2['product']?></a></h6>
                              <p class="pro-price"><?php echo $row2['price']?></p>
                           </div>
                        </div>
                     </div>
                     <?php 
                  }
                  ?>
                  </div><!---end of row----->


               </div>
            </section>
         </section><!---end of section cv-->
         <!--Blog End--> 
         <!--Footer Start-->
         <footer class="footer">
            <div class="footer-top wf100">
               <div class="container">
                  <div class="row">
                     <div class="col-lg-4 col-md-8 col-sm-8">
                        <!--Footer Widget Start-->
                        <div class="footer-widget">
                           <h4>Company</h4>
                           <p> AgriCon Mart is the first and only e-commerce platform exclusively in Oriental Mindoro. </p>
                           <a href="#" class="lm" data-toggle="modal" data-target="#aboutus">About us</a> 
                        </div>
                        <!-- Modal -->
                        <div class="modal fade" id="aboutus" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                           <div class="modal-dialog" role="document">
                           <div class="modal-content">
                              <div class="modal-header">
                                 <h5 class="modal-title" id="exampleModalLabel">About Us</h5>
                                 <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                 <span aria-hidden="true">&times;</span>
                                 </button>
                              </div>
                              <?php 
                                 $query = "SELECT * FROM admin";
                                 $result = mysqli_query($conn, $query);
                                 while ($row = mysqli_fetch_array($result)) {

                              ?>
                              <div class="modal-body">
                                 <p><?php echo $row['about'] ?></p>
                              </div>
                              <?php } ?>
                           </div>
                           </div>
                        </div>
                        <!--Footer Widget End--> 
                     </div>
                     <div class="col-lg-4 col-md-8 col-sm-8">
                        <!--Footer Widget Start-->
                        <div class="footer-widget">
                           <h4>Information</h4>
                           <ul class="">
                              <li><a href="#">My Account</a></li>
                              <li><a href="#">Terms and Conditions</a></li>
                              <li><a href="#">Buying Guide </a></li>
                           </ul>
                        </div>
                        <!--Footer Widget End--> 
                     </div>
                     <div class="col-lg-4 col-md-8 col-sm-8">
                        <!--Footer Widget Start-->
                        <div class="footer-widget">
                           <h4>Contact Us</h4>
                           <p>Mobile: +630369450548</p>
                           <p>Email: cristcastillo14@gmail.com</p>
                        </div>
                        <!--Footer Widget End--> 
                     </div>
                  </div>
               </div>
            </div>
            <div class="footer-copyr wf100">
               <div class="container">
                  <div class="row">
                     <div class="col-md-4 col-sm-4"> <img src="../images/logo.png" alt=""> </div>
                  </div>
               </div>
            </div>
         </footer>
         <!--Footer End--> 
      </div>
      <!--   JS Files Start  --> 
      <script src="../js/jquery-3.3.1.min.js"></script> 
      <script src="../js/jquery-migrate-1.4.1.min.js"></script> 
      <script src="../js/popper.min.js"></script> 
      <script src="../js/bootstrap.min.js"></script> 
      <script src="../js/owl.carousel.min.js"></script> 
      <script src="../js/jquery.prettyPhoto.js"></script> 
      <script src="../js/isotope.min.js"></script> 
      <script src="../js/custom.js"></script>
   </body>


</html>