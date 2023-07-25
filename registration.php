<!DOCTYPE html>
<html lang="en">
<?php
   session_start(); 
   error_reporting(0); 
   include("connection/connect.php"); 

   if(isset($_POST['submit'] )) {         //Αν ο χρήστης πατήσει το κουμπί 'Register'
      if(empty($_POST['firstname']) || empty($_POST['lastname'])||  empty($_POST['email']) ||   empty($_POST['phone'])|| empty($_POST['password'])|| empty($_POST['cpassword']) || empty($_POST['cpassword'])){       //Αν δεν έχουν συμπληρωθεί συγκεκριμένα πεδία
         $message = "All fields must be Required.";
      }
      else{
         $check_username= mysqli_query($db, "SELECT username FROM users where username = '".$_POST['username']."' ");      //Αναζήτηση για εύρεση ίδιου username στη βάση
         $check_email = mysqli_query($db, "SELECT email FROM users where email = '".$_POST['email']."' ");        //Αναζήτηση για εύρεση ίδιου email στη βάση
            
         if($_POST['password'] != $_POST['cpassword']){        //Αν το password δεν ταιριαζει με το confirm password
            echo "<script>alert('Password does not match');</script>"; 
         }
         elseif(strlen($_POST['password']) < 6)  {             //Αν το password έχει μήκος < 6
            echo "<script>alert('Password Must be >=6');</script>"; 
         }
         elseif(strlen($_POST['phone']) < 10)  {               //Αν ο αριθμός τηλεφώνου έχει μήκος < 10
            echo "<script>alert('Invalid phone number!');</script>"; 
         }
         elseif (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {       //Αν το email δεν έχει έγκυρη μορφή
            echo "<script>alert('Invalid email address. Please type a valid email.');</script>"; 
         }
         elseif(mysqli_num_rows($check_username) > 0) {           //Αν υπάρχει το ίδιο username
            echo "<script>alert('Username Already exists!');</script>"; 
         }
         elseif(mysqli_num_rows($check_email) > 0) {              //Αν υπάρχει το ίδιο email
            echo "<script>alert('Email Already exists!');</script>"; 
         }
         else{
            $mql = "INSERT INTO users(username,f_name,l_name,email,phone,password,address) VALUES('".$_POST['username']."','".$_POST['firstname']."','".$_POST['lastname']."','".$_POST['email']."','".$_POST['phone']."','".md5($_POST['password'])."','".$_POST['address']."')";
            mysqli_query($db, $mql);            //Ο νέος χρήστης αποθηκεύεται στη βάση δεδομένων
            header("refresh:0.1;url=login.php");
         }
      }
   }
?>


<script type="text/javascript">
  function openAdminPage(event) {
    event.preventDefault();           //Αποτρέπει τον προεπιλεγμένο χειρισμό του συνδέσμου (το ανοίγμα του στην ίδια καρτέλα)

    window.open(event.target.href, '_blank');       //Ανοίγει τη νέα σελίδα σε νέο παράθυρο
  }
</script>


<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" href="#">
    <title>Registration</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <link href="css/animsition.min.css" rel="stylesheet">
    <link href="css/animate.css" rel="stylesheet">
    <link href="css/style.css?v=<?php echo time(); ?>" rel="stylesheet">
</head>


<body>
   <div>
      <header id="header" class="header-scroll top-header headrom">
         <nav class="navbar navbar-dark">
            <div class="container">
               <button class="navbar-toggler hidden-lg-up" type="button" data-toggle="collapse" data-target="#mainNavbarCollapse">&#9776;</button>
               <a class="navbar-brand" href="index.php" style="color:yellow; font-weight:bold; font-size:1.2rem"> myOnlineDelivery  </a>
               <div class="collapse navbar-toggleable-md  float-lg-right" id="mainNavbarCollapse">
                  <ul class="nav navbar-nav">
                     <li class="nav-item"> <a class="nav-link active" href="index.php" style="color:yellow; font-weight:bold; font-size:1.2rem">Home <span class="sr-only">(current)</span></a> </li>
                     <li class="nav-item"> <a class="nav-link active" href="restaurants.php" style="color:yellow; font-weight:bold; font-size:1.2rem">Restaurants <span class="sr-only"></span></a> </li>
                     <?php
                        if(empty($_SESSION["user_id"])){
                           echo '<li class="nav-item"><a href="login.php" class="nav-link active" style="color:yellow; font-weight:bold; font-size:1.2rem">Login</a> </li>
                           <li class="nav-item"><a href="registration.php" class="nav-link active" style="color:yellow; font-weight:bold; font-size:1.2rem">Register</a> </li>
                           <li class="nav-item"><a href="admin/index.php" class="nav-link active" style="color: yellow; font-weight: bold; font-size: 1.2rem" onclick="openAdminPage(event)">Admin</a></li>';
                        }
                        else{
                           echo  '<li class="nav-item"><a href="your_orders.php" class="nav-link active" style="color:yellow; font-weight:bold; font-size:1.2rem">My Orders</a> </li>';
                           echo  '<li class="nav-item"><a href="logout.php" class="nav-link active" style="color:yellow; font-weight:bold; font-size:1.2rem">Logout</a> </li>';
                           echo '<li class="nav-item"><a href="admin/index.php" class="nav-link active" style="color: yellow; font-weight: bold; font-size: 1.2rem" onclick="openAdminPage(event)">Admin</a></li>';
                           
                        }
                     ?>
                  </ul>
               </div>
            </div>
         </nav>
      </header>
      <div class="page-wrapper">
            <div class="container">
               <ul></ul>
            </div>
         <section class="contact-page inner-page">
            <div class="container ">
               <div class="row ">
                  <div class="col-md-12">
                     <div class="widget" >
                        <div class="widget-body">
                           <form action="" method="post">
                              <div class="row">
                                 <div class="form-group col-sm-12">
                                    <label for="exampleInputEmail1">Username</label>
                                    <input class="form-control" type="text" name="username" id="example-text-input"> 
                                 </div>
                                 <div class="form-group col-sm-6">
                                    <label for="exampleInputEmail1">First Name</label>
                                    <input class="form-control" type="text" name="firstname" id="example-text-input"> 
                                 </div>
                                 <div class="form-group col-sm-6">
                                    <label for="exampleInputEmail1">Last Name</label>
                                    <input class="form-control" type="text" name="lastname" id="example-text-input-2"> 
                                 </div>
                                 <div class="form-group col-sm-6">
                                    <label for="exampleInputEmail1">Email Address</label>
                                    <input type="text" class="form-control" name="email" id="exampleInputEmail1" aria-describedby="emailHelp"> 
                                 </div>
                                 <div class="form-group col-sm-6">
                                    <label for="exampleInputEmail1">Phone number</label>
                                    <input class="form-control" type="text" name="phone" id="example-tel-input-3"> 
                                 </div>
                                 <div class="form-group col-sm-6">
                                    <label for="exampleInputPassword1">Password</label>
                                    <input type="password" class="form-control" name="password" id="exampleInputPassword1"> 
                                 </div>
                                 <div class="form-group col-sm-6">
                                    <label for="exampleInputPassword1">Confirm password</label>
                                    <input type="password" class="form-control" name="cpassword" id="exampleInputPassword2"> 
                                 </div>
                                 <div class="form-group col-sm-12">
                                    <label for="exampleTextarea">Delivery Address</label>
                                    <textarea class="form-control" id="exampleTextarea"  name="address" rows="3"></textarea>
                                 </div>
                              </div>
                              <div class="row">
                                 <div class="col-sm-4">
                                    <p> <input type="submit" value="Register" name="submit" class="btn theme-btn"> </p>
                                 </div>
                              </div>
                           </form>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </section>
         
         <footer class="footer">
            <div class="container">
               <div class="row bottom-footer">
                  <div class="container">
                     <div class="row">
                        <div class="col-xs-12 col-sm-3 payment-options color-gray">
                           <h5>Payment</h5>
                           <ul>
                              <li><a href="#"> <img src="images/paypal.png" alt="Paypal"> </a></li>
                              <li><a href="#"> <img src="images/mastercard.png" alt="Mastercard"> </a></li>
                              <li><a href="#"> <img src="images/maestro.png" alt="Maestro"> </a></li>
                              <li><a href="#"> <img src="images/stripe.png" alt="Stripe"> </a></li>
                              <li><a href="#"> <img src="images/bitcoin.png" alt="Bitcoin"> </a></li>
                           </ul>
                        </div>
                        <div class="col-xs-12 col-sm-4 address color-gray">
                           <h5>Address</h5>
                           <p>Omonoias 45, Athens, Greece</p>
                           <h5>Phone-number: 210-78935641</a></h5>
                        </div>
                        <div class="col-xs-12 col-sm-5 additional-info color-gray">
                           <h5>Information</h5>
                           <p>Join thousands of other restaurants who benefit from having partnered with us.</p>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </footer>
      </div>
       
    <script src="js/jquery.min.js"></script>
    <script src="js/tether.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/animsition.min.js"></script>
    <script src="js/bootstrap-slider.min.js"></script>
    <script src="js/jquery.isotope.min.js"></script>
    <script src="js/headroom.js"></script>
    <script src="js/foodpicky.min.js"></script>
</body>
</html>