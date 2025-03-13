<?php
require_once '../includes/config.php';
require_once '../includes/database.php';

// Kiểm tra quyền admin
if (!isset($_SESSION['user_id']) || !isset($_SESSION['is_admin'])) {
    header('Location: ../login.php');
    exit();
}

$db = new Database();
$conn = $db->getConnection();

// Lấy thống kê
$stmt = $conn->query("SELECT COUNT(*) as total_products FROM products");
$products_count = $stmt->fetch()['total_products'];

$stmt = $conn->query("SELECT COUNT(*) as total_orders FROM orders");
$orders_count = $stmt->fetch()['total_orders'];

$stmt = $conn->query("SELECT COUNT(*) as total_users FROM users WHERE is_admin = 0");
$users_count = $stmt->fetch()['total_users'];
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Fresh Garden</title>
    <link rel="stylesheet" href="../assets/css/admin.css">
</head>
<body>
    <div class="admin-container">
        <nav class="admin-nav">
            <div class="admin-logo">
                <h2>Fresh Garden Admin</h2>
            </div>
            <ul>
                <li><a href="dashboard.php" class="active">Dashboard</a></li>
                <li><a href="products.php">Sản phẩm</a></li>
                <li><a href="orders.php">Đơn hàng</a></li>
                <li><a href="users.php">Người dùng</a></li>
                <li><a href="../logout.php">Đăng xuất</a></li>
            </ul>
        </nav>
        
        <main class="admin-main">
            <h1>Dashboard</h1>
            
            <div class="stats-grid">
                <div class="stat-card">
                    <h3>Sản phẩm</h3>
                    <p><?php echo $products_count; ?></p>
                </div>
                <div class="stat-card">
                    <h3>Đơn hàng</h3>
                    <p><?php echo $orders_count; ?></p>
                </div>
                <div class="stat-card">
                    <h3>Khách hàng</h3>
                    <p><?php echo $users_count; ?></p>
                </div>
            </div>
        </main>
    </div>
</body>
</html> 