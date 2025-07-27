let cart = [];

function addToCart(name, price) {
    cart.push({ name, price });
    updateCartCount();
    saveCart();
}

function updateCartCount() {
    const cartCount = document.querySelectorAll('.cart span')[0];
    if (cartCount) {
        cartCount.textContent = cart.length;
    }
}

function calculateTotal() {
    return cart.reduce((total, item) => total + item.price, 0);
}

function saveCart() {
    localStorage.setItem('cart', JSON.stringify(cart));
}

function loadCart() {
    const savedCart = localStorage.getItem('cart');
    if (savedCart) {
        cart = JSON.parse(savedCart);
        updateCartCount();
    }
}

function clearCart() {
    cart = [];
    saveCart();
    updateCartCount();
}

// Initialize cart when page loads
document.addEventListener('DOMContentLoaded', loadCart);
