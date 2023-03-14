<?php 
include ('../config/database_config.php');
function createEmployee($firstname,$insertion,$lastname,$birthday,$function,$room_number,$nfcid,$createdAt) {
    $connect = connect();
    $stmt = $connect->prepare("INSERT INTO employees (Firstname,Insertion,Lastname,Birthday,Function,Room_NR,NFC_ID,Created_at) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssssss", $firstnameData, $insertionData, $lastnameData,$birthdayData,$functionData,$room_numberData,$nfcidData,$createdAtData);
    $firstnameData = $firstname;
    $insertionData = $insertion;
    $lastnameData = $lastname;
    $birthdayData = $birthday;
    $functionData = $function;

    $room_numberData = $room_number;
    $nfcidData = $nfcid;
    $createdAtData = $createdAt;
    $stmt->execute();
}
function readEmployee($id) {
    $result = connect()->query("SELECT * FROM `employees` WHERE id='$id'");
    return $result->fetch_row();
}
function readAllEmployees() {
    connect()->query("DELETE FROM unasigned_uid WHERE Created_At < DATE_SUB(NOW(), INTERVAL 5 MINUTE)");
    $result = connect()->query("SELECT * FROM `employees` ORDER BY Lastname");
    return $result;
}
function updateEmployee($id,$firstname,$insertion,$lastname,$birthday,$function,$room_number,$nfcid) {

    $connect = connect();
    $stmt = $connect->prepare("UPDATE `employees` SET Firstname=?, Insertion=?, Lastname=?, Birthday=?, Function=?, Room_NR=?, NFC_ID=? WHERE id=$id");
    $stmt->bind_param("sssssss", $firstnameData, $insertionData, $lastnameData,$birthdayData,$functionData,$room_numberData,$nfcidData);
    $firstnameData = $firstname;
    $insertionData = $insertion;
    $lastnameData = $lastname;
    $birthdayData = $birthday;
    $functionData = $function;
    $room_numberData = $room_number;
    $nfcidData = $nfcid;
    $stmt->execute();
}
function deleteEmployee($id) {
    connect()->query("DELETE FROM `employees` WHERE id=$id");
}
function getAllUnasignedUID() {
    $result = connect()->query("SELECT * FROM `unasigned_uid`");
    return $result;
}
?>