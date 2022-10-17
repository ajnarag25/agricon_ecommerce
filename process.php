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