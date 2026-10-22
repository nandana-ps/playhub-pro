
<?php
session_start();

if (isset($_SESSION["username"])) {
    header("Location: display.php");
    exit;
}

$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    if ($username == "admin" && $password == "1234") {
        $_SESSION["username"] = $username;
        header("Location: display.php");
        exit;
    } else {
        $error = "Invalid username or password.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Login | PlayHub Pro</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: Arial, sans-serif;
            background: #0b0f19;
            color: #f1f5f9;
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
        }

        .login-card {
            width: 100%;
            max-width: 400px;
            background: #141b2a;
            border: 1px solid #293346;
            border-radius: 18px;
            padding: 36px;
        }

        .logo {
            color: #a3e635;
            font-size: 23px;
            font-weight: bold;
            margin-bottom: 35px;
        }

        h2 {
            font-size: 28px;
            margin-bottom: 10px;
        }

        .subtitle {
            color: #94a3b8;
            font-size: 14px;
            margin-bottom: 28px;
        }

        label {
            display: block;
            margin-bottom: 8px;
            font-size: 13px;
        }

        input {
            width: 100%;
            padding: 13px;
            margin-bottom: 20px;
            background: #0b1220;
            border: 1px solid #354157;
            border-radius: 8px;
            color: white;
        }

        input:focus {
            outline: none;
            border-color: #a3e635;
        }

        button {
            width: 100%;
            padding: 14px;
            background: #a3e635;
            color: #101609;
            font-size: 15px;
            font-weight: bold;
            border: none;
            border-radius: 8px;
            cursor: pointer;
        }

        button:hover {
            background: #bef264;
        }

        .error {
            color: #fca5a5;
            background: #451a1a;
            padding: 12px;
            border-radius: 8px;
            font-size: 13px;
            margin-bottom: 20px;
        }

        .back {
            display: block;
            margin-top: 24px;
            text-align: center;
            color: #a3e635;
            text-decoration: none;
            font-size: 14px;
        }
    </style>
</head>

<body>
    <div class="login-card">
        <div class="logo">PLAYHUB PRO.</div>

        <h2>Welcome back.</h2>
        <p class="subtitle">Sign in to manage sports registrations.</p>

        <?php if ($error != "") { ?>
            <div class="error">
                <?php echo htmlspecialchars($error); ?>
            </div>
        <?php } ?>

        <form method="POST" action="login.php">
            <label for="username">Username</label>
            <input type="text" id="username" name="username"
                   placeholder="Enter username" required>

            <label for="password">Password</label>
            <input type="password" id="password" name="password"
                   placeholder="Enter password" required>

            <button type="submit">Sign In →</button>
        </form>

        <a class="back" href="index.html">← Back to Home</a>
    </div>
</body>
</html>
