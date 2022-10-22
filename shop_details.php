<?php 
  include('dbconn.php');
  session_start();
  if (!isset($_SESSION['data']['username'])) {
   header("Location: login.php");
}
?>

<!doctype html>
<html lang="en">
   

<head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <meta name="description" content="">
      <meta name="author" content="">
      <link rel="icon" href="images/logo.png">
      <title>AgriCon - Shop Details</title>
      <!-- CSS FILES START -->
      <link href="css/custom.css" rel="stylesheet">
      <link href="css/color.css" rel="stylesheet">
      <link href="css/responsive.css" rel="stylesheet">
      <link href="css/owl.carousel.min.css" rel="stylesheet">
      <link href="css/bootstrap.min.css" rel="stylesheet">
      <link href="css/prettyPhoto.css" rel="stylesheet">
      <link href="css/all.min.css" rel="stylesheet">
      <!-- CSS FILES End -->
   </head>
   <body>
      <div class="wrapper">
         <!--Header Start-->
         <header class="header-style-2">
            <nav class="navbar navbar-expand-lg">
               <a class="navbar-brand" href="home.php"><img src="images/logo.png" width="200px" alt=""></a>
               <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"> <i class="fas fa-bars"></i> </button>
               <div class="collapse navbar-collapse" id="navbarSupportedContent">
                  <ul class="navbar-nav mr-auto">
                     <li class="nav-item dropdown">
                        <a class="nav-link" href="home.php" >Home</a>
                     </li>
                     <li class="nav-item"> <a class="nav-link" href="feed_home.php">Feed</a> </li>
                     <li class="nav-item"> <a class="nav-link" href="shop_home.php">Shops</a> </li>
                     <li class="nav-item"> <a class="nav-link" href="bidding_home.php">Bidding</a> </li>
                     
                  </ul>
                  <ul class="navbar-nav mr-auto">
                  
                  <li class="dropdown">
                        <a class="cart-icon" href="my_cart.php"> <i class="fas fa-shopping-cart"></i></a>
                    </li>
                    <li class="login-reg"> <a href="my_account.php">My Account</a> | <a href="index.php">Logout</a> </li>
                  </ul>
               </div>
            </nav>
         </header>
         
         <!--Header End--> 
         <!--Inner Header Start-->
         <section class="wf100 p100 inner-header">
            <div class="container">
               <h1>Shop Details</h1>
               <?php $getid = $_GET["id"];?>
               <p class="text-white">User: <?php echo $_SESSION['data']['firstname'].' '.$_SESSION['data']['lastname']  ?></p>
            </div>
         </section>
         <!--Inner Header End--> 
         <!--Blog Start-->
         <section class="wf100 p80 shop">
            <div class="product-details">
               <div class="container">
               <?php 
                     $get_s_email = null;
                     
                     $getid = $_GET["id"];
                     $query = "SELECT * FROM shops WHERE  id = $getid";
                     $result = mysqli_query($conn, $query);
                     while ($row = mysqli_fetch_array($result)) {
                        
                  ?>
                  <div class="row">
                     <div class="col-md-6">
                        <div class="pro-large"><img src="seller/<?php echo $row['image']?>" alt=""></div>
                     </div>
                     <div class="col-md-6">
                        <div class="product-text">
                            <h2><?php echo $row['name']?></h2>
                            <p><?php echo $row['details']?></p>
                            <ul>
                                <li>Address: <?php echo $row['address']?></li>
                                <li>Contact: <?php echo $row['contact']?></li>
                                <?php $get_s_email = $row['email']?>
                            </ul>
                        </div><!---product-text---->
                     </div><!---end of col-md-6---->
                  </div><!---end of row---->
                        <?php 
                        }
                        ?>
               </div>
            </div>
            <section class="online-shop wf100 p80">
               <div class="container">
                  <div class="row">
                     <div class="col-md-12">
                        <h2>Products</h2>
                     </div>
                  </div>

                  <div class="row">
                  <?php
                  $query2 = "SELECT * FROM products WHERE  email = '$get_s_email' LIMIT 5";
                  $result2 = mysqli_query($conn, $query2);
                  while ($row2 = mysqli_fetch_array($result2)) {
                     $getID2 = "process.php?id=". $row2["id"];
                  ?>
                     <div class="col-md-3 col-sm-6">
                        <div class="product-box">
                           <div class="pro-thumb"> <a href="<?php echo $getID2?>">Add To Cart</a> 
                           <img src="seller/<?php echo $row2['image']?>" alt=""></div>
                           <div class="pro-txt">
                              <h6><a href="<?php echo $getID2?>"><?php echo $row2['product']?></a></h6>
                              <p class="pro-price">P<?php echo $row2['price']?>.00</p>
                           </div>
                        </div>
                       
                     </div>
                     <?php
                  }
                  ?>
                  </div><!-----end of row cv------>
               </div>
            </section>
         </section>
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
                     <div class="col-md-4 col-sm-4"> <img src="images/logo.png" alt=""> </div>
                  </div>
               </div>
            </div>
         </footer>
         <!--Footer End--> 
      </div>
      <!--   JS Files Start  --> 
      <script src="js/jquery-3.3.1.min.js"></script> 
      <script src="js/jquery-migrate-1.4.1.min.js"></script> 
      <script src="js/popper.min.js"></script> 
      <script src="js/bootstrap.min.js"></script> 
      <script src="js/owl.carousel.min.js"></script> 
      <script src="js/jquery.prettyPhoto.js"></script> 
      <script src="js/isotope.min.js"></script> 
      <script src="js/custom.js"></script>
   </body>


</html>