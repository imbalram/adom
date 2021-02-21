




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

?>









<?php
session_start();
require_once "config.php";

if(isset($_POST['registerbtn']))
{
$username = $_POST['UserName'];
$email = $_POST['email'];
$password = $_POST['Password'];
$cpassword = $_POST['confirmPassword'];

if($password === $cpassword)
{

    
      $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
      
    $query = "INSERT INTO tbladmin(UserName,email,Password) VALUES('$username','$email','$hashedPassword')";
    
    $query_run = mysqli_query($conn, $query);
    if($query_run)
    {
        $_SESSION['success'] = "Your data is updated";
        header('Location: register.php');
    }
    
    else{
        
    $_SESSION['status'] = "Admin profile not Added";
    header('Location: register.php');
    
    }
    
}

else{
    $_SESSION['status'] = "password and confirm password dos not match";
    header('Location: register.php');
    
   

}




}


if(isset($_POST['updatbtn']))
{

    $id = $_POST['edit_id'];
    $UserName = $_POST['edit_UserName'];
    $email = $_POST['edit_email'];
    $password = $_POST['edit_password'];
    
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);


    $query = " UPDATE tbladmin SET UserName = '$UserName', email = '$email', password = '$hashedPassword' WHERE id ='$id'";

    $query_run = mysqli_query($conn, $query);
if($query_run)
{
    $_SESSION['success'] = "Your data is updated";
    header('Location: register.php');
}
else{
 $_SESSION['success'] = "Your data is  Not updated";
    header('Location: register.php');
}

}



if(isset($_POST['delete_btn']))
{

$id = $_POST['delete_id'] ;

$query = "DELETE  FROM tbladmin WHERE id='$id'";
$query_run = mysqli_query($conn, $query);

if($query_run)
{
    $_SESSION['success'] = "Your data is  DELETED";
    header('Location: register.php');
}
else
{
    $_SESSION['status'] = "Your data is  Not DELETED";
    header('Location: register.php');
}



}









?>