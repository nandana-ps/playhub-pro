

<?php
session_start();

if (!isset($_SESSION["username"])) {
    header("Location: login.php");
    exit;
}

include "db.php";

$result = mysqli_query($conn, "SELECT * FROM registrations");

echo "<h2>Sports Registrations</h2>";
echo "<table border='1' cellpadding='8'>";
echo "<tr><th>ID</th><th>Name</th><th>Email</th><th>Age</th><th>Sport</th><th>Actions</th></tr>";

while ($row = mysqli_fetch_assoc($result)) {
    echo "<tr>";
    echo "<td>" . $row['id'] . "</td>";
    echo "<td>" . htmlspecialchars($row['name']) . "</td>";
    echo "<td>" . htmlspecialchars($row['email']) . "</td>";
    echo "<td>" . $row['age'] . "</td>";
    echo "<td>" . htmlspecialchars($row['sport']) . "</td>";
    echo "<td><a href='edit.php?id=" . $row['id'] . "'>Edit</a> | ";
    echo "<a href='delete.php?id=" . $row['id'] . "'>Delete</a></td>";
    echo "</tr>";
}

echo "</table>";
echo "<br><a href='index.html'>Add Registration</a>";
echo "<br><a href='logout.php'>Logout</a>";
?>
