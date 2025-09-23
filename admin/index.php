<?php
session_start();
include 'includes/db.php';

// Handle login form submit
if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Example credentials
    if ($username === "admin" && $password === "1234") {
        $_SESSION['admin'] = $username;
        header("Location: dashboard"); // Redirect to folder (index.php inside will load)
        exit();
    } else {
        $error = "Invalid username or password!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Login</title>
    <style>
        /* Reset & Body */
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #f4f7fb;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        /* Login card */
        .login-container {
            background: #ffffff;
            padding: 50px 40px;
            border-radius: 15px;
            width: 380px;
            box-shadow: 0 15px 40px rgba(0,0,0,0.2);
            position: relative;
            animation: fadeInUp 1s ease;
        }

        /* Heading */
        .login-container h2 {
            text-align: center;
            color: #2a3f54;
            font-size: 28px;
            margin-bottom: 35px;
            font-weight: 700;
        }

        /* Floating label inputs */
        .form-group {
            position: relative;
            margin-bottom: 25px;
        }

        .form-group input {
            width: 100%;
            padding: 14px 12px;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 8px;
            background: none;
            outline: none;
            transition: 0.3s;
        }

        .form-group label {
            position: absolute;
            left: 12px;
            top: 14px;
            color: #aaa;
            font-size: 16px;
            pointer-events: none;
            transition: 0.3s;
            background: #fff;
            padding: 0 5px;
        }

        .form-group input:focus + label,
        .form-group input:not(:placeholder-shown) + label {
            top: -10px;
            left: 8px;
            font-size: 13px;
            color: #2a5298;
        }

        .form-group input:focus {
            border-color: #2a5298;
            box-shadow: 0 0 5px rgba(42,82,152,0.3);
        }

        /* Error message */
        .error-message {
            color: #e74c3c;
            font-size: 14px;
            text-align: center;
            margin-bottom: 15px;
        }

        /* Button */
        .login-container button {
            width: 100%;
            padding: 14px;
            font-size: 16px;
            font-weight: 600;
            color: #fff;
            background: #2a5298;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .login-container button:hover {
            background: #1e3c72;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0,0,0,0.2);
        }

        /* Fade-in-up animation */
        @keyframes fadeInUp {
            0% { opacity: 0; transform: translateY(30px); }
            100% { opacity: 1; transform: translateY(0); }
        }

        /* Optional: responsive */
        @media (max-width: 420px) {
            .login-container { width: 90%; padding: 40px 20px; }
        }
    </style>
</head>
<body>
    <div class="login-container">
        <h2>Admin Panel Login</h2>
        <?php if (isset($error)) echo "<p class='error-message'>$error</p>"; ?>
        <form method="post">
            <div class="form-group">
                <input type="text" name="username" placeholder=" " required>
                <label>Username</label>
            </div>
            <div class="form-group">
                <input type="password" name="password" placeholder=" " required>
                <label>Password</label>
            </div>
            <button type="submit" name="login">Login</button>
        </form>
    </div>
</body>
</html>
