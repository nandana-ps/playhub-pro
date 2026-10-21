<?php
include "db.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $email = $_POST["email"];
    $age = $_POST["age"];
    $sport = $_POST["sport"];

    $sql = "INSERT INTO registrations (name, email, age, sport)
            VALUES (?, ?, ?, ?)";

    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "ssis", $name, $email, $age, $sport);

    if (mysqli_stmt_execute($stmt)) {
        echo "Registration successful!";
        echo "<br><a href='index.html'>Register another</a>";
        echo "<br><a href='display.php'>View registrations</a>";
    } else {
        echo "Error inserting record.";
    }
} else {
    echo "Please submit the form first.";
}
?>