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
      <title>AgriCon - My Products</title>
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
                    <li class="login-reg"> <a href="my_account_seller.php">My Account</a> | <a href="../index.php">Logout</a> </li>
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
               <h1>My Products</h1>
               <p class="text-white">Seller: <?php echo $_SESSION['data']['firstname'],' ', $_SESSION['data']['lastname'] ?></p>
            </div>
         </section>
         <!--Inner Header End--> 
         <!--Contact Start-->
         <section class="shop wf100 p80">
            <div class="container table-responsive">
               <!-- Button trigger modal -->
               <?php 
                  $account = $_SESSION['data']['email'];
                  $query = "SELECT * FROM shops WHERE email='$account' ";
                  $result = mysqli_query($conn, $query);
                  while ($row = mysqli_fetch_array($result)) {
                  $get_shop = $row['name'];
               ?>
               <div class="row">
                  <div class="col-md-4">
                     <h5>My Current Shop: <br> <span style="color:green"><?php echo $row['name'] ?></span></h5>
                     <img src="<?php echo $row['image'] ?>" width="250px" alt="">
                  </div>
                  <div class="col-md-4">
                     <ul>
                        <li> <h6>Owner: <?php echo $row['owner'] ?></h6></li>
                        <li> <h6>Address: <?php echo $row['address'] ?></h6></li>
                        <li> <h6>Contact: <?php echo $row['contact'] ?></h6></li>
                        <li> <h6>Details: <?php echo $row['details'] ?></h6></li>
                     </ul>
                  </div>
               </div>
               <br><br>
               <?php } ?>
               <?php 
                  $account = $_SESSION['data']['username'];
                  $query = "SELECT * FROM accounts WHERE username='$account' ";
                  $result = mysqli_query($conn, $query);
                  while ($row = mysqli_fetch_array($result)) {
               ?>
               <button type="button" class="btn btn-success" data-toggle="modal" data-target="#addshop<?php echo $row['id'] ?>"> <i class="fas fa-plus"></i> Add Shop </button>
               <button type="button" class="btn btn-success" data-toggle="modal" data-target="#addproduct<?php echo $row['id'] ?>"> <i class="fas fa-plus"></i> Add Product </button>
               <br><br>
               <!-- Modal Add Shop-->
               <div class="modal fade" id="addshop<?php echo $row['id'] ?>"" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                     <div class="modal-content">
                        <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Add Shop</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                           <span aria-hidden="true">&times;</span>
                        </button>
                        </div>
                        <form method="POST" action="process.php" enctype="multipart/form-data">
                           <div class="modal-body">
                              <p><strong>*Note: 1 Shop only per account of seller*</strong></p>
                              <label for="">Owner:</label>
                              <input type="text" class="form-control" name="owner" value="<?php echo $row['firstname'] ?> <?php echo $row['middlename'] ?> <?php echo $row['lastname'] ?>" readonly>
                              <label for="">Address:</label>
                              <input type="text" class="form-control" name="address" value="<?php echo $row['address'] ?>" readonly>
                              <input type="hidden" class="form-control" name="email" value="<?php echo $row['email'] ?>">
                              <br>
                              <label for="">Upload Shop Image <span style="color:red">*</span></label>
                              <input type="file" class="form-control" name="shop_image" required>
                              <label for="">Shop Name <span style="color:red">*</span></label>
                              <input type="text" class="form-control" name="shop_name" required>
                              <label for="">Shop Contact No. <span style="color:red">*</span></label>
                              <input type="number" class="form-control" name="shop_contact" required>
                              <label for="">Shop Details <span style="color:red">*</span></label>
                              <textarea class="form-control" name="shop_det" id="" cols="30" rows="5" required></textarea>
                           </div>
                           <div class="modal-footer">
                              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                              <button type="submit" class="btn btn-success" name="addshop">Create Shop</button>
                           </div>
                        </form>
                     </div>
                  </div>
               </div>

               <!-- Modal Add Product-->
               <div class="modal fade" id="addproduct<?php echo $row['id'] ?>"" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                     <div class="modal-content">
                        <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Add Product</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                           <span aria-hidden="true">&times;</span>
                        </button>
                        </div>
                        <form method="POST" action="process.php" enctype="multipart/form-data">
                           <div class="modal-body">
                              <input type="hidden" class="form-control" name="email" value="<?php echo $row['email'] ?>">
                              <label for="">Upload Product Image <span style="color:red">*</span></label>
                              <input type="file" class="form-control" name="product_image" required>
                              <label for="">Product Name <span style="color:red">*</span></label>
                              <input type="text" class="form-control" name="product_name" required>
                              <label for="">Product Price <span style="color:red">*</span></label>
                              <input type="number" class="form-control" name="product_price" required>
                              <label for="">Quantity <span style="color:red">*</span></label>
                              <input type="number" class="form-control" name="product_quants" required>
                              <label for="">Product Details <span style="color:red">*</span></label>
                              <textarea class="form-control" name="product_det" id="" cols="30" rows="5" required></textarea>
                           </div>
                           <div class="modal-footer">
                              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                              <button type="submit" class="btn btn-success" name="addproduct">Add Product</button>
                           </div>
                        </form>
                     </div>
                  </div>
               </div>

               <?php } ?>

               <table class="table table-hover">
                  <thead>
                     <tr>
                     <th scope="col">Image</th>
                     <th scope="col">Product Name</th>
                     <th scope="col">Price</th>
                     <th scope="col">Available Stock</th>
                     <th scope="col">Description</th>
                     <th scope="col">Action</th>
                     </tr>
                  </thead>
                  <tbody>
                  <?php 
                     $account = $_SESSION['data']['email'];
                     $query = "SELECT * FROM products WHERE email='$account' ";
                     $result = mysqli_query($conn, $query);
                     while ($row = mysqli_fetch_array($result)) {
                  ?>
                     <tr>
                     <th scope="row"><img src="<?php echo $row['image'] ?>" width="70px" alt=""></th>
                     <td><?php echo $row['product'] ?></td>
                     <td>P<?php echo $row['price'] ?></td>
                     <td><?php echo $row['stock'] ?>pc/s</td>
                     <td><?php echo $row['details'] ?></td>
                     <td>
                        <button class="btn btn-primary w-100" data-toggle="modal" data-target="#editproduct<?php echo $row['id'] ?>">Edit</button>
                        <button class="btn btn-danger w-100" data-toggle="modal" data-target="#deleteproduct<?php echo $row['id'] ?>">Delete</button>
                     </td>
                     </tr>

                     <!-- Modal Edit-->
                     <div class="modal fade" id="editproduct<?php echo $row['id'] ?>"" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                           <div class="modal-content">
                              <div class="modal-header">
                              <h5 class="modal-title" id="exampleModalLabel">Edit Product: <?php echo $row['product'] ?></h5>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                 <span aria-hidden="true">&times;</span>
                              </button>
                              </div>
                              <form method="POST" action="process.php">
                                 <div class="modal-body">
                                    <input type="hidden" class="form-control" name="id" value="<?php echo $row['id'] ?>">
                                    <label for="">Product Name</label>
                                    <input type="text" class="form-control" name="product_name" value="<?php echo $row['product'] ?>">
                                    <label for="">Product Price</label>
                                    <input type="number" class="form-control" name="product_price" value="<?php echo $row['price'] ?>">
                                    <label for="">Available Stock</label>
                                    <input type="number" class="form-control" name="product_quants" value="<?php echo $row['stock'] ?>">
                                    <label for="">Product Details</label>
                                    <textarea class="form-control" name="product_det" id="" cols="30" rows="5" required><?php echo $row['details'] ?></textarea>
                                 </div>
                                 <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-success" name="update_product">Save Changes</button>
                                 </div>
                              </form>
                           </div>
                        </div>
                     </div>
                     
                     <!-- Modal Delete-->
                     <div class="modal fade" id="deleteproduct<?php echo $row['id'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                           <div class="modal-content">
                              <div class="modal-header">
                              <h5 class="modal-title" id="exampleModalLabel">Deleting Product: <?php echo $row['product'] ?></h5>
                              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                              </div>
                              <div class="modal-body">
                              <h5>Are you sure you want to delete this product?</h5>
                              <p> This Action is Irreversible!</p>
                              </div>
                              <div class="modal-footer">
                              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                              <a class="btn btn-danger" style="color:white" href="process.php?deleteProduct=<?php echo $row["id"] ?>">Delete</a>
                              </div>
                           </div>
                        </div>
                     </div>

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
      <!-- <script src="../js/custom.js"></script> -->
   </body>

</html>