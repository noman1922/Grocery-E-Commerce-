<?php
// ডাটাবেজ কানেকশন সেটআপ
$servername = "localhost";  // আপনার হোস্টের নাম
$username = "root";         // আপনার MySQL ইউজারনেম
$password = "";             // আপনার MySQL পাসওয়ার্ড
$dbname = "grocery";        // ডাটাবেজের নাম

// কানেকশন তৈরি করা
$conn = new mysqli($servername, $username, $password, $dbname);

// কানেকশন চেক করা
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// ফর্ম সাবমিট চেক করা
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // ফর্মের ইনপুট নেওয়া
    $full_name = $_POST['full_name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    // পাসওয়ার্ড মেলানো
    if ($password !== $confirm_password) {
        echo "<script>alert('Passwords do not match!');</script>";
        exit();
    }

    // পাসওয়ার্ড হ্যাশিং করা
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // SQL ইনসার্ট কুয়েরি
    $sql = "INSERT INTO signup (Full_Name, Email, Phone_Number, Address, Password) 
            VALUES ('$full_name', '$email', '$phone', '$address', '$hashed_password')";

    // কুয়েরি রান করা
    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('New record created successfully');</script>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // কানেকশন বন্ধ করা
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Madaripur General Store - Sign Up</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f0f0f0;
            margin: 0;
            padding: 0;
        }

        .container {
            width: 40%;
            margin: 50px auto;
            background-color: #fff;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        h2 {
            text-align: center;
            color: #333;
            font-size: 24px;
            margin-bottom: 20px;
        }

        label {
            font-size: 16px;
            color: #555;
            margin-bottom: 8px;
            display: block;
        }

        input[type="text"], input[type="email"], input[type="tel"], input[type="password"], textarea {
            width: 100%;
            padding: 12px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 8px;
            box-sizing: border-box;
            font-size: 14px;
            background-color: #f9f9f9;
        }

        input[type="submit"] {
            background-color: #5cb85c;
            color: white;
            border: none;
            padding: 15px 0;
            font-size: 16px;
            border-radius: 8px;
            cursor: pointer;
            width: 100%;
            transition: background-color 0.3s ease;
        }

        input[type="submit"]:hover {
            background-color: #4cae4c;
        }

        textarea {
            resize: vertical;
            min-height: 120px;
        }

        .footer {
            text-align: center;
            font-size: 14px;
            margin-top: 20px;
        }

        .footer a {
            color: #5cb85c;
            text-decoration: none;
        }
    </style>
</head>
<body>

    <div class="container">
        <h2>Madaripur General Store - Sign Up</h2>
        <form action="singup.php" method="POST">
            <label for="full_name">Full Name:</label>
            <input type="text" id="full_name" name="full_name" required>

            <label for="email">Email Address:</label>
            <input type="email" id="email" name="email" required>

            <label for="phone">Phone Number:</label>
            <input type="tel" id="phone" name="phone" required>

            <label for="address">Address:</label>
            <textarea id="address" name="address" required></textarea>

            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>

            <label for="confirm_password">Confirm Password:</label>
            <input type="password" id="confirm_password" name="confirm_password" required>

            <input type="submit" value="Sign Up">
        </form>
        <div class="footer">
            <p>Already have an account? <a href="#">Login here</a></p>
        </div>
    </div>

</body>
</html>
