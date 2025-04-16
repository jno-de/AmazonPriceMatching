<?php
$conn = new mysqli("Database_Server_Private_IP", "username", "password", "PriceData");
$result = $conn->query("SELECT product_name, current_price, matched_price FROM price_data");


echo "
<!DOCTYPE html>
<html lang='en'>
<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <style>
        body {
            font-family: 'Arial', sans-serif; /* Clean, sans-serif font */
            background-color: #f4f4f4;
            color: #333;
            margin: 0;
            padding: 0;
        }

        h1 {
            text-align: center;
            color: #333;
            margin-top: 20px;
        }

        table {
            width: 80%;
            margin: 20px auto;
            border-collapse: collapse; /* No borders except the bottom border */
        }

        th, td {
            padding: 12px;
            text-align: left;
        }

        th {
            background-color: #304157;
            color: white;
            font-weight: normal; /* Lighter text */
        }

        td {
            background-color: #fff;
            font-size: 1.1em;
        }

        tr {
            border-bottom: 1px solid #ddd; /* Only bottom border for each row */
        }

        tr:last-child {
            border-bottom: none; /* Remove border on the last row */
        }

        tr:hover {
            background-color: #f5f5f5; /* Light grey hover effect */
        }
    </style>
</head>
<body>

<h1>Trending Items</h1>

<table>
    <tr>
        <th>Product</th>
        <th>Amazon</th>
        <th>Walmart</th>
    </tr>";

while ($row = $result->fetch_assoc()) {
    echo "<tr>
            <td>" . htmlspecialchars($row["product_name"]) . "</td>
            <td>$" . number_format($row["current_price"], 2) . "</td>
            <td>$" . number_format($row["matched_price"], 2) . "</td>
          </tr>";
}

echo "</table>
</body>
</html>";

$conn->close();
?>
