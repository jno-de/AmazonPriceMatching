CREATE DATABASE PriceData;
USE PriceData;
CREATE TABLE price_data (
    id INT AUTO_INCREMENT PRIMARY KEY,
    product_name VARCHAR(255),
    current_price DECIMAL(10,2),
    matched_price DECIMAL(10,2)
);
INSERT INTO price_data (product_name, current_price, matched_price) VALUES
('Wireless Headphones', '$99.99', '$94.99'),
('4K TV', '	$799.99', '$749.99'),
('Smartphone', '$499.99', '$479.99'),
('Bluetooth Speaker', '$59.99', '$54.99'),
('Laptop', '$999.99', '$899.99'),
('Smartwatch', '$149.99', '$139.99');