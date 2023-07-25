<!DOCTYPE html>
<html lang="en">

<script type="text/javascript">
  function openAdminPage(event) {
    event.preventDefault();           //Αποτρέπει τον προεπιλεγμένο χειρισμό του συνδέσμου (το ανοίγμα του στην ίδια καρτέλα)

    window.open(event.target.href, '_blank');       //Ανοίγει τη νέα σελίδα σε νέο παράθυρο
  }
</script>

<head>
  <meta charset="UTF-8">
  <title>Login</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css">
  <link rel='stylesheet prefetch' href='https://fonts.googleapis.com/css?family=Roboto:400,100,300,500,700,900|RobotoDraft:400,100,300,500,700,900'>
  <link rel='stylesheet prefetch' href='https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css'>
  <link rel="stylesheet" href="css/login.css">

  <style type="text/css">
    #buttn {
      color: #fff;
      background-color: #5c4ac7;
    }
  </style>

  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <link href="css/font-awesome.min.css" rel="stylesheet">
  <link href="css/animsition.min.css" rel="stylesheet">
  <link href="css/animate.css" rel="stylesheet">
  <link href="css/style.css?v=<?php echo time(); ?>" rel="stylesheet">
</head>


<body>
  <header id="header" class="header-scroll top-header headrom">
    <nav class="navbar navbar-dark">
      <div class="container">
        <button class="navbar-toggler hidden-lg-up" type="button" data-toggle="collapse" data-target="#mainNavbarCollapse">&#9776;</button>
        <a class="navbar-brand" href="index.php" style="color:yellow; font-weight:bold; font-size:1.2rem"> myOnlineDelivery </a>
        <div class="collapse navbar-toggleable-md  float-lg-right" id="mainNavbarCollapse">
          <ul class="nav navbar-nav">
            <li class="nav-item"> <a class="nav-link active" href="index.php" style="color:yellow; font-weight:bold; font-size:1.2rem">Home <span class="sr-only">(current)</span></a></li>
            <li class="nav-item"> <a class="nav-link active" href="restaurants.php" style="color:yellow; font-weight:bold; font-size:1.2rem">Restaurants <spanclass="sr-only"></span></a></li>
            <?php
              if(empty($_SESSION["user_id"])){
                echo '<li class="nav-item"><a href="login.php" class="nav-link active" style="color:yellow; font-weight:bold; font-size:1.2rem">Login</a> </li>
                <li class="nav-item"><a href="registration.php" class="nav-link active" style="color:yellow; font-weight:bold; font-size:1.2rem">Register</a> </li>
                <li class="nav-item"><a href="admin/index.php" class="nav-link active" style="color: yellow; font-weight: bold; font-size: 1.2rem" onclick="openAdminPage(event)">Admin</a></li>';
              }
              else{
                echo  '<li class="nav-item"><a href="your_orders.php" class="nav-link active" style="color:yellow; font-weight:bold; font-size:1.2rem">My Orders</a> </li>';
                echo  '<li class="nav-item"><a href="logout.php" class="nav-link active" style="color:yellow; font-weight:bold; font-size:1.2rem">Logout</a> </li>';
              }
						?>
          </ul>
        </div>
      </div>
    </nav>
  </header>

  <div style=" background-image: url('images/img/login-bg.jpg');">
    <?php
      include("connection/connect.php"); 

      error_reporting(0); 
      session_start(); 

      if(isset($_POST['submit']))      //Αν ο χρήστης πατήσει το κουμπί 'Login'
      {
        $username = $_POST['username'];  
        $password = $_POST['password'];
        
        if(!empty($_POST["submit"])){
          $loginquery ="SELECT * FROM users WHERE username='$username' && password='".md5($password)."'";      //Αναζήτηση στη βάση με βάση τα στοιχεία που εισήχθησαν
          $result=mysqli_query($db, $loginquery);
          $row=mysqli_fetch_array($result);
        
          if(is_array($row)){         //Αν τα στοιχεία που εισήγαγε ο χρήστης είναι έγκυρα
            $_SESSION["user_id"] = $row['u_id']; 
            header("refresh:1;url=index.php"); 
          }else{
            $message = "Invalid Username or Password."; 
          }
        }
      }
    ?>

    <div class="pen-title"> </div> 
    <div class="module form-module">
        <div class="toggle"></div>
        <div class="form" style="background-color:#F0E68C">
          <h2>Login to your account</h2>
          <span style="color:red;"><?php echo $message; ?></span>
          <span style="color:green;"><?php echo $success; ?></span>
          <form action="" method="post">
            <input type="text" placeholder="Username" name="username" />
            <input type="password" placeholder="Password" name="password" />
            <input type="submit" id="buttn" name="submit" value="Login" />
          </form>
        </div>
        <div class="cta">Not registered?<a href="registration.php" style="color:#5c4ac7;"> Create an account</a></div>
    </div>
    <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>

    <div class="container-fluid pt-3">
      <p></p>
    </div>

    <footer class="footer">
      <div class="container">
        <div class="bottom-footer">
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
                <h5>information</h5>
                <p>Join thousands of other restaurants who benefit from having partnered with us.</p>
            </div>
          </div>
        </div>
      </div>
    </footer>
  </div>
  
</body>
</html>