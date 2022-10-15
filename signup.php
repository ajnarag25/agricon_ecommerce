<!doctype html>
<html lang="en">
   

<head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <meta name="description" content="">
      <meta name="author" content="">
      <link rel="icon" href="images/logo.png">
      <title>AgriCon - Signup</title>
      <!-- CSS FILES START -->
      <link href="css/custom.css" rel="stylesheet">
      <link href="css/color.css" rel="stylesheet">
      <link href="css/responsive.css" rel="stylesheet">
      <link href="css/owl.carousel.min.css" rel="stylesheet">
      <link href="css/bootstrap.min.css" rel="stylesheet">
      <link href="css/prettyPhoto.css" rel="stylesheet">
      <link href="css/all.min.css" rel="stylesheet">
      <link href="https://fonts.googleapis.com/css2?family=Rubik&display=swap" rel="stylesheet">
      <!-- CSS FILES End -->
   </head>
   <body>
      <div class="wrapper">
         <!--Header Start-->
         <header class="header-style-2">
            <nav class="navbar navbar-expand-lg">
               <a class="navbar-brand" href="index.php"><img src="images/logo.png" width="200px" alt=""></a>
               <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"> <i class="fas fa-bars"></i> </button>
               <div class="collapse navbar-collapse" id="navbarSupportedContent">
                  <ul class="navbar-nav mr-auto">
                     <li class="nav-item dropdown">
                        <a class="nav-link" href="index.php" >Home</a>
                     </li>
                     <li class="nav-item"> <a class="nav-link" href="shop.php">Shops</a> </li>
                     <li class="nav-item"> <a class="nav-link" href="bidding.php">Bidding</a> </li>
                     
                  </ul>
                  <ul class="navbar-nav mr-auto">
                     <li class="nav-item"> <a href="login.php" class="nav-link">Login</a> </li>
                     <li class="nav-item"><a href="signup.php" class="nav-link">Signup</a></li>
                  </ul>
               </div>
            </nav>
         </header>
         <!--Header End-->
         <!--Inner Header Start-->
         <section class="wf100 p100 inner-header">
            <div class="container">
               <h1>Signup</h1>
            </div>
         </section>
         <!--Inner Header End--> 
         <!--Causes Start-->
         <section class="wf100 p80">
            <div class="container">
                <div class="myaccount-form">
                    <h3>Register Your Account</h3>
                    <form method="POST" action="process.php" enctype="multipart/form-data">
                        <ul class="row">
                            <li class="col-md-4">
                              <label for="">Firstname <span style="color:red">*</span></label>
                              <div class="input-group">
                              <input type="text" class="form-control" name="fname" placeholder="Enter First Name" required>
                              </div>
                            </li>
                            <li class="col-md-4">
                              <label for="">Middlename <span style="color:red">*</span></label>
                              <div class="input-group">
                              <input type="text" class="form-control" name="mname" placeholder="Enter Middle Name" required>
                              </div>
                            </li>
                            <li class="col-md-4">
                              <label for="">Lastname <span style="color:red">*</span></label>
                              <div class="input-group">
                              <input type="text" class="form-control" name="lname" placeholder="Enter Lastname" required>
                              </div>
                            </li>
                            <li class="col-md-6">
                              <label for="">Username <span style="color:red">*</span></label>
                              <div class="input-group">
                              <input type="text" class="form-control" name="uname" placeholder="Enter Username" required>
                              </div>
                            </li>
                            <li class="col-md-6">
                              <label for="">Email <span style="color:red">*</span></label>
                              <div class="input-group">
                              <input type="email" class="form-control" name="email" placeholder="Enter Email" required>
                              </div>
                            </li>
                            <li class="col-md-6">
                              <label for="">Address <span style="color:red">*</span></label>
                              <div class="input-group">
                              <input type="text" class="form-control" name="address" placeholder="Enter Address" required>
                              </div>
                            </li>
                            <li class="col-md-6">
                              <label for="">Birthday <span style="color:red">*</span></label>
                              <div class="input-group">
                              <input type="date" class="form-control" name="birthday" placeholder="Enter Birthday" required>
                              </div>
                            </li>
                            <li class="col-md-4">
                              <label for="">Upload a picture of your valid ID for KYC verification <span style="color:red">*</span></label>
                              <br>
                              <input type="file" name="valid_id" required>
                            </li>
                            <li class="col-md-4">
                              <label for="">Password <span style="color:red">*</span></label>
                              <div class="input-group">
                              <input type="password" name="pass1" class="form-control" placeholder="Enter Password" required>
                              </div>
                            </li>
                            <li class="col-md-4">
                              <label for="">Retype Password <span style="color:red">*</span></label>
                              <div class="input-group">
                              <input type="password" name="pass2" class="form-control" placeholder="Retype Password" required>
                              </div>
                            </li>
                            <li class="col-md-4">
                              <label for="">Register as <span style="color:red">*</span></label>
                              <div class="input-group">
                                 <select class="form-control" name="type" id="" required>
                                    <option value="" selected disabled>Please Choose</option>
                                    <option value="USER">User</option>
                                    <option value="SELLER">Seller</option>
                                 </select>
                              </div>
                            </li>
                            <li class="col-md-8">
                              <label for="">Delivery Address <span style="color:red">*</span></label>
                              <div class="input-group">
                              <textarea class="form-control" name="del_address" placeholder="Delivery Address" id="" cols="30" rows="5" required></textarea>
                              </div>
                            </li>
                            <li class="col-md-12">
                              <div class="input-group form-check">
                              <input type="checkbox" class="form-check-input" id="exampleCheck1" required>
                              <label class="form-check-label" for="exampleCheck1">I agree to the Terms of <a href="#">Services & Privacy Plicy</a></label>
                              </div>
                            </li>
                            <li class="col-md-12">
                              <button type="submit" name="signup" class="register">Register Your Account</button>
                            </li>
                        </ul>
                       
                    </form>
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
                              <div class="modal-body">
                                 <p>AgriCon Mart is the first and only e-commerce platform exclusively in Oriental Mindoro. 
                                    <br><br>
                                    Launched in 2022, it is a platform specialized for the province, abling the customers enjoy an easy, fast, and secured online purchasing of agricultural and construction or hardware products.
                                    <br><br>
                                    AgriCon Mart believes that those types of products should be easily accessible. This is the vision we aspire to deliver and the Mindoreños deserve.
                                 </p>
                              </div>
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
