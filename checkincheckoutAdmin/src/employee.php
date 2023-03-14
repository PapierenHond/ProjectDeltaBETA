<?php 
require_once('functions/crud_employee.php');
$method = $_GET['method'];

if($method  == "create") {
    $firstname = $_POST['firstname'];
    $insertion = $_POST['insertion'];
    $lastname = $_POST['lastname'];
    $birthday = $_POST['birthday'];
    $function = $_POST['function'];
    $room_number = $_POST['room_number'];
    $nfcid = $_POST['nfc_id'];
    $createdAt = date("Y-m-d");

    createEmployee($firstname,$insertion,$lastname,$birthday,$function,$room_number,$nfcid,$createdAt);

    header("location: ../public/control_panel_employees.php");
}  
if ($method  == "update") {
    $id = $_GET['id'];
    $firstname = $_POST['firstname'];
    $insertion = $_POST['insertion'];
    $lastname = $_POST['lastname'];
    $birthday = $_POST['birthday'];
    $function = $_POST['function'];
    $room_number = $_POST['room_number'];
    $nfcid = $_POST['nfc_id'];

    updateEmployee($id,$firstname,$insertion,$lastname,$birthday,$function,$room_number,$nfcid);

    header("location: ../public/control_panel_employees.php");
}
if ($method  == "delete") {
    $id = $_GET['id'];
    deleteEmployee($id);
    header("location: ../public/control_panel_employees.php");
}
?>