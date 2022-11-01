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
      <title>AgriCon - My Purchases</title>
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
               <a class="navbar-brand" href="homephphtml"><img src="images/logo.png" width="200px" alt=""></a>
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
               <h1>My Purchases</h1>
               <p class="text-white">User: <?php echo $_SESSION['data']['firstname'].' '.$_SESSION['data']['lastname']  ?></p>
            </div>
         </section>
         <!--Inner Header End--> 
         <section class="shop wf100 p80">
            <div class="container">
               <div class="row">
                  <!--Pro Box Start-->
                  <div class="col-lg-3 col-md-4">
                    <div class="sidebar">
                        <div class="product-box">
                            <div class="pro-thumb">
                            <form method="POST" action="process.php" enctype="multipart/form-data">
                              <a href="#">
                                 <input type="file" name="valid_id" class="btn btn-success w-100" required>
                              </a>
                              <?php 
                                    $account = $_SESSION['data']['username'];
                                    $query = "SELECT * FROM accounts WHERE username='$account' ";
                                    $result = mysqli_query($conn, $query);
                                    while ($row = mysqli_fetch_array($result)) {
                                 ?>
                              <img src="<?php echo $row['valid_id']; ?>" alt=""></div>
                              <input type="hidden" value="<?php echo $row['id'] ?>" name="id">
                              <?php }; ?>
                              <br>
                              <p class="text-center">My Valid I.D</p>
                              <button type="submit" name="update_profile" class="btn btn-success w-100">Upload Image</button>
                            </form>
                        </div>
                        <ul>
                            <li><a href="my_account.php">My Account</a></li>
                            <li><a href="my_purchases.php">My Purchases</a></li>
                        </ul>
                      
                    </div>
                  </div>
                  <!--Pro Box End--> 
                  <!--Pro Box Start-->
                  <div class="col-lg-9 col-md-8">
                    <h3>My Purchases</h3>
                    <p>View all your purchases</p>
                    <table class="table table-hover table-responsive">
                        <thead>
                          <tr>
                            <th scope="col">Image</th>
                            <th scope="col">Shop Name</th>
                            <th scope="col">Contact</th>
                            <th scope="col">Product Name</th>
                            <th scope="col">Quantity</th>
                            <th scope="col">Product Price</th>
                            <th scope="col">Total Price</th>
                            <th scope="col">Status</th>
                            <th scope="col">Action</th>
                           
                          </tr>
                        </thead>
                        <tbody>
                           <?php
                           $user_id = $_SESSION['data']['id'];
                           $populate_data="SELECT * FROM checkout where USER_ID = $user_id";
                           $prompt = mysqli_query($conn, $populate_data);
                           foreach ($prompt as $p_row) {
                           ?>
                          <tr>
                            <th scope="row"><img src="seller/<?= $p_row['imagee'];?>" width="70px" alt=""></th>
                            <td><?= $p_row['shop_name'];?></td>
                            <td><?= $p_row['contact'];?></td>
                            <td><?= $p_row['product_name'];?></td>
                            <td><?= $p_row['quantity'];?>pc/s</td>
                            <td>P<?= $p_row['price'];?>.00</td>
                            <td>P<?= $p_row['total'];?>.00</td>
                            <td><?= $p_row['status'];?></td>
                            <?php
                            if ($p_row['status']== "PENDING" or $p_row['status']== "RECEIVED" or $p_row['status']== "REJECT") {
                            
                            ?>
                            <td>
                            <?php $getID_del = "process.php?del_purchase=". $p_row["id"];?>
                           <a href = "<?php echo $getID_del?>" type="submit" class="bura btn btn-danger">Delete</a>
                           </td>
                           <?php
                            }elseif ($p_row['status']== "TO RECEIVE") {
                              ?>
                                 <td>
                                 <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#rateModal<?php echo $p_row['id']?>">Order Received</button>
                           </td>
                           <?php
                            }
                           ?>
                          </tr>
                          <!-- Modal -->
                           <div class="modal fade" id="rateModal<?php echo $p_row['id']?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                           <div class="modal-dialog" role="document">
                              <div class="modal-content">
                                 <div class="modal-header">
                                 <h5 class="modal-title" id="exampleModalLabel">Rate and Comment</h5>
                                 <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                 </button>
                                 </div>
                                 <div class="modal-body">
                                    <form action="process.php" method="post">
                                    <input type="hidden" name = "id" value ='<?php echo $p_row['id'];?>'>
                                       <input type="hidden" name = "user_id" value ='<?php echo $user_id?>'>
                                       <input type="hidden" name = "product_id" value ='<?php echo $p_row['product_id'];?>'>
                                       <label class="form-label" for="ratee">Rate:*</label>
                                       <br>
                                       <select id = "ratee" name = "rates" class="selectpicker show-menu-arrow" data-style="btn-info">
                                          <option value = "5">5</option>
                                          <option value = "4">4</option>
                                          <option value = "3">3</option>
                                          <option value = "2">2</option>
                                          <option value = "1">1</option>
                                       </select>
                                       <div class="form-outline">
                                       <label class="form-label" for="comment">Write a Comment:*</label>
                                       <textarea class="form-control" name="comment" id="comment" rows="5" placeholder = "What's your Insight?" required></textarea>
                                       </div><!----end of form outline.comment------>
                                       </div>
                                       <div class="modal-footer">
                                       <?php $getID_no_comment = "process.php?no_comment=". $p_row["id"];?>
                                       <a href = "<?php echo $getID_no_comment ?>" type="submit" class="bura btn btn-danger">Leave No Comment</a>
                                       <button type="submit" name = "comment_rate" class="btn btn-primary">Send</button>
                                       </div><!-----end of modal footer----->
                                    </form>
                              </div><!----end of modal content------>
                           </div>
                           </div>
                          <?php
                           }
                          ?>
                        </tbody>
                      </table>
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
                     <div class="col-md-4 col-sm-4"> <img src="images/logo.png" alt=""> </div>
                  </div>
               </div>
            </div>
         </footer>
         <!--Footer End--> 
      </div>

      <!--   JS Files Start  --> 
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
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