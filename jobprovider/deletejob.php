<?php
  session_start();
  if(!$_SESSION)
    header("location:login.php");

  if($_SESSION)
  {
    // if job seeker is trying to access this profile page send it to its own
    if($_SESSION['type']=="js")
      header("location:../jobseeker/profile.php");
  }
  include("../dbconnection/dbconnect.php");

  $jobid=$_GET['jobid'];
  //echo($jobid);
  $query="delete from jobslist where id='$jobid'";
  mysqli_query($con,$query);
  header("location:managejobs.php");




?>
