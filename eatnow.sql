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

INSERT INTO products (id, img, name, price, old_price, category) VALUES
(0, 'img/product/1.png', 'Food', 350.00, NULL, 'Algerian'),
(1, 'img/product/1.png', 'Food', 280.00, NULL, 'Algerian'),
(2, 'img/product/2.png', 'Food', 400.00, NULL, 'Algerian'),
(3, 'img/product/3.png', 'Food', 530.00, NULL, 'Algerian'),
(4, 'img/product/2.png', 'Food', 250.00, NULL, 'Algerian'),
(5, 'img/product/3.png', 'Food', 280.00, NULL, 'Algerian'),
(6, 'img/product/1.png', 'Food', 220.00, 300.00, 'Algerian'),
(7, 'img/product/2.png', 'Food', 370.00, NULL, 'Algerian'),
(8, 'img/product/3.png', 'Food', 320.00, NULL, 'Algerian'),
(9, 'img/product/3.png', 'Food', 80.00, 100.00, 'Syrian'),
(10, 'img/product/2.png', 'Food', 300.00, NULL, 'Syrian'),
(11, 'img/product/1.png', 'Food', 260.00, 300.00, 'Syrian'),
(12, 'img/product/3.png', 'Food', 370.00, NULL, 'Syrian'),
(13, 'img/product/1.png', 'Food', 490.00, NULL, 'Syrian'),
(14, 'img/product/2.png', 'Food', 340.00, NULL, 'Syrian'),
(15, 'img/product/1.png', 'Food', 240.00, 300.00, 'Syrian'),
(16, "“img/product/2.png", 'Food', 600.00, 700.00, 'Syrian'),
(17, 'img/product/3.png', 'Food', 185.00, NULL, 'Chinese'),
(18, 'img/product/1.png', 'Food', 225.00, NULL, 'Chinese'),
(19, 'img/product/2.png', 'Food', 140.00, NULL, 'Chinese'),
(20, 'img/product/2.png', 'Food', 280.00, 330.00, 'Chinese'),
(21, 'img/project/1.png', 'Food', 350.00, NULL, 'Chinese'),
(22, 'img/product/3.png', 'Food', 580.00, NULL, 'Chinese'),
(23, 'img/product/3.png', 'Food', 400.00, NULL, 'Chinese'),
(24, 'img/product/2.png', 'Food', 300.00, 380.00, 'Chinese');
