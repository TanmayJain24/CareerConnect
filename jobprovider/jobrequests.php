
<?php
  session_start();
  // if session is not available send to main page(index page)
  if(!$_SESSION)
    header("location:login.php");

  if($_SESSION)
  {
    // if job seeker is trying to access this profile page send it to its
    if($_SESSION['type']=="js")
      header("location:../jobseeker/profile.php");
  }
  include("../dbconnection/dbconnect.php");
?>


<!DOCTYPE html>
<html lang="en">

<head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <meta http-equiv="x-ua-compatible" content="ie=edge">
      <title>JP Jobrequests</title>
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
              <i class="fas fa-bell"></i> Job Requests</a>
          </li>

          <li class="nav-item">
            <a class="nav-link" href="managejobs.php">
              <i class="fas fa-address-card"></i> Manage Jobs</a>
          </li>

          <li class="nav-item">
            <a class="nav-link" href="postjob.php">
              <i class="fas fa-pencil-alt"></i> Post Job</a>
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
// extract all values from form in the this below variables

$email=$_SESSION['email'];
$query="SELECT id FROM `jpdetails` WHERE email='$email';";
$result = mysqli_query($con,$query);

$data = mysqli_fetch_assoc($result);
$jpid = $data['id'];
//echo($jsid);



$query="SELECT * FROM `jobslist` WHERE `posted_by` = '$jpid' AND id in (select job_id from jobrequest);";
$result = mysqli_query($con,$query);
//echo "HElo";
//print_r($result);
$i=1;
if($result)
while($data =mysqli_fetch_assoc($result))
{


        $jobid2=$data['id'];
        $query2="SELECT * from jobrequest where job_id='$jobid2'";
        $result2 = mysqli_query($con,$query2);
        while($data2 =mysqli_fetch_assoc($result2))
        {
            $jsid2=$data2['js_id'];

            $query3="SELECT name from jsdetails where id='$jsid2'";
            $result3=mysqli_query($con,$query3);
            $data3=mysqli_fetch_assoc($result3);
            $jsname=$data3['name'];
           // echo($jsname);

            $jobrequestid=$data2['id'];


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


                  <a href="jsprofile.php?jsid=<?php echo($jsid2); ?>" class="btn btn-primary">Applied By : <?php echo($jsname); ?></a>
                  <?php
                      $jobstatus=$data2['status'];
                      if($jobstatus=='pending')
                      {
                          ?>
                          <a href="approvejob.php?jobrequestid=<?php echo ($jobrequestid);?>&jobstatus=approved"  class="btn btn-primary">Approve</a><br>
                          <?php

                      }
                      else
                      {
                          ?>
                          <a href="approvejob.php?jobrequestid=<?php echo ($jobrequestid);?>&jobstatus=pending"  class="btn btn-primary">DisApprove</a><br>
                          <?php
                      }

                  ?>

                </div>
              </div>
            </div>
          </div>
        </div>
            <br><br>


<?php }}

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
