<?php
// DB connection
$host = "localhost";
$user = "root";
$password = "";
$database = "grocery";

$conn = new mysqli($host, $user, $password, $database);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch snacks and drinks
$sql = "SELECT name, price, details, image FROM snacks_drinks";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Snacks & Drinks - Grocery Shop</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet" />
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Roboto', sans-serif;
            background: #f9f9f9;
            color: #333;
        }

        header {
            background-color: #4CAF50;
            color: white;
            padding: 30px 0;
            text-align: center;
        }

        header h1 {
            font-size: 2.5rem;
            margin-bottom: 10px;
        }

        header p {
            font-size: 1.1rem;
        }

        .intro-section {
            padding: 20px;
            background-color: #fff;
            text-align: center;
            font-size: 1.1rem;
        }

        .items-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
            gap: 20px;
            padding: 30px;
        }

        .item {
            background-color: #fff;
            border-radius: 12px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            text-align: center;
            padding: 20px;
            transition: transform 0.3s ease;
        }

        .item:hover {
            transform: translateY(-5px);
        }

        .item img {
            width: 100px;
            height: 100px;
            object-fit: contain;
            margin-bottom: 15px;
        }

        .item h2 {
            font-size: 1.3rem;
            color: #4CAF50;
            margin-bottom: 10px;
        }

        .item p {
            font-size: 0.95rem;
            margin: 5px 0;
        }

        .item button {
            margin-top: 10px;
            background-color: #4CAF50;
            color: white;
            border: none;
            padding: 10px 18px;
            font-size: 0.95rem;
            border-radius: 8px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .item button:hover {
            background-color: #45a049;
        }

        footer {
            background-color: #333;
            color: white;
            padding: 20px;
            text-align: center;
        }

        .footer-nav a {
            color: #ddd;
            margin: 0 10px;
            text-decoration: none;
        }

        .footer-nav a:hover {
            text-decoration: underline;
        }

        @media (max-width: 600px) {
            header h1 {
                font-size: 1.8rem;
            }

            .item img {
                width: 80px;
                height: 80px;
            }
        }
    </style>

    <script>
        const cartHandler = {
            addToCart: function (productName, price) {
                const cartItem = `${productName} - ${price} BDT`;
                alert(`${cartItem} added to cart! ✅`);
            }
        };
    </script>
</head>
<body>
    <header>
        <div class="header-container">
            <h1>Snacks & Drinks</h1>
            <p>Your favorite snacks and beverages in one place</p>
        </div>
    </header>

    <main>
        <section class="intro-section">
            <p>Welcome to the Snacks & Drinks section of Madaripur General Store! Browse and add your favorites to your cart.</p>
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
                echo "<p style='text-align:center;'>No snacks or drinks available.</p>";
            }
            $conn->close();
            ?>
        </section>
    </main>

    <footer>
        <div class="footer-container">
            <p>&copy; 2024 Madaripur General Store | Snacks and smiles for everyone</p>
            <nav class="footer-nav">
                <a href="home.html">Home</a> |
                <a href="about.html">About Us</a> |
                <a href="contact.html">Contact</a>
            </nav>
        </div>
    </footer>
</body>
</html>
