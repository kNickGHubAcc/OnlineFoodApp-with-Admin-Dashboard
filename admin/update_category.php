<!DOCTYPE html>
<html lang="en">
<?php
    include("../connection/connect.php");

    error_reporting(0);
    session_start();

    if(isset($_POST['submit']))         //Αν ο χρήστης πατήσει το κουμπί 'Save'
    {
        if(empty($_POST['c_name'])){       //Αν δεν έχει εισαχθεί κάποια κατηγορία
            $error='<div class="alert alert-danger alert-dismissible fade show">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <strong>Field Required.</strong>
                    </div>';
        }
        else{
            $mql = "update res_category set c_name ='$_POST[c_name]' where c_id='$_GET[cat_upd]'";          //Update της κατηγορίας με την νέα κατηγορία που εισήγαγε ο χρήστης
            mysqli_query($db, $mql);
            $success='<div class="alert alert-success alert-dismissible fade show">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <strong>Category updated!</strong> successfully!</br>
                    </div>';
        }
    }
?>


<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/png" sizes="16x16" href="images/favicon.png">
    <title>Update Category</title>
    <link href="css/lib/bootstrap/bootstrap.min.css" rel="stylesheet">
    <link href="css/helper.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
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
                    <ul class="navbar-nav mr-auto mt-md-0">
                        <li class="nav-item dropdown mega-dropdown">
                            <div class="dropdown-menu animated zoomIn"></div>
                        </li>
                    </ul>
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
                        <li> <a class="has-arrow  " href="#" aria-expanded="false"><i class="fa fa-archive f-s-20 text-white"></i><span class="hide-menu text-white">Restaurant</span></a>
                            <ul aria-expanded="false" class="collapse">
								<li><a href="all_restaurant.php" class="text-white">All Restaurants</a></li>
								<li><a href="add_category.php" class="text-white">Add Category</a></li>
                                <li><a href="add_restaurant.php" class="text-white">Add Restaurant</a></li>
                            </ul>
                        </li>
                       <li> <a class="has-arrow  " href="#" aria-expanded="false"><i class="fa fa-cutlery text-white" aria-hidden="true"></i><span class="hide-menu text-white">Menu</span></a>
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
                                    <h4 class="m-b-0 text-white text-center">Update Restaurant Category</h4>
                                </div>
                                <div class="card-body">
                                    <form action='' method='post' >
                                        <div class="form-body">
                                            <?php 
                                                $ssql ="select * from res_category where c_id='$_GET[cat_upd]'";
                                                $res=mysqli_query($db, $ssql); 
                                                $row=mysqli_fetch_array($res);
                                            ?>
                                            <hr>
                                            <div class="row p-t-20">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label class="control-label">Category</label>
                                                        <input type="text" name="c_name" value="<?php echo $row['c_name'];  ?>" class="form-control">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-actions">
                                            <input type="submit" name="submit" class="btn btn-primary" value="Save"> 
                                            <a href="add_category.php" class="btn btn-inverse">Cancel</a>
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