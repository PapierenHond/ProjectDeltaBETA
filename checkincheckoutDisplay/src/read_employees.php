<?php
include ('../config/database_config.php');

$result = connect()->query('SELECT * FROM employees');
connect()->query("DELETE FROM unasigned_uid WHERE Created_At < DATE_SUB(NOW(), INTERVAL 5 MINUTE)");

$data = array();
while ($row = $result->fetch_assoc()) {
  $data[] = array(
    'id' => $row['ID'],
    'firstname' => $row['Firstname'],
    'insertion' => $row['Insertion'],
    'lastname' => $row['Lastname'],
    'function' => $row['Function'],
    'roomnr' => $row['Room_NR'],
    'value' => $row['Value']
  );
}


header('Content-Type: application/json');

echo json_encode($data);
?>

