CREATE DATABASE PriceData;
USE PriceData;

CREATE TABLE price_data (
    product_id VARCHAR(50) PRIMARY KEY,
    product_name VARCHAR(255) NOT NULL,
    current_price DECIMAL(10,2),
    walmart_price DECIMAL(10,2),
    target_price DECIMAL(10,2),
    bestbuy_price DECIMAL(10,2)
);

INSERT INTO price_data (product_id, product_name, current_price, walmart_price, target_price, bestbuy_price) VALUES
('012345678901', 'Wireless Headphones', 99.99, 94.99, 96.49, 97.89),
('123456789012', '4K TV', 799.99, 749.99, 769.49, 755.99),
('234567890123', 'Smartphone', 499.99, 479.99, 489.49, 475.00),
('345678901234', 'Bluetooth Speaker', 59.99, 54.99, 52.00, 55.55),
('456789012345', 'Laptop', 999.99, 899.99, 929.49, 915.00),
('567890123456', 'Smartwatch', 149.99, 139.99, 145.00, 142.00),
('678901234567', 'Wireless Mouse', 29.99, 24.99, 26.49, 27.99),
('789012345678', 'Gaming Headset', 129.99, 119.99, 122.99, 124.49),
('890123456789', 'Smart Home Thermostat', 199.99, 189.99, 194.49, 196.00),
('901234567890', 'Smart TV', 599.99, 579.99, 589.99, 595.00),
('112233445566', 'Electric Kettle', 49.99, 44.99, 46.99, 47.99),
('223344556677', 'Cordless Drill', 89.99, 84.99, 86.49, 87.99),
('334455667788', 'Bluetooth Earbuds', 79.99, 74.99, 76.49, 78.00),
('445566778899', 'Digital Camera', 599.99, 579.99, 589.99, 595.99),
('556677889900', 'Washing Machine', 499.99, 459.99, 469.99, 479.00);
