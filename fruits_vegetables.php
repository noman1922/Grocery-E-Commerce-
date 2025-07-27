<?php
// Enable error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

// DB connection
$host = "localhost";
$user = "root";
$password = "";
$database = "grocery";

$conn = new mysqli($host, $user, $password, $database);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch fruits & vegetables
$sql = "SELECT name, price, details, image FROM fruits_vegetables";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Fruits & Vegetables - Grocery Shop</title>
    <link rel="stylesheet" href="cart-styles.css" />
    <script src="cartHandler.js"></script>
    <style>
        /* CSS code same as your last shared design (copied from above) */
        /* Keep the same CSS you wrote earlier here */
        /* -- START OF CSS -- */
        body, h1, h2, p, a { margin: 0; padding: 0; font-family: "Roboto", sans-serif; }
        body { background-color: #f3f4f6; color: #333; line-height: 1.6; margin: 0; }
        header { background: linear-gradient(135deg, #81c784, #66bb6a); color: white; text-align: center; padding: 2rem 0; margin-bottom: 1.5rem; }
        .header-container h1 { font-size: 3rem; margin-bottom: 0.5rem; }
        .header-container p { font-size: 1.2rem; }
        .intro-section { text-align: center; padding: 1rem 2rem; background-color: #e8f5e9; margin-bottom: 1.5rem; border-radius: 8px; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); }
        .items-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 1.5rem; padding: 0 2rem; }
        .item { background-color: white; border: 1px solid #ddd; border-radius: 10px; text-align: center; padding: 1.5rem; box-shadow: 0 6px 10px rgba(0, 0, 0, 0.1); transition: transform 0.3s ease, box-shadow 0.3s ease; }
        .item:hover { transform: translateY(-5px); box-shadow: 0 8px 15px rgba(0, 0, 0, 0.2); }
        .item img { max-width: 100%; height: auto; border-radius: 10px; margin-bottom: 1rem; }
        .item h2 { font-size: 1.5rem; margin-bottom: 0.5rem; color: #388e3c; }
        .item p { font-size: 1rem; color: #555; margin-bottom: 1rem; }
        .item button { background-color: #388e3c; color: white; border: none; padding: 0.7rem 1.5rem; font-size: 1rem; border-radius: 5px; cursor: pointer; transition: background-color 0.3s ease; }
        .item button:hover { background-color: #2e7d32; }
        footer { background-color: #333; color: white; text-align: center; padding: 1.5rem 0; margin-top: 2rem; }
        .footer-container { max-width: 800px; margin: auto; padding: 0 1rem; }
        .footer-container p { margin-bottom: 0.5rem; }
        .footer-nav a { color: #81c784; text-decoration: none; margin: 0 0.5rem; font-size: 1rem; transition: color 0.3s ease; }
        .footer-nav a:hover { color: #66bb6a; }
        /* -- END OF CSS -- */
    </style>
</head>
<body>
    <header>
        <div class="header-container">
            <h1>Fruits & Vegetables Category</h1>
            <p>Fresh and healthy produce for your daily needs</p>
        </div>
    </header>

    <main>
        <section class="intro-section">
            <p>
                Welcome to the Fruits & Vegetables section of Madaripur General Store!
                Discover our fresh and high-quality produce to keep your meals
                nutritious and delicious. Explore and add to your cart now.
            </p>
        </section>

        <section class="items-grid">
            <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<div class='item'>";
                    echo "<img src='" . htmlspecialchars($row['image']) . "' alt='" . htmlspecialchars($row['name']) . "' />";
                    echo "<h2>" . htmlspecialchars($row['name']) . "</h2>";
                    echo "<p>" . htmlspecialchars($row['details']) . "</p>";
                    echo "<p><strong>Price: " . htmlspecialchars($row['price']) . " BDT</strong></p>";
                    echo "<button onclick=\"cartHandler.addToCart('" . addslashes($row['name']) . "', " . $row['price'] . ")\">Add to Cart</button>";
                    echo "</div>";
                }
            } else {
                echo "<p style='text-align:center;'>No fruits or vegetables available.</p>";
            }
            $conn->close();
            ?>
        </section>
    </main>

    <footer>
        <div class="footer-container">
            <p>&copy; 2024 Madaripur General Store | Freshness delivered to your door</p>
            <nav class="footer-nav">
                <a href="home.html">Home</a> |
                <a href="about.html">About Us</a> |
                <a href="contact.html">Contact</a>
            </nav>
        </div>
    </footer>
</body>
</html>
