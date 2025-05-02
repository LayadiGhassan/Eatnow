<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Content-Type');

require_once 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        // Sanitize and retrieve form data
        $email = filter_var($_POST['Email'], FILTER_SANITIZE_EMAIL);
        $name = filter_var($_POST['Name'], FILTER_SANITIZE_STRING);
        $address = filter_var($_POST['Address'], FILTER_SANITIZE_STRING);
        $phone = filter_var($_POST['Phone'], FILTER_SANITIZE_STRING);
        $items = filter_var($_POST['items'], FILTER_SANITIZE_STRING);
        $total_price = filter_var($_POST['Total_Price'], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
        $count_items = filter_var($_POST['Count_Items'], FILTER_SANITIZE_NUMBER_INT);

        // Validate required fields
        if (empty($email) || empty($name) || empty($address) || empty($phone) || empty($items) || empty($total_price) || empty($count_items)) {
            throw new Exception('All fields are required.');
        }

        // Prepare and execute the SQL query
        $stmt = $conn->prepare("INSERT INTO orders (email, name, address, phone, items, total_price, count_items, order_date) VALUES (?, ?, ?, ?, ?, ?, ?, NOW())");
        $stmt->bind_param("sssssdi", $email, $name, $address, $phone, $items, $total_price, $count_items);

        if ($stmt->execute()) {
            echo json_encode(['result' => 'success', 'message' => 'Order placed successfully']);
        } else {
            throw new Exception('Failed to save order.');
        }

        $stmt->close();
        $conn->close();
    } catch (Exception $e) {
        http_response_code(500);
        echo json_encode(['result' => 'error', 'error' => $e->getMessage()]);
    }
} else {
    http_response_code(405);
    echo json_encode(['result' => 'error', 'error' => 'Method not allowed']);
}
?>