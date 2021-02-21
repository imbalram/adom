
<?php
// Initialize the session
session_start();
 
// Check if the user is already logged in, if yes then redirect him to welcome page
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    header("location: index.php");
    exit;
}
 
// Include config file
require_once "config.php";
 
// Define variables and initialize with empty values
$UserName= $Password = "";
$UserName_err = $Password_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Check if UserName is empty
    if(empty(trim($_POST["UserName"]))){
        $UserName_err = "Please enter UserName.";
    } else{
        $UserName = trim($_POST["UserName"]);
    }
    
    // Check if Password is empty
    if(empty(trim($_POST["Password"]))){
        $Password_err = "Please enter your Password.";
    } else{
        $Password = trim($_POST["Password"]);
    }
    
    // Validate credentials
    if(empty($UserName_err) && empty($Password_err)){
        // Prepare a select statement
        $sql = "SELECT id, UserName, Password FROM tbladmin WHERE UserName = ?";
        
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_UserName);
            
            // Set parameters
            $param_UserName = $UserName;
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Store result
                mysqli_stmt_store_result($stmt);
                
                // Check if UserName exists, if yes then verify Password
                if(mysqli_stmt_num_rows($stmt) == 1){                    
                    // Bind result variables
                    mysqli_stmt_bind_result($stmt, $id, $UserName, $hashed_Password);
                    if(mysqli_stmt_fetch($stmt)){
                        if(Password_verify($Password, $hashed_Password)){
                            // Password is correct, so start a new session
                            session_start();
                            
                            // Store data in session variables
                            $_SESSION["loggedin"] = true;
                            $_SESSION["id"] = $id;
                            $_SESSION["UserName"] = $UserName;                            
                            // Redirect user to welcome page
                            header("location: index.php");


                        } else{
                            // Display an error message if Password is not valid
                            $Password_err = "The Password you entered was not valid.";
                        }
                    }
                } else{
                    // Display an error message if UserName doesn't exist
                    $UserName_err = "No account found with that UserName.";
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }
    
    // Close connection
    mysqli_close($link);
}
?>



<?php

session_start();
include('../netclr/includes/heder.php'); 
include('../netclr/includes/navbar.php'); 
?>



<!DOCTYPE html>
<html lang="en">
<head>



	<title>User Login</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->	
<link rel="shortcut icon" type="image/x-icon" href="../netclr/img/logo.png" />
<!--===============================================================================================-->
<link rel="stylesheet" type="text/css" href="../netclr/r/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
<link rel="stylesheet" type="text/css" href="../netclr//fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
<link rel="stylesheet" type="text/css" href="../netclr//fonts/iconic/css/material-design-iconic-font.min.css">
<!--===============================================================================================-->
<link rel="stylesheet" type="text/css" href="../netclr//vendor/animate/animate.css">
<!--===============================================================================================-->	
<link rel="stylesheet" type="text/css" href="../netclr//vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
<link rel="stylesheet" type="text/css" href="../netclr//vendor/animsition/css/animsition.min.css">
<!--===============================================================================================-->
<link rel="stylesheet" type="text/css" href="../netclr//vendor/select2/select2.min.css">
<!--===============================================================================================-->	
<link rel="stylesheet" type="text/css" href="../netclr//vendor/daterangepicker/daterangepicker.css">
<!--===============================================================================================-->
<link rel="stylesheet" type="text/css" href="../netclr/css/util.css">
<link rel="stylesheet" type="text/css" href="../netclr/css/main.css">
<!--===============================================================================================-->
</head>
<body>
	
	<div class="limiter">
		<div class="container-login100" style="background-image: url('img/bg-01.jpg');">
			<div class="wrap-login100">
       

					<span class="login100-form-logo">
						<i class="zmdi zmdi-landscape"></i>
					</span>

					<span class="login100-form-title p-b-34 p-t-27">
						Log in
					</span>




 <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="wrap-input100 validate-input <?php echo (!empty($UserName_err)) ? 'has-error' : ''; ?>">
                
                <input class="input100" type="text" name="UserName" placeholder="UserName "<?php echo $UserName; ?>">
                <span class="focus-input100" data-placeholder="&#xf207;"><?php echo $UserName_err; ?></span>
            </div>    
            <div class="wrap-input100 validate-input" data-validate="Enter Password" <?php echo (!empty($Password_err)) ? 'has-error' : ''; ?>">
                
               <input class="input100" type="Password" name="Password" placeholder="Password">
                <span class="focus-input100" data-placeholder="&#xf191;"><?php echo $Password_err; ?></span>


</div>

	<div class="contact100-form-checkbox">
						<input class="input-checkbox100" id="ckb1" type="checkbox" name="remember-me">
						<label class="label-checkbox100" for="ckb1">
							Remember me
						</label>
					</div>





            <div class="container-login100-form-btn">
						<button class="login100-form-btn">
							Login
						</button>
            </div>
            
            <div class="text-center p-t-90">
						<a class="txt1"  href="../netclr/contact.php">CONTACT US
                        </a>
					</div>
       



        </form>










			</div>
		</div>
	</div>
	


	
<!--===============================================================================================-->
<script src="../netclr/vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
<script src="../netclr/vendor/animsition/js/animsition.min.js"></script>
<!--===============================================================================================-->
<script src="../netclr/vendor/bootstrap/js/popper.js"></script>
<script src="../netclr/vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
<script src="../netclr/vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
<script src="../netclr/vendor/daterangepicker/moment.min.js"></script>
<script src="../netclr/vendor/daterangepicker/daterangepicker.js"></script>
<!--===============================================================================================-->
<script src="../netclr/vendor/countdowntime/countdowntime.js"></script>
<!--===============================================================================================-->
<script src="../netclr/js/main.js"></script>

</body>
</html>
