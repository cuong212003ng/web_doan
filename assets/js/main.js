// Load products from API
async function loadProducts() {
    try {
        const response = await fetch('api/products.php');
        const products = await response.json();
        displayProducts(products);
    } catch (error) {
        console.error('Error loading products:', error);
    }
}

// Display products in grid
function displayProducts(categorizedProducts) {
    const productGrid = document.querySelector('.product-grid');
    let html = '';

    // Hiển thị bánh ngọt
    if (categorizedProducts.banh_ngot.length > 0) {
        html += '<div class="category-section"><h3>Bánh Ngọt</h3><div class="products-row">';
        html += categorizedProducts.banh_ngot.map(product => createProductCard(product)).join('');
        html += '</div></div>';
    }

    // Hiển thị bánh mặn
    if (categorizedProducts.banh_man.length > 0) {
        html += '<div class="category-section"><h3>Bánh Mặn</h3><div class="products-row">';
        html += categorizedProducts.banh_man.map(product => createProductCard(product)).join('');
        html += '</div></div>';
    }

    productGrid.innerHTML = html;
}

function createProductCard(product) {
    return `
        <div class="product-card">
            <div class="product-image">
                <img src="${product.image}" alt="${product.name}">
            </div>
            <div class="product-info">
                <h4>${product.name}</h4>
                <p class="description">${product.description}</p>
                <p class="price">${product.price.toLocaleString('vi-VN')} đ</p>
                <button onclick="addToCart(${product.id})" class="add-to-cart">
                    Thêm vào giỏ hàng
                </button>
            </div>
        </div>
    `;
}

// Add to cart function
function addToCart(productId) {
    if (!isLoggedIn()) {
        window.location.href = 'login.php';
        return;
    }
    // Add to cart logic here
}

// Check if user is logged in
function isLoggedIn() {
    return document.cookie.includes('user_logged_in=true');
}

// Load products when page loads
document.addEventListener('DOMContentLoaded', loadProducts); 