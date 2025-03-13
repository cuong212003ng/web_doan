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

// Xử lý thêm sản phẩm mới
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_product'])) {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $category = $_POST['category'];
    
    // Xử lý upload ảnh
    $target_dir = "../assets/images/products/";
    $image = time() . '_' . basename($_FILES["image"]["name"]);
    $target_file = $target_dir . $image;
    
    if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
        $image = 'assets/images/products/' . $image;
    }
    
    $stmt = $conn->prepare("INSERT INTO products (name, description, price, image, category) VALUES (?, ?, ?, ?, ?)");
    $stmt->execute([$name, $description, $price, $image, $category]);
}

// Lấy danh sách sản phẩm
$stmt = $conn->query("SELECT * FROM products ORDER BY created_at DESC");
$products = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý sản phẩm - Fresh Garden</title>
    <link rel="stylesheet" href="../assets/css/admin.css">
</head>
<body>
    <div class="admin-container">
        <nav class="admin-nav">
            <div class="admin-logo">
                <h2>Fresh Garden Admin</h2>
            </div>
            <ul>
                <li><a href="dashboard.php">Dashboard</a></li>
                <li><a href="products.php" class="active">Sản phẩm</a></li>
                <li><a href="orders.php">Đơn hàng</a></li>
                <li><a href="users.php">Người dùng</a></li>
                <li><a href="../logout.php">Đăng xuất</a></li>
            </ul>
        </nav>
        
        <main class="admin-main">
            <h1>Quản lý sản phẩm</h1>
            
            <div class="admin-actions">
                <button onclick="showAddProductForm()" class="btn-primary">Thêm sản phẩm mới</button>
            </div>

            <div id="addProductForm" class="modal" style="display: none;">
                <div class="modal-content">
                    <h2>Thêm sản phẩm mới</h2>
                    <form method="POST" enctype="multipart/form-data">
                        <div class="form-group">
                            <label>Tên sản phẩm</label>
                            <input type="text" name="name" required>
                        </div>
                        <div class="form-group">
                            <label>Mô tả</label>
                            <textarea name="description" required></textarea>
                        </div>
                        <div class="form-group">
                            <label>Giá</label>
                            <input type="number" name="price" required>
                        </div>
                        <div class="form-group">
                            <label>Danh mục</label>
                            <select name="category" required>
                                <option value="banh_ngot">Bánh ngọt</option>
                                <option value="banh_man">Bánh mặn</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Hình ảnh</label>
                            <input type="file" name="image" accept="image/*" required>
                        </div>
                        <button type="submit" name="add_product">Thêm sản phẩm</button>
                        <button type="button" onclick="hideAddProductForm()">Hủy</button>
                    </form>
                </div>
            </div>

            <div class="products-grid">
                <?php foreach ($products as $product): ?>
                <div class="product-card">
                    <img src="../<?php echo $product['image']; ?>" alt="<?php echo $product['name']; ?>">
                    <h3><?php echo $product['name']; ?></h3>
                    <p class="price"><?php echo number_format($product['price']); ?> đ</p>
                    <div class="product-actions">
                        <button onclick="editProduct(<?php echo $product['id']; ?>)">Sửa</button>
                        <button onclick="deleteProduct(<?php echo $product['id']; ?>)" class="btn-danger">Xóa</button>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </main>
    </div>

    <script>
        function showAddProductForm() {
            document.getElementById('addProductForm').style.display = 'block';
        }

        function hideAddProductForm() {
            document.getElementById('addProductForm').style.display = 'none';
        }

        function editProduct(id) {
            // Implement edit functionality
        }

        function deleteProduct(id) {
            if (confirm('Bạn có chắc muốn xóa sản phẩm này?')) {
                // Implement delete functionality
            }
        }
    </script>
</body>
</html> 