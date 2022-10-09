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
      <title>AgriCon - My Cart</title>
      
      <!-- CSS FILES START -->
      <link href="css/custom.css" rel="stylesheet">
      <link href="css/color.css" rel="stylesheet">
      <link href="css/responsive.css" rel="stylesheet">
      <link href="css/owl.carousel.min.css" rel="stylesheet">
      <link href="css/bootstrap.min.css" rel="stylesheet">
      <link href="css/prettyPhoto.css" rel="stylesheet">
      <link href="css/all.min.css" rel="stylesheet">
      <!-- CSS FILES End -->
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
      <script src="js/custom1.js"></script>
   </head>
   <body>
      <div class="wrapper">
         <!--Header Start-->
         <header class="header-style-2">
            <nav class="navbar navbar-expand-lg">
               <a class="navbar-brand" href="home.html"><img src="images/logo.png" width="200px" alt=""></a>
               <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"> <i class="fas fa-bars"></i> </button>
               <div class="collapse navbar-collapse" id="navbarSupportedContent">
                  <ul class="navbar-nav mr-auto">
                     <li class="nav-item dropdown">
                        <a class="nav-link" href="home.html" >Home</a>
                     </li>
                     <li class="nav-item"> <a class="nav-link" href="feed_home.html">Feed</a> </li>
                     <li class="nav-item"> <a class="nav-link" href="shop_home.html">Shops</a> </li>
                     <li class="nav-item"> <a class="nav-link" href="bidding_home.html">Bidding</a> </li>
                     
                  </ul>
                  <ul class="navbar-nav mr-auto">
                    <li> <a class="search-icon" href="#search"> <i class="fas fa-search"></i> </a> </li>
         
                    <li class="login-reg"> <a href="my_account.html">My Account</a> | <a href="index.html">Logout</a> </li>
                   
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
               <p class="text-white">User: Sample Name</p>
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
                        <th scope="col">Shop Name</th>
                        <th scope="col">Contact</th>
                        <th scope="col">Variation</th>
                        <th scope="col">Quantity</th>
                        <th scope="col">Price</th>
                        <th scope="col">Subtotal</th>
                        <th scope="col">Delete</th>
                        </tr>
                    </thead>


                     <tbody>
                     <?php
                           $user_id = $_SESSION['get_data']['user_id'];
                           $populate_data="SELECT id,imagee,shop_name,contact,variation,quantity,price FROM cart where user_id = $user_id";
                           $prompt = mysqli_query($conn, $populate_data);
                           
                          foreach ($prompt as $papo) {
                          
                          
                           //$check = mysqli_num_rows($prompt);
                        ?>
                        
                        <tr class = "quan">
                              <td><input type="checkbox" class = "cb_class" id = "checkbox_row" onclick = "cb_check()" value = "<?=$papo['id'];?>"></td>
                              <td scope="row"><img src="<?= $papo['imagee'];?>" name = "image" width="70px" alt=""></td>
                              <td><?= $papo['shop_name'];?></td>
                              <td><?= $papo['contact'];?></td>
                              <td><?= $papo['variation'];?></td>
                             
                              <td>
                                       <div class = "col-md-4">
                                          <div class = "input-group mb-3" style = "width:130px">
                                             <button id = "decre" class = "input-group-text decrement-btn" disabled>-</button>
                                             <input type = "text" id = "qty_id<?= $papo['id'];?>" class = "form-control text-center input-qty bg-white" value = "<?=$papo['quantity'];?>" disabled>
                                             <button id = "incre" class = "input-group-text increment-btn" disabled>+</button>
                                          </div>
                                       </div>
                              </td>
                              
                     
                              <!-- <td><input type="number" id = "quantity_id" name="quantity" min="1" max="99" name = "quantity[]" value="" required></td> -->
                              <td><p class="price"> <?=$papo['price']?></p></td>
                              <td><p class = 'subtotal'></p></td>
                              <td><button class="btn btn-danger"><i class="fa fa-trash me-2" disabled></i> Delete</button></td>
                              
                           </tr>
                        <?php }?>
                        
                    </tbody>
                </table>

                <p id = "total">Total Price: 0</p>
                <button class="btn btn-success">Checkout</button>
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
                              <li><a href="#">Rewards</a></li>
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