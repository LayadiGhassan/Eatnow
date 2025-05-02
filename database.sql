CREATE DATABASE eatnow;

USE eatnow;

CREATE TABLE products (
    id INT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    price DECIMAL(10, 2) NOT NULL,
    old_price DECIMAL(10, 2) DEFAULT NULL,
    img VARCHAR(255) NOT NULL,
    category VARCHAR(50) NOT NULL
);

CREATE TABLE orders (
    id INT AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(255) NOT NULL,
    name VARCHAR(255) NOT NULL,
    address TEXT NOT NULL,
    phone VARCHAR(20) NOT NULL,
    items TEXT NOT NULL,
    total_price DECIMAL(10, 2) NOT NULL,
    count_items INT NOT NULL,
    order_date DATETIME NOT NULL
);

INSERT INTO products (id, name, price, old_price, img, category) VALUES
(0, 'Food', 350.00, NULL, 'img/product/1.png', 'Algerian'),
(1, 'Food', 280.00, NULL, 'img/product/1.png', 'Algerian'),
(2, 'Food', 400.00, NULL, 'img/product/2.png', 'Algerian'),
(3, 'Food', 530.00, NULL, 'img/product/3.png', 'Algerian'),
(4, 'Food', 250.00, NULL, 'img/product/2.png', 'Algerian'),
(5, 'Food', 280.00, NULL, 'img/product/3.png', 'Algerian'),
(6, 'Food', 220.00, 300.00, 'img/product/1.png', 'Algerian'),
(7, 'Food', 370.00, NULL, 'img/product/2.png', 'Algerian'),
(8, 'Food', 320.00, NULL, 'img/product/3.png', 'Algerian'),
(9, 'Food', 80.00, 100.00, 'img/product/3.png', 'Syrian'),
(10, 'Food', 300.00, NULL, 'img/product/2.png', 'Syrian'),
(11, 'Food', 260.00, 300.00, 'img/product/1.png', 'Syrian'),
(12, 'Food', 370.00, NULL, 'img/product/3.png', 'Syrian'),
(13, 'Food', 490.00, NULL, 'img/product/1.png', 'Syrian'),
(14, 'Food', 340.00, NULL, 'img/product/2.png', 'Syrian'),
(15, 'Food', 240.00, 300.00, 'img/product/1.png', 'Syrian'),
(16, 'Food', 600.00, 700.00, 'img/product/2.png', 'Syrian'),
(17, 'Food', 185.00, NULL, 'img/product/3.png', 'Chinese'),
(18, 'Food', 225.00, NULL, 'img/product/1.png', 'Chinese'),
(19, 'Food', 140.00, NULL, 'img/product/2.png', 'Chinese'),
(20, 'Food', 280.00, 330.00, 'img/product/2.png', 'Chinese'),
(21, 'Food', 350.00, NULL, 'img/product/1.png', 'Chinese'),
(22, 'Food', 580.00, NULL, 'img/product/3.png', 'Chinese'),
(23, 'Food', 400.00, NULL, 'img/product/3.png', 'Chinese'),
(24, 'Food', 300.00, 380.00, 'img/product/2.png', 'Chinese');