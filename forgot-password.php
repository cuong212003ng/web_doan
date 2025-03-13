<?php
require_once 'includes/config.php';
require_once 'includes/database.php';

$error = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $new_password = $_POST['new_password'];
    $confirm_password = $_POST['confirm_password'];
    
    if ($new_password !== $confirm_password) {
        $error = 'Mật khẩu xác nhận không khớp';
    } else {
        $db = new Database();
        $conn = $db->getConnection();
        
        // Kiểm tra email tồn tại
        $stmt = $conn->prepare("SELECT id FROM users WHERE email = ?");
        $stmt->execute([$email]);
        
        if ($user = $stmt->fetch()) {
            // Cập nhật mật khẩu mới
            $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);
            $stmt = $conn->prepare("UPDATE users SET password = ? WHERE email = ?");
            
            if ($stmt->execute([$hashed_password, $email])) {
                $success = 'Mật khẩu đã được cập nhật. Vui lòng đăng nhập lại.';
            } else {
                $error = 'Có lỗi xảy ra. Vui lòng thử lại.';
            }
        } else {
            $error = 'Email không tồn tại trong hệ thống';
        }
    }
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quên mật khẩu - Fresh Garden</title>
    <link rel="stylesheet" href="assets/css/auth.css">
</head>
<body>
    <div class="auth-container">
        <div class="auth-form">
            <h2>Quên mật khẩu</h2>
            <?php if ($error): ?>
                <div class="error"><?php echo $error; ?></div>
            <?php endif; ?>
            <?php if ($success): ?>
                <div class="success"><?php echo $success; ?></div>
            <?php endif; ?>
            <form method="POST">
                <div class="form-group">
                    <input type="email" name="email" placeholder="Email đăng ký" required>
                </div>
                <div class="form-group">
                    <input type="password" name="new_password" placeholder="Mật khẩu mới" required>
                </div>
                <div class="form-group">
                    <input type="password" name="confirm_password" placeholder="Xác nhận mật khẩu mới" required>
                </div>
                <button type="submit">Đổi mật khẩu</button>
            </form>
            <p>
                <a href="login.php">Đăng nhập</a> | 
                <a href="register.php">Đăng ký</a>
            </p>
        </div>
    </div>
</body>
</html> 