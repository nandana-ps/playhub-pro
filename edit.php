
<?php
session_start();

if (!isset($_SESSION["username"])) {
    header("Location: login.php");
    exit;
}

include "db.php";

if (!isset($_GET["id"]) || !is_numeric($_GET["id"])) {
    header("Location: display.php");
    exit;
}

$id = (int) $_GET["id"];

$stmt = mysqli_prepare($conn, "SELECT * FROM registrations WHERE id = ?");
mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);

$result = mysqli_stmt_get_result($stmt);
$row = mysqli_fetch_assoc($result);

if (!$row) {
    header("Location: display.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>PlayHub Pro | Edit Registration</title>
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
        }

        .container {
            max-width: 500px;
            margin: 60px auto;
            padding: 20px;
        }

        .card {
            background: #1b1e21;
            padding: 30px;
            border: 1px solid #303438;
            border-radius: 12px;
        }

        h1 {
            margin-top: 0;
            font-size: 26px;
        }

        p {
            color: #a0a0a0;
            margin-bottom: 25px;
        }

        label {
            display: block;
            margin: 18px 0 8px;
            font-size: 14px;
        }

        input, select {
            width: 100%;
            padding: 12px;
            background: #111315;
            color: #eeeeee;
            border: 1px solid #393d41;
            border-radius: 6px;
            font-size: 14px;
        }

        input:focus, select:focus {
            outline: none;
            border-color: #c7f36b;
        }

        button, .back {
            display: inline-block;
            padding: 12px 16px;
            border: none;
            border-radius: 6px;
            background: #c7f36b;
            color: #151515;
            font-weight: bold;
            text-decoration: none;
            cursor: pointer;
            font-size: 14px;
        }

        .back {
            background: #303438;
            color: #eeeeee;
        }

        .actions {
            display: flex;
            gap: 10px;
            margin-top: 25px;
        }

        @media (max-width: 550px) {
            .container {
                margin: 25px auto;
            }

            .card {
                padding: 22px;
            }
        }
    </style>
</head>

<body>
<div class="container">
    <div class="card">
        <h1>Edit Registration</h1>
        <p>Update the participant's details below.</p>

        <form action="update.php" method="POST">
            <input type="hidden" name="id"
                   value="<?php echo $row['id']; ?>">

            <label for="name">Full Name</label>
            <input type="text" id="name" name="name"
                   value="<?php echo htmlspecialchars($row['name']); ?>"
                   required>

            <label for="email">Email Address</label>
            <input type="email" id="email" name="email"
                   value="<?php echo htmlspecialchars($row['email']); ?>"
                   required>

            <label for="age">Age</label>
            <input type="number" id="age" name="age"
                   value="<?php echo $row['age']; ?>"
                   min="1" required>

            <label for="sport">Sport</label>
            <select id="sport" name="sport" required>
                <option value="Football"
                    <?php if ($row['sport'] == 'Football') echo 'selected'; ?>>
                    Football
                </option>

                <option value="Cricket"
                    <?php if ($row['sport'] == 'Cricket') echo 'selected'; ?>>
                    Cricket
                </option>

                <option value="Badminton"
                    <?php if ($row['sport'] == 'Badminton') echo 'selected'; ?>>
                    Badminton
                </option>
            </select>

            <div class="actions">
                <button type="submit">Save Changes</button>
                <a href="display.php" class="back">Cancel</a>
            </div>
        </form>
    </div>
</div>
</body>
</html>
