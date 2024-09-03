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

          <li class="nav-item active">
            <a class="nav-link" href="#">
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

    <div class="container">
      <div class="row">
        <div class="col-4"></div>
        <div class="col-4">
          <form action="searchjobs.php" method="POST">
            <select class="browser-default custom-select" name="category">
              <option value="0" disabled  selected >Choose Job Category</option>
              <option value="web development" >Web development</option>
              <option value="Programming" >Programming</option>
              <option value="Back End developer" >Back End developer</option>
              <option value="Tester" >Tester</option>
            </select>
            <center><button type="submit" class="btn btn-primary">Apply</button></center>
         </form>
        </div>

        <div class="col-4"></div>
      </div>
    </div>
<br>
<?php


// extract all values from form in the this below variables
//  $email=$_SESSION['email'];
//  $query="SELECT id FROM `jpdetails` WHERE email='$email';";
//  $result = mysqli_query($con,$query);

  // $data = mysqli_fetch_assoc($result);
  // $jpid = $data['id'];
  //echo($jsid);
  $email=$_SESSION['email'];

  $query="SELECT id FROM `jsdetails` WHERE email='$email';";
  $result = mysqli_query($con,$query);

  $data = mysqli_fetch_assoc($result);
//  print_r($data);
  $jsid = $data['id'];

//  echo("JS ID : "); echo($jsid);
  //    //echo($jsid);




  $query="select * from jobslist where status='1' AND id not in (SELECT job_id from jobrequest WHERE js_id='$jsid')";

  if($_POST)
  {
    $category=$_POST['category'];
    //echo($category);
    $query="select * from jobslist where status='1' AND job_category='$category' AND id not in (SELECT job_id from jobrequest WHERE js_id='$jsid')";
  }

  //$query="SELECT * FROM `jobslist`;";
  $result = mysqli_query($con,$query);

  
  //echo "HElo";
  //print_r($result);


//  $query="SELECT * FROM `jobslist` where status='1';";
//  $result = mysqli_query($con,$query);

  while($data =mysqli_fetch_assoc($result))
  {
    ?>
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="card text-center">
            <div class="card-header">
              JOb Title : <?php echo $data['job_title']; ?>
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

              <a href="applyjob.php?jobid=<?php echo $data['id'];?>&jsid=<?php echo $jsid;?>" onclick="toastr.success('Applied Successfully');" class="btn btn-primary">Apply</a>
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
