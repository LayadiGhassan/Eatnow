<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET');
header('Access-Control-Allow-Headers: Content-Type');

require_once 'config.php';

try {
    // Query to fetch all products
    $query = "SELECT id, name, price, old_price, img, category FROM products";
    $result = $conn->query($query);

    $products = [];
    while ($row = $result->fetch_assoc()) {
        // Ensure category matches JSON spelling ('catetory') for compatibility
        $row['catetory'] = $row['category'];
        unset($row['category']);
        $products[] = $row;
    }

    // Output products as JSON
    echo json_encode($products);

    $result->free();
    $conn->close();
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(['error' => 'Failed to fetch products: ' . $e->getMessage()]);
}
?>