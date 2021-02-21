



<?php

session_start();
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}

?>








<?php

session_start();
include('includes/header.php'); 
include('includes/navbar.php'); 
?>




<div class="card shadow mb-4">
  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary"> Edit Admin Profile </h6>
  </div>

 
  <div class="cord-body">
  
  <?php
  require_once "config.php";

if(isset($_POST['edit_btn']))
{

    $id = $_POST['edit_id'];

    $query = "SELECT * FROM tbladmin WHERE id = '$id' ";
    $query_run = mysqli_query($conn, $query);
    foreach ($query_run as $row) {
      ?>
      
      <form action="code.php" method="POST">
       <input type = "hidden" name = "edit_id"value = "<?php  echo $row['id'] ?>"> 
  <div class="form-group">
                <label> UserName </label>
                <input type="text" name="edit_UserName" value=" <?php  echo $row['UserName'] ?> "
class="form-control" placeholder="Enter UserName">
            </div>
            <div class="form-group">
                <label>Email</label>
                <input type="email" name="edit_email" value=" <?php  echo $row['email'] ?> "
class="form-control" placeholder="Enter Email">
            </div>
            <div class="form-group">
                <label>Password</label>
                <input type="password" name="edit_password" value=" <?php  echo $row['Password'] ?> "
class="form-control" placeholder="Enter Password">
            </div>
<a href="register.php" class="btn btn-danger" >CANCEL</a>
<button type="submit" name="updatbtn" class="btn btn-primary"> Update </button>

    </form>

            <?php
    }

}

?>    
</div>
       


<?php
include('includes/scripts.php');
include('includes/footer.php');
?>