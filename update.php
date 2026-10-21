
<?php
session_start();

if (!isset($_SESSION["username"])) {
    header("Location: login.php");
    exit;
}
include "db.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = (int) $_POST["id"];
    $name = trim($_POST["name"]);
    $email = trim($_POST["email"]);
    $age = (int) $_POST["age"];
    $sport = $_POST["sport"];

    if ($name == "" || !filter_var($email, FILTER_VALIDATE_EMAIL) || $age < 1 || $age > 100) {
        die("Invalid input.");
    }

    $sql = "UPDATE registrations SET name=?, email=?, age=?, sport=? WHERE id=?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "ssisi", $name, $email, $age, $sport, $id);

    if (mysqli_stmt_execute($stmt)) {
        header("Location: display.php");
        exit;
    } else {
        echo "Update failed.";
    }
} else {
    echo "Invalid request.";
}
?>
