<?php
// ডিবাগিং এর জন্য error দেখানো চালু করা
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// সেশন শুরু
session_start();
$error = "";

// ফর্ম সাবমিট হলে
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // ডাটাবেস কানেকশন তথ্য
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "grocery";

    // কানেকশন তৈরি
    $conn = new mysqli($servername, $username, $password, $dbname);

    // কানেকশন চেক
    if ($conn->connect_error) {
        die("❌ Database connection failed: " . $conn->connect_error);
    }

    // ফর্ম ডেটা নেওয়া
    $email = $_POST["email"];
    $pass = $_POST["password"];

    // ইউজার চেক করা
    $sql = "SELECT * FROM admin_login WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $res = $stmt->get_result();

    if ($res->num_rows === 1) {
        $row = $res->fetch_assoc();

        // যদি পাসওয়ার্ড hashed হয়, তাহলে নিচের লাইন ব্যবহার করুন:
        // if (password_verify($pass, $row["password"])) {

        // যদি পাসওয়ার্ড সরাসরি স্টোর করা থাকে:
        if ($pass === $row["password"]) {
            $_SESSION["admin"] = $row["email"];
            header("Location: admin_dashboard.php");
            exit();
        } else {
            $error = "❌ Invalid password.";
        }
    } else {
        $error = "❌ Email not found.";
    }

    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Login - Grocery Store</title>
    <style>
        body {
            background: #f4f6f8;
            font-family: Arial, sans-serif;
        }
        .login-container {
            width: 400px;
            margin: 80px auto;
            background: #ffffff;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }
        h2 {
            text-align: center;
            color: #333;
            margin-bottom: 25px;
        }
        input[type="email"], input[type="password"] {
            width: 100%;
            padding: 12px;
            margin: 12px 0;
            border: 1px solid #ccc;
            border-radius: 8px;
            font-size: 15px;
        }
        input[type="submit"] {
            width: 100%;
            background-color: #28a745;
            color: white;
            font-weight: bold;
            padding: 14px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            margin-top: 10px;
        }
        input[type="submit"]:hover {
            background-color: #218838;
        }
        .error {
            text-align: center;
            color: red;
            margin-top: 15px;
        }
    </style>
</head>
<body>

<div class="login-container">
    <h2>Admin Login</h2>
    <form method="POST" action="" onsubmit="return validateForm();">
        <input type="email" name="email" id="email" placeholder="Enter admin email" required>
        <input type="password" name="password" id="password" placeholder="Enter password" required>
        <input type="submit" value="Login">
    </form>
    <?php if (!empty($error)) echo "<div class='error'>$error</div>"; ?>
</div>

<script>
function validateForm() {
    const email = document.getElementById("email").value.trim();
    const pass = document.getElementById("password").value.trim();
    if (email === "" || pass === "") {
        alert("Please fill in all fields.");
        return false;
    }
    return true;
}
</script>

</body>
</html>
