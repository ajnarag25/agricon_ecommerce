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
      <title>AgriCon - My Account</title>
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
                        <a class="cart-icon" href="my_cart_seller.php" > <i class="fas fa-shopping-cart"></i></a>
                    </li>
                    <li class="login-reg"> <a href="my_account_seller.php">My Account</a> | <a href="../process.php?logout">Logout</a> </li>
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
               <h1>My Account</h1>
               <p class="text-white">Seller: <?php echo $_SESSION['data']['firstname'],' ', $_SESSION['data']['lastname'] ?></p>
            </div>
         </section>
         <!--Inner Header End--> 
         <!--Contact Start-->
         <section class="shop wf100 p80">
            <div class="container">
               <div class="row">
                  <!--Pro Box Start-->
                  <div class="col-lg-3 col-md-4">
                    <div class="sidebar">
                        <div class="product-box">
                            <div class="pro-thumb">
                            <form method="POST" action="../process.php" enctype="multipart/form-data">
                              <a href="#">
                                 <input type="file" name="valid_id" class="btn btn-success w-100" required>
                              </a>
                              <?php 
                                    $account = $_SESSION['data']['username'];
                                    $query = "SELECT * FROM accounts WHERE username='$account' ";
                                    $result = mysqli_query($conn, $query);
                                    while ($row = mysqli_fetch_array($result)) {
                                 ?>
                              <img src="../<?php echo $row['valid_id']; ?>" alt=""></div>
                              <input type="hidden" value="<?php echo $row['id'] ?>" name="id">
                              <?php }; ?>
                              <br>
                              <p class="text-center">My Valid I.D</p>
                              <button type="submit" name="update_profile_seller" class="btn btn-success w-100">Upload Image</button>
                            </form>
                        </div>
                        <ul>
                            <li><a href="my_account_seller.php">My Account</a></li>
                            <li><a href="my_purchases_seller.php">My Purchases</a></li>
                        </ul>
                      
                    </div>
                  </div>
                  <!--Pro Box End--> 
                  <div class="col-lg-9 col-md-8">
                    <h3>My Account</h3>
                    <p>Edit your profile here</p>
                    <div class="myaccount-form">
                        <?php 
                           $account = $_SESSION['data']['username'];
                           $query = "SELECT * FROM accounts WHERE username='$account' ";
                           $result = mysqli_query($conn, $query);
                           while ($row = mysqli_fetch_array($result)) {
                        ?>
                        <form method="POST" action="process.php">
                            <ul class="row">
                              <li class="col-md-4">
                                 <label for="">Firstname</label>
                                 <div class="input-group">
                                 <input type="text" class="form-control" name="fname" value="<?php echo $row['firstname'] ?>" required>
                                 </div>
                              </li>
                              <li class="col-md-4">
                                 <label for="">Middlename</label>
                                 <div class="input-group">
                                 <input type="text" class="form-control" name="mname" value="<?php echo $row['middlename'] ?>" required>
                                 </div>
                              </li>
                              <li class="col-md-4">
                                 <label for="">Lastname</label>
                                 <div class="input-group">
                                 <input type="text" class="form-control" name="lname" value="<?php echo $row['lastname'] ?>" required>
                                 </div>
                              </li>
                              <li class="col-md-6">
                                 <label for="">Username</label>
                                 <div class="input-group">
                                 <input type="text" class="form-control" name="uname" value="<?php echo $row['username'] ?>" required>
                                 </div>
                              </li>
                              <li class="col-md-6">
                                 <label for="">Email</label>
                                 <div class="input-group">
                                 <input type="email" class="form-control" name="email" value="<?php echo $row['email'] ?>" required>
                                 </div>
                              </li>
                              <li class="col-md-6">
                                 <label for="">Address</label>
                                 <div class="input-group">
                                 <input type="text" class="form-control" name="address" value="<?php echo $row['address'] ?>" required>
                                 </div>
                              </li>
                              <li class="col-md-6">
                                 <label for="">Birthday</label>
                                 <div class="input-group">
                                 <input type="text" class="form-control" name="birthday" value="<?php echo $row['birthday'] ?>" required>
                                 </div>
                              </li>
                              <li class="col-md-12">
                                 <label for="">Delivery Address</label>
                                 <div class="input-group">
                                 <textarea class="form-control" name="del_address" value="<?php echo $row['delivery_address'] ?>" id="" cols="30" rows="5" required><?php echo $row['delivery_address'] ?></textarea>
                                 </div>
                              </li>
                              <li class="col-md-12">
                                 <button type="button" class="register" data-toggle="modal" data-target="#update<?php echo $row['id'] ?>">Save Changes</button>
                              </li>
                            </ul>

                        <!-- Modal -->
                        <div class="modal fade" id="update<?php echo $row['id'] ?>" tabindex="-1" role="dialog" aria-hidden="true">
                           <div class="modal-dialog" role="document">
                              <div class="modal-content">
                                 <div class="modal-header">
                                    <h5 class="modal-title">Update Account</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                 </div>
                                 <div class="modal-body">
                                    <p>Updating Account of Seller: <?php echo $row['firstname'], ' ', $row['lastname'] ?></p>
                                    <h5>Are you sure to update your account?</h5>
                                 </div>
                                 <div class="modal-footer">
                                    <input type="hidden" value="<?php echo $row['id'] ?>" name="id">
                                    <button class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="submit" name="update_seller" class="btn btn-success">Update</button>
                                 </div>
                              </div>
                           </div>
                        </div>

                        </form>

                        <?php } ?>
                        <br><br>
                        
                        <?php 
                           $account = $_SESSION['data']['username'];
                           $query = "SELECT * FROM accounts WHERE username='$account' ";
                           $result = mysqli_query($conn, $query);
                           while ($row = mysqli_fetch_array($result)) {
                        ?>
                        <form method="POST" action="process.php">
                           <ul class="row">
                              <li class="col-md-6">
                                 <label for="">New Password</label>
                                 <div class="input-group">
                                 <input type="password" class="form-control" name="pass1" placeholder="Enter New Password" required>
                                 </div>
                              </li>
                              <li class="col-md-6">
                                 <label for="">Retype Password</label>
                                 <div class="input-group">
                                 <input type="password" class="form-control" name="pass2" placeholder="Retype Password" required>
                                 </div>
                              </li>
                              <li class="col-md-12">
                                 <button type="button" class="register" data-toggle="modal" data-target="#changepass<?php echo $row['id'] ?>">Change Password</button>
                              </li>
                           </ul>

                           <!-- Modal -->
                           <div class="modal fade" id="changepass<?php echo $row['id'] ?>" tabindex="-1" role="dialog" aria-hidden="true">
                              <div class="modal-dialog" role="document">
                                 <div class="modal-content">
                                    <div class="modal-header">
                                       <h5 class="modal-title">Update Password</h5>
                                       <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                       <span aria-hidden="true">&times;</span>
                                       </button>
                                    </div>
                                    <div class="modal-body">
                                       <p>Updating Password Account of Seller: <?php echo $row['firstname'], ' ', $row['lastname'] ?></p>
                                       <h5>Are you sure to update your account password?</h5>
                                       <p>You will be automatically logout and kindly login your new password account. This action is irreversible!</p>
                                    </div>
                                    <div class="modal-footer">
                                       <input type="hidden" value="<?php echo $row['id'] ?>" name="id">
                                       <button class="btn btn-secondary" data-dismiss="modal">Close</button>
                                       <button type="submit" name="update_password_seller" class="btn btn-success">Update</button>
                                    </div>
                                 </div>
                              </div>
                           </div>

                        <?php } ?>
                        </form>

                    </div>
                  </div>
                  <!--Pro Box End--> 

               </div>
            </div>
         </section>
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
      <!-- <script src="../js/custom.js"></script> -->
   </body>

</html>