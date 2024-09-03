<?php
    $jobid=$_GET['jobid'];
    $jsid=$_GET['jsid'];
    include("../dbconnection/dbconnect.php");
    $query="INSERT INTO `jobrequest` (`id`, `js_id`, `job_id`, `applied`) VALUES (NULL, '$jsid', '$jobid', CURRENT_TIMESTAMP);";

    $result = mysqli_query($con,$query);
    if ($result) {
        echo("<script>alert('applied successfully');</script>");
        header("location:searchjobs.php");
      }  
      else
      {    
        echo("<script>alert('Some Problem occcured');</script>");

        header("location:searchjobs.php");
	 }


?>