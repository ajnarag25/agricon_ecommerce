<link href="../css/bootstrap.min.css" rel="stylesheet">
<?php
include('../dbconn.php');
session_start();
error_reporting(0);

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







<?php //START OF ADD TO CART-> DELETE FRCM CART, EDIT CART, AND CHECKOUT?>


<?php
if (isset($_POST['add_to_cart'])) {
    $email = $_POST['email'];
    $imagee = $_POST['imagee'];
    $price = $_POST['price'];
    $shop_name = $_POST['shop_name'];
    $contact = $_POST['contact'];
    $quantity = $_POST['quantity'];
    $product_name = $_POST['product_name'];
    $user_id = $_POST['user_idd'];

    $check_exist="SELECT id,quantity FROM cart WHERE email='$email' AND shop_name = '$shop_name' AND product_name = '$product_name'AND user_id = '$user_id'";
    $prompt = mysqli_query($conn, $check_exist);
    $check = mysqli_num_rows($prompt);
    
    
    if ($check == 0 or $check == null) {
        $conn->query("INSERT INTO cart (imagee, shop_name, contact, price,quantity, email, product_name,user_id) 
        VALUES('$imagee','$shop_name','$contact', '$price', '$quantity', '$email', '$product_name','$user_id')") or die($conn->error);
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

                window.location.href = "my_cart_seller.php";
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

    
    $check_exist="SELECT id,quantity FROM cart WHERE email='$email' AND shop_name = '$shop_name' AND product_name = '$product_name' AND user_id = '$user_id'";
    $prompt = mysqli_query($conn, $check_exist);
    $check = mysqli_num_rows($prompt);
    
    
    if ($check == 0 or $check == null) {
        $conn->query("INSERT INTO cart (imagee, shop_name, contact, price,quantity, email, product_name,product_id,user_id) 
        VALUES('$image','$shop_name','$contact', '$price', '$quantity', '$email', '$product_name','$getid','$user_id')") or die($conn->error);
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

                window.location.href = "my_cart_seller.php";
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

                window.location.href = "my_cart_seller.php";
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
                    timer: 1000
                    }).then((result)=>{

                        window.location.href = "my_cart_seller.php";
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

                        window.location.href = "my_purchases_seller.php";
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
//APPROVE-REJECT ORDER REQUEST
if(isset($_GET['approve_product_id'])){
    $getid = $_GET['approve_product_id'];
    $get_cart_id = $_GET['cart_id'];
    $query1 = "SELECT stock FROM products where id =". $getid;
    $result1 = mysqli_query($conn, $query1);
    $int_fetch_quan = null;
    $int_get_quan = null;
    while ($row1 = mysqli_fetch_array($result1)) {

        //product stock
        $int_fetch_quan = (int)$row1['stock'];

        //request quantity
        $int_get_quan = (int)$_GET['quantity'];

    }
    $sub_quantity = $int_fetch_quan-$int_get_quan;
   
    if ($sub_quantity>=0) {
        $conn->query("UPDATE products SET stock= '$sub_quantity' WHERE id='$getid'") or die($conn->error);
        $conn->query("UPDATE checkout SET status= 'TO RECEIVE' WHERE id='$get_cart_id'") or die($conn->error);

    ?>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
        <script>
                $(document).ready(function(){
                    Swal.fire({
                    position: 'middle',
                    icon: 'success',
                    title: 'Order Approved',
                    showConfirmButton: false,
                    timer: 1000
                    }).then((result)=>{

                        window.location.href = "order_request_seller.php";
                    })
                    })
        </script>
    <?php
    }else {
        ?>
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
        <script>
                $(document).ready(function(){
                    Swal.fire({
                    position: 'middle',
                    icon: 'error',
                    title: 'Insufficient Stock',
                    showConfirmButton: false,
                    timer: 1000
                    }).then((result)=>{

                        window.location.href = "order_request_seller.php";
                    })
                    })
        </script>
        <?php
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

                        window.location.href = "my_purchases_seller.php";
                    })
                    })
        </script>
    <?php
}


?>



<?php
if(isset($_GET['reject_cart_id'])){
    $get_cart_id = $_GET['reject_cart_id'];
    $conn->query("UPDATE checkout SET status= 'REJECT' WHERE id='$get_cart_id'") or die($conn->error);
    ?>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
        <script>
                $(document).ready(function(){
                    Swal.fire({
                    position: 'middle',
                    icon: 'success',
                    title: 'Order Reject Successfully',
                    showConfirmButton: false,
                    timer: 1000
                    }).then((result)=>{

                        window.location.href = "order_request_seller.php";
                    })
                    })
        </script>
    <?php

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

                window.location.href = "my_purchases_seller.php";
            })
            })

</script>    
<?php
    }
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

                        window.location.href = "my_purchases_seller.php";
                    })
                    })
        </script>
<?php
}
?>