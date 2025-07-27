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
        /* Navigation Styles */
        .navigation {
            background-color: #fff;
            padding: 15px 5%;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 2px 15px rgba(0,0,0,0.1);
            position: sticky;
            top: 0;
            z-index: 1000;
        }

        .logo {
            font-size: 28px;
            font-weight: bold;
            color: #333;
            text-decoration: none;
            font-family: 'Poppins', sans-serif;
        }

        .logo span {
            color: #4CAF50;
        }

        .menu {
            display: flex;
            list-style: none;
            margin: 0;
            padding: 0;
            align-items: center;
        }

        .menu li {
            margin-left: 25px;
            position: relative;
        }

        .menu a {
            color: #333;
            text-decoration: none;
            font-weight: 500;
            transition: all 0.3s;
            display: block;
            padding: 8px 0;
            font-size: 16px;
        }

        .menu a:hover, .menu a.active {
            color: #4CAF50;
        }

        .right-nav {
            display: flex;
            align-items: center;
        }

        .right-nav a {
            margin-left: 20px;
            color: #333;
            position: relative;
            display: flex;
            align-items: center;
            transition: all 0.3s;
        }

        .right-nav a:hover {
            color: #4CAF50;
        }

        .right-nav a span {
            position: absolute;
            top: -8px;
            right: -8px;
            background-color: #4CAF50;
            color: white;
            border-radius: 50%;
            width: 18px;
            height: 18px;
            display: flex;
            justify-content: center;
            align-items: center;
            font-size: 10px;
        }

        /* Dropdown Styles */
        .dropdown {
            position: relative;
        }

        .dropdown-content {
            display: none;
            position: absolute;
            right: 0;
            background-color: #fff;
            min-width: 200px;
            box-shadow: 0 8px 16px rgba(0,0,0,0.1);
            z-index: 1;
            border-radius: 8px;
            overflow: hidden;
            border: 1px solid #eee;
        }

        .dropdown-content a {
            color: #555;
            padding: 12px 16px;
            text-decoration: none;
            display: block;
            transition: all 0.3s;
            font-size: 14px;
            border-bottom: 1px solid #f5f5f5;
        }

        .dropdown-content a:last-child {
            border-bottom: none;
        }

        .dropdown-content a:hover {
            background-color: #4CAF50;
            color: white;
            padding-left: 20px;
        }

        .dropdown-content a i {
            margin-right: 10px;
            width: 20px;
            text-align: center;
        }

        .dropdown:hover .dropdown-content {
            display: block;
        }

        .dropbtn {
            background-color: transparent;
            color: #333;
            padding: 10px 15px;
            font-size: 16px;
            border: none;
            cursor: pointer;
            display: flex;
            align-items: center;
            transition: all 0.3s;
            border-radius: 30px;
            border: 1px solid #eee;
        }

        .dropbtn:hover {
            background-color: #f5f5f5;
            color: #4CAF50;
        }

        .dropbtn i {
            margin-right: 8px;
            font-size: 16px;
        }

        /* Mobile Menu Styles */
        .menu-btn {
            display: none;
        }

        .menu-icon {
            display: none;
            cursor: pointer;
            padding: 10px;
        }

        .nav-icon {
            display: block;
            width: 25px;
            height: 2px;
            background-color: #333;
            position: relative;
            transition: all 0.3s;
        }

        .nav-icon::before,
        .nav-icon::after {
            content: '';
            position: absolute;
            width: 100%;
            height: 100%;
            background-color: #333;
            transition: all 0.3s;
        }

        .nav-icon::before {
            top: -8px;
        }

        .nav-icon::after {
            top: 8px;
        }

        @media (max-width: 992px) {
            .menu {
                position: fixed;
                top: 70px;
                left: -100%;
                width: 80%;
                height: calc(100vh - 70px);
                background-color: #fff;
                flex-direction: column;
                align-items: flex-start;
                padding: 20px;
                transition: left 0.3s;
                box-shadow: 2px 0 10px rgba(0,0,0,0.1);
            }

            .menu.active {
                left: 0;
            }

            .menu li {
                margin: 15px 0;
                width: 100%;
            }

            .menu a {
                padding: 12px 0;
                border-bottom: 1px solid #f5f5f5;
                width: 100%;
            }

            .menu-icon {
                display: block;
            }

            .dropdown-content {
                position: static;
                box-shadow: none;
                background-color: transparent;
                display: none;
                width: 100%;
                border: none;
                margin-top: 10px;
            }

            .dropdown:hover .dropdown-content {
                display: none;
            }

            .dropdown.active .dropdown-content {
                display: block;
            }

            .dropbtn {
                width: 100%;
                justify-content: space-between;
                border: none;
                padding: 12px 0;
            }

            .menu-btn:checked ~ .menu {
                left: 0;
            }

            .menu-btn:checked ~ .menu-icon .nav-icon {
                background-color: transparent;
            }

            .menu-btn:checked ~ .menu-icon .nav-icon::before {
                transform: rotate(45deg);
                top: 0;
            }

            .menu-btn:checked ~ .menu-icon .nav-icon::after {
                transform: rotate(-45deg);
                top: 0;
            }
        }
    </style>
</head>
<body>
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
            <li><a href="admin_login.html">Admin Login</a></li>
            <li class="dropdown">
                <button class="dropbtn"><i class="fas fa-user"></i> My Account</button>
                <div class="dropdown-content">
                    <a href="http://localhost/grocery/login.php"><i class="fas fa-sign-in-alt"></i> Login</a>
                    <a href="http://localhost/grocery/singup.php"><i class="fas fa-user-plus"></i> Sign Up</a>
                </div>
            </li>
        </ul>
        <!--right-nav-(cart-like)-->
        <div class="right-nav">
            <!--like----->
            <a href="#" class="like">
                <i class="far fa-heart"></i>
                <span>0</span>
            </a>
            <!--cart----->
            <a href="#" class="cart" onclick="cartHandler.showCartModal(); return false;">
                <i class="fas fa-shopping-cart"></i>
                <span>0</span>
            </a>
        </div>
    </nav>

    <!-- Rest of your content remains exactly the same -->
    <!-- Search Banner -->
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

    <!-- Categories Section -->
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

    <!-- Popular Products Section -->
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
                <!--like-btn------->
                <a href="#" class="like-btn">
                    <i class="far fa-heart"></i>
                </a>
            </div>
        </div>
    </section>

    <!-- Bundle Packs Section -->
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
                <!--like-btn------->
                <a href="#" class="like-btn">
                    <i class="far fa-heart"></i>
                </a>
            </div>
        </div>
    </section>

    <!-- Testimonials Section -->
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

    <!-- Partners Section -->
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

    <!-- App Download Section -->
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

    <!-- Footer -->
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
        // Mobile menu toggle
        document.getElementById('menu-btn').addEventListener('change', function() {
            const menu = document.querySelector('.menu');
            if (this.checked) {
                menu.classList.add('active');
            } else {
                menu.classList.remove('active');
            }
        });

        // Dropdown functionality for mobile
        document.querySelectorAll('.dropdown > .dropbtn').forEach(btn => {
            btn.addEventListener('click', function(e) {
                if (window.innerWidth <= 992) {
                    e.preventDefault();
                    const dropdown = this.parentElement;
                    dropdown.classList.toggle('active');
                }
            });
        });

        // Sample cart handler
        const cartHandler = {
            showCartModal: function() {
                alert("Cart functionality would appear here");
            }
        };

        // Handle login/signup parameters
        if (window.location.pathname.includes('login_signup.html')) {
            const urlParams = new URLSearchParams(window.location.search);
            const action = urlParams.get('action');
            
            if (action === 'login' && document.getElementById('login-tab')) {
                document.getElementById('login-tab').click();
            } else if (action === 'signup' && document.getElementById('signup-tab')) {
                document.getElementById('signup-tab').click();
            }
        }
    </script>
</body>
</html>