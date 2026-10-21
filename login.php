
<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    if ($username == "admin" && $password == "1234") {
        $_SESSION["username"] = $username;
        header("Location: display.php");
        exit;
    } else {
        echo "Invalid username or password.";
    }
}
?>

<h2>Login</h2>

<form method="POST" action="login.php">
    Username:
    <input type="text" name="username" required>
    <br><br>

    Password:
    <input type="password" name="password" required>
    <br><br>

    <input type="submit" value="Login">
</form>
