<?php
require_once '../includes/config.php';
require_once '../includes/database.php';

header('Content-Type: application/json');

$db = new Database();
$conn = $db->getConnection();

try {
    $stmt = $conn->query("
        SELECT id, name, description, price, image, category 
        FROM products 
        ORDER BY category, created_at DESC
    ");
    $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    // Nhóm sản phẩm theo danh mục
    $categorized = [
        'banh_ngot' => [],
        'banh_man' => []
    ];
    
    foreach ($products as $product) {
        $categorized[$product['category']][] = $product;
    }
    
    echo json_encode($categorized);
} catch(PDOException $e) {
    http_response_code(500);
    echo json_encode(['error' => 'Không thể lấy danh sách sản phẩm']);
} 