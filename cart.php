<?php
require_once 'config.php';
header('Content-Type: application/json');

$action = $_POST['action'] ?? '';

if ($action === 'add') {
    $product_id = (int)($_POST['id'] ?? 0);
    $stmt = $pdo->prepare("SELECT * FROM products WHERE id = ?");
    $stmt->execute([$product_id]);
    $product = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($product) {
        if (!isset($_SESSION['cart'][$product_id])) {
            $_SESSION['cart'][$product_id] = [
                'id' => $product['id'],
                'name' => $product['name'],
                'price' => $product['price'],
                'img' => $product['img'],
                'quantity' => 1
            ];
        } else {
            $_SESSION['cart'][$product_id]['quantity']++;
        }
        echo json_encode(['success' => true, 'cart' => array_values($_SESSION['cart'])]);
    } else {
        echo json_encode(['success' => false, 'error' => 'Product not found']);
    }
} elseif ($action === 'increase') {
    $index = (int)($_POST['index'] ?? -1);
    $cart = array_values($_SESSION['cart']);
    if (isset($cart[$index])) {
        $_SESSION['cart'][$cart[$index]['id']]['quantity']++;
        echo json_encode(['success' => true, 'cart' => array_values($_SESSION['cart'])]);
    } else {
        echo json_encode(['success' => false, 'error' => 'Invalid index']);
    }
} elseif ($action === 'decrease') {
    $index = (int)($_POST['index'] ?? -1);
    $cart = array_values($_SESSION['cart']);
    if (isset($cart[$index]) && $cart[$index]['quantity'] > 1) {
        $_SESSION['cart'][$cart[$index]['id']]['quantity']--;
        echo json_encode(['success' => true, 'cart' => array_values($_SESSION['cart'])]);
    } else {
        echo json_encode(['success' => false, 'error' => 'Invalid index or quantity']);
    }
} elseif ($action === 'remove') {
    $index = (int)($_POST['index'] ?? -1);
    $cart = array_values($_SESSION['cart']);
    if (isset($cart[$index])) {
        $product_id = $cart[$index]['id'];
        unset($_SESSION['cart'][$product_id]);
        echo json_encode(['success' => true, 'cart' => array_values($_SESSION['cart'])]);
    } else {
        echo json_encode(['success' => false, 'error' => 'Invalid index']);
    }
} else {
    echo json_encode(['success' => false, 'error' => 'Invalid action']);
}
?>
