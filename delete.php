
<?php
session_start();

if (!isset($_SESSION["username"])) {
    header("Location: login.php");
    exit;
}

include "db.php";

if ($_SERVER["REQUEST_METHOD"] != "POST") {
    header("Location: display.php");
    exit;
}

$id = $_POST["id"] ?? "";

if (!is_numeric($id) || (int)$id < 1) {
    header("Location: display.php");
    exit;
}

$id = (int)$id;

$stmt = mysqli_prepare($conn, "DELETE FROM registrations WHERE id = ?");
mysqli_stmt_bind_param($stmt, "i", $id);

if (mysqli_stmt_execute($stmt)) {
    mysqli_stmt_close($stmt);
    header("Location: display.php?deleted=1");
    exit;
}

mysqli_stmt_close($stmt);
$message = "Unable to delete the registration. Please try again.";
?>

<!DOCTYPE html>
<html>
<head>
    <title>PlayHub Pro | Delete</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: #111315;
            color: #eeeeee;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .card {
            width: 100%;
            max-width: 440px;
            background: #1b1e21;
            padding: 35px;
            border: 1px solid #303438;
            border-radius: 12px;
            text-align: center;
        }

        h1 {
            font-size: 25px;
        }

        p {
            color: #b0b0b0;
            line-height: 1.6;
        }

        a {
            display: inline-block;
            margin-top: 15px;
            padding: 12px 16px;
            background: #c7f36b;
            color: #151515;
            text-decoration: none;
            font-weight: bold;
            border-radius: 6px;
            font-size: 14px;
        }
    </style>
</head>

<body>
    <div class="card">
        <h1>PlayHub Pro</h1>
        <p><?php echo htmlspecialchars($message); ?></p>
        <a href="display.php">Back to Dashboard</a>
    </div>
</body>
</html>
