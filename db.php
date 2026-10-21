<?php
$conn = mysqli_connect("localhost", "root", "", "playhub");

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>