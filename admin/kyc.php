<?php 
 include('../dbconn.php');
?>

<!DOCTYPE html>
<html dir="ltr" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="noindex,nofollow">
    <link href="assets/images/users/logo.png" rel="icon">
    <title>AgriconMart - KYC Panel</title>
    <link href="assets/libs/chartist/dist/chartist.min.css" rel="stylesheet">
    <link href="dist/css/style.css" rel="stylesheet">

</head>

<style>
    .no-result-div{
        display:none;
    }
</style>

<body>
    <div class="preloader">
        <div class="lds-ripple">
            <div class="lds-pos"></div>
            <div class="lds-pos"></div>
        </div>
    </div>
    <div id="main-wrapper" data-navbarbg="skin6" data-theme="light" data-layout="vertical" data-sidebartype="full"
        data-boxed-layout="full">
        <header class="topbar" data-navbarbg="skin6">
            <nav class="navbar top-navbar navbar-expand-md navbar-light">
                <div class="navbar-header" data-logobg="skin5">
                    <a class="nav-toggler waves-effect waves-light d-block d-md-none" href="javascript:void(0)">
                        <i class="ti-menu ti-close"></i>
                    </a>
                    <div class="navbar-brand text-center">
                        <a href="main.php" class="logo">
                            <b class="logo-icon">
                                <img src="assets/images/users/logo.png" width="35" alt="homepage" class="light-logo" />
                            </b>
                            <span class="logo-text">
                                <span style="color: white">AgriconMart</span>
                            </span>
                        </a>
                    </div>
                </div>
                <div class="navbar-collapse collapse" id="navbarSupportedContent" data-navbarbg="skin6">
                    <ul class="navbar-nav float-start me-auto">
                        <li class="nav-item search-box">
                            <form class="app-search position-absolute">
                                <input type="text" class="form-control" placeholder="Search &amp; enter">
                                <a class="srh-btn">
                                    <i class="ti-close"></i>
                                </a>
                            </form>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>
        <aside class="left-sidebar" data-sidebarbg="skin5">
            <div class="scroll-sidebar">
                <nav class="sidebar-nav">
                    <ul id="sidebarnav">
                        <li class="sidebar-item">
                            <a class="sidebar-link waves-effect waves-dark sidebar-link" href="dashboard.php"
                                aria-expanded="false">
                                <i class="mdi mdi-av-timer"></i>
                                <span class="hide-menu">Dashboard</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link waves-effect waves-dark sidebar-link" href="user.php"
                                aria-expanded="false">
                                <i class="mdi mdi-account"></i>
                                <span class="hide-menu">User's Data</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link waves-effect waves-dark sidebar-link" href="kyc.php"
                                aria-expanded="false">
                                <i class="mdi mdi-calendar-text"></i>
                                <span class="hide-menu">KYC Panel</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link waves-effect waves-dark sidebar-link" href="web_info.php"
                                aria-expanded="false">
                                <i class="mdi mdi-alert-circle"></i>
                                <span class="hide-menu">Website Information</span>
                            </a>
                        </li>

                        <li class="sidebar-item">
                            <a class="sidebar-link waves-effect waves-dark sidebar-link" href="index.php"
                                aria-expanded="false">
                                <i class="mdi mdi-arrow-left"></i>
                                <span class="hide-menu">Logout</span>
                            </a>
                        </li>
                       
                    </ul>
                </nav>
            
            </div>
        </aside>
        <div class="page-wrapper">
            <div class="page-breadcrumb">
                <div class="row">
                    <div class="col-5 align-self-center">
                        <h4 class="page-title">KYC Panel</h4>
                        <div class="col-lg-10" style="display: inline-flex;">
                            <input type="search" class="form-control rounded"  placeholder="Search" onkeyup="userSearch()" id="searchUser" />
                            <span class="input-group-text bg-success text-white"><i class='mdi mdi-magnify'></i></span>
                        </div>
                    </div>
                    <div class="col-7 align-self-center">
                        <div class="d-flex align-items-center justify-content-end">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item">
                                        <a href="index.php">Home</a>
                                    </li>
                                    <li class="breadcrumb-item active" aria-current="page">KYC Panel</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
            <br><br>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card card-body">
                            <div class="container-fluid">
                                <div class="card-body overflow-auto table-responsive">
                                    <table class="table table-hover" id="userTable">
                                        <thead class="thead-dark">
                                          <tr>
                                            <th scope="col">Name</th>
                                            <th scope="col">Category</th>
                                            <th scope="col">Status</th>
                                            <th scope="col">Action</th>
                                          </tr>
                                        </thead>
                                        <tbody>
                                        <?php 
                                            $query = "SELECT * FROM accounts ";
                                            $result = mysqli_query($conn, $query);
                                            while ($row = mysqli_fetch_array($result)) {

                                        ?>
                                          <tr>
                                            <td><?php echo $row['firstname']; ?> <?php echo $row['middlename']; ?> <?php echo $row['lastname']; ?></td>
                                            <td><?php echo $row['type']; ?></td>
                                            <td>
                                                <?php 
                                                if ($row['status'] == 'VERIFIED'){
                                                    $set_status = $row['status'];
                                                    echo '
                                                    <span style="color:green">'.$set_status.'</span>
                                                    ';
                                                }elseif ($row['status'] == 'UNVERIFIED') {
                                                    $set_status = $row['status'];
                                                    echo '
                                                    <span style="color:rgb(213,213,0)">'.$set_status.'</span>
                                                    ';
                                                }
                                                else{
                                                    $set_status = $row['status'];
                                                    echo '
                                                    <span style="color:red">'.$set_status.'</span>
                                                    ';
                                                }
                                                ?>
                                            </td>
                                            <td>
                                                <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#verifyModal<?php echo $row['id'] ?>"> <i class="mdi mdi-check"></i></button>
                                                <button type="button" class="btn btn-danger" style="color:white" data-bs-toggle="modal" data-bs-target="#denyModal<?php echo $row['id'] ?>"> <i class="mdi mdi-close"></i></button>
                                            </td>
                                          </tr>
                                        </tbody>

                                         <!-- Modal Verify -->
                                         <div class="modal fade" id="verifyModal<?php echo $row['id'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                <div class="modal-header" style="background-color:green; color: white">
                                                    <h5 class="modal-title" id="exampleModalLabel">Verify this User: <?php echo $row['firstname']; ?> <?php echo $row['middlename']; ?> <?php echo $row['lastname']; ?></h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <form method="POST" action="process.php">
                                                    <div class="modal-body">
                                                        <div class="row">
                                                            <div class="col-md-4">
                                                                <label for="">Account Information:</label>
                                                                <ul>
                                                                    <li><?php echo $row['firstname']; ?> <?php echo $row['middlename']; ?> <?php echo $row['lastname']; ?></li>
                                                                    <li><?php echo $row['email']; ?></li>
                                                                    <li><?php echo $row['address']; ?></li>
                                                                </ul>
                                                            </div>
                                                            <div class="col-md-8">
                                                                <div class="text-center">
                                                                    <label for="">Valid I.D:</label>
                                                                    <img src="../<?php echo $row['valid_id']; ?> " width="250" alt="">
                                                                </div>   
                                                            </div>
                                                        </div>
                                                        <br>
                                                        <label for="">Remarks/Reason:</label>
                                                        <textarea class="form-control" name="msg" id="" cols="30" rows="5" required></textarea>
                                                    </div>

                                                    <div class="modal-footer">
                                                        <input type="hidden" value="<?php echo $row['id'] ?>" name="id">
                                                        <input type="hidden" value="<?php echo $row['status'] ?>" name="check_stat">
                                                        <input type="hidden" value="<?php echo $row['email'] ?>" name="email">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-success" name="verify_user">Send</button>
                                                    </div>
                                                </form>
                                                </div>
                                            </div>
                                        </div>

                                            <!-- Modal Deny -->
                                        <div class="modal fade" id="denyModal<?php echo $row['id'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                <div class="modal-header" style="background-color:red; color: white">
                                                    <h5 class="modal-title" id="exampleModalLabel">Deny this User: <?php echo $row['firstname']; ?> <?php echo $row['middlename']; ?> <?php echo $row['lastname']; ?></h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <form method="POST" action="process.php">
                                                    <div class="modal-body">
                                                        <div class="row">
                                                            <div class="col-md-4">
                                                                <label for="">Account Information:</label>
                                                                <ul>
                                                                    <li><?php echo $row['firstname']; ?> <?php echo $row['middlename']; ?> <?php echo $row['lastname']; ?></li>
                                                                    <li><?php echo $row['email']; ?></li>
                                                                    <li><?php echo $row['address']; ?></li>
                                                                </ul>
                                                            </div>
                                                            <div class="col-md-8">
                                                                <div class="text-center">
                                                                    <label for="">Valid I.D:</label>
                                                                    <img src="../<?php echo $row['valid_id']; ?> " width="250" alt="">
                                                                </div>   
                                                            </div>
                                                        </div>
                                                        <br>
                                                        <label for="">Remarks/Reason:</label>
                                                        <textarea class="form-control" name="msg" id="" cols="30" rows="5" required></textarea>
                                                    </div>

                                                    <div class="modal-footer">
                                                        <input type="hidden" value="<?php echo $row['id'] ?>" name="id">
                                                        <input type="hidden" value="<?php echo $row['status'] ?>" name="check_stat">
                                                        <input type="hidden" value="<?php echo $row['email'] ?>" name="email">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-danger" name="deny_user">Send</button>
                                                    </div>
                                                </form>
                                                </div>
                                            </div>
                                        </div>

                                        <?php } ?>
                                      </table>
                                      <br>
                                                
                                    <?php 
                                        $sql = "SELECT * FROM accounts ";
                                        $result=mysqli_query($conn, $sql);
                                        $row = mysqli_num_rows($result);
                                    ?>
                                    <p>Showing <?php echo $row; ?> entries </p>
                        
                                    
                                    <div class="no-result-div mt-4 text-center" id="no-user">
                                        <div class="div">
                                            <img src="assets/images/search.svg" width="150" height="150" alt="">
                                            <h4 class="mt-3">Search not found...</h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <footer class="footer text-center">
                AgriconMart
            </footer>
        </div>
    </div>

    <script src="assets/libs/jquery/dist/jquery.min.js"></script>
    <script src="assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="assets/extra-libs/sparkline/sparkline.js"></script>
    <script src="dist/js/waves.js"></script>
    <script src="dist/js/sidebarmenu.js"></script>
    <script src="dist/js/custom.min.js"></script>
    <script src="dist/js/functions.js"></script>
</body>

</html>