<?php 
  include('dbconn.php');
  session_start();
?>

<!doctype html>
<html lang="en">
   

<head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <meta name="description" content="">
      <meta name="author" content="">
      <link rel="icon" href="images/logo.png">
      <title>AgriCon - Feed</title>
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
                    <li> <a class="search-icon" href="#search"> <i class="fas fa-search"></i> </a> </li>
                    <li class="dropdown">
                        <a class="cart-icon" href="#" role="button" id="cartdropdown" data-toggle="dropdown"> <i class="fas fa-shopping-cart"></i></a>
                        <div class="dropdown-menu cart-box" aria-labelledby="cartdropdown">
                            Recently added item(s)
                            <ul class="list">
                                <li class="item">
                                <a href="#" class="preview-image"><img class="preview" src="images/pro.jpg" alt=""></a>
                                <div class="description"> <a href="#">Sample Product 1</a> <strong class="price">1 x P50.95</strong> </div>
                                </li>
                                <li class="item">
                                <a href="#" class="preview-image"><img class="preview" src="images/pro.jpg" alt=""></a>
                                <div class="description"> <a href="#">Sample Product 2</a> <strong class="price">2 x P144.00</strong> </div>
                                </li>
                            </ul>
                            <div class="total">Total: <strong>P244.95</strong></div>
                            <div class="view-link"><a href="#">Proceed to Checkout</a> <a href="#">View cart </a></div>
                        </div>
                    </li>
                    <li class="login-reg"> <a href="my_account.php">My Account</a> | <a href="index.php">Logout</a> </li>
                  </ul>
               </div>
            </nav>
         </header>
         <div id="search">
            <button type="button" class="close">×</button>
            <form class="search-overlay-form">
               <input type="search" value="" placeholder="type keyword(s) here" />
               <button type="submit" class="btn btn-primary"><i class="fas fa-search"></i></button>
            </form>
         </div>
         <!--Header End-->
         <!--Inner Header Start-->
         <section class="wf100 p100 inner-header">
            <div class="container">
               <h1>AgriCon Mart Feed</h1>
            </div>
         </section>
         <!--Inner Header End--> 
         <!--Causes Start-->
         <section class="wf100 p80 blog">
            <div class="causes-listing">
               <div class="container">
                     <?php 
                        $query = "SELECT * FROM feed";
                        $result = mysqli_query($conn, $query);
                        while ($row = mysqli_fetch_array($result)) {
                           
                     ?>

                     <div class="campaign-box">
                           <div class="campaign-thumb"> <a href="shop_details.php"><i class="fas fa-link"></i></a> <img src="./seller/<?php echo $row['image'] ?>" alt=""> </div>
                           <div class="campaign-txt">
                              <h4><a href="shop_details.php"><?php echo $row['shop'] ?></a></h4>
                              <h5><?php echo $row['header'] ?></h5>
                              <p><?php echo $row['description'] ?></p>
                              <a href="shop_details.php" class="dn-btn">Visit Shop</a> 
                           </div>
                     </div>

                     <?php } ?>
               </div>
            </div>
         </section>
         <!--Causes End--> 
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