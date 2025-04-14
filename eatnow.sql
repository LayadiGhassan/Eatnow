CREATE DATABASE eatnow;

USE eatnow;

CREATE TABLE products (
    id INT PRIMARY KEY,
    img VARCHAR(255) NOT NULL,
    name VARCHAR(100) NOT NULL,
    price DECIMAL(10, 2) NOT NULL,
    old_price DECIMAL(10, 2) DEFAULT NULL,
    category VARCHAR(50) NOT NULL
);

CREATE TABLE orders (
    id INT AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(100) NOT NULL,
    name VARCHAR(100) NOT NULL,
    address TEXT NOT NULL,
    phone VARCHAR(20) NOT NULL,
    items TEXT NOT NULL,
    total_price DECIMAL(10, 2) NOT NULL,
    count_items INT NOT NULL,
    order_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
