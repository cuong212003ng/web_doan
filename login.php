<?php
require_once 'includes/config.php';
require_once 'includes/database.php';

$error = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];
    
    $db = new Database();
    $conn = $db->getConnection();
    
    $stmt = $conn->prepare("SELECT id, password FROM users WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch();
    
    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['id'];
        // Kiểm tra và lưu quyền admin
        $stmt = $conn->prepare("SELECT is_admin FROM users WHERE id = ?");
        $stmt->execute([$user['id']]);
        $admin = $stmt->fetch();
        if ($admin && $admin['is_admin']) {
            $_SESSION['is_admin'] = true;
        }
        setcookie('user_logged_in', 'true', time() + 3600, '/');
        header('Location: index.php');
        exit();
    } else {
        $error = 'Email hoặc mật khẩu không đúng';
    }
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng nhập - Fresh Garden</title>
    <link rel="stylesheet" href="assets/css/auth.css">
</head>
<body>
    <div class="auth-container">
        <div class="auth-form">
            <h2>Đăng nhập</h2>
            <?php if ($error): ?>
                <div class="error"><?php echo $error; ?></div>
            <?php endif; ?>
            <form method="POST">
                <div class="form-group">
                    <input type="email" name="email" placeholder="Email" required>
                </div>
                <div class="form-group">
                    <input type="password" name="password" placeholder="Mật khẩu" required>
                </div>
                <button type="submit">Đăng nhập</button>
            </form>
            <p>
                <a href="forgot-password.php">Quên mật khẩu?</a> | 
                Chưa có tài khoản? <a href="register.php">Đăng ký</a>
            </p>
        </div>
    </div>
</body>
</html> 