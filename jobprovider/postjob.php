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

  if(isset($_POST['submit']))
  {
    include("../dbconnection/dbconnect.php");
    //print_r($_POST);

    // extract all values from form in the this below variables
    $email=$_SESSION['email'];
    $query="SELECT id FROM `jpdetails` WHERE email='$email';";
    $result = mysqli_query($con,$query);

    $data = mysqli_fetch_assoc($result);
    $jsid = $data['id'];
    //echo($jsid);


    $jobtitle=$_POST['jobtitle'];
		$companyname=$_POST['companyname'];
		$jobcategory=$_POST['jobcategory'];
		$jobdescription=$_POST['jobdescription'];
		$experience=$_POST['experience'];
    $joblocation=$_POST['joblocation'];
		$work=$_POST['work'];
		$qualification=$_POST['qualification'];
		$salary=$_POST['salary'];

    if($con)
		{
      //Query to insert values in jobslist table
      $query="INSERT INTO `jobslist` (`id`, `posted_date`, `posted_by`, `job_title`, `company_name`, `job_category`, `job_description`, `experience`, `job_location`, `work`, `qualification`, `salary`) VALUES (NULL, CURRENT_TIMESTAMP, '$jsid', '$jobtitle', '$companyname', '$jobcategory', '$jobdescription', '$experience', '$joblocation', '$work', '$qualification', '$salary');";


      $result = mysqli_query($con,$query);
      if ($result)
      {
        echo("<script>alert('Your job uploaded successfully');</script>");
        header("location:managejobs.php");
      }
      else
      {
      echo("<script>alert('Some problem occured while uploading your job');</script>");
			}

      }

    }

?>





<!DOCTYPE html>
<html lang="en">

<head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <meta http-equiv="x-ua-compatible" content="ie=edge">
      <title>JP PostJob</title>
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
            <a class="nav-link" href="jobrequests.php">
              <i class="fas fa-bell"></i> Job Requests</a>
          </li>

          <li class="nav-item ">
            <a class="nav-link" href="managejobs.php">
              <i class="fas fa-address-card"></i> Manage Jobs</a>
          </li>

          <li class="nav-item active">
            <a class="nav-link" href="#">
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

<!-- login form starts here -->
  <div class="container">
    <div class="row">
      <div class="col-3"></div>
      <div class="col-6">
        <!-- Material form login -->
        <div class="card">

          <!-- Default form contact -->
          <form class="text-center border border-light p-5" action="postjob.php" onsubmit="return validate()" method="POST">

              <p class="h4 mb-4">Post New Job</p>

              <!-- Name -->
              <input type="text"  required id="job_title" class="form-control mb-4" placeholder="jobtitle" name="jobtitle" autofocus>

              <!-- Email -->

              <input type="text" required id="company" class="form-control mb-4" placeholder="companyname" name="companyname">
              <!-- Subject -->
              <!--this data will come from database jobcategories table-->
              <select class="browser-default custom-select mb-4" id="category" name="jobcategory" required>
                  <option value="0" disabled  selected >Choose Job Category</option>
                  <option value="web development" >Web development</option>
                  <option value="Programming" >Programming</option>
                  <option value="Back End developer" >Back End developer</option>
                  <option value="Tester" >Tester</option>
              </select>

              <!-- Message -->
              <div class="form-group">
                  <textarea class="form-control rounded-0"  required id="desc" rows="3" placeholder="Job description" name="jobdescription"></textarea>
              </div>


              <select class="browser-default custom-select mb-4" name="experience" id="experience" required>
                  <option value="0" disabled  selected>Required experience</option>
                  <option value="0 year" name="year">0 Year</option>
                  <option value="1 year" name="year">1 Year</option>
                  <option value="2 year" name="year">2 Year</option>
                  <option value="3 year" name="year">3 Year</option>
                  <option value="4 year" name="year">4 Year</option>
                  <option value="5+ year" name="year">5+ Year</option>


              </select>


          <!-- Email -->
          <input type="text" required id="job_location" class="form-control mb-4" placeholder="job location" name="joblocation">
          <!-- Email -->
          <input type="text" required id="work" class="form-control mb-4" placeholder="work" name="work">
          <!-- Email -->
          <input type="text" required id="qualification" class="form-control mb-4" placeholder="qualification" name="qualification">
          <!-- Email -->
          <input type="text" required id="salary" class="form-control mb-4" placeholder="salary" name="salary">


              <!-- Send button -->
              <button class="btn btn-info btn-block" type="submit" name="submit">POST</button>

          </form>
          <!-- Default form contact -->

        </div>
        <!-- Material form login -->

      </div>
      <div class="col-3"></div>
    </div>
  </div>
<!-- login form ends here -->

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
			function validate(){
          var category=document.getElementById('category').value;
          if(category==0)
          {
            alert('Please select job category');
            return false;
          }
          var experience=document.getElementById('experience').value;
          if(experience==0)
          {
            alert("please select required experience field");
            return false;
          }

          var salary=document.getElementById('salary').value;
          //alert(salary);
          if(isNaN(salary))
          {
            alert('Salary should be in number formate');
            return false;
          }
          <!-- Success message -->
          toastr.success('Successfully Posted');

			}
	</script>
