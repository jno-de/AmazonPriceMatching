<?php
    // Get values passed from web server
    $store = isset($_GET['store']) ? $_GET['store'] : 'walmart'; // Default store is Walmart
    $upc = isset($_GET['upc']) ? $_GET['upc'] : ''; // Default UPC is blank

    // Map store names to database columns
    $storeColumnMap = [
        'walmart' => 'walmart_price',
        'target' => 'target_price',
        'bestbuy' => 'bestbuy_price'
    ];

    // If the store name is found in the map, set value to column, otherwise default to Walmart
    $store_column = isset($storeColumnMap[$store]) ? $storeColumnMap[$store] : 'walmart_price';

    // Database connection
    $conn = new mysqli("Database_Server_Private_IP", "username", "password", "PriceData");
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Query that selects product info and store column from table
    $query = "SELECT product_id, product_name, current_price, $store_column AS store_price
              FROM price_data";

    // If a UPC is declared, append it to the query
    if (!empty($upc)) {
        $query .= " WHERE product_id = '" . $conn->real_escape_string($upc) . "'";
    }

    // Run query
    $result = $conn->query($query);

    // Start HTML Output
    echo "
    <!DOCTYPE html>
    <html lang='en'>
        <head>
            <meta charset='UTF-8'>
            <meta name='viewport' content='width=device-width, initial-scale=1.0'>

            <style>
                body {
                    font-family: 'Arial', sans-serif;
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
                    width: 90%;
                    margin: 20px auto;
                    border-collapse: collapse;
                }

                th, td {
                    padding: 12px;
                    text-align: left;
                }

                th {
                    background-color: #304157;
                    color: white;
                    font-weight: normal;
                }

                td {
                    background-color: #fff;
                    font-size: 1.1em;
                }

                tr {
                    border-bottom: 1px solid #ddd;
                }

                tr:last-child {
                    border-bottom: none;
                }
            </style>
        </head>

        <body>
            <h1>Price Comparison – " . ucfirst($store) . "</h1>
            <table>
                <tr>
                    <th>UPC</th>
                    <th>Product</th>
                    <th>Amazon Price</th>
                    <th>" . ucfirst($store) . " Price</th>
                </tr>
    ";

    // Populate table with rows (if query result returns them)
    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "
                <tr>
                    <td>" . htmlspecialchars($row["product_id"]) . "</td>
                    <td>" . htmlspecialchars($row["product_name"]) . "</td>
                    <td>$" . number_format($row["current_price"], 2) . "</td>
                    <td>$" . number_format($row["store_price"], 2) . "</td>
                </tr>
            ";
        }
    } else {
        echo "<tr><td colspan='4'>No results found.</td></tr>";
    }

    // End HTML output and close database connection
    echo "
            </table>
        </body>
    </html>
    ";

    $conn->close();
?>
