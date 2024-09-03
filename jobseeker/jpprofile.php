<?php
  session_start();
  if(!$_SESSION)
    header("location:login.php");

  if($_SESSION)
  {
    if($_SESSION['type']=="jp")
      header("location:../jobprovider/profile.php");
  }
  include("../dbconnection/dbconnect.php");
?>



<!DOCTYPE html>
<html lang="en">

<head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <meta http-equiv="x-ua-compatible" content="ie=edge">
      <title>JS Profile</title>
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
            <a class="nav-link" href="appliedjobs.php">
              <i class="fas fa-address-card"></i> Applied Jobs</a>
          </li>

          <li class="nav-item">
            <a class="nav-link" href="searchjobs.php">
              <i class="fas fa-search"></i> Search Jobs</a>
          </li>

          <li class="nav-item">
            <a class="nav-link" href="profile.php">
              <i class="fas fa-user-circle"></i> profile
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

<?php

// extract all values from form in the this below variables
  $jpid=$_GET['jpid'];

  $query="SELECT * FROM `jpdetails` WHERE id='$jpid';";
  $result = mysqli_query($con,$query);
  while($data =mysqli_fetch_assoc($result))
  {
    ?>


    <br><br><br><br>

    <div class="container">
      <div class="row">

          <div class="col-1">
          </div>
          <div class="col-7">

          <div class="card" style="width: 60rem;">
            <div class="card-body">
              <form class="md-form" action="changeprofile.php">
                <div class="file-field">
                  <div class="z-depth-1-half mb-4">
                    <img src="profile.png" class="img-fluid rounded float-right file-upload" alt="example placeholder" height="200" width="200">
                  </div>
                </div>
              </form>

              <h5 class="font-weight-bold mb-3"><?php echo $data['name']; ?></h5>
              <p class="mb-0"></p>
            </div>
            <ul class="list-group list-group-flush">
              <li class="list-group-item">Name : <?php echo $data['name']; ?></li>
              <li class="list-group-item">Email : <?php echo $data['email']; ?></li>
              <li class="list-group-item">Mobile : <?php echo $data['mobile']; ?></li>
              <li class="list-group-item">Company Name : <?php echo $data['company_name']; ?></li>
              <li class="list-group-item">State : <?php echo $data['state']; ?></li>
              <li class="list-group-item">City : <?php echo $data['city']; ?></li>

            </ul>

          </div>
        </div>
        <div class="col-1">
        </div>
      </div>
    </div>


<?php
}
 ?>




    <br><br><br>


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


<script>
$('.file_upload').file_upload();

</script>
