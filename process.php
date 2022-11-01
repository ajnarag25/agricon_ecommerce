<link href="css/bootstrap.min.css" rel="stylesheet">

<?php 
include('dbconn.php');
session_start();
error_reporting(0);


// logout
if (isset($_GET['logout'])) {
    session_destroy();
    header('location:index.php');
} 

// login
if (isset($_POST['login'])) {
    $user = $_POST['username'];
    $pass = $_POST['password'];
    $login="SELECT * FROM accounts WHERE username='$user'";
    $prompt = mysqli_query($conn, $login);
    $getData = mysqli_fetch_array($prompt);

    if (password_verify($pass, $getData['password'])){
        if ($getData['status'] == 'UNVERIFIED'){
            if ($getData['type'] == 'USER'){
                $_SESSION['data'] = $getData;
                header('location:unverified.php');
            }else{
                $_SESSION['data'] = $getData;
                header('location: ./seller/unverified_seller.php');
            }
        }else if($getData['status'] == 'DENIED'){
            if ($getData['type'] == 'USER'){
                $_SESSION['data'] = $getData;
                header('location:denied.php');
            }else{
                $_SESSION['data'] = $getData;
                header('location: ./seller/denied_seller.php');
            }
        }
        else{
            if ($getData['type'] == 'USER'){
                $_SESSION['data'] = $getData;
                header('location:home.php');
            }else{
                $_SESSION['data'] = $getData;
                header('location: ./seller/home_seller.php');
            }
        }
      
    }else{
        ?>
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
        <script>
            $(document).ready(function(){
                Swal.fire({
                icon: 'error',
                title: 'Username and/or Password is incorrect',
                text: 'Something went wrong!',
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'Okay'
                }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = "login.php";
                    }else{
                        window.location.href = "login.php";
                    }
                })
                
            })
    
        </script>
        <?php
        
    }

}

// signup
if (isset($_POST['signup'])) {
    $firstname = $_POST['fname'];
    $middlename = $_POST['mname'];
    $lastname = $_POST['lname'];
    $username = $_POST['uname'];
    $emails = $_POST['email'];
    $address = $_POST['address'];
    $birthday = $_POST['birthday'];
    $pass1 = $_POST['pass1'];
    $pass2 = $_POST['pass2'];
    $type = $_POST['type'];
    $del_address = $_POST['del_address'];

    $checking = "SELECT * FROM accounts WHERE firstname='$firstname' AND middlename='$middlename' AND lastname='$lastname' OR email='$emails'";
    $prompt = $conn->query($checking);
    $row = mysqli_num_rows($prompt);

    $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES["valid_id"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
    $check = getimagesize($_FILES["valid_id"]["tmp_name"]);

    if ($pass1 != $pass2){
        ?>
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
        <script>
            $(document).ready(function(){
                Swal.fire({
                icon: 'error',
                title: 'Password does not match',
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'Okay'
                }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = "signup.php";
                    }else{
                        window.location.href = "signup.php";
                    }
                })
                
            })
    
        </script>

        <?php
    }else if($row == 0){
        if($check !== false) {
            $uploadOk = 1;
            if ($uploadOk == 0) {
                echo "<script type=\"text/javascript\">
                alert(\"Sorry, your file was not uploaded.\");
                window.location = \"signup.php\"
                </script>";
        }else {
          move_uploaded_file($_FILES["valid_id"]["tmp_name"], $target_file);
          $conn->query("INSERT INTO accounts (firstname, middlename, lastname, username, email, address, birthday, valid_id, password, type, delivery_address, otp, status) 
          VALUES('$firstname', '$middlename', '$lastname', '$username', '$emails', '$address', '$birthday', '$target_file' , '".password_hash($pass1, PASSWORD_DEFAULT)."', '$type','$del_address', '0', 'UNVERIFIED')") or die($conn->error);
          include 'signup_email.php';
          ?>
          <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
          <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
          <script>
              $(document).ready(function(){
                  Swal.fire({
                  icon: 'success',
                  title: 'Successfully Registered',
                  text: 'Please login your credentials now',
                  confirmButtonColor: '#3085d6',
                  confirmButtonText: 'Okay'
                  }).then((result) => {
                  if (result.isConfirmed) {
                      window.location.href = "login.php";
                      }else{
                          window.location.href = "login.php";
                      }
                  })
              })
          </script>
          <?php
        }
           
          } else {
            $uploadOk = 0;
            ?>
            <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
            <script>
                $(document).ready(function(){
                    Swal.fire({
                    icon: 'warning',
                    title: 'File is not an image!',
                    confirmButtonColor: '#3085d6',
                    confirmButtonText: 'Okay'
                    }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = "signup.php";
                        }else{
                            window.location.href = "signup.php";
                        }
                    })
                    
                })
            </script>
            <?php

          }
    }else{
        ?>
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
        <script>
            $(document).ready(function(){
                Swal.fire({
                icon: 'warning',
                title: 'This user is already existing!',
                text: 'Please login your credentials now',
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'Okay'
                }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = "signup.php";
                    }else{
                        window.location.href = "signup.php";
                    }
                })
                
            })
    
        </script>
        <?php
    }
}

// update user account
if (isset($_POST['update_user'])) {
    $id = $_POST['id'];
    $firstname = $_POST['fname'];
    $middlename = $_POST['mname'];
    $lastname = $_POST['lname'];
    $username = $_POST['uname'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    $birthday = $_POST['birthday'];
    $del_address = $_POST['del_address'];

    $checking = "SELECT * FROM accounts WHERE firstname='$firstname' AND middlename='$middlename' AND lastname='$lastname' AND username='$username' AND email='$email' AND
    address='$address' AND birthday='$birthday' AND delivery_address='$del_address'";
    $prompt = $conn->query($checking);
    $row = mysqli_num_rows($prompt);


    if ($row == 0){
        $conn->query("UPDATE accounts SET firstname='$firstname', middlename='$middlename', lastname='$lastname', username='$username', email='$email',
        address='$address', birthday='$birthday', delivery_address='$del_address' WHERE id='$id'") or die($conn->error);

        ?>
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
        <script>
            $(document).ready(function(){
                Swal.fire({
                icon: 'success',
                title: 'Successfully Updated your Account',
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'Okay'
                }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = "my_account.php";
                    }else{
                        window.location.href = "my_account.php";
                    }
                })
                
            })

        </script>
        <?php

    }else{
        ?>
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
        <script>
            $(document).ready(function(){
                Swal.fire({
                icon: 'warning',
                title: 'No changes has been made!',
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'Okay'
                }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = "my_account.php";
                    }else{
                        window.location.href = "my_account.php";
                    }
                })
                
            })
    
        </script>
        <?php
    }
}

// update user valid id
if (isset($_POST['update_profile'])) {
    $get_id = $_POST['id'];
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES["valid_id"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
    $check = getimagesize($_FILES["valid_id"]["tmp_name"]);

    if($check !== false) {

        $uploadOk = 1;
        if ($uploadOk == 0) {
            echo "<script type=\"text/javascript\">
            alert(\"Sorry, your file was not uploaded.\");
            window.location = \"my_account.php\"
            </script>";
    } else {
    move_uploaded_file($_FILES["valid_id"]["tmp_name"], $target_file);
    }
        $sql='UPDATE accounts SET valid_id="'.$target_file.'" WHERE id="'.$get_id.'"';
        $result = mysqli_query($conn, $sql);
        header('location: my_account.php');
        
    } else {
        echo "<script type=\"text/javascript\">
        alert(\"File is not an image!\");
        window.location = \"my_account.php\"
        </script>";
        $uploadOk = 0;
    }
}

// update seller valid id
if (isset($_POST['update_profile_seller'])) {
    $get_id = $_POST['id'];
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES["valid_id"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
    $check = getimagesize($_FILES["valid_id"]["tmp_name"]);

    if($check !== false) {

        $uploadOk = 1;
        if ($uploadOk == 0) {
            echo "<script type=\"text/javascript\">
            alert(\"Sorry, your file was not uploaded.\");
            window.location = \"./seller/my_account_seller.php\"
            </script>";
    } else {
    move_uploaded_file($_FILES["valid_id"]["tmp_name"], $target_file);
    }
        $sql='UPDATE accounts SET valid_id="'.$target_file.'" WHERE id="'.$get_id.'"';
        $result = mysqli_query($conn, $sql);
        header('location: ./seller/my_account_seller.php');
        
    } else {
        echo "<script type=\"text/javascript\">
        alert(\"File is not an image!\");
        window.location = \"./seller/my_account_seller.php\"
        </script>";
        $uploadOk = 0;
    }
}


// update user password
if (isset($_POST['update_password'])) {
    $id = $_POST['id'];
    $password1 = $_POST['pass1'];
    $password2 = $_POST['pass2'];

    if ($password1 != $password2){
        ?>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
        <script>
            $(document).ready(function(){
                Swal.fire({
                icon: 'error',
                title: 'Password does not match',
                text: 'Something went wrong!',
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'Okay'
                }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = "my_account.php";
                    }else{
                        window.location.href = "my_account.php";
                    }
                })
                
            })
    
        </script>
        <?php
    }else{
        $conn->query("UPDATE accounts SET password='".password_hash($password1, PASSWORD_DEFAULT)."' WHERE id='$id'") or die($conn->error);
        session_destroy();
        ?>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
        <script>
            $(document).ready(function(){
                Swal.fire({
                icon: 'success',
                title: 'Successfully changed your password',
                text: 'Please login your credentials now',
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'Okay'
                }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = "index.php";
                    }else{
                        window.location.href = "index.php";
                    }
                })
                
            })

        </script>
        <?php
    }
}

// forgot password
if (isset($_POST['forgotpass'])) {
    $emails = $_POST['email'];
    $setOTP = rand(0000,9999);

    $sql = "SELECT * FROM accounts WHERE email='$emails'";
    $result = mysqli_query($conn, $sql);
    $check = mysqli_num_rows($result);
    if ($check == 0){
        ?>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
        <script>
            $(document).ready(function(){
                Swal.fire({
                icon: 'error',
                title: 'We could not find your account!',
                text: 'Something Went Wrong.',
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'Okay'
                }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = "login.php";
                    }else{
                        window.location.href = "login.php";
                    }
                })
                
            })
    
        </script>
        <?php
    }else{
        $conn->query("UPDATE accounts SET otp='$setOTP' WHERE email='$emails'") or die($conn->error);
        $_SESSION['otp'] = $emails;
        include 'otp_email.php';
        header("Location: otp.php");
    }

}

 // otp submit
if (isset($_POST['otp_submit'])) {
    $otp = $_POST['otp'];
    $_SESSION['otp'] = $otp;
    $sql = "SELECT * FROM accounts WHERE otp='$otp'";
    $result = mysqli_query($conn, $sql);
    $check = mysqli_num_rows($result);

    if ($check == 0){
        ?>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
        <script>
            $(document).ready(function(){
                Swal.fire({
                icon: 'error',
                title: 'OTP entered is wrong!',
                text: 'Please check your email for the OTP verification',
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'Okay'
                }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = "otp.php";
                    }else{
                        window.location.href = "otp.php";
                    }
                })
                
            })
    
        </script>
        <?php
    }else{
        header("Location: changepass.php");
    }
}

// change password
if (isset($_POST['change_pass'])) {
    $password1 = $_POST['pass1'];
    $password2 = $_POST['pass2'];
    $get_otp = $_SESSION['otp'];
    
    if ($password1 != $password2){
        ?>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
        <script>
            $(document).ready(function(){
                Swal.fire({
                icon: 'error',
                title: 'Password does not match!',
                text: 'Something went wrong',
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'Okay'
                }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = "changepass.php";
                    }else{
                        window.location.href = "changepass.php";
                    }
                })
                
            })
    
        </script>
        <?php
    }else{
        $conn->query("UPDATE accounts SET password='".password_hash($password1, PASSWORD_DEFAULT)."' WHERE otp='$get_otp'") or die($conn->error);
        ?>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
        <script>
            $(document).ready(function(){
                Swal.fire({
                icon: 'success',
                title: 'Successfully changed your password',
                text: 'Please login your new created password account',
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'Okay'
                }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = "login.php";
                    }else{
                        window.location.href = "login.php";
                    }
                })
                
            })
    
        </script>
        <?php
    }
 

}

?>

<?php
if (isset($_POST['add_to_cart'])) {
    $email = $_POST['email'];
    $imagee = $_POST['imagee'];
    $price = $_POST['price'];
    $shop_name = $_POST['shop_name'];
    $contact = $_POST['contact'];
    $quantity = $_POST['quantity'];
    $product_name = $_POST['product_name'];
    $user_id = $_POST['user_id'];
    $product_id = $_POST['product_id'];

    $check_exist="SELECT id,quantity FROM cart WHERE email='$email' AND shop_name = '$shop_name' AND product_name = '$product_name'";
    $prompt = mysqli_query($conn, $check_exist);
    $check = mysqli_num_rows($prompt);
    
    
    if ($check == 0 or $check == null) {
        $conn->query("INSERT INTO cart (imagee, shop_name, contact, price,quantity, email, product_name,product_id,user_id) 
        VALUES('$imagee','$shop_name','$contact', '$price', '$quantity', '$email', '$product_name','$product_id','$user_id')") or die($conn->error);
    }
    else {
        $fetch = mysqli_fetch_array($prompt);
        $id = $fetch[0];
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
            position: 'middle',
            icon: 'success',
            title: 'Product Added to Cart',
            showConfirmButton: false,
            timer: 1500
            }).then((result)=>{

                window.location.href = "my_cart.php";
            })

            })

</script>

<?php
}
?>

<?php

//add_to_cart

if (isset($_GET["id"])){
//product_table
    $getid = $_GET["id"];
    $email = null;
    $image = null;
    $price = null;
    $product_name = null;

//shop_table
    $shop_name = null;
    $contact = null;

//user_logged_in
    $quantity = 1;
    $user_id =  $_SESSION['data']['id'];


    $query = "SELECT * FROM products WHERE  id = $getid";
    $result = mysqli_query($conn, $query);
    while ($row = mysqli_fetch_array($result)) {
        $email = $row['email'];
        $image = $row['image'];
        $price = $row['price'];
        $product_name = $row['product'];
    }
    $query1 = "SELECT name,contact FROM shops WHERE email = '$email'";
    $result1 = mysqli_query($conn, $query1);
    while ($row1 = mysqli_fetch_array($result1)) {
        $shop_name = $row1['name'];
        $contact = $row1['contact'];
    }

    
    $check_exist="SELECT id,quantity FROM cart WHERE email='$email' AND shop_name = '$shop_name' AND product_name = '$product_name' AND user_id = $user_id";
    $prompt = mysqli_query($conn, $check_exist);
    $check = mysqli_num_rows($prompt);
    
    
    if ($check == 0 or $check == null) {
        $conn->query("INSERT INTO cart (imagee, shop_name, contact, price,quantity, email, product_name,user_id,product_id) 
        VALUES('$image','$shop_name','$contact', '$price', '$quantity', '$email', '$product_name','$user_id','$getid')") or die($conn->error);
    }
    else {
        $fetch = mysqli_fetch_array($prompt);
        $id = $fetch[0];
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
            position: 'middle',
            icon: 'success',
            title: 'Product Added to Cart',
            showConfirmButton: false,
            timer: 1500
            }).then((result)=>{

                window.location.href = "my_cart.php";
            })
            })

</script>
<?php
}
?>
<?php
//delete on add to cart table
if (isset($_GET["iddelzxc"])){
    $fetched_id = $_GET['iddelzxc'];
    $sql = "DELETE FROM cart WHERE id= $fetched_id";
    if (mysqli_query($conn, $sql)) {
?>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script>
          $(document).ready(function(){
            Swal.fire({
            position: 'middle',
            icon: 'success',
            title: 'Product Deleted',
            showConfirmButton: false,
            timer: 1500
            }).then((result)=>{

                window.location.href = "my_cart.php";
            })
            })
</script>    
<?php
    }
}
?>


<?php
//delete on add to cart table
if (isset($_GET["del_purchase"])){
    $fetched_id = $_GET['del_purchase'];
    $sql = "DELETE FROM checkout WHERE id= $fetched_id";
    if (mysqli_query($conn, $sql)) {
?>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script>
          $(document).ready(function(){
            Swal.fire({
            position: 'middle',
            icon: 'success',
            title: 'Product Deleted',
            showConfirmButton: false,
            timer: 1500
            }).then((result)=>{

                window.location.href = "my_purchases.php";
            })
            })

</script>    
<?php
    }
}
?>


<?php
if(isset($_POST['edit_quantity'])){
    $id = $_POST['id'];
    $quantity = $_POST['quantity'];
    if ($id != 0) {
        $sql='UPDATE cart SET quantity="'.$quantity.'" WHERE id="'.$id.'"';
        $result = mysqli_query($conn, $sql);

        ?>
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
        <script>
                $(document).ready(function(){
                    Swal.fire({
                    position: 'middle',
                    icon: 'success',
                    title: 'Quantity Updated',
                    showConfirmButton: false,
                    timer: 800
                    }).then((result)=>{

                        window.location.href = "my_cart.php";
                    })
                    })
        </script>
<?php
    }
    else {
        
    
 ?>
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
        <script>
                $(document).ready(function(){
                    Swal.fire({
                    position: 'middle',
                    icon: 'error',
                    title: 'Invalid Quantity Input',
                    showConfirmButton: false,
                    timer: 800
                    }).then((result)=>{

                        window.location.href = "my_cart.php";
                    })
                    })
        </script>
<?php
}
}
?>

<?php
//checkout
if(isset($_POST['checkout'])){

    if(!empty($_POST['purchase_id'])) {
        $purchase_id = implode(",",$_POST['purchase_id']);
        $product_id = null;
        $statuss = null;
        $imagee = null;
        $shop_name =null;
        $contact =null;
        $price =null;
        $quantityy =null;
        $email = null;
        $product_name =null;
        $user_id = null;

        $id_checkout =null;
        $quantity_checkout =null;
        

        $query = "SELECT * FROM cart where id in($purchase_id)";
        $result = mysqli_query($conn, $query);
        while ($row = mysqli_fetch_array($result)) {
            $product_id = $row['product_id'];
            $statuss = "PENDING";
            $imagee = $row['imagee'];
            $shop_name = $row['shop_name'];
            $contact = $row['contact'];
            $price = $row['price'];
            $quantityy = $row['quantity'];
            $email = $row['email'];
            $product_name = $row['product_name'];
            $user_id = $row['user_id'];
            
            $intprice = (int)$price;
            $intquan = (int)$quantityy;
            $totall = bcmul($intprice,$intquan);
            $gtotall = null;
            $quantity_total = null;


            $check_exist="SELECT id,quantity FROM CHECKOUT WHERE user_id ='$user_id' and product_id = '$product_id' and status = 'PENDING'";
            $prompt = mysqli_query($conn, $check_exist);
            while ($row1 = mysqli_fetch_array($prompt)) {
                $id_checkout = $row1['id'];
                $quantity_checkout = $row1['quantity'];
                $int_quantity_checkout = (int)$quantity_checkout;
                $quantity_total = $int_quantity_checkout + $quantityy;
                $gtotall = bcmul($intprice,$quantity_total);
            }
        
            $check = mysqli_num_rows($prompt);
            
    
            if ($check == 0 or $check == null) {
                $conn->query("INSERT INTO CHECKOUT (imagee, shop_name, contact, price,quantity, email, product_name,user_id,status,total,product_id) 
                VALUES('$imagee','$shop_name','$contact','$price','$quantityy','$email','$product_name','$user_id','$statuss','$totall','$product_id')") or die($conn->error);
                 }
            else {
                $conn->query("UPDATE checkout SET quantity= '$quantity_total',total='$gtotall' WHERE id='$id_checkout'") or die($conn->error);
                 }
    
            }



        
        
        ?>
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
        <script>
                $(document).ready(function(){
                    Swal.fire({
                    position: 'middle',
                    icon: 'success',
                    title: 'Selected Products Checked Out Successfully',
                    showConfirmButton: false,
                    timer: 1000
                    }).then((result)=>{

                        window.location.href = "my_purchases.php";
                    })
                    })
        </script>
        <?php
    }
    else {
        echo"sadfsadfsdaf";
    }
}

?>

<?php
//COMMENT AND RATE
if(isset($_POST['comment_rate'])){
    $id = $_POST['id'];
    $user_id = $_POST['user_id'];
    $product_id = $_POST['product_id'];
    $ratee = $_POST['rates'];
    $comment = $_POST['comment'];
    //change the status to "RECEIVED"
    $conn->query("UPDATE checkout SET status='RECEIVED' where id = '$id'") or die($conn->error);

    $conn->query("INSERT INTO rating (user_id, product_id, comment, rates) 
    VALUES('$user_id','$product_id','$comment','$ratee')") or die($conn->error);
    ?>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
        <script>
                $(document).ready(function(){
                    Swal.fire({
                    position: 'middle',
                    icon: 'success',
                    title: 'Comment Sent',
                    showConfirmButton: false,
                    timer: 1000
                    }).then((result)=>{

                        window.location.href = "my_purchases.php";
                    })
                    })
        </script>
    <?php
}


?>

<?php
if (isset($_GET["no_comment"])){
    $fetched_id = $_GET['no_comment'];
    $conn->query("UPDATE checkout SET status='RECEIVED' where id = '$fetched_id'") or die($conn->error);
?>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
        <script>
                $(document).ready(function(){
                    Swal.fire({
                    position: 'middle',
                    icon: 'success',
                    title: 'Status Updated',
                    showConfirmButton: false,
                    timer: 1000
                    }).then((result)=>{

                        window.location.href = "my_purchases.php";
                    })
                    })
        </script>
<?php
}
?>