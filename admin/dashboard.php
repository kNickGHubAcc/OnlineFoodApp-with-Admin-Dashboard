<!DOCTYPE html>
<html lang="en">
    <?php
        include("../connection/connect.php");

        error_reporting(0);
        session_start();

        if(empty($_SESSION["adm_id"]))      //Αν δεν υπάρχει καταχωρημένος admin στη βάση δεδομένων
        {
            header('location:index.php');
        }
        else{
    ?>


    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">    
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Admin Panel</title>
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
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle text-muted " href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img src="images/bookingSystem/user-icn.png" alt="user" class="profile-pic" /></a>
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
        
            <div class="left-sidebar bg-dark">
                <div class="scroll-sidebar">
                    <nav class="sidebar-nav">
                        <ul id="sidebarnav">
                            <li class="nav-devider"></li>
                            <li class="nav-label">Home</li>
                            <li> <a href="dashboard.php"><i class="fa fa-tachometer"></i><span>Dashboard</span></a></li>
                            <li class="nav-label">Log</li>
                            <li> <a href="all_users.php">  <span><i class="fa fa-user f-s-20 text-white"></i></span><span class="text-white">Users</span></a></li>
                            <li> <a class="has-arrow" href="#" aria-expanded="false"><i class="fa fa-archive f-s-20 text-white"></i><span class="hide-menu text-white">Restaurant</span></a>
                                <ul aria-expanded="false" class="collapse">
                                    <li><a href="all_restaurant.php" class="text-white">All Restaurant</a></li>
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
                <div class="container-fluid">
                    <div class="col-lg-12">
                        <div class="card card-outline-primary">
                            <div class="card-header">
                                <h4 class="m-b-0 text-white text-center">Admin Dashboard</h4>
                            </div>
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="card p-30 bg-dark">
                                        <div class="media">
                                            <div class="media-left meida media-middle">
                                                <span><i class="fa fa-home f-s-40"></i></span>
                                            </div>
                                            <div class="media-body media-text-right">
                                                <h2>
                                                    <?php 
                                                        $sql="select * from restaurant";
                                                        $result=mysqli_query($db,$sql); 
                                                        $rws=mysqli_num_rows($result);        //Το πλήθος των restaurants που υπάρχουν στη βάση
                                                        echo '<div style="color:white;">' . $rws . '</div>';
                                                    ?>
                                                </h2>
                                                <p class="m-b-0 text-white">Restaurants</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            
                                <div class="col-md-3">
                                    <div class="card p-30 bg-dark">
                                        <div class="media">
                                            <div class="media-left meida media-middle">
                                                <span><i class="fa fa-cutlery f-s-40" aria-hidden="true"></i></span>
                                            </div>
                                            <div class="media-body media-text-right">
                                                <h2>
                                                    <?php 
                                                        $sql="select * from dishes";
                                                        $result=mysqli_query($db,$sql); 
                                                        $rws=mysqli_num_rows($result);          //Το πλήθος των dishes που υπάρχουν στη βάση
                                                        echo '<div style="color:white;">' . $rws . '</div>';
                                                    ?>
                                                </h2>
                                                <p class="m-b-0 text-white">Dishes</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="col-md-3">
                                    <div class="card p-30 bg-dark">
                                        <div class="media">
                                            <div class="media-left meida media-middle">
                                                <span><i class="fa fa-users f-s-40"></i></span>
                                            </div>
                                            <div class="media-body media-text-right">
                                                <h2>
                                                    <?php 
                                                        $sql="select * from users";
                                                        $result=mysqli_query($db,$sql); 
                                                        $rws=mysqli_num_rows($result);          //Το πλήθος των χρηστών που υπάρχουν στη βάση
                                                        echo '<div style="color:white;">' . $rws . '</div>';
                                                    ?>
                                                    </h2>
                                                <p class="m-b-0 text-white">Users</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="col-md-3">
                                    <div class="card p-30 bg-dark">
                                        <div class="media">
                                            <div class="media-left meida media-middle"> 
                                                <span><i class="fa fa-shopping-cart f-s-40" aria-hidden="true"></i></span>
                                            </div>
                                            <div class="media-body media-text-right">
                                                <h2>
                                                    <?php 
                                                        $sql="select * from users_orders";
                                                        $result=mysqli_query($db,$sql); 
                                                        $rws=mysqli_num_rows($result);          //Το πλήθος των παραγγελιών που υπάρχουν στη βάση
                                                        echo '<div style="color:white;">' . $rws . '</div>';
                                                    ?>
                                                </h2>
                                                <p class="m-b-0 text-white">Total Orders</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>	                   
                            </div>     
                    
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="card p-30 bg-dark">
                                        <div class="media">
                                            <div class="media-left meida media-middle"> 
                                                <span><i class="fa fa-th-large f-s-40" aria-hidden="true"></i></span>
                                            </div>
                                            <div class="media-body media-text-right">
                                                <h2>
                                                    <?php 
                                                        $sql="select * from res_category";
                                                        $result=mysqli_query($db,$sql); 
                                                        $rws=mysqli_num_rows($result);          //Το πλήθος των κατηγοριών των restaurants
                                                        echo '<div style="color:white;">' . $rws . '</div>';
                                                    ?>
                                                </h2>
                                                <p class="m-b-0 text-white">Restaurant Categories</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="col-md-4">
                                    <div class="card p-30 bg-dark">
                                        <div class="media">
                                            <div class="media-left meida media-middle"> 
                                                <span><i class="fa fa-spinner f-s-40" aria-hidden="true"></i></span>
                                            </div>
                                            <div class="media-body media-text-right">
                                                <h2>
                                                    <?php 
                                                        $sql="select * from users_orders WHERE status = 'in process' ";
                                                        $result=mysqli_query($db,$sql); 
                                                        $rws=mysqli_num_rows($result);          //Το πλήθος των παραγγελιών που έχουν status 'in process'
                                                        echo '<div style="color:white;">' . $rws . '</div>';
                                                    ?>
                                                </h2>
                                                <p class="m-b-0 text-white">Processing Orders</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="card p-30 bg-dark">
                                        <div class="media">
                                            <div class="media-left meida media-middle"> 
                                                <span><i class="fa fa-check f-s-40" aria-hidden="true"></i></span>
                                            </div>
                                            <div class="media-body media-text-right">
                                                <h2>
                                                    <?php 
                                                        $sql="select * from users_orders WHERE status = 'closed' ";
                                                        $result=mysqli_query($db,$sql); 
                                                        $rws=mysqli_num_rows($result);          //Το πλήθος των παραγγελιών που έχουν status 'closed'
                                                        echo '<div style="color:white;">' . $rws . '</div>';
                                                    ?>
                                                </h2>
                                                <p class="m-b-0 text-white">Delivered Orders</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-4">
                                    <div class="card p-30 bg-dark">
                                        <div class="media">
                                            <div class="media-left meida media-middle"> 
                                                <span><i class="fa fa-times f-s-40" aria-hidden="true"></i></span>
                                            </div>
                                            <div class="media-body media-text-right">
                                                <h2>
                                                    <?php 
                                                        $sql="select * from users_orders WHERE status = 'rejected' ";
                                                        $result=mysqli_query($db,$sql); 
                                                        $rws=mysqli_num_rows($result);          //Το πλήθος των παραγγελιών που έχουν status 'rejected'
                                                        echo '<div style="color:white;">' . $rws . '</div>';
                                                    ?>
                                                </h2>
                                                <p class="m-b-0 text-white">Cancelled Orders</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="card p-30 bg-dark">
                                        <div class="media">
                                            <div class="media-left meida media-middle"> 
                                                <span><i class="fa fa-usd f-s-40" aria-hidden="true"></i></span>
                                            </div>
                                            <div class="media-body media-text-right">
                                                <h2>
                                                    <?php 
                                                        $result = mysqli_query($db, 'SELECT SUM(price) AS value_sum FROM users_orders WHERE status = "closed"'); 
                                                        $row = mysqli_fetch_assoc($result); 
                                                        $sum = $row['value_sum'];           //Το πλήθος των ολοκληρωμένων πληρωμών που έχουν πραγματοποιηθεί
                                                        echo '<div style="color:white;">' . $rws . '</div>';
                                                    ?>
                                                </h2>
                                                <p class="m-b-0 text-white">Total Earnings</p>
                                            </div>
                                        </div>
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

<?php
    }
?>