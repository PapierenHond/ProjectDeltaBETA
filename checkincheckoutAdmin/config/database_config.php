<?php 
function connect() {
$localhost = "localhost";
$username = "root";
$password = "";
$databasename = "checkincheckout";

$mysqli = new mysqli($localhost,$username,$password,$databasename);

return $mysqli;
}
?>
