<?php 
  include('dbconn.php');
  session_start();
?>
<!DOCTYPE html>
<html lang="en">
   

<head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <meta name="description" content="">
      <meta name="author" content="">
      <link rel="icon" href="images/logo.png">
      <title>AgriCon - Product Details</title>
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
                    <li> <a class="cart-icon" href="my_cart.php"> <i class="fas fa-shopping-cart"></i> </a> </li>
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
               <h1>Product Details</h1>
            </div>
         </section>
         <!--Inner Header End--> 
         <!--Blog Start-->
         <section class="wf100 p80 shop">
            <div class="product-details">
               <div class="container">
                  <div class="row">
                     <div class="col-md-6">
                        <div class="pro-large"><img src="images/Products/product2.jpg" alt=""></div>
                     </div>
                     <div class="col-md-6">
                        <div class="product-text">
                           <h2>General Fertilizer</h2>
                           <div class="pro-pricing">P80.00 </div>
                           <p> What is general fertilizer?
                              General and Special-Purpose Fertilizers
                              The various products labeled “general-purpose fertilizers” contain either equal amounts of each major nutrient (N-P-K ratio 12-12-12, for example) or a slightly higher percentage of nitrogen than of phosphorus and potassium (such as a 12-8-6 product).</p>
                              <form action="functions.php" method="POST" enctype="multipart/form-data">
                                 <input type="hidden" name = "imagee" value = "uploads/sample.jpg">
                                 <input type="hidden" name = "shop_name" value = "Jacool-It Company">
                                 <input type="hidden" name = "contact" value = "65448">
                                 <input type="hidden" name = "variation" value = "aasdfgdfhgh">
                                 <input type="hidden" name = "price" value = "100">
                                 <div class="add-2-cart"> <strong>Quantity:</strong>
                                    <input type="number" name="quantity" min="1" max="99" required>
                                    <a type="button" href="home.php" class="btn btn-secondary">Back</a>
                                    <button type="submit" name="add_to_cart" class="btn btn-success">Add to Cart</button>
                                 </div>
                              </form>
                           

                        </div>
                     </div>
                  </div>
                  <div class="row">
                     <div class="col-md-12">
                        <div class="products-tabs wf100 p80">
                           <nav>
                              <div class="nav nav-tabs" id="nav-tab" role="tablist"> <a class="nav-item nav-link active" id="nav-one-tab" data-toggle="tab" href="#nav-one" role="tab" aria-controls="nav-one" aria-selected="true">Description</a> <a class="nav-item nav-link" id="nav-two-tab" data-toggle="tab" href="#nav-two" role="tab" aria-controls="nav-two" aria-selected="true">Additional Information</a> </div>
                           </nav>
                           <div class="tab-content" id="nav-tabContent">
                              <div class="tab-pane fade show active" id="nav-one" role="tabpanel" aria-labelledby="nav-one-tab">
                                 <p> What is general fertilizer?
                                    General and Special-Purpose Fertilizers
                                    
                                    The various products labeled “general-purpose fertilizers” contain either equal amounts of each major nutrient (N-P-K ratio 12-12-12, for example) or a slightly higher percentage of nitrogen than of phosphorus and potassium (such as a 12-8-6 product). </p>
                              </div>
                              <div class="tab-pane fade" id="nav-two" role="tabpanel" aria-labelledby="nav-two-tab">
                                 <table>
                                    <tr>
                                       <td>Weight</td>
                                       <td>5 kg</td>
                                    </tr>
                                    <tr>
                                       <td>Bevat</td>
                                       <td>40.0 g/kg</td>
                                    </tr>
                                    <tr>
                                       <td>N</td>
                                       <td>60.0 g/kg</td>
                                    </tr>
                                    <tr>
                                       <td>P</td>
                                       <td>40.0 g/kg</td>
                                    </tr>
                                 </table>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            <section class="online-shop wf100">
               <div class="container">
                  <div class="row">
                     <div class="col-md-12">
                        <h2>Related Products</h2>
                     </div>
                  </div>
                  <div class="row">
                     <div class="col-md-3 col-sm-6">
                        <div class="product-box">
                           <div class="pro-thumb"> <a href="#">Add To Cart</a> <img src="images/Products/product1.jpg" alt=""></div>
                           <div class="pro-txt">
                              <h6><a href="#">Powders</a></h6>
                              <p class="pro-price">P19.00</p>
                           </div>
                        </div>
                     </div>
                     <div class="col-md-3 col-sm-6">
                        <div class="product-box">
                           <div class="pro-thumb"> <a href="#">Add To Cart</a> <img src="images/Products/product3.jpg" alt=""></div>
                           <div class="pro-txt">
                              <h6><a href="#">Organic & Natural All Purpose Fertilizers</a></h6>
                              <p class="pro-price">P250.00</p>
                           </div>
                        </div>
                     </div>
                     <div class="col-md-3 col-sm-6">
                        <div class="product-box">
                           <div class="pro-thumb"> <a href="#">Add To Cart</a> <img src="images/Products/product4.jpg" alt=""></div>
                           <div class="pro-txt">
                              <h6><a href="#">Magic Gro Plus</a></h6>
                              <p class="pro-price">P75.00</p>
                           </div>
                        </div>
                     </div>
                  </div>
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
      
      <!-- <script src="js/jquery-3.3.1.min.js"></script>  -->
      <script src="js/jquery-migrate-1.4.1.min.js"></script> 
      <script src="js/popper.min.js"></script> 
      <script src="js/bootstrap.min.js"></script> 
      <script src="js/owl.carousel.min.js"></script> 
      <script src="js/jquery.prettyPhoto.js"></script> 
      <script src="js/isotope.min.js"></script> 
      <script src="js/custom.js"></script>
   </body>


</html>