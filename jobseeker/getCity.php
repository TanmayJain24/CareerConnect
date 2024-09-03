<?php
      include("../dbconnection/dbconnect.php");
      $state_id = $_GET['state_id'];
      $query = "SELECT * from cities where state_id='$state_id'";
      $res = mysqli_query($con, $query);


      ?>

      <option value="0">Select City</option>

      <?php while($data = mysqli_fetch_assoc($res)){ ?>
      <option value="<?= $data['id'] ?>"><?= $data['name'] ?></option>

<?php } ?>
