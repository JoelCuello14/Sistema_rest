
CREATE DATABASE restaurant_db;

USE restaurant_db;

CREATE TABLE menu (
    id INT AUTO_INCREMENT PRIMARY KEY,
    dish_name VARCHAR(100),
    price DECIMAL(5,2)
);

CREATE TABLE orders (
    id INT AUTO_INCREMENT PRIMARY KEY,
    customer_name VARCHAR(100),
    dish_id INT,
    quantity INT,
    order_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (dish_id) REFERENCES menu(id)
);

CREATE TABLE inventory (
    id INT AUTO_INCREMENT PRIMARY KEY,
    item_name VARCHAR(100),
    quantity INT,
    last_updated TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE reports (
    id INT AUTO_INCREMENT PRIMARY KEY,
    report_type VARCHAR(50),
    report_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
