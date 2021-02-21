<?php


// Create connection
//$conn = mysqli_connect("localhost","root","","contactdb");
// Check connection
//if ($conn->connect_error) {
  //die("Connection failed: " . $conn->connect_error);
//}

?>

<?php
/* Database credentials. Assuming you are running MySQL
server with default setting (user 'root' with no password) */
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'contactdb');
 
/* Attempt to connect to MySQL database */
$link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
$conn = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

// Check connection
if($conn === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
    $_SESSION['success'] = "ERROR: Could not connect.";
    header('Location: register.php');
}
?>