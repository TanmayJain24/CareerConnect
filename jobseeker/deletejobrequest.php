<?php
    $jobid=$_GET['jobid'];
    $jsid=$_GET['jsid'];
    include("../dbconnection/dbconnect.php");


    $query="DELETE FROM `jobrequest` WHERE js_id='$jsid' and job_id='$jobid';";

    $result = mysqli_query($con,$query);
    if ($result) {
        echo("<script>alert('Request deleted successfully');</script>");
        header("location:appliedjobs.php");
      }
      else
      {
        echo("<script>alert('Problem in request deletion');</script>");

        header("location:appliedjobs.php");
	 }


?>
