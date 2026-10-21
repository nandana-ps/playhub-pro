
<?php
ession_start();

if (!isset($_SESSION["username"])) {
    header("Location: login.php");
    exit;
include "db.php";

$id = (int) $_GET["id"];

$result = mysqli_query($conn, "SELECT * FROM registrations WHERE id = $id");
$row = mysqli_fetch_assoc($result);

if (!$row) {
    die("Registration not found.");
}
?>

<h2>Edit Registration</h2>

<form action="update.php" method="POST">
    <input type="hidden" name="id" value="<?php echo $row['id']; ?>">

    Name:
    <input type="text" name="name" value="<?php echo htmlspecialchars($row['name']); ?>" required>
    <br><br>

    Email:
    <input type="email" name="email" value="<?php echo htmlspecialchars($row['email']); ?>" required>
    <br><br>

    Age:
    <input type="number" name="age" value="<?php echo $row['age']; ?>" required>
    <br><br>

    Sport:
    <select name="sport" required>
        <option value="Football" <?php if ($row['sport'] == 'Football') echo 'selected'; ?>>Football</option>
        <option value="Cricket" <?php if ($row['sport'] == 'Cricket') echo 'selected'; ?>>Cricket</option>
        <option value="Badminton" <?php if ($row['sport'] == 'Badminton') echo 'selected'; ?>>Badminton</option>
    </select>
    <br><br>

    <input type="submit" value="Update">
</form>
