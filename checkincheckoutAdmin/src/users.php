<?php 
require_once('functions/crud_user.php');
$method = $_GET['method'];

if($method  == "create") {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $passwordRepeat = $_POST['passwordrepeat'];
    $createdAt = date("Y-m-d");
    if($password === $passwordRepeat){
    createusers($username,$password,$createdAt);

    header("location: ../public/control_panel_users.php");
    }else{
        header("location: ../public/control_panel_users.php?error=password");
    }
}

if ($method  == "update") {
    $id = $_GET['id'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $passwordRepeat = $_POST['passwordrepeat'];
    if($password === $passwordRepeat){
    updateusers($id,$username,$pasword);

    header("location: ../public/control_panel_users.php");
    }else{
        header("location: ../public/control_panel_users.php?error=password");
    }
}

if ($method  == "delete") {
    $result = connect()->query("SELECT * FROM users");
    if($result->num_rows > 1){

    $id = $_GET['id'];
    deleteusers($id);
    header("location: ../public/control_panel_users.php");
}
else{
    header("location: ../public/control_panel_users.php?error=delete");
}
}

    
?>
