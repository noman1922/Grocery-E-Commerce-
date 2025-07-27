<?php
// ডাটাবেজ কানেকশন সেটআপ
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "grocery";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// ফর্ম সাবমিট হলে চেক
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    $sql = "SELECT * FROM signup WHERE Email = '$email' LIMIT 1";
    $result = $conn->query($sql);

    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row['Password'])) {
            header("Location: http://localhost/grocery/index.php");
            exit();
        } else {
            echo "<script>alert('❌ Invalid password');</script>";
        }
    } else {
        echo "<script>alert('❌ No user found with this email');</script>";
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login - Grocery Shop</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(to right, #f5f5f5, #dfe9f3);
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .login-container {
            background-color: #fff;
            width: 400px;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 8px 20px rgba(0,0,0,0.1);
        }
        .login-container h2 {
            text-align: center;
            margin-bottom: 25px;
            color: #333;
        }
        label {
            display: block;
            margin-bottom: 6px;
            font-weight: 600;
        }
        input[type="email"],
        input[type="password"] {
            width: 100%;
            padding: 12px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 8px;
            background-color: #f7f7f7;
        }
        input[type="submit"] {
            width: 100%;
            padding: 14px;
            background-color: #28a745;
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            cursor: pointer;
            transition: 0.3s ease;
        }
        input[type="submit"]:hover {
            background-color: #218838;
        }
        .footer {
            text-align: center;
            margin-top: 15px;
            font-size: 14px;
        }
        .footer a {
            color: #28a745;
            text-decoration: none;
            font-weight: bold;
        }
    </style>
</head>
<body>

    <div class="login-container">
        <h2>Login - Grocery Shop</h2>
        <form action="login.php" method="POST" autocomplete="off">
            <label for="email">Email Address:</label>
            <input type="email" id="email" name="email" required autocomplete="off">

            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required autocomplete="off">

            <input type="submit" value="Login">
        </form>
        <div class="footer">
            <p>Don't have an account? <a href="signup.php">Sign up here</a></p>
        </div>
    </div>

</body>
</html>
