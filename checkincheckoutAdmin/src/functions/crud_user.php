<?php 
include ('../config/database_config.php');
function createusers($username,$password,$createdAt) {
    $connect = connect();
    $stmt = $connect->prepare("INSERT INTO users (Username,Password,Created_At) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $usernameData, $passwordData,$createdAtData);
    $usernameData = $username;
    $passwordData = password_hash($password, PASSWORD_DEFAULT);
    $createdAtData = $createdAt;
    $stmt->execute();
}

function readusers($id) {
    $result = connect()->query("SELECT * FROM `users` WHERE id='$id'");
    return $result->fetch_row();
}

function readAllusers() {
    $result = connect()->query("SELECT * FROM `users` ORDER BY username");
    return $result;
}

function updateusers($id,$username,$password) {
    $connect = connect();
    $stmt = $connect->prepare("UPDATE `users` SET Username=?, Password=? WHERE id=$id");
    $stmt->bind_param("ss", $usernameData, $passwordData, );
    $stmt->bind_param("ss", $usernameData, $passwordData, );
    $usernameData = $username;
    $passwordData = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $stmt->execute();
}

function deleteusers($id) {
    connect()->query("DELETE FROM users WHERE id=$id");
}
?>