<?php
// Creates session.
session_start();
//requires the config file to be loaded.
require('../config/database_config.php');
//fills variables.
$username = $_POST['username'];
$password = $_POST['password'];
$connect = connect();
//prepares an sql query to prevent sql injection.
$stmt = $connect->prepare("SELECT * FROM users WHERE username = ?");
$stmt->bind_param("s", $usernameData);
$usernameData = $username;
$stmt->execute();
//fills vairable with results from query.
$result = $stmt->get_result();
//checks if rows in result is higher then 0.
if($result->num_rows > 0 ) {
    $userInfo = $result->fetch_assoc();
    $passwordDB = $userInfo['Password'];
    
    //checks if password is correct.
    if(password_verify($password,$passwordDB) == true) {
        header("location: ../public/control_panel_employees.php");
        $_SESSION["loggedin"] = true;
    } else {
        header("location: ../public/index.php?error=faultlogin");
    }
} else {
    header("location: ../public/index.php?error=faultlogin");
}
?>
