<?php
if(!$_SESSION)
  header("location:login.php");

include("../dbconnection/dbconnect.php");
$jobrequestid=$_GET['jobrequestid'];
$jobstatus=$_GET['jobstatus'];

$query="UPDATE `jobrequest` SET `status` = '$jobstatus' WHERE `jobrequest`.`id` = '$jobrequestid';";
$result = mysqli_query($con,$query);
if($result)
{
    echo("Approval successfull");
    header("location:jobrequests.php");
}
else
{
    echo("Some problem occured in approval ");
    header("location:jobrequests.php");
}
?>
