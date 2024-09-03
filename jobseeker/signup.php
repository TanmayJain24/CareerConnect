<?php

  session_start();
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
    include("../dbconnection/dbconnect.php");
    $name=$_POST['name'];
		$email=$_POST['email'];
		$pass=$_POST['pass'];
		$mob=$_POST['mob'];
		$state=$_POST['state'];
		$city=$_POST['city'];
		$address=$_POST['address'];

    $query = "SELECT name FROM cities where id='$city';";
    $result = mysqli_query($con,$query);
    $data =mysqli_fetch_assoc($result);
    $city=$data['name'];
    echo($city);

    $query = "SELECT name FROM states where id='$state';";
    $result = mysqli_query($con,$query);
    $data =mysqli_fetch_assoc($result);
    $state=$data['name'];
    echo($state);



    $extenstion=explode(".",$_FILES["file"]["name"]);

    if($extenstion[1]=="pdf")
    {
      $target_file="resume/".strtotime(date("y-m-d h:i:s")).".".$extenstion[1];

      move_uploaded_file($_FILES["file"]["tmp_name"], $target_file);

      if($con)
  		{
        //Query to insert values in jslogin table
        $query1="INSERT INTO jslogin (email,mob,pass) VALUES ('$email','$mob','$pass');";

        //Query to insert values in jssignup table
  			$query2="INSERT INTO `jsdetails` (`id`, `name`, `email`, `mob`, `state`, `city`, `address`, `resumeurl`, `last_updated`, `registration_date`) VALUES (NULL, '$name', '$email', '$mob', '$state', '$city', '$address', '$target_file', NULL, CURRENT_TIMESTAMP);";

        // check email or mob exists or not
        //      $query = "SELECT * FROM jslogin WHERE email ='$email' or mob='$mob'";

        $query = "SELECT * FROM jslogin WHERE email ='$email'";
        $result = mysqli_query($con,$query);
        if (mysqli_num_rows($result) >= 1) {
          echo("<script>alert('You are already registered with this email address');</script>");
          //header("location:signup.php");
        }
        else
        {
          $res1=mysqli_query($con,$query1);
  		  	$res2=mysqli_query($con,$query2);
  		  	if($res1 && $res2)
          {
          echo("<script>alert('signup successful');</script>");

          //create session
          $email=$_POST['email'];
          $pass=$_POST['pass'];
          $type="js";
          $_SESSION['email']=$email;
          $_SESSION['pass']=$pass;
          $_SESSION['type']=$type;

          //redirect to profile page
          header("location:profile.php");
  			  }

        }


    }
    }
    else {
      echo("<script>alert('Resume should only be in .pdf formate')</script>");
    }
	}


?>



<!DOCTYPE html>
<html lang="en">

<head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <meta http-equiv="x-ua-compatible" content="ie=edge">
      <title>JS SignUp</title>
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

<!-- nav bar starts from here -->
    <nav class="navbar fixed-top navbar-expand-lg navbar-dark blue-gradient scrolling-navbar">
        <a class="navbar-brand" href="../">CareerConnect</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent-4"
        aria-controls="navbarSupportedContent-4" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent-4">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item">
            <a class="nav-link" href="login.php">
              <i class="fas fa-sign-in-alt"></i> Login
              <span class="sr-only">(current)</span>
            </a>
          </li>
          <li class="nav-item active">
            <a class="nav-link" href="#">
              <i class="fas fa-user-plus"></i> SignUp</a>
          </li>
        </ul>
      </div>
    </nav>
<!-- nav bar end here -->

<br><br><br><br>


<!-- Sign Up form starts from here -->

  <div class="container">
    <div class="row">
      <div class="col-3"></div>
      <div class="col-6">
        <!-- Material form login -->
        <div class="card">

          <!-- Default form register -->
          <form class="text-center border border-light p-5" action="signup.php" onsubmit="return validate()" method="POST" enctype="multipart/form-data">

              <p class="h4 mb-4">Sign up</p>

              <!-- Name -->
              <input type="text" name="name" id="name" class="form-control" placeholder="Enter name" required><br>

              <!-- E-mail -->
              <input type="email" name="email" id="email" class="form-control mb-4" placeholder="E-mail" requried>

              <!-- Password -->
              <input type="password" name="pass" id="pass" class="form-control" placeholder="Password" aria-describedby="defaultRegisterFormPasswordHelpBlock"  requried>

<?php /*
              <small id="defaultRegisterFormPasswordHelpBlock" class="form-text text-muted mb-4">
                  At least 8 characters and 1 digit
              </small>


              <!-- Confirm Password -->
              <input type="password" id="cpassword" class="form-control" placeholder="Confirm Password" aria-describedby="defaultRegisterFormPasswordHelpBlock"><br>

*/?>
<br>
              <!-- Phone number -->
              <input type="text" name="mob" id="mob" class="form-control" placeholder="Phone number" aria-describedby="defaultRegisterFormPhoneHelpBlock"  requried><br>

              <!-- state -->
              <?php
                 include("../dbconnection/dbconnect.php");
                 $query = "SELECT * from states where country_id=101";
                 $res = mysqli_query($con, $query);
                 ?>
              <select class="browser-default custom-select mb-4" name="state" id="state"  requried>
                  <option value="0" disabled="" selected="">Choose your state</option>
                  <?php while($data = mysqli_fetch_assoc($res)){ ?>
                <option value="<?= $data['id'] ?>"><?= $data['name'] ?></option>
                <?php } ?>
              </select>

              <!-- City -->
              <select class="browser-default custom-select mb-4" name="city" id="city"  requried>
                  <option value="0" disabled="" selected="">Choose your city</option>
              </select>


              <!-- Address -->
              <input type="text" name="address" id="address" class="form-control" placeholder="Address" aria-describedby="defaultRegisterFormPhoneHelpBlock"  requried><br>

              <!-- Resume -->
              <div class="input-group mb-4">
                      <div class="input-group-prepend">
                          <span class="input-group-text">Upload</span>
                      </div>
                      <div class="custom-file">
                          <input type="file" name="file" class="custom-file-input" name="resume" id="file" aria-describedby="fileInput">
                          <label class="custom-file-label" for="fileInput">Upload Resume</label>
                      </div>
                  </div>

              <!-- Sign up button -->
              <button class="btn btn-info my-4 btn-block blue-gradient" type="submit" name="submit">Sign Up</button>


              <hr>

              <!-- Terms of service -->
              <p>By clicking
                  <em>Sign up</em> you agree to our
                  <a href="#">terms of service</a>

          </form>
          <!-- Default form register -->
        </div>
        <!-- Material form login -->

      </div>
      <div class="col-3"></div>
    </div>
  </div>

<!-- Sign Up form ends here -->

<br><br>

<!-- Footer -->
<footer class="page-footer font-small blue-gradient pt-4">

<!-- Footer Links -->
<div class="container-fluid text-center text-md-left">

  <!-- Grid row -->
  <div class="row">

    <!-- Grid column -->
    <div class="col-md-6 mt-md-0 mt-3">

      <!-- Content -->
      <h5 class="text-uppercase">CareerConnect</h5><br><br>
      <p>Choose a job you love, and you will never have to work a day in your life.
</p><p>—Confucius</p>

    </div>
    <!-- Grid column -->

    <hr class="clearfix w-100 d-md-none pb-3">

    <!-- Grid column -->
    <div class="col-md-3 mb-md-0 mb-3">

      <!-- Links -->
      <h6 class="text-uppercase font-weight-bold">Useful links</h6>
      <hr class="teal accent-3 mb-4 mt-0 d-inline-block mx-auto" style="width: 60px;">
      <p>
        <a href="#!">Job Seeker Login</a>
      </p>
      <p>
        <a href="#!">Job Provider Login</a>
      </p>
      <p>
        <a href="#!">Job Seeker SignUp</a>
      </p>
      <p>
        <a href="#!">Job Provider Signup</a>
      </p>
      </div>
      <!-- Grid column -->

      <!-- Grid column -->
      <div class="col-md-3 mb-md-0 mb-3">

        <!-- Links -->
      <h6 class="text-uppercase font-weight-bold">Contact</h6>
      <hr class="teal accent-3 mb-4 mt-0 d-inline-block mx-auto" style="width: 60px;">
      <p>
        <i class="fas fa-home mr-3"></i>Indore</p>
      <p>
        <i class="fas fa-envelope mr-3"></i> rajan@gmail.com</p>
      <p>
        <i class="fas fa-phone mr-3"></i> +91 84628851589</p>


      </div>
      <!-- Grid column -->

  </div>
  <!-- Grid row -->

</div>
<!-- Footer Links -->

<!-- Copyright -->
<div class="footer-copyright text-center py-3">© 2019 Copyright:
  <a href="#"> CareerConnect</a>
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

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<script type="text/javascript">
   $(document).ready(function(){
      $("#state").change(function(){
         var a  = $(this).val();

         $.ajax({
              url:"getCity.php",
              type:"get",
              data:{"state_id":a},
              dataType:"text",
              success:function(data){
                  $("#city").html(data);
                //alert(a);
              },
              error:function(){
               alert("failed");
              },
         });
      });
   });
</script>

<script>
			function validate(){
          var name=document.getElementById('name').value;
          if(name=="")
          {
            alert('Please enter your name');
          //  toastr.error("username cannot be empty");
              return false;
          }
          var email=document.getElementById('email').value;
          if(email=="")
          {
            alert('Please enter your email');
            return false;
          }

          var pass=document.getElementById('pass').value;
          if(pass=="")
          {
            alert('Please enter your password');
            return false;
          }

          var mob=document.getElementById('mob').value;
          if(mob=="")
          {
            alert('Please enter your 10 digit mob no');
            return false;
          }
          if(isNaN(mob))
          {
            alert('mob number can contain only numbers');

            return false;
          }
          else {
            if(mob.length!=10)
            {
              alert('Mobile no should be of only 10 digit');
              return false;
            }
          }

          var city=document.getElementById('state').value;
          if(city==0)
          {
            alert('Please select state');
            return false;
          }
          var city=document.getElementById('city').value;
          if(city==0)
          {
            alert("please select city");
            return false;
          }

          var address=document.getElementById('address').value;
          if(address=="")
          {
            alert('Please enter your address');
            return false;
          }

          var resume=document.getElementById('file').value;
          if(!resume)
          {
            alert('Please select resume in pdf formate');
            return false;
          }


			}
	</script>
