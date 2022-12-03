<?php 
   include('../dbconn.php');
   session_start();
   error_reporting(0);
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
      <title>AgriCon - Order Requests</title>
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
                        <a class="cart-icon" href="my_cart_seller.php"> <i class="fas fa-shopping-cart"></i></a>
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
               <h1>Order Requests</h1>
               <p class="text-white">Seller: <?php echo $_SESSION['data']['firstname'],' ', $_SESSION['data']['lastname'] ?></p>
            </div>
         </section>
         <!--Inner Header End--> 
         <!--Contact Start-->
         <section class="shop wf100 p80">
            <div class="container">
               <div class="section-title-2 text-center">
                  <h2>Order Requests</h2>
               </div>
               <div class="row">
               <?php 
                  $get_email = $_SESSION['data']['email'];
                  $query = "SELECT * FROM checkout where email = '$get_email' and status = 'PENDING'";
                  $result = mysqli_query($conn, $query);
                  $check = mysqli_num_rows($result);
                  if ($check == 0 or $check == null) {
                     echo "<center><h5> No Requests in the Database</h5></center>";
                  }
                  else {
                  while ($row = mysqli_fetch_array($result)) {
               ?>
                  <div class="col-lg-3 col-sm-6">
                     <div class="product-box">
                        <div class="pro-thumb"> <img src="<?php echo $row['imagee'] ?>" alt=""></div>
                        <div class="pro-txt">
                           <h6><a href="#"><?php echo $row['product_name'] ?></a></h6>
                           <p class="pro-price">P<?php echo $row['price'] ?>.00</p>
                        </div>
                        <!-- <a href="" class="btn btn-success w-100">View Request</a> -->
                        <button type="button" class="btn btn-success w-100" data-toggle="modal" data-target="#order<?php echo $row['id'] ?>">
                        View Requests
                        </button>

                     </div>
                  </div>


                  <!-- Modal -->
                  <div class="modal fade bd-example-modal-lg" id="order<?php echo $row['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog modal-lg" role="document">
                     <div class="modal-content">
                        <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Order Request for <?php echo $row['product_name'] ?></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                           <span aria-hidden="true">&times;</span>
                        </button>
                        </div>
                        <div class="modal-body">
                           <div class="row">
                           <div class="container-fluid">
                              <table class="table table-hover table-responsive">
                              <thead>
                              <tr>
                                 <th scope="col">Buyer's Image</th>
                                 <th scope="col">Buyer's Name</th>
                                 <th scope="col">Delivery Address</th>
                                 <th scope="col">Quantity</th>
                                 <th scope="col">Product Price</th>
                                 <th scope="col">Total Price</th>
                                 <th scope="col">Action</th>
                                 
                              </tr>
                              </thead>
                              <tbody>
                                 <?php
                                 $id = $row['product_id'];

                                 $populate_data="SELECT * FROM checkout where product_id = $id and status = 'PENDING'";
                                 
                                 $prompt = mysqli_query($conn, $populate_data);
                                 foreach ($prompt as $p_row) {
                                    $getID1 = "process.php?approve_product_id=".$id."&quantity=".$p_row['quantity']."&cart_id=".$p_row['id'];
                                    $getID2 = "process.php?reject_cart_id=".$p_row['id'];
                                 ?>
                              <tr>
                                 <?php
                                 $query1 = "SELECT * FROM accounts where id =". $row['user_id'];
                                 $result1 = mysqli_query($conn, $query1);
                                 while ($row1 = mysqli_fetch_array($result1)) {
                                 ?>
                                 <th scope="row"><img src="../<?php echo $row1['valid_id'];?>" width="70px" alt=""></th>
                                 <td><?php echo $row1['firstname']." ".$row1['middlename']." ".$row1['lastname'];?></td>
                                 <td><?php echo $row1['delivery_address'];?></td>
                                 <?php
                                 }
                                 ?>
                                 <td><?= $p_row['quantity'];?>pc/s</td>
                                 <td>P<?= $p_row['price'];?>.00</td>
                                 <td>P<?= $p_row['total'];?>.00</td>
                                 
                                 <td scope = "col">
                                 <a href = "<?php echo $getID1?>"type="button" class="btn btn-primary sm">
                                       Approve
                                 </a>
                                 <a href = "<?php echo $getID2?>" type="button" class="btn btn-danger">
                                       Reject   
                                 </a>   
                                 </td>
                                 
                              </tr>
                              <?php
                                 }
                              ?>
                              </tbody>
                           </table>
                           </div>
                           </div>
                        
                        </div>
                        <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>
                     </div>
                  </div>
                  </div>
                  <!---end of modal-->
                  <?php
                  }
               }
                  ?>
               </div>
            </div>
         </section>
         <section class="shop wf100 p80">
            <div class="container">
                <h3>History</h3>
                <table class="table table-hover">
                    <thead>
                    <tr>                                
                        <th scope="col">Image</th>
                        <th scope="col">Product Name</th>
                        <th scope="col">Shop Name</th>
                        <th scope="col">Contact</th>
                        <th scope="col">Quantity</th>
                        <th scope="col">Price</th>
                        <th scope="col">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                     <?php 
                        $get_email = $_SESSION['data']['email'];
                        $query = "SELECT * FROM shops where email='$get_email'";
                        $result = mysqli_query($conn, $query);
                        $check = mysqli_num_rows($result);
                        while ($row = mysqli_fetch_array($result)) {
                           $get_shop = $row['name'];
                        }
                     ?>
                        <?php 
                           $query = "SELECT * FROM checkout where shop_name='$get_shop'";
                           $result = mysqli_query($conn, $query);
                           $check = mysqli_num_rows($result);
                           while ($row = mysqli_fetch_array($result)) {
                        ?>

                        <tr>
                           <td scope="row"><img src="<?php echo $row['imagee'] ?>" name = "image" style = "width:70px;height:80px;" alt=""></td>
                           <td><?php echo $row['product_name'] ?></td>
                           <td><?php echo $row['shop_name'] ?></td>
                           <td><?php echo $row['contact'] ?></td>
                           <td>
                              <p class="input_qty"><?php echo $row['quantity'] ?></p>pc/s
                           </td>
                              
                           <td><p>P <span class = "price"><?php echo $row['price'] ?></span>.00</p></td>
                           <td><?php echo $row['status'] ?></td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>

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
                     <div class="col-md-4 col-sm-4"> <img src="images/logo.png" alt=""> </div>
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