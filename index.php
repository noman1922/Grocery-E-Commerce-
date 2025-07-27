<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>eGrocery Store</title>
    <link rel="stylesheet" type="text/css" href="style.css" />
    <link rel="stylesheet" href="cart-styles.css" />
    <link rel="shortcut icon" href="images/fav-icon.png" />
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;900&display=swap" rel="stylesheet" />
    <style>
        /* Cart Modal Styles */
        .cart-modal {
            display: none;
            position: fixed;
            top: 0;
            right: 0;
            width: 350px;
            height: 100%;
            background: white;
            box-shadow: -2px 0 10px rgba(0,0,0,0.1);
            z-index: 1000;
            overflow-y: auto;
            transition: transform 0.3s ease;
        }
        
        .cart-modal.active {
            display: block;
            transform: translateX(0);
        }
        
        .cart-header {
            padding: 15px;
            background: #f8f9fa;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 1px solid #ddd;
        }
        
        .close-cart {
            font-size: 24px;
            cursor: pointer;
        }
        
        .cart-items {
            padding: 15px;
        }
        
        .cart-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px 0;
            border-bottom: 1px solid #eee;
        }
        
        .cart-item-info {
            flex-grow: 1;
        }
        
        .cart-item-price {
            font-weight: bold;
            margin: 0 15px;
        }
        
        .remove-item {
            color: #ff0000;
            cursor: pointer;
            background: none;
            border: none;
            font-size: 18px;
        }
        
        .cart-total {
            padding: 15px;
            font-size: 18px;
            font-weight: bold;
            text-align: right;
            border-top: 1px solid #ddd;
        }
        
        .checkout-btn {
            display: block;
            width: 90%;
            margin: 15px auto;
            padding: 10px;
            background: #28a745;
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
        }
        
        .overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0,0,0,0.5);
            z-index: 999;
        }
        
        .overlay.active {
            display: block;
        }
        
        .cart-count {
            position: absolute;
            top: -8px;
            right: -8px;
            background: #ff0000;
            color: white;
            border-radius: 50%;
            width: 18px;
            height: 18px;
            font-size: 12px;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        
        .cart-icon-container {
            position: relative;
        }

        /* Notification style */
        .add-to-cart-notification {
            position: fixed;
            bottom: 20px;
            left: 50%;
            transform: translateX(-50%);
            background: #28a745;
            color: white;
            padding: 10px 20px;
            border-radius: 5px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.2);
            z-index: 1001;
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .add-to-cart-notification.show {
            opacity: 1;
        }
    </style>
</head>
<body>
    <!-- Add to cart notification -->
    <div class="add-to-cart-notification" id="addToCartNotification"></div>

    <!--==Navigation================================-->
    <nav class="navigation">
        <!--logo-------->
        <a href="index.html" class="logo"> <span>e</span>Grocery </a>
        <!--menu-btn---->
        <input type="checkbox" class="menu-btn" id="menu-btn" />
        <label for="menu-btn" class="menu-icon">
            <span class="nav-icon"></span>
        </label>
        <!--menu-------->
        <ul class="menu">
            <li><a href="index.html" class="active">Home</a></li>
            <li><a href="#category">Categories</a></li>
            <li><a href="#popular-bundle-pack">Our Packages</a></li>
            <li><a href="#download-app">Our App</a></li>
        </ul>
        <!--right-nav-(cart-like)-->
        <div class="right-nav">
            <!--like----->
            <a href="#" class="like">
                <i class="far fa-heart"></i>
                <span>0</span>
            </a>
            <!--cart----->
            <div class="cart-icon-container">
                <a href="#" class="cart" onclick="cartHandler.showCartModal(); return false;">
                    <i class="fas fa-shopping-cart"></i>
                    <span class="cart-count">0</span>
                </a>
            </div>
        </div>
    </nav>

    <!-- Cart Modal -->
    <div class="overlay" id="overlay"></div>
    <div class="cart-modal" id="cartModal">
        <div class="cart-header">
            <h3>Your Cart</h3>
            <span class="close-cart" onclick="cartHandler.hideCartModal()">&times;</span>
        </div>
        <div class="cart-items" id="cartItems">
            <!-- Cart items will be added here dynamically -->
            <div class="empty-cart-message">Your cart is empty</div>
        </div>
        <div class="cart-total" id="cartTotal">
            Total: ৳0
        </div>
        <button class="checkout-btn">Proceed to Checkout</button>
    </div>

    <!-- Rest of your HTML content remains the same -->
    <!--==Search-banner=======================================-->
    <section id="search-banner">
        <!--bg--------->
        <img alt="bg" class="bg-1" src="images/bg-1.png" />
        <img alt="bg-2" class="bg-2" src="images/bg-2.png" />
        <!--text------->
        <div class="search-banner-text">
            <h1>Order Your daily Groceries</h1>
            <strong>#Free Delivery</strong>
            <!--search-box------>
            <form action="" class="search-box">
                <!--icon------>
                <i class="fas fa-search"></i>
                <!--input----->
                <input
                    type="text"
                    class="search-input"
                    placeholder="Search your daily groceries"
                    name="search"
                    required
                />
                <!--btn------->
                <input type="submit" class="search-btn" value="Search" />
            </form>
        </div>
    </section>

    <!--==category=========================================-->
    <section id="category">
        <!--heading---------------->
        <div class="category-heading">
            <h2>Category</h2>
            <span>All</span>
        </div>
        <!--box-container---------->
        <div class="category-container">
            <!--box---------------->
            <a href="Spices.html" class="category-box">
                <img alt="Spices" src="images/spices.png" />
                <span>Spices</span>
            </a>
            <!--box---------------->
            <a href="fruits_vegetables.html" class="category-box">
                <img alt="Fish" src="images/healthy-food.png" />
                <span>Fruit & Vegatbles</span>
            </a>
            <!--box---------------->
            <a href="snacks_drinks.html" class="category-box">
                <img alt="Snacks" src="images/candies.png" />
                <span>Snacks & Drinks</span>
            </a>
            <!--box---------------->
            <a href="cookings.html" class="category-box">
                <img alt="Fish" src="images/bake.png" />
                <span>Cookings</span>
            </a>
            <!--box---------------->
            <a href="household.html" class="category-box">
                <img alt="Household" src="images/cleaning-products.png" />
                <span>Household Items</span>
            </a>
        </div>
    </section>

    <!--==Products====================================-->
    <section id="popular-product">
        <!--heading----------->
        <div class="product-heading">
            <h3>Popular Product</h3>
            <span>All</span>
        </div>
        <!--box-container------>
        <div class="product-container">
            <!--box---------->
            <div class="product-box">
                <img alt="apple" src="images/apple.png" />
                <strong>Apple</strong>
                <span class="quantity">1 KG</span>
                <span class="price"> ৳ 310</span>
                <!--cart-btn------->
                <button onclick="cartHandler.addToCart('Apple', 310, 'images/apple.png')" class="cart-btn">
                    <i class="fas fa-shopping-bag"></i> Add Cart
                </button>
                <!--like-btn------->
                <a href="#" class="like-btn">
                    <i class="far fa-heart"></i>
                </a>
            </div>
            <!--box---------->
            <div class="product-box">
                <img alt="apple" src="images/chili.png" />
                <strong>Chili</strong>
                <span class="quantity">1 KG</span>
                <span class="price"> ৳ 160</span>
                <!--cart-btn------->
                <button onclick="cartHandler.addToCart('Chili', 160, 'images/chili.png')" class="cart-btn">
                    <i class="fas fa-shopping-bag"></i> Add Cart
                </button>
                <!--like-btn------->
                <a href="#" class="like-btn">
                    <i class="far fa-heart"></i>
                </a>
            </div>
            <!--box---------->
            <div class="product-box">
                <img alt="apple" src="images/onion.png" />
                <strong>Onion</strong>
                <span class="quantity">1 KG</span>
                <span class="price"> ৳ 70</span>
                <!--cart-btn------->
                <button onclick="cartHandler.addToCart('Onion', 70, 'images/onion.png')" class="cart-btn">
                    <i class="fas fa-shopping-bag"></i> Add Cart
                </button>
                <!--like-btn------->
                <a href="#" class="like-btn">
                    <i class="far fa-heart"></i>
                </a>
            </div>
            <!--box---------->
            <div class="product-box">
                <img alt="apple" src="images/patato.png" />
                <strong>Patato</strong>
                <span class="quantity">1 KG</span>
                <span class="price"> ৳ 330</span>
                <!--cart-btn------->
                <button onclick="cartHandler.addToCart('Patato', 330, 'images/patato.png')" class="cart-btn">
                    <i class="fas fa-shopping-bag"></i> Add Cart
                </button>
                <!--like-btn------->
                <a href="#" class="like-btn">
                    <i class="far fa-heart"></i>
                </a>
            </div>
            <!--box---------->
            <div class="product-box">
                <img alt="apple" src="images/garlic.png" />
                <strong>Garlic</strong>
                <span class="quantity">1 KG</span>
                <span class="price"> ৳ 240</span>
                <!--cart-btn------->
                <button onclick="cartHandler.addToCart('Garlic', 240, 'images/garlic.png')" class="cart-btn">
                    <i class="fas fa-shopping-bag"></i> Add Cart
                </button>
                <!--like-btn------->
                <a href="#" class="like-btn">
                    <i class="far fa-heart"></i>
                </a>
            </div>
            <!--box---------->
            <div class="product-box">
                <img alt="apple" src="images/tamato.png" />
                <strong>Tamato</strong>
                <span class="quantity">1 KG</span>
                <span class="price"> ৳ 150</span>
                <!--cart-btn------->
                <button onclick="cartHandler.addToCart('Tamato', 150, 'images/tamato.png')" class="cart-btn">
                    <i class="fas fa-shopping-bag"></i> Add Cart
                </button>
                <!--like-btn------->
                <a href="#" class="like-btn">
                    <i class="far fa-heart"></i>
                </a>
            </div>
        </div>
    </section>

    <!--Popular-bundle-pack===================================-->
    <section id="popular-bundle-pack">
        <!--heading-------------->
        <div class="product-heading">
            <h3>Popular Bundle Pack</h3>
        </div>
        <!--box-container------>
        <div class="product-container">
            <!--box---------->
            <div class="product-box">
                <img alt="pack" src="images/pack1.png" />
                <strong>Big Pack</strong>
                <span class="quantity">Lemone, Tamato, Patato,+4</span>
                <span class="price"> ৳ 670</span>
                <!--cart-btn------->
                <button onclick="cartHandler.addToCart('Big Pack', 670, 'images/pack1.png')" class="cart-btn">
                    <i class="fas fa-shopping-bag"></i> Add Cart
                </button>
                <!--like-btn------->
                <a href="#" class="like-btn">
                    <i class="far fa-heart"></i>
                </a>
            </div>
            <!--box---------->
            <div class="product-box">
                <img alt="apple" src="images/pack2.jpg" />
                <strong>Large Pack</strong>
                <span class="quantity">Lemone, Tamato, Patato,+2</span>
                <span class="price">৳ 450</span>
                <!--cart-btn------->
                <button onclick="cartHandler.addToCart('Large Pack', 450, 'images/pack2.jpg')" class="cart-btn">
                    <i class="fas fa-shopping-bag"></i> Add Cart
                </button>
                <!--like-btn------->
                <a href="#" class="like-btn">
                    <i class="far fa-heart"></i>
                </a>
            </div>
            <!--box---------->
            <div class="product-box">
                <img alt="apple" src="images/pack3.png" />
                <strong>Small Pack</strong>
                <span class="quantity">Lemone, Tamato, Patato</span>
                <span class="price"> ৳ 320</span>
                <!--cart-btn------->
                <button onclick="cartHandler.addToCart('Small Pack', 320, 'images/pack3.png')" class="cart-btn">
                    <i class="fas fa-shopping-bag"></i> Add Cart
                </button>
                <!--like-btn------->
                <a href="#" class="like-btn">
                    <i class="far fa-heart"></i>
                </a>
            </div>
            <!--box---------->
            <div class="product-box">
                <img alt="pack" src="images/pack1.png" />
                <strong>Big Pack</strong>
                <span class="quantity">Lemone, Tamato, Patato,+4</span>
                <span class="price"> ৳ 970</span>
                <!--cart-btn------->
                <button onclick="cartHandler.addToCart('Big Pack', 970, 'images/pack1.png')" class="cart-btn">
                    <i class="fas fa-shopping-bag"></i> Add Cart
                </button>
                <!--like-btn------->
                <a href="#" class="like-btn">
                    <i class="far fa-heart"></i>
                </a>
            </div>
            <!--box---------->
            <div class="product-box">
                <img alt="apple" src="images/pack2.jpg" />
                <strong>Large Pack</strong>
                <span class="quantity">Lemone, Tamato, Patato,+2</span>
                <span class="price"> ৳ 500</span>
                <!--cart-btn------->
                <button onclick="cartHandler.addToCart('Large Pack', 500, 'images/pack2.jpg')" class="cart-btn">
                    <i class="fas fa-shopping-bag"></i> Add Cart
                </button>
                <!--like-btn------->
                <a href="#" class="like-btn">
                    <i class="far fa-heart"></i>
                </a>
            </div>
            <!--box---------->
            <div class="product-box">
                <img alt="apple" src="images/pack3.png" />
                <strong>Small Pack</strong>
                <span class="quantity">Lemone, Tamato, Patato</span>
                <span class="price"> ৳ 325</span>
                <!--cart-btn------->
                <button onclick="cartHandler.addToCart('Small Pack', 325, 'images/pack3.png')" class="cart-btn">
                    <i class="fas fa-shopping-bag"></i> Add Cart
                </button>
                <!--like-btn------->
                <a href="#" class="like-btn">
                    <i class="far fa-heart"></i>
                </a>
            </div>
        </div>
    </section>

    <!--==Clients===============================================-->
    <section id="clients">
        <!--heading---------------->
        <div class="client-heading">
            <h3>What Our Client's Say</h3>
        </div>
        <!--box-container---------->
        <div class="client-box-container">
            <!--box------------->
            <div class="client-box">
                <!--==profile===-->
                <div class="client-profile">
                    <!--img--->
                    <img alt="client" src="images/client-1.jpg" />
                    <!--text-->
                    <div class="profile-text">
                        <strong>Abdul Rahim</strong>
                        <span>Businessman</span>
                    </div>
                </div>
                <!--==Rating======-->
                <div class="rating">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                </div>
                <!--==comments===-->
                <p>
                    eGrocery তে এটা আমার ৭ম অর্ডার। এতোদিন রিভিউ দেওয়া হয়নি আজকে রিভিউ
                    দিচ্ছি প্রোডাক্ট যেমনটা দেখছি তার থেকে অনেক ভালো কোয়ালিটি
                    পেয়েছিলাম ‌। সবাই নিতে পারেন অনেক ভালো। আর ডেলিভারি ম্যান এর
                    ব্যবহারটাও অনেক ভালো ছিল
                </p>
            </div>
            <!--box------------->
            <div class="client-box">
                <!--==profile===-->
                <div class="client-profile">
                    <!--img--->
                    <img alt="client" src="images/client-2.jpg" />
                    <!--text-->
                    <div class="profile-text">
                        <strong>Abdul Karim</strong>
                        <span>Teacher</span>
                    </div>
                </div>
                <!--==Rating======-->
                <div class="rating">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                </div>
                <!--==comments===-->
                <p>
                    প্রোডাক্ট এর গুণগত মান খুবই ভালো পেয়েছি।সেলার কে বলেছিলাম সব ঠিক ঠাক
                    দিবেন,কোন খারাপ জিনিস দিবেন না,ঠিক সেরকমই ভালোমানের টাটকা সবজি
                    দিয়েছে আমাকে।ধন্যবাদ
                </p>
            </div>
            <!--box------------->
            <div class="client-box">
                <!--==profile===-->
                <div class="client-profile">
                    <!--img--->
                    <img alt="client" src="images/client-3.jpg" />
                    <!--text-->
                    <div class="profile-text">
                        <strong>Jorina Begum</strong>
                        <span>Housewife</span>
                    </div>
                </div>
                <!--==Rating======-->
                <div class="rating">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                </div>
                <!--==comments===-->
                <p>
                    আমার হাসব্যান্ড তো আমার রান্নার অনেক প্রসংশা করেছে। সম্পূর্ন ক্রেডিট
                    টাই eGrocery এর। ওদের প্রোডাক্ট গুলো অনেক ভালো। এবং ডেলিভারিও অনেক
                    ফাস্ট।
                </p>
            </div>
        </div>
    </section>

    <!--==Partnre-logo================================-->
    <section id="partner">
        <!--heading------------>
        <div class="partner-heading">
            <h3>Our Trusted Partner</h3>
        </div>
        <!--logo-container----->
        <div class="logo-container">
            <img alt="logo" src="images/logo-1.png" />
            <img alt="logo" src="images/logo-2.png" />
            <img alt="logo" src="images/logo-3.png" />
            <img alt="logo" src="images/logo-4.png" />
        </div>
    </section>

    <!--==download-app====================================-->
    <section id="download-app">
        <!--img----------------------->
        <div class="app-img">
            <img alt="app" src="images/mobile-app.png" />
        </div>
        <!--text---------------------->
        <div class="download-app-text">
            <strong>Download App</strong>
            <p>
                The core mission of eGrocery is to save money and save time as we
                focus on the fact that people don't have to spend too much of their
                precious money and time to buy their necessities on a daily basis. We
                want to make people's lives easier so that they can do their daily
                activities without running to the supermarket or vegetable market.
            </p>
            <!--btns------->
            <div class="download-btns">
                <a href="#"><img alt="" src="images/appstore-btn.png" /></a>
                <a href="#"><img alt="" src="images/googleplay-btn.png" /></a>
            </div>
        </div>
    </section>

    <!--==Footer=============================================-->
    <footer>
        <div class="footer-container">
            <!--logo-container------>
            <div class="footer-logo">
                <a href="#"><span>e</span>Grocery</a>
                <!--social----->
                <div class="footer-social">
                    <a href="#"><i class="fab fa-facebook-f"></i></a>
                    <a href="#"><i class="fab fa-twitter"></i></a>
                    <a href="#"><i class="fab fa-instagram"></i></a>
                    <a href="#"><i class="fab fa-youtube"></i></a>
                </div>
            </div>
            <!--links------------------------->
            <div class="footer-links">
                <strong>Product</strong>
                <ul>
                    <li><a href="#">Clothes</a></li>
                    <li><a href="#">Packages</a></li>
                    <li><a href="#">Popular</a></li>
                    <li><a href="#">New</a></li>
                </ul>
            </div>
            <!--links------------------------->
            <div class="footer-links">
                <strong>Category</strong>
                <ul>
                    <li><a href="#">Beauty</a></li>
                    <li><a href="#">Meats</a></li>
                    <li><a href="#">Kids</a></li>
                    <li><a href="#">Clothes</a></li>
                </ul>
            </div>
            <!--links-------------------------->
            <div class="footer-links">
                <strong>Contact Us</strong>
                <ul>
                    <li><a href="#">Phone : +8801518913006</a></li>
                    <li><a href="#">Email : egrocery@gmail.com</a></li>
                </ul>
            </div>
        </div>
    </footer>

    <script>
        // Cart Handler
        const cartHandler = {
            cartItems: [],
            
            // Initialize the cart
            init: function() {
                // Load cart from localStorage if available
                const savedCart = localStorage.getItem('cart');
                if (savedCart) {
                    this.cartItems = JSON.parse(savedCart);
                    this.updateCartCount();
                }
            },
            
            // Show cart modal
            showCartModal: function() {
                document.getElementById('cartModal').classList.add('active');
                document.getElementById('overlay').classList.add('active');
                this.renderCartItems();
            },
            
            // Hide cart modal
            hideCartModal: function() {
                document.getElementById('cartModal').classList.remove('active');
                document.getElementById('overlay').classList.remove('active');
            },
            
            // Add item to cart
            addToCart: function(name, price, image) {
                // Check if item already exists in cart
                const existingItem = this.cartItems.find(item => item.name === name);
                
                if (existingItem) {
                    existingItem.quantity += 1;
                } else {
                    this.cartItems.push({
                        name: name,
                        price: price,
                        image: image,
                        quantity: 1
                    });
                }
                
                // Save to localStorage
                this.saveCart();
                
                // Update cart count
                this.updateCartCount();
                
                // Render cart items (but don't show the modal)
                this.renderCartItems();
                
                // Show notification instead of cart modal
                this.showAddToCartNotification(name);
            },
            
            // Show add to cart notification
            showAddToCartNotification: function(itemName) {
                const notification = document.getElementById('addToCartNotification');
                notification.textContent = `${itemName} added to cart`;
                notification.classList.add('show');
                
                // Hide after 3 seconds
                setTimeout(() => {
                    notification.classList.remove('show');
                }, 3000);
            },
            
            // Remove item from cart
            removeFromCart: function(index) {
                this.cartItems.splice(index, 1);
                this.saveCart();
                this.updateCartCount();
                this.renderCartItems();
            },
            
            // Update quantity of an item
            updateQuantity: function(index, newQuantity) {
                if (newQuantity < 1) {
                    this.removeFromCart(index);
                    return;
                }
                
                this.cartItems[index].quantity = newQuantity;
                this.saveCart();
                this.renderCartItems();
            },
            
            // Save cart to localStorage
            saveCart: function() {
                localStorage.setItem('cart', JSON.stringify(this.cartItems));
            },
            
            // Update cart count in the header
            updateCartCount: function() {
                const totalItems = this.cartItems.reduce((total, item) => total + item.quantity, 0);
                document.querySelector('.cart-count').textContent = totalItems;
            },
            
            // Render cart items in the modal
            renderCartItems: function() {
                const cartItemsContainer = document.getElementById('cartItems');
                const cartTotalElement = document.getElementById('cartTotal');
                
                if (this.cartItems.length === 0) {
                    cartItemsContainer.innerHTML = '<div class="empty-cart-message">Your cart is empty</div>';
                    cartTotalElement.textContent = 'Total: ৳0';
                    return;
                }
                
                let itemsHTML = '';
                let total = 0;
                
                this.cartItems.forEach((item, index) => {
                    const itemTotal = item.price * item.quantity;
                    total += itemTotal;
                    
                    itemsHTML += `
                        <div class="cart-item">
                            <img src="${item.image}" alt="${item.name}" width="50">
                            <div class="cart-item-info">
                                <strong>${item.name}</strong>
                                <div>
                                    <button onclick="cartHandler.updateQuantity(${index}, ${item.quantity - 1})">-</button>
                                    <span>${item.quantity}</span>
                                    <button onclick="cartHandler.updateQuantity(${index}, ${item.quantity + 1})">+</button>
                                </div>
                            </div>
                            <div class="cart-item-price">৳${itemTotal}</div>
                            <button class="remove-item" onclick="cartHandler.removeFromCart(${index})">
                                <i class="fas fa-trash"></i>
                            </button>
                        </div>
                    `;
                });
                
                cartItemsContainer.innerHTML = itemsHTML;
                cartTotalElement.textContent = `Total: ৳${total}`;
            }
        };
        
        // Initialize the cart when page loads
        window.onload = function() {
            cartHandler.init();
        };
        
        // Close cart when clicking on overlay
        document.getElementById('overlay').addEventListener('click', function() {
            cartHandler.hideCartModal();
        });
    </script>
</body>
</html>