<link href="../css/bootstrap.min.css" rel="stylesheet">
<?php
include('../dbconn.php');
session_start();
// error_reporting(0);

// update seller account
if (isset($_POST['update_seller'])) {
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
                    window.location.href = "my_account_seller.php";
                    }else{
                        window.location.href = "my_account_seller.php";
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
                    window.location.href = "my_account_seller.php";
                    }else{
                        window.location.href = "my_account_seller.php";
                    }
                })
                
            })
    
        </script>
        <?php
    }
}


// update user password
if (isset($_POST['update_password_seller'])) {
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
                    window.location.href = "my_account_seller.php";
                    }else{
                        window.location.href = "my_account_seller.php";
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
                    window.location.href = "../index.php";
                    }else{
                        window.location.href = "../index.php";
                    }
                })
                
            })

        </script>
        <?php
    }
}




?>