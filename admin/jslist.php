<?php

  session_start();
  if(!$_SESSION)
    header("location:login.php");
  // check for session
  if($_SESSION)
{
    // if user is of type js redirect it to jobseeker profile page
    if($_SESSION['type']=="js")
      header("location:profile.php");

    // if user if of type jp redirect it to jobprovider profile page
    if($_SESSION['type']=="jp")
      header("location:../jobprovider/profile.php");

}
  if(isset($_POST['submit']))
  {
    //connect to database CareerConnect
    include("../dbconnection/dbconnect.php");

    //extract values which have came from form
    $email=$_POST['email'];
    $pass=$_POST['pass'];

    // attach input values with the mysql query
    $query = "SELECT * FROM adminlogin WHERE email = '$email' AND pass = '$pass' AND status='1'" ;
    // here status denotes that account is open or close

    //execute query
    $result = mysqli_query($con,$query);

    // if only one account is available for the input details
    // means successfully login

    if (mysqli_num_rows($result) == 1)
    {
      //create session
      $_SESSION['email']=$email;
      $_SESSION['pass']=$pass;
      $_SESSION['type']="admin";

      //redirect to profile page
      header("location: profile.php");
    }
    else
    {
      echo("Hello");
      echo("<script>alert('Invalid email or password');</script>");
    }
}

?>




<!DOCTYPE html>
<html lang="en">

<head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <meta http-equiv="x-ua-compatible" content="ie=edge">
      <title>Admin jslist</title>
      <!-- Font Awesome -->
      <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css">
      <!-- Bootstrap core CSS -->
      <link href="../css/bootstrap.min.css" rel="stylesheet">
      <!-- Material Design Bootstrap -->
      <link href="../css/mdb.min.css" rel="stylesheet">
      <link href="../css/compiled.min.css" rel="stylesheet">
      <!-- Your custom styles (optional) -->
      <link href="../css/style.css" rel="stylesheet">
</head>

<body>

        <!-- Start your project here-->

<!--  nav bar starts here -->
    <nav class="navbar fixed-top navbar-expand-lg navbar-dark blue-gradient scrolling-navbar">
        <a class="navbar-brand" href="../">CareerConnect</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent-4"
        aria-controls="navbarSupportedContent-4" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent-4">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item">
            <a class="nav-link" href="jplist.php">
              <i class="fas fa-user-friends"></i> List Of JobProviders</a>
          </li>
          <li class="nav-item  active">
            <a class="nav-link" href="#">
              <i class="fas fa-users"></i></i>List Of JobSeekers</a>
          </li>

          <li class="nav-item">
            <a class="nav-link" href="profile.php">
              <i class="fas fa-user"></i> Profile
              <span class="sr-only">(current)</span>
            </a>
          </li>

          <li class="nav-item">
            <a class="nav-link" href="logout.php">
              <i class="fas fa-sign-out-alt"></i> Logout</a>
          </li>
        </ul>
      </div>
    </nav>

<!-- nav bar ends here -->

    <br><br><br><br>


    <br><br><br>

<!-- Footer -->
<footer class="page-footer font-small blue-gradient pt-4">

<!-- Footer Links -->
<div class="container-fluid text-center text-md-left">

  <!-- Grid row -->
  <div class="row">

    <!-- Grid column -->
    <div class="col-md-6 mt-md-0 mt-3">

      <!-- Content -->
      <h5 class="text-uppercase">Our Moto</h5>
      <p>Find out what you like doing best, and get someone to pay you for doing it.</p>

    </div>
    <!-- Grid column -->

    <hr class="clearfix w-100 d-md-none pb-3">

    <!-- Grid column -->
    <div class="col-md-3 mb-md-0 mb-3">

      <!-- Links -->
      <h6 class="text-uppercase font-weight-bold">Useful links</h6>
      <hr class="teal accent-3 mb-4 mt-0 d-inline-block mx-auto" style="width: 60px;">
      <p>
        <a href="#!">Your Account</a>
      </p>
      <p>
        <a href="#!">Become an Affiliate</a>
      </p>
      <p>
        <a href="#!">Shipping Rates</a>
      </p>
      <p>
        <a href="#!">Help</a>
      </p>
      </div>
      <!-- Grid column -->

      <!-- Grid column -->
      <div class="col-md-3 mb-md-0 mb-3">

        <!-- Links -->
      <h6 class="text-uppercase font-weight-bold">Contact</h6>
      <hr class="teal accent-3 mb-4 mt-0 d-inline-block mx-auto" style="width: 60px;">
      <p>
        <i class="fas fa-home mr-3"></i> New York, NY 10012, US</p>
      <p>
        <i class="fas fa-envelope mr-3"></i> info@example.com</p>
      <p>
        <i class="fas fa-phone mr-3"></i> + 01 234 567 88</p>
      <p>
        <i class="fas fa-print mr-3"></i> + 01 234 567 89</p>
      </div>
      <!-- Grid column -->

  </div>
  <!-- Grid row -->

</div>
<!-- Footer Links -->

<!-- Copyright -->
<div class="footer-copyright text-center py-3">© 2018 Copyright:
  <a href="https://mdbootstrap.com/education/bootstrap/"> MDBootstrap.com</a>
</div>
<!-- Copyright -->

</footer>
<!-- Footer -->

<!-- /Start your project here-->


      <!-- SCRIPTS -->
      <!-- JQuery -->
      <script type="text/javascript" src="../js/jquery-3.3.1.min.js"></script>
      <!-- Bootstrap tooltips -->
      <script type="text/javascript" src="../js/popper.min.js"></script>
      <!-- Bootstrap core JavaScript -->
      <script type="text/javascript" src="../js/bootstrap.min.js"></script>
      <script type="text/javascript" src="../js/compiled.min.js"></script>
      <!-- MDB core JavaScript -->
      <script type="text/javascript" src="../js/mdb.js"></script>
</body>

</html>
