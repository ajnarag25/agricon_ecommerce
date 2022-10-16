<?php 

include('../dbconn.php');
session_start();


// login
if (isset($_POST['login_admin'])) {
    $user = $_POST['username'];
    $pass = $_POST['password'];

    $login="SELECT * FROM admin WHERE username='$user' AND password='$pass'";
    $prompt = $conn->query($login);
    $row = mysqli_num_rows($prompt);

    if ($row == 1){
        header('location:dashboard.php');
    }
    else{
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

// update admin
if (isset($_POST['updateAdmin'])) {
    $username = $_POST['user'];
    $pass1 = $_POST['pass1'];
    $pass2 = $_POST['pass2'];
    $emails = $_POST['mail'];
    
    if ($pass1 != $pass2){
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
                    window.location.href = "web_info.php";
                    }else{
                        window.location.href = "web_info.php";
                    }
                })
                
            })
    
        </script>
        <?php
    }else{
        $conn->query("UPDATE admin SET username='$username', password='$pass1', email='$emails' WHERE id=1") or die($conn->error);
        header("Location: index.php");
    }



}

// update about
if (isset($_POST['update_about'])) {
    $get_about = $_POST['about'];
    $conn->query("UPDATE admin SET about='$get_about' WHERE id=1") or die($conn->error);
    header("Location: web_info.php");
}

// suspend account
if (isset($_GET['suspendUser'])) {
    $id = $_GET['suspendUser'];
    $conn->query("DELETE FROM accounts WHERE id=$id") or die($conn->error);
    header("Location: user.php");
}

// verify account
if (isset($_POST['verify_user'])) {
    $id = $_POST['id'];
    $check_status = $_POST['check_stat'];
    $messages = $_POST['msg'];
    $emails = $_POST['email'];
    
    if ($check_status == 'VERIFIED'){
        ?>
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
        <script>
            $(document).ready(function(){
                Swal.fire({
                icon: 'warning',
                title: 'This user is already verified!',
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'Okay'
                }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = "kyc.php";
                    }else{
                        window.location.href = "kyc.php";
                    }
                })
                
            })
    
        </script>
        <?php
    }else{
        $conn->query("UPDATE accounts SET status='VERIFIED' WHERE id='$id'") or die($conn->error);
        include 'verify_email.php';
        ?>
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
        <script>
            $(document).ready(function(){
                Swal.fire({
                icon: 'success',
                title: 'Successfully Submitted',
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'Okay'
                }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = "kyc.php";
                    }else{
                        window.location.href = "kyc.php";
                    }
                })
                
            })
    
        </script>
        <?php
    }

   

}

// deny account
if (isset($_POST['deny_user'])) {
    $id = $_POST['id'];
    $check_status = $_POST['check_stat'];
    $messages = $_POST['msg'];
    $emails = $_POST['email'];
    
    if ($check_status == 'DENIED'){
        ?>
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
        <script>
            $(document).ready(function(){
                Swal.fire({
                icon: 'warning',
                title: 'This user is already denied!',
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'Okay'
                }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = "kyc.php";
                    }else{
                        window.location.href = "kyc.php";
                    }
                })
                
            })
    
        </script>
        <?php
    }else{
        $conn->query("UPDATE accounts SET status='DENIED' WHERE id='$id'") or die($conn->error);
        include 'deny_email.php';
        ?>
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
        <script>
            $(document).ready(function(){
                Swal.fire({
                icon: 'success',
                title: 'Successfully Submitted',
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'Okay'
                }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = "kyc.php";
                    }else{
                        window.location.href = "kyc.php";
                    }
                })
                
            })
    
        </script>
        <?php
    }

   

}


?>