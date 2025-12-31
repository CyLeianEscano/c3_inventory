GROUP 3 INMGT BS INFO 3C
MEMBERS:

THESE ARE SAMPLE DTA FOR DATABASE FOR THE APP TO BE READILY CHECKED

------------------db-------------------------------
CREATE DATABASE c3_inventory;

USE c3_inventory;
CREATE TABLE users(
    user_id INT(11) PRIMARY KEY NOT NULL AUTO_INCREMENT COMMENT"Unique identifier of the user",
    full_name VARCHAR(100) NOT NULL COMMENT"Complete name of the user",
    username VARCHAR(50) UNIQUE KEY NOT NULL COMMENT"System login username",
    password VARCHAR(255) NOT NULL COMMENT"Encrypted user password",
    role VARCHAR(20) NOT NULL COMMENT"Access level (Admin, Staff, Cashier)"  
);

CREATE TABLE suppliers(
    supplier_id INT(11) PRIMARY KEY NOT NULL AUTO_INCREMENT COMMENT"Unique supplier ID",
    supplier_name VARCHAR(100) NOT NULL COMMENT"Name of the supplier",
    contact_number VARCHAR(20) NULL COMMENT"Supplier contact number",
    address VARCHAR(255) NULL COMMENT"Supplier physical address"
);

CREATE TABLE products(
    product_id INT(11) PRIMARY KEY NOT NULL AUTO_INCREMENT COMMENT"Unique product ID",
    supplier_id INT(11) NULL COMMENT"Reference to the suppliers table",
    FOREIGN KEY(supplier_id) REFERENCES suppliers(supplier_id),
    product_name VARCHAR(100) NOT NULL COMMENT"Name of the product",
    barcode VARCHAR(100) UNIQUE KEY NOT NULL COMMENT"Unique barcode identifier",
    category VARCHAR(50) NULL COMMENT"Product category",
    price DECIMAL(10,2) NOT NULL COMMENT"",
    stock_quantity INT(11) NOT NULL COMMENT""
);

CREATE TABLE transaction(
    transaction_id INT(11) PRIMARY KEY AUTO_INCREMENT NOT NULL COMMENT"Unique transaction id",
    product_id INT(11) NOT NULL COMMENT"Refrence to products table",
    FOREIGN KEY(product_id) REFERENCES products(product_id),
    user_id INT(11) NOT NULL COMMENT"Refrence to users table",
    FOREIGN KEY(user_id) REFERENCES users(user_id),
    transaction_type VARCHAR(20) NOT NULL COMMENT"Type of transaction (Sale, Purchases, Receipts)",
    quantity INT(11) NOT NULL COMMENT"Number of units transacted",
    transaction_date DATETIME NOT NULL COMMENT"Date and time of transaction"
);

-----------------add products---------------
-- Insert 5 suppliers first
INSERT INTO suppliers (supplier_name, contact_number, address) VALUES
('TechGiant Electronics', '1-800-TECH-123', '123 Silicon Valley Blvd, San Jose, CA'),
('FreshHarvest Groceries', '555-987-6543', '456 Farm Fresh Lane, Salinas, CA'),
('FitPro Sports Equipment', '888-FIT-PRO1', '789 Wellness Park, Boulder, CO'),
('WriteRight Stationery Co.', '333-456-7890', '321 Paper Mill Road, Chicago, IL'),
('HomeComfort Kitchenware', '777-234-5678', '654 Cook Street, Cleveland, OH');

-- Then insert products with matching supplier IDs
INSERT INTO products (supplier_id, product_name, barcode, category, price, stock_quantity) VALUES
-- TechGiant Electronics (supplier_id: 1) - Electronics products
(1, 'Apple MacBook Pro 14"', '000001', 'Electronics', 1999.99, 15),
(1, 'Sony WH-1000XM5 Headphones', '000002', 'Electronics', 329.99, 30),
(1, 'Wireless Mouse Ergonomic', '000006', 'Electronics', 29.99, 60),
(1, 'Bluetooth Speaker Portable', '000010', 'Electronics', 89.99, 25),
(1, 'Noise Cancelling Earbuds', '000030', 'Electronics', 129.99, 28),
(1, 'Power Bank 20000mAh', '000022', 'Electronics', 54.99, 40),

-- FreshHarvest Groceries (supplier_id: 2) - Grocery products
(2, 'Organic Arabica Coffee Beans 500g', '000004', 'Groceries', 18.50, 75),
(2, 'Green Tea Bags 100-pack', '000012', 'Groceries', 9.99, 150),
(2, 'Extra Virgin Olive Oil 1L', '000020', 'Groceries', 27.99, 60),
(2, 'Honey Pure 500g Jar', '000028', 'Groceries', 13.25, 85),
(2, 'Granola Bars 12-pack', '000036', 'Groceries', 11.99, 130),
(2, 'Almonds Raw 500g', '000044', 'Groceries', 16.99, 95),

-- FitPro Sports Equipment (supplier_id: 3) - Fitness products
(3, 'Yoga Mat Premium 6mm', '000005', 'Fitness', 39.99, 40),
(3, 'Resistance Bands Set 5pc', '000013', 'Fitness', 22.50, 80),
(3, 'Jump Rope with Counter', '000021', 'Fitness', 14.99, 110),
(3, 'Foam Roller 36-inch', '000029', 'Fitness', 29.99, 60),
(3, 'Adjustable Dumbbells 20kg', '000037', 'Fitness', 189.99, 12),
(3, 'Pull-up Bar Doorway', '000045', 'Fitness', 34.99, 70),

-- WriteRight Stationery Co. (supplier_id: 4) - Stationery products
(4, 'Hardcover Notebook A5', '000007', 'Stationery', 12.99, 200),
(4, 'Ballpoint Pens 12-pack Black', '000015', 'Stationery', 6.99, 300),
(4, 'Sticky Notes 5-pack Assorted', '000023', 'Stationery', 8.50, 180),
(4, 'Mechanical Pencil 0.5mm', '000031', 'Stationery', 3.99, 250),
(4, 'Correction Tape 2-pack', '000039', 'Stationery', 4.25, 190),
(4, 'Highlighters 8-color Set', '000047', 'Stationery', 9.99, 140),

-- HomeComfort Kitchenware (supplier_id: 5) - Kitchenware products
(5, 'Stainless Steel Water Bottle 1L', '000003', 'Kitchenware', 24.99, 100),
(5, 'Cast Iron Skillet 12-inch', '000011', 'Kitchenware', 45.00, 20),
(5, 'Ceramic Dinner Plate Set 6pc', '000019', 'Kitchenware', 32.75, 45),
(5, 'Chef\'s Knife 8-inch', '000027', 'Kitchenware', 36.50, 50),
(5, 'Non-stick Frying Pan 10-inch', '000035', 'Kitchenware', 28.75, 55),
(5, 'Glass Food Storage Set 10pc', '000043', 'Kitchenware', 38.50, 48),

-- Mixed/Other categories products (can be assigned to appropriate suppliers)
(1, 'USB-C Cable 2m Fast Charging', '000014', 'Electronics', 15.99, 120),
(1, 'Graphics Tablet for Drawing', '000038', 'Electronics', 89.99, 20),
(3, 'Running Shorts Medium', '000033', 'Athletic Wear', 25.50, 75),
(4, 'Desk Organizer Multifunction', '000024', 'Home & Office', 28.99, 70),
(5, 'Electric Kettle 1.7L', '000032', 'Home Appliances', 39.99, 32);

------------------add users-----------------
php app/tools/set_test_users.php
"C:\xampp\php\php.exe" app/tools/set_test_users.php

After running, you should see output like:

Updated user '1' with password '1' as role 'Cashier'
Updated user '2' with password '2' as role 'Staff'
Updated user '3' with password '3' as role 'Admin'


---------------run----------------
cd c:\Users\user\Desktop\c3_inventory
php -S localhost:8000 router.php



---------------barchart----------------
INSERT INTO transaction (product_id, user_id, transaction_type, quantity, transaction_date) VALUES
    -- January 2025
    (51, 10, 'Sales', 3,  '2025-01-05 10:15:00'),
    (52, 10, 'Sales', 5,  '2025-01-08 11:30:00'),
    (53, 10, 'Sales', 2,  '2025-01-12 14:00:00'),
    (54, 10, 'Sales', 4,  '2025-01-18 16:45:00'),
    (55, 10, 'Sales', 6,  '2025-01-25 09:20:00'),

    -- February 2025
    (56, 10, 'Sales', 4,  '2025-02-03 10:00:00'),
    (57, 10, 'Sales', 7,  '2025-02-09 13:15:00'),
    (58, 10, 'Sales', 3,  '2025-02-14 17:30:00'),
    (59, 10, 'Sales', 9,  '2025-02-20 11:05:00'),
    (60, 10, 'Sales', 5,  '2025-02-26 15:40:00'),

    -- March 2025
    (61, 10, 'Sales', 6,  '2025-03-04 09:50:00'),
    (62, 10, 'Sales', 8,  '2025-03-10 12:10:00'),
    (63, 10, 'Sales', 4,  '2025-03-16 18:20:00'),
    (64, 10, 'Sales', 10, '2025-03-22 14:35:00'),
    (65, 10, 'Sales', 7,  '2025-03-28 10:55:00');

    NOTE CHANGE 10 TO WHAT UR CASHIER ID IS