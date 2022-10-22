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

// add shop
if (isset($_POST['addshop'])) {
    $owner = $_POST['owner'];
    $address = $_POST['address'];
    $email = $_POST['email'];
    $name = $_POST['shop_name'];
    $contact = $_POST['shop_contact'];
    $details = $_POST['shop_det'];

    $checking = "SELECT * FROM shops WHERE email='$email'";
    $prompt = $conn->query($checking);
    $row = mysqli_num_rows($prompt);

    $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES["shop_image"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
    $check = getimagesize($_FILES["shop_image"]["tmp_name"]);


    if($row == 0){
        if($check !== false) {
            $uploadOk = 1;
            if ($uploadOk == 0) {
                echo "<script type=\"text/javascript\">
                alert(\"Sorry, your file was not uploaded.\");
                window.location = \"my_products_seller.php\"
                </script>";
            }else{
                move_uploaded_file($_FILES["shop_image"]["tmp_name"], $target_file);
                $conn->query("INSERT INTO shops (owner, address, email, image, name, contact, details) 
                VALUES('$owner', '$address', '$email','$target_file', '$name', '$contact', '$details')") or die($conn->error);
                ?>
                <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
                <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
                <script>
                    $(document).ready(function(){
                        Swal.fire({
                        icon: 'success',
                        title: 'Successfully Created your Shop',
                        confirmButtonColor: '#3085d6',
                        confirmButtonText: 'Okay'
                        }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.href = "my_products_seller.php";
                            }else{
                                window.location.href = "my_products_seller.php";
                            }
                        })
                    })
                </script>
                <?php
            }
        }else {
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
                        window.location.href = "my_products_seller.php";
                        }else{
                            window.location.href = "my_products_seller.php";
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
                title: 'You have already created your shop',
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'Okay'
                }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = "my_products_seller.php";
                    }else{
                        window.location.href = "my_products_seller.php";
                    }
                })
                
            })
    
        </script>
        <?php
    }


}

// add product
if (isset($_POST['addproduct'])) {
    $name = $_POST['product_name'];
    $price = $_POST['product_price'];
    $quantity = $_POST['product_quants'];
    $details = $_POST['product_det'];
    $email = $_POST['email'];

    $checking1 = "SELECT * FROM shops WHERE email='$email'";
    $prompt1 = $conn->query($checking1);
    $row1 = mysqli_num_rows($prompt1);
    $checking2 = "SELECT * FROM products WHERE product='$name' AND email='$email'";
    $prompt2 = $conn->query($checking2);
    $row2 = mysqli_num_rows($prompt2);

    $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES["product_image"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
    $check = getimagesize($_FILES["product_image"]["tmp_name"]);


    if($row1 == 0){
        ?>
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
        <script>
            $(document).ready(function(){
                Swal.fire({
                icon: 'warning',
                title: 'Please Create First your Shop',
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'Okay'
                }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = "my_products_seller.php";
                    }else{
                        window.location.href = "my_products_seller.php";
                    }
                })
                
            })
    
        </script>
        <?php
     
    }else{
        if($row2 == 0){
            if($check !== false) {
                $uploadOk = 1;
                if ($uploadOk == 0) {
                    echo "<script type=\"text/javascript\">
                    alert(\"Sorry, your file was not uploaded.\");
                    window.location = \"my_products_seller.php\"
                    </script>";
                }else{
                        move_uploaded_file($_FILES["product_image"]["tmp_name"], $target_file);
                        $conn->query("INSERT INTO products (product, image, price, stock, details, email) 
                        VALUES('$name', '$target_file', '$price', '$quantity', '$details', '$email')") or die($conn->error);
                        ?>
                        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
                        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
                        <script>
                            $(document).ready(function(){
                                Swal.fire({
                                icon: 'success',
                                title: 'Successfully Added your Product',
                                confirmButtonColor: '#3085d6',
                                confirmButtonText: 'Okay'
                                }).then((result) => {
                                if (result.isConfirmed) {
                                    window.location.href = "my_products_seller.php";
                                    }else{
                                        window.location.href = "my_products_seller.php";
                                    }
                                })
                            })
                        </script>
                        <?php
                }
    
            }else {
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
                            window.location.href = "my_products_seller.php";
                            }else{
                                window.location.href = "my_products_seller.php";
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
                    title: 'You have already added that product',
                    confirmButtonColor: '#3085d6',
                    confirmButtonText: 'Okay'
                    }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = "my_products_seller.php";
                        }else{
                            window.location.href = "my_products_seller.php";
                        }
                    })
                    
                })
        
            </script>
            <?php
        }   
    }


}


// update product details 
if (isset($_POST['update_product'])) {
    $id = $_POST['id'];
    $name = $_POST['product_name'];
    $price = $_POST['product_price'];
    $stock = $_POST['product_quants'];
    $details = $_POST['product_det'];

    $checking = "SELECT * FROM products WHERE product='$name' AND price='$price' AND stock='$stock' AND details='$details'";
    $prompt = $conn->query($checking);
    $row = mysqli_num_rows($prompt);


    if ($row == 0){
        $conn->query("UPDATE products SET product='$name', price='$price', stock='$stock', details='$details' WHERE id='$id'") or die($conn->error);
        $conn->query("UPDATE cart SET product_name='$name', price='$price' WHERE product_id='$id'") or die($conn->error);
        ?>
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
        <script>
            $(document).ready(function(){
                Swal.fire({
                icon: 'success',
                title: 'Successfully Updated the Product',
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'Okay'
                }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = "my_products_seller.php";
                    }else{
                        window.location.href = "my_products_seller.php";
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
                    window.location.href = "my_products_seller.php";
                    }else{
                        window.location.href = "my_products_seller.php";
                    }
                })
                
            })
    
        </script>
        <?php
    }
}

// delete product 
if (isset($_GET['deleteProduct'])) {
    $id = $_GET['deleteProduct'];
    $conn->query("DELETE FROM products WHERE id=$id") or die($conn->error);
    header("Location: my_products_seller.php");
}

// publish post 
if (isset($_POST['publish_post'])) { 
    $name = $_POST['feed_name'];
    $header = $_POST['feed_header'];
    $details = $_POST['feed_det'];

    $checking = "SELECT * FROM feed WHERE header='$header' AND description='$details'";
    $prompt = $conn->query($checking);
    $row = mysqli_num_rows($prompt);

    $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES["feed_image"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
    $check = getimagesize($_FILES["feed_image"]["tmp_name"]);


    if($row == 0){
        if($check !== false) {
            $uploadOk = 1;
            if ($uploadOk == 0) {
                echo "<script type=\"text/javascript\">
                alert(\"Sorry, your file was not uploaded.\");
                window.location = \"feed_seller.php\"
                </script>";
            }else{
                move_uploaded_file($_FILES["feed_image"]["tmp_name"], $target_file);
                $conn->query("INSERT INTO feed (image, shop, header, description) 
                VALUES('$target_file', '$name', '$header', '$details')") or die($conn->error);
                ?>
                <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
                <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
                <script>
                    $(document).ready(function(){
                        Swal.fire({
                        icon: 'success',
                        title: 'Successfully Published your Post',
                        confirmButtonColor: '#3085d6',
                        confirmButtonText: 'Okay'
                        }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.href = "feed_seller.php";
                            }else{
                                window.location.href = "feed_seller.php";
                            }
                        })
                    })
                </script>
                <?php
            }
        }else {
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
                        window.location.href = "feed_seller.php";
                        }else{
                            window.location.href = "feed_seller.php";
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
                title: 'You already created that post',
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'Okay'
                }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = "feed_seller.php";
                    }else{
                        window.location.href = "feed_seller.php";
                    }
                })
                
            })
    
        </script>
        <?php
    }

}


?>