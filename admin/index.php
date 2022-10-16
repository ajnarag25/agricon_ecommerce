<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="assets/images/users/logo.png" rel="icon">
    <title>Login Administrator</title>
    <link rel="stylesheet" href="dist/css/login.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
    <div class="container">
        <div class="container-fluid ps-md-0">
            <div class="row g-0">
                <div class="d-none d-md-flex col-md-4 col-lg-6 " style="background-image:url('assets/images/users/logo.png');    background-size: 700px 300px; background-repeat:no-repeat; background-position: center;"></div>
                    <div class="col-md-8 col-lg-6">
                        <div class="login d-flex align-items-center py-5">
                            <div class="container">
                                <div class="row">
                                    <div class="col-md-9 col-lg-8 mx-auto">
                                        <h3 class="login-heading mb-4">Login Administrator</h3>

                                    <form action="process.php" method="POST">
                                        <div class="form-floating mb-3">
                                            <label for="floatingInput">Username</label>
                                            <input type="text" class="form-control" name="username"  placeholder="Enter Username" required>

                                        <div class="form-floating mb-3">
                                            <label for="floatingPassword">Password</label>
                                            <input type="password" class="form-control" name="password" placeholder="Enter Password" required>
                                        </div>
                                        <a href="">Forgot Password?</a>
                                        <br><br>
                                        <div class="d-grid">
                                            <button class="btn btn-lg btn-success btn-login w-100" name="login_admin" type="submit">Login</button>
                                        </div>

                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


</body>
</html>