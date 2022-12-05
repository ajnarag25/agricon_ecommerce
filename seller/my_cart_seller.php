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
      <title>AgriCon - My Cart</title>
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
               <h1>My Cart</h1>
               <p class="text-white">Seller: <?php echo $_SESSION['data']['firstname'].' '.$_SESSION['data']['lastname']  ?></p>
            </div>
         </section>
         <!--Inner Header End--> 
         <!--Contact Start-->
         <section class="shop wf100 p80">
            <div class="container">
                <h3>My Cart</h3>
                <table class="table table-hover">
                    <thead>
                    <tr>                                
                        <th scope="col">#</th>
                        <th scope="col">Image</th>
                        <th scope="col">Product Name</th>
                        <th scope="col">Shop Name</th>
                        <th scope="col">Contact</th>
                        <th scope="col">Quantity</th>
                        <th scope="col">Price</th>
                        <th scope="col">Subtotal</th>
                        <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                           $user_id = $_SESSION['data']['id'];
                           $populate_data="SELECT id,imagee,product_name,shop_name,contact,quantity,price,product_id FROM cart where USER_ID = $user_id";
                           $prompt = mysqli_query($conn, $populate_data);


                          foreach ($prompt as $p_row) {
                          
                          
                           //$check = mysqli_num_rows($prompt);
                        ?>
                        <tr>
                           <td><input type="checkbox" form="for_checkout" name = "purchase_id[]" class = "cb_class" onclick = "cb_func()" id = "checkbox_row" value = "<?=$p_row['id'];?>"></td>
                           <td scope="row"><img src="<?= $p_row['imagee'];?>" name = "image" style = "width:70px;height:80px;" alt=""></td>
                           <td><?= $p_row['product_name'];?></td>
                           <td><?= $p_row['shop_name'];?></td>
                           <td><?= $p_row['contact'];?></td>
                           <td>
                              <p class="input_qty"> <?= $p_row['quantity'];?></p>pc/s
                           </td>
                              
                           <td><p>P <span class = "price"><?=$p_row['price']?></span>.00</p></td>
                           <td><p>P <span class = "subtotal"></span>.00</p></td>
                           <td>
                              <?php $getID_del = "process.php?iddelzxc=". $p_row["id"];?>
                              <a href = "<?php echo $getID_del?>" type="submit" class="bura btn btn-danger"><i class="fa fa-trash me-2"></i> Delete</a>
                              <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#edit_row<?=$p_row['id'] ?>">
                                 Edit
                              </button>
                              </td>
                        </tr>
                        <!-- Modal -->
                        <div class="modal fade" id="edit_row<?=$p_row['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                           <div class="modal-content">
                              <div class="modal-header">
                              <h5 class="modal-title" id="exampleModalLabel">Edit Quantity</h5>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                 <span aria-hidden="true">&times;</span>
                              </button>
                              </div>
                              <div class="modal-body">
                                 <form method="POST" action="process.php" >

                                       <input type="hidden" name = "id" value= "<?= $p_row['id'];?>">
                                       
                                       <label for="">Product Name <span style="color:red">*</span></label>
                                       <input type="text" class="form-control" name="product_name" value= "<?= $p_row['product_name'];?>" readonly>

                                       <label for="">Shop Name <span style="color:red">*</span></label>
                                       <input type="text" class="form-control" name="shop_name" value= "<?= $p_row['shop_name'];?>" readonly>

                                       <label for="">Contact Number <span style="color:red">*</span></label>
                                       <input type="text" class="form-control" name="contact" value= "<?= $p_row['contact'];?>" readonly>

                                       <label for="">Price <span style="color:red">*</span></label>
                                       <input type="text" class="form-control" name="price" value= "<?= $p_row['price'];?>" readonly>

                                 
                                       <label for="">Quantity <span style="color:red">*</span></label>
                                       <?php
                                       $populate_data2="SELECT stock FROM products where id =".$p_row['product_id'];
                                       $prompt2 = mysqli_query($conn, $populate_data2);
                                       foreach ($prompt2 as $stock) {
                                       ?>
                                       <input type="number" class="form-control" name="quantity" value= "<?= $p_row['quantity'];?>"  min="1" max="<?= $stock['stock'];?>" required>
                                          <?php
                                       }
                                          ?>
                                    
                                    </div>
                                    <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="submit" name = "edit_quantity" class="btn btn-primary">Save Quantity</button>
                                    </div>
                                    </form>
                              </div>
                           </div>
                        </div>
                        </div>
                        
                        <!-----end of modal--------->
                     <?php
                          }
                     ?>
                    </tbody>
                </table>
                <!----Grand Total--->
                <h5>Total: </h5>
                <h6 id = 'gtotal'></h6>

                  <!----Check out button----->
                  <form id="for_checkout" action="process.php" method="post">
                    
                     <button type= "submit" name="checkout" class="btn btn-success" id = "checkout" disabled>Checkout</button>

                  </form>
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

      <script>
         var price = document.getElementsByClassName("price");
         var subtotal = document.getElementsByClassName("subtotal");
         var quantity = document.getElementsByClassName("input_qty");
         var total = document.getElementById("gtotal");
         var checkout = document.getElementById("checkout");
         // checkout.disabled = false;
         var overall = 0;
         for(i=0;price.length>i;i++){
            subtotal[i].innerText = (price[i].innerText)*(quantity[i].innerText);
         }


         function cb_func(){
            overall = 0;
            var checkBoxes = document.getElementsByClassName("cb_class");
            var subtotal = document.getElementsByClassName("subtotal");
            for (var i = 0; i < checkBoxes.length; i++) {
               if(checkBoxes[i].checked){
                  quantity[i].disabled = false;
                  checkout.disabled = false;
                  overall = (overall) + (price[i].innerText)*(quantity[i].innerText);
               }
               else if(checkBoxes[i].checked == false){
                  quantity[i].disabled = true;
               }
         }
         total.innerText = overall;
         }

      
      </script>
      <!-- <script src="../js/jquery-3.3.1.min.js"></script>  -->
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
      <script src="../js/jquery-migrate-1.4.1.min.js"></script> 
      <script src="../js/popper.min.js"></script> 
      <script src="../js/bootstrap.min.js"></script> 
      <script src="../js/owl.carousel.min.js"></script> 
      <script src="../js/jquery.prettyPhoto.js"></script> 
      <script src="../js/isotope.min.js"></script> 
      <!-- <script src="../js/custom.js"></script> -->
   </body>

</html>