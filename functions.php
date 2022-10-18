<?php
include('dbconn.php');

session_start();
$email = "micorilan1999@gmail.com";
$kunwareng_login="SELECT * FROM accounts WHERE email='$email'";
$prompt = mysqli_query($conn, $kunwareng_login);
$getData = mysqli_fetch_array($prompt);
$_SESSION['get_data'] = $getData;


if (isset($_POST['add_to_cart'])) {
    $user_id = $_SESSION['get_data']['id'];
    $imagee  = $_POST['imagee'];
    $shopname = $_POST['shop_name'];
    $contact = $_POST['contact'];
    $variation = $_POST['variation'];
    $quantity = $_POST['quantity'];
    $price = $_POST['price'];

    $check_exist="SELECT id,quantity FROM cart WHERE user_id='$user_id' AND shop_name = '$shopname' AND variation = '$variation'";
    $prompt = mysqli_query($conn, $check_exist);
    $check = mysqli_num_rows($prompt);
    
    
    if ($check == 0 or $check == null) {
        $conn->query("INSERT INTO cart (user_id, contact, variation, quantity, price, shop_name, imagee) 
        VALUES('$user_id','$contact','$variation', '$quantity', '$price', '$shopname', '$imagee')") or die($conn->error);
    }
    else {
        $fetch = mysqli_fetch_array($prompt);
        $id=  $fetch[0];
        $rc = $fetch[1];
        $int_quantity_input = (int)$quantity;
        $int_quantity_db = (int)$rc;
        $add_quantity = $int_quantity_db + $int_quantity_input;
        $conn->query("UPDATE cart SET quantity= '$add_quantity' WHERE id='$id'") or die($conn->error);
    }
?>


    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
        <script>
          $(document).ready(function(){
            Swal.fire({
            position: 'top-end',
            icon: 'success',
            title: 'Product Added to Cart',
            showConfirmButton: false,
            timer: 1500
            }).then((result)=>{

                window.location.href = "product_details.php";
            })

            })

    
        </script>

<?php
}
?>




