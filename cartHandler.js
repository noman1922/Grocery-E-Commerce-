const cartHandler = {
    cart: [],

    init() {
        this.loadCart();
        this.setupEventListeners();
        this.updateCartUI();
    },

    setupEventListeners() {
        // Convert all cart buttons to use cartHandler
        document.querySelectorAll('.cart-btn').forEach(btn => {
            btn.addEventListener('click', (e) => {
                e.preventDefault();
                const productBox = e.target.closest('.product-box');
                const name = productBox.querySelector('strong').textContent;
                const price = parseInt(productBox.querySelector('.price').textContent.replace('৳', '').trim());
                this.addToCart(name, price);
            });
        });

        // Add cart icon click event
        const cartIcon = document.querySelector('.cart');
        if (cartIcon) {
            cartIcon.addEventListener('click', (e) => {
                e.preventDefault();
                this.showCartModal();
            });
        }
    },

    addToCart(name, price, quantity = 1) {
        try {
            const item = {
                name,
                price: parseFloat(price),
                quantity
            };

            const existingItem = this.cart.find(i => i.name === name);
            if (existingItem) {
                existingItem.quantity += quantity;
            } else {
                this.cart.push(item);
            }

            this.updateCartUI();
            this.saveCart();
            this.showNotification('Item added to cart!');
        } catch (error) {
            console.error('Error adding to cart:', error);
            this.showNotification('Failed to add item to cart', 'error');
        }
    },

    removeFromCart(name) {
        this.cart = this.cart.filter(item => item.name !== name);
        this.updateCartUI();
        this.saveCart();
    },

    updateQuantity(name, quantity) {
        const item = this.cart.find(i => i.name === name);
        if (item) {
            item.quantity = parseInt(quantity);
            this.updateCartUI();
            this.saveCart();
        }
    },

    calculateTotal() {
        return this.cart.reduce((total, item) => total + (item.price * item.quantity), 0);
    },

    updateCartUI() {
        // Fix multiple counter issue
        const cartCounters = document.querySelectorAll('.cart span');
        const totalItems = this.cart.reduce((total, item) => total + item.quantity, 0);
        cartCounters.forEach(counter => {
            counter.textContent = totalItems;
        });
    },

    saveCart() {
        localStorage.setItem('cart', JSON.stringify(this.cart));
    },

    loadCart() {
        const savedCart = localStorage.getItem('cart');
        if (savedCart) {
            this.cart = JSON.parse(savedCart);
            this.updateCartUI();
        }
    },

    clearCart() {
        this.cart = [];
        this.updateCartUI();
        this.saveCart();
    },

    showCartModal() {
        // Remove any existing modal first
        const existingModal = document.querySelector('.cart-modal');
        if (existingModal) existingModal.remove();

        const modal = document.createElement('div');
        modal.className = 'cart-modal';
        modal.innerHTML = `
            <div class="cart-modal-content">
                <h2>Shopping Cart</h2>
                <div class="cart-items">
                    ${this.cart.map(item => `
                        <div class="cart-item">
                            <span>${item.name}</span>
                            <span>${item.quantity} x ৳${item.price}</span>
                            <button class="remove-item" data-name="${item.name}">Remove</button>
                        </div>
                    `).join('')}
                </div>
                <div class="cart-total">
                    <strong>Total: ৳${this.calculateTotal()}</strong>
                </div>
                ${this.cart.length > 0 ?
                `<button class="checkout-btn">Checkout</button>` :
                '<p>Your cart is empty</p>'}
                <button class="close-btn">Close</button>
            </div>
        `;

        document.body.appendChild(modal);

        // Add event listeners
        modal.querySelector('.close-btn').addEventListener('click', () => modal.remove());
        modal.querySelectorAll('.remove-item').forEach(btn => {
            btn.addEventListener('click', () => {
                this.removeFromCart(btn.dataset.name);
                this.showCartModal(); // Refresh modal
            });
        });
        modal.querySelector('.checkout-btn')?.addEventListener('click', () => this.checkout());
    },

    async checkout() {
        try {
            const response = await fetch('http://localhost:3000/api/orders', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Authorization': localStorage.getItem('token')
                },
                body: JSON.stringify({
                    items: this.cart,
                    total_price: this.calculateTotal()
                })
            });

            if (!response.ok) {
                throw new Error('Checkout failed');
            }

            const data = await response.json();
            this.clearCart();
            this.showNotification('Order placed successfully!');
            window.location.href = 'order-success.html';
        } catch (error) {
            console.error('Checkout error:', error);
            if (error.message === 'Unauthorized') {
                window.location.href = 'login_signup.html';
            } else {
                this.showNotification('Checkout failed. Please try again.', 'error');
            }
        }
    },

    showNotification(message, type = 'success') {
        const notification = document.createElement('div');
        notification.className = `notification ${type}`;
        notification.textContent = message;
        document.body.appendChild(notification);

        setTimeout(() => {
            notification.remove();
        }, 3000);
    }
};

// Initialize cart handler when page loads
document.addEventListener('DOMContentLoaded', () => cartHandler.init());
