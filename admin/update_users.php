<!DOCTYPE html>
<html lang="en">
    <?php
        session_start();
        error_reporting(0);

        include("../connection/connect.php");

        if(isset($_POST['submit']))         //Αν ο admin πατήσει το κουμπί 'Save'
        {
            if(empty($_POST['uname']) || empty($_POST['fname'])|| empty($_POST['lname']) ||  empty($_POST['email'])||empty($_POST['password'])||empty($_POST['phone'])){        //Αν δεν έχουν συμπληρωθεί συγκεκριμένα πεδία
                $error='<div class="alert alert-danger alert-dismissible fade show">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <strong>All fields Required.</strong>
                        </div>';
            }
            else{
                if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){        //Αν το εισαχθέν email δεν έχει την σωστή μορφή (π.χ name@gmail.com)
                    $error='<div class="alert alert-danger alert-dismissible fade show">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <strong>Invalid email.</strong>
                            </div>';
                }
                elseif(strlen($_POST['password']) < 6){         //Αν το password έχει μήκος < 6
                    $error='<div class="alert alert-danger alert-dismissible fade show">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <strong>Password must be >=6.</strong>
                            </div>';
                }
                elseif(strlen($_POST['phone']) < 10){           //Αν ο αριθμός τηλεφώνου έχει μήκος < 10
                    $error='<div class="alert alert-danger alert-dismissible fade show">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <strong>Invalid phone.</strong>
                            </div>';
                }
                else{
                    $mql = "update users set username='$_POST[uname]', f_name='$_POST[fname]', l_name='$_POST[lname]',email='$_POST[email]',phone='$_POST[phone]',password='.md5($_POST[password]).' where u_id='$_GET[user_upd]' ";
                    mysqli_query($db, $mql);
                    $success='<div class="alert alert-success alert-dismissible fade show">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <strong>User Updated!</strong>
                            </div>';
                }
            }
        }
    ?>


<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/png" sizes="16x16" href="images/favicon.png">
    <title>Update Users</title>
    <link href="css/lib/bootstrap/bootstrap.min.css" rel="stylesheet">
    <link href="css/helper.css" rel="stylesheet">
    <link href="css/style.css?v=<?php echo time(); ?>" rel="stylesheet">
</head>


<body class="fix-header">
    <div class="preloader">
        <svg class="circular" viewBox="25 25 50 50">
			<circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10" />
        </svg>
    </div>
    <div id="main-wrapper">
         <div class="header bg-dark">
            <nav class="navbar top-navbar navbar-expand-md navbar-light">
                <div class="navbar-header bg-dark">
                    <a class="navbar-brand" href="dashboard.php"> <span style="color:#fff; font-weight:bold">myOnlineDelivery</span> </a>
                </div>
                <div class="navbar-collapse">
                    <ul class="navbar-nav mr-auto mt-md-0"></ul>
                    <ul class="navbar-nav my-lg-0">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle text-muted  " href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img src="images/bookingSystem/user-icn.png" alt="user" class="profile-pic" /></a>
                            <div class="dropdown-menu dropdown-menu-right animated zoomIn">
                                <ul class="dropdown-user">
                                    <li><a href="logout.php"><i class="fa fa-power-off"></i> Logout</a></li>
                                </ul>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>
   
        <div class="left-sidebar">
            <div class="scroll-sidebar bg-dark">
                <nav class="sidebar-nav">
                    <ul id="sidebarnav">
                        <li class="nav-devider"></li>
                        <li class="nav-label">Home</li>
                        <li> <a href="dashboard.php"><i class="fa fa-tachometer text-white"></i><span class="text-white">Dashboard</span></a></li>
                        <li class="nav-label">Log</li>
                        <li> <a href="all_users.php">  <span><i class="fa fa-user f-s-20 text-white"></i></span><span class="text-white">Users</span></a></li>
                        <li>
                            <a class="has-arrow  " href="#" aria-expanded="false"><i class="fa fa-archive f-s-20 text-white"></i><span class="hide-menu text-white">Restaurant</span></a>
                            <ul aria-expanded="false" class="collapse">
								<li><a href="all_restaurant.php" class="text-white">All Restaurants</a></li>
								<li><a href="add_category.php" class="text-white">Add Category</a></li>
                                <li><a href="add_restaurant.php" class="text-white">Add Restaurant</a></li>
                            </ul>
                        </li>
                        <li>
                            <a class="has-arrow  " href="#" aria-expanded="false"><i class="fa fa-cutlery text-white" aria-hidden="true"></i><span class="hide-menu text-white">Menu</span></a>
                            <ul aria-expanded="false" class="collapse">
								<li><a href="all_menu.php" class="text-white">All Menues</a></li>
								<li><a href="add_menu.php" class="text-white">Add Menu</a></li>
                            </ul>
                        </li>
						<li> <a href="all_orders.php"><i class="fa fa-shopping-cart text-white" aria-hidden="true"></i><span class="text-white">Orders</span></a></li>
                    </ul>
                </nav>
            </div>
        </div>

        <div class="page-wrapper">
            <div class="row page-titles">
                <div class="col-md-5 align-self-center">
                    <h3 class="text-danger" style="font-weight:900">Dashboard</h3> 
                </div>
            </div>
            <div class="container-fluid">
                <div class="row">
                    <div class="container-fluid">
                        <?php  
                            echo $error;
                            echo $success; 
                        ?>
                        <div class="col-lg-12">
                            <div class="card card-outline-primary bg-dark">
                                <div class="card-header">
                                    <h4 class="m-b-0 text-white text-center">Update User</h4>
                                </div>
                                <div class="card-body">
                                    <?php 
                                        $ssql ="select * from users where u_id='$_GET[user_upd]'";
                                        $res=mysqli_query($db, $ssql); 
                                        $newrow=mysqli_fetch_array($res);
                                    ?>
                                    <form action='' method='post'>
                                        <div class="form-body">
                                            <hr>
                                            <div class="row p-t-20">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="control-label">Username</label>
                                                        <input type="text" name="uname" class="form-control" value="<?php  echo $newrow['username']; ?>">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="control-label">Password</label>
                                                        <input type="text" name="password" class="form-control form-control-danger"   value="<?php  echo $newrow['password'];  ?>">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group has-danger">
                                                        <label class="control-label">FirstName</label>
                                                        <input type="text" name="fname" class="form-control form-control-danger"  value="<?php  echo $newrow['f_name'];  ?>">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="control-label">LastName </label>
                                                        <input type="text" name="lname" class="form-control" value="<?php  echo $newrow['l_name']; ?>">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group has-danger">
                                                        <label class="control-label">Email</label>
                                                        <input type="text" name="email" class="form-control form-control-danger"  value="<?php  echo $newrow['email'];  ?>">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="control-label">Phone</label>
                                                        <input type="text" name="phone" class="form-control form-control-danger"   value="<?php  echo $newrow['phone'];  ?>">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-actions">
                                            <input type="submit" name="submit" class="btn btn-primary" value="Save"> 
                                            <a href="all_users.php" class="btn btn-inverse">Cancel</a>
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

    <script src="js/lib/jquery/jquery.min.js"></script>
    <script src="js/lib/bootstrap/js/popper.min.js"></script>
    <script src="js/lib/bootstrap/js/bootstrap.min.js"></script>
    <script src="js/jquery.slimscroll.js"></script>
    <script src="js/sidebarmenu.js"></script>
    <script src="js/lib/sticky-kit-master/dist/sticky-kit.min.js"></script>
    <script src="js/custom.min.js"></script>
</body>
</html>