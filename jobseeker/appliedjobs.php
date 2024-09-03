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
      <title>JS AppliedJobs</title>
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

          <li class="nav-item  active">
            <a class="nav-link" href="#">
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

    <br><br><br><br>

    <?php


    //print_r($_POST);

  // extract all values from form in the this below variables
      $email=$_SESSION['email'];

      $query="SELECT id FROM `jsdetails` WHERE email='$email';";
     $result = mysqli_query($con,$query);

     $data = mysqli_fetch_assoc($result);
    // print_r($data);
     $jsid = $data['id'];

    // echo("JS ID : "); echo($jsid);
  //    //echo($jsid);


  $query="select * from jobslist where id in (SELECT job_id from jobrequest WHERE js_id='$jsid')";

  //$query="SELECT * FROM `jobslist`;";
  $result = mysqli_query($con,$query);

  //echo "HElo";
  //print_r($result);

      while($data =mysqli_fetch_assoc($result))
      {
          $job_id=$data['id'];
          $query1="SELECT status from jobrequest WHERE js_id='$jsid' and job_id='$job_id';";
          $result1 = mysqli_query($con,$query1);
          $data1 = mysqli_fetch_assoc($result1);
          $status=$data1['status'];


        ?>
        
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="card text-center">
            <div class="card-header">
              JOb Title : <?php echo $data['job_title']; ?>

              <?php


              if($status=='approved')
              {
                ?>
                  <button type="button" class="btn btn-success">Job Request Approved</button>
                <?php
              }
              else {
                ?>
                  <button type="button" class="btn btn-warning">Job Request is Pending</button>
                <?php
              }


               ?>

            </div>
            <div class="card-body">
              <h5 class="card-title">Company Name :<?php echo $data['company_name']; ?> </h5>
              <p class="card-text"> Desription : <?php echo $data['job_description']; ?></p>
              <ul class="list-group list-group-flush">
                <li class="list-group-item">Job category : <?php echo $data['job_category']; ?></li>
                <li class="list-group-item">required experience : <?php echo $data['experience']; ?></li>
                <li class="list-group-item">job location : <?php echo $data['job_location']; ?></li>
                <li class="list-group-item">work : <?php echo $data['work']; ?></li>
                <li class="list-group-item">qualification : <?php echo $data['qualification']; ?></li>
                <li class="list-group-item">salary : <?php echo $data['salary']; ?></li>





              </ul>

              <a href="deletejobrequest.php?jobid=<?php echo $data['id'];?>&jsid=<?php echo $jsid;?>" class="btn btn-primary">Cancel Job Request</a>
              <a href="jpprofile.php?jpid=<?php echo $data['posted_by'];?>" class="btn btn-primary">View Employer Profile</a>


            </div>
          </div>
        </div>
      </div>
    </div>
        <br><br>

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
