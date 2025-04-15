<?php
$conn = new mysqli("Database_Server_Private_IP", "username", "password", "PriceData");
$result = $conn->query("SELECT * FROM price_data");

$data = array();
while($row = $result->fetch_assoc()) {
    $data[] = $row;
}
header('Content-Type: application/json');
echo json_encode($data);
?>
