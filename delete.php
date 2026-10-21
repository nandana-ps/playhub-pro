
<?php
session_start();

if (!isset($_SESSION["username"])) {
    header("Location: login.php");
    exit;
}
include "db.php";

if (isset($_GET["id"])) {
    $id = (int) $_GET["id"];

    $sql = "DELETE FROM registrations WHERE id = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "i", $id);

    if (mysqli_stmt_execute($stmt)) {
        header("Location: display.php");
        exit;
    } else {
        echo "Delete failed.";
    }
} else {
    echo "Registration ID missing.";
}
?>
