<?php
// Enable error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Database connection
$host = "localhost";
$user = "root";
$password = "";
$database = "grocery";

$conn = new mysqli($host, $user, $password, $database);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch all spices
$sql = "SELECT name, price, details, image FROM spices";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Spices - Grocery Shop</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Roboto', sans-serif;
            background: #f5f5f5;
            color: #333;
        }

        header {
            background: linear-gradient(135deg, #ff9800, #ff5722);
            padding: 2rem;
            text-align: center;
            color: white;
            box-shadow: 0 4px 8px rgba(0,0,0,0.2);
        }

        .header-container h1 {
            font-size: 3rem;
            margin-bottom: 0.5rem;
        }

        .header-container p {
            font-size: 1.2rem;
        }

        .intro-section {
            padding: 1rem 2rem;
            background-color: #fff8e1;
            margin: 1rem auto;
            border-radius: 8px;
            max-width: 800px;
            text-align: center;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .spices-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 1.5rem;
            padding: 2rem;
        }

        .spice-item {
            background-color: #ffffff;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
            text-align: center;
            padding: 1.5rem;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .spice-item:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.15);
        }

        .spice-item img {
            width: 100%;
            height: 180px;
            object-fit: cover;
            border-radius: 10px;
            margin-bottom: 1rem;
        }

        .spice-item h2 {
            font-size: 1.5rem;
            color: #ff5722;
            margin-bottom: 0.5rem;
        }

        .spice-item p {
            font-size: 1rem;
            color: #555;
            margin-bottom: 0.5rem;
        }

        .spice-item button {
            padding: 0.7rem 1.5rem;
            background-color: #4caf50;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 1rem;
            transition: background-color 0.3s;
        }

        .spice-item button:hover {
            background-color: #388e3c;
        }

        footer {
            background-color: #333;
            color: white;
            text-align: center;
            padding: 1.5rem 0;
            margin-top: 2rem;
        }

        .footer-nav a {
            color: #ffcc80;
            margin: 0 0.5rem;
            text-decoration: none;
            transition: color 0.3s;
        }

        .footer-nav a:hover {
            color: #ffab40;
        }
    </style>
    <script>
        const cartHandler = {
            addToCart: function (productName, price) {
                alert(`${productName} added to cart (Price: ${price} BDT)`);
                // You can extend this function to actually update a cart
            }
        }
    </script>
</head>
<body>
    <header>
        <div class="header-container">
            <h1>Spices Category</h1>
            <p>Discover the aromatic and flavorful spices of Bangladesh</p>
        </div>
    </header>

    <main>
        <section class="intro-section">
            <p>Welcome to the spices section of Madaripur General Store! Find a variety of authentic Bangladeshi spices to enhance your cooking. Browse and add your favorites to the cart.</p>
        </section>

        <section class="spices-grid">
            <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<div class='spice-item'>";
                    echo "<img src='" . htmlspecialchars($row['image']) . "' alt='" . htmlspecialchars($row['name']) . "' />";
                    echo "<h2>" . htmlspecialchars($row['name']) . "</h2>";
                    echo "<p>" . htmlspecialchars($row['details']) . "</p>";
                    echo "<p><strong>Price: " . htmlspecialchars($row['price']) . " BDT</strong></p>";
                    echo "<button onclick=\"cartHandler.addToCart('" . addslashes($row['name']) . "', " . $row['price'] . ")\">Add to Cart</button>";
                    echo "</div>";
                }
            } else {
                echo "<p style='text-align:center;'>No spices available.</p>";
            }
            $conn->close();
            ?>
        </section>
    </main>

    <footer>
        <div>
            <p>&copy; 2024 Madaripur General Store | Designed with love for Bangladeshi cuisine</p>
            <nav class="footer-nav">
                <a href="home.html">Home</a> |
                <a href="about.html">About Us</a> |
                <a href="contact.html">Contact</a>
            </nav>
        </div>
    </footer>
</body>
</html>
