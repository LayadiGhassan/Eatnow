<?php
require_once 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = filter_var($_POST['Email'] ?? '', FILTER_SANITIZE_EMAIL);
    $name = filter_var($_POST['Name'] ?? '', FILTER_SANITIZE_STRING);
    $address = filter_var($_POST['Address'] ?? '', FILTER_SANITIZE_STRING);
    $phone = filter_var($_POST['Phone'] ?? '', FILTER_SANITIZE_STRING);
    $items = $_POST['items'] ?? '';
    $total_price = (float)($_POST['total_Price'] ?? 0);
    $count_items = (int)($_POST['count_Items'] ?? 0);

  
    if (empty($email) || empty($name) || empty($address) || empty($phone) || empty($items) || $total_price <= 0 || $count_items <= 0) {
        die("Invalid input. Please fill all fields.");
    }

    $stmt = $pdo->prepare("INSERT INTO orders (email, name, address, phone, items, total_price, count_items) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->execute([$email, $name, $address, $phone, $items, $total_price, $count_items]);

    $_SESSION['cart'] = [];

    header("Location: index.php?order=success");
    exit;
} else {
    header("Location: checkout.php");
    exit;
}
?>
