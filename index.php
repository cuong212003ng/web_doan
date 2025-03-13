<?php
require_once 'includes/config.php';
require_once 'includes/database.php';
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fresh Garden - Tiệm bánh ngọt</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <header>
        <nav class="navbar">
            <div class="logo">
                <a href="index.php">Fresh Garden</a>
            </div>
            <div class="nav-links">
                <a href="index.php">Trang chủ</a>
                <a href="#products">Sản phẩm</a>
                <?php if(isset($_SESSION['user_id'])): ?>
                    <?php if(isset($_SESSION['is_admin']) && $_SESSION['is_admin']): ?>
                        <a href="admin/dashboard.php">Admin Panel</a>
                    <?php endif; ?>
                    <a href="profile.php">Tài khoản</a>
                    <a href="logout.php">Đăng xuất</a>
                <?php else: ?>
                    <a href="login.php">Đăng nhập</a>
                    <a href="register.php">Đăng ký</a>
                <?php endif; ?>
            </div>
        </nav>
    </header>

    <main>
        <!-- Banner section -->
        <section class="banner" style="background-image: linear-gradient(rgba(0,0,0,0.5), rgba(0,0,0,0.5)), url('assets/images/banner.png');">
            <h1>Thay lời yêu thương</h1>
            <p>Những chiếc bánh ngọt ngào và tinh tế</p>
        </section>

        <!-- Products section -->
        <section id="products" class="products">
            <h2>Sản phẩm nổi bật</h2>
            <div class="featured-products">
                <div class="product-card">
                    <div class="product-image">
                        <img src="assets/images/banhmochidau.png" alt="Bánh Mochi Dâu">
                    </div>
                    <div class="product-info">
                        <h4>Bánh Mochi Dâu</h4>
                        <p class="price">25.000 đ</p>
                        <button class="add-to-cart">Thêm vào đơn hàng</button>
                    </div>
                </div>
                <div class="product-card">
                    <div class="product-image">
                        <img src="assets/images/banhmochimatcha.png" alt="Bánh Mochi Matcha">
                    </div>
                    <div class="product-info">
                        <h4>Bánh Mochi Matcha</h4>
                        <p class="price">15.000 đ</p>
                        <button class="add-to-cart">Thêm vào đơn hàng</button>
                    </div>
                </div>
                <div class="product-card">
                    <div class="product-image">
                        <img src="assets/images/banhsukem.png" alt="Bánh Su Kem">
                    </div>
                    <div class="product-info">
                        <h4>Bánh Su Kem</h4>
                        <p class="price">20.000 đ</p>
                        <button class="add-to-cart">Thêm vào đơn hàng</button>
                    </div>
                </div>
                <div class="product-card">
                    <div class="product-image">
                        <img src="assets/images/banhCroissant.png" alt="Bánh Croissant">
                    </div>
                    <div class="product-info">
                        <h4>Bánh Croissant</h4>
                        <p class="price">30.000 đ</p>
                        <button class="add-to-cart">Thêm vào đơn hàng</button>
                    </div>
                </div>
                <div class="product-card">
                    <div class="product-image">
                        <img src="assets/images/banhquy.png" alt="Bánh Quy">
                    </div>
                    <div class="product-info">
                        <h4>Bánh Quy</h4>
                        <p class="price">35.000 đ</p>
                        <button class="add-to-cart">Thêm vào đơn hàng</button>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <footer>
        <div class="footer-content">
            <div class="footer-section">
                <h3>Fresh Garden</h3>
                <p>Nơi những chiếc bánh ngọt ngào được làm ra với tình yêu và sự tận tâm.</p>
                <div class="social-links">
                    <a href="#"><i class="fab fa-facebook"></i></a>
                    <a href="#"><i class="fab fa-instagram"></i></a>
                    <a href="#"><i class="fab fa-twitter"></i></a>
                </div>
            </div>
            
            <div class="footer-section">
                <h3>Liên hệ</h3>
                <p><i class="fas fa-map-marker-alt"></i> 254 Nguyễn Văn Linh, Thạc Gián, Thanh Khê, Đà Nẵng</p>
                <p><i class="fas fa-phone"></i> 0123 456 789</p>
                <p><i class="fas fa-envelope"></i> info@freshgarden.com</p>
            </div>
            
            <div class="footer-section">
                <h3>Giờ mở cửa</h3>
                <p>Thứ 2 - Thứ 6: 7:00 - 21:00</p>
                <p>Thứ 7 - Chủ nhật: 8:00 - 22:00</p>
            </div>
            
            <div class="footer-section">
                <h3>Đăng ký nhận tin</h3>
                <p>Nhận thông tin về sản phẩm mới và khuyến mãi</p>
                <form class="newsletter-form">
                    <input type="email" placeholder="Email của bạn">
                    <button type="submit">Đăng ký</button>
                </form>
            </div>
        </div>
        <div class="footer-bottom">
            <p>&copy; 2024 Fresh Garden. All rights reserved.</p>
        </div>
    </footer>

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <script src="assets/js/main.js"></script>
</body>
</html> 