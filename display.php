
<?php
session_start();

if (!isset($_SESSION["username"])) {
    header("Location: login.php");
    exit;
}

include "db.php";

$result = mysqli_query($conn, "SELECT * FROM registrations");
?>

<!DOCTYPE html>
<html>
<head>
    <title>PlayHub Pro | Dashboard</title>
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
            max-width: 1000px;
            margin: 50px auto;
            padding: 25px;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 15px;
            flex-wrap: wrap;
            margin-bottom: 30px;
        }

        h1 {
            margin: 0 0 8px;
            font-size: 28px;
        }

        p {
            color: #a0a0a0;
        }

        .card {
            background: #1b1e21;
            padding: 25px;
            border: 1px solid #303438;
            border-radius: 12px;
        }

        a, button {
            display: inline-block;
            padding: 10px 15px;
            border: none;
            border-radius: 6px;
            background: #c7f36b;
            color: #151515;
            text-decoration: none;
            font-weight: bold;
            cursor: pointer;
            font-size: 13px;
        }

        .secondary {
            background: #303438;
            color: #eeeeee;
        }

        .danger {
            background: #dc5555;
            color: white;
        }

        .table-wrap {
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }

        th, td {
            padding: 14px 12px;
            text-align: left;
            border-bottom: 1px solid #303438;
        }

        th {
            color: #c7f36b;
            font-size: 13px;
        }

        td {
            color: #dddddd;
            font-size: 14px;
        }

        .actions {
            display: flex;
            gap: 8px;
            flex-wrap: wrap;
        }

        form {
            display: inline;
        }

        @media (max-width: 600px) {
            .container {
                margin: 20px auto;
                padding: 15px;
            }

            .card {
                padding: 15px;
            }
        }
    </style>
</head>

<body>
<div class="container">

    <div class="header">
        <div>
            <h1>PlayHub Pro</h1>
            <p>Registration Dashboard</p>
        </div>

        <a href="logout.php" class="secondary">Logout</a>
    </div>

    <div class="card">
        <div class="header">
            <div>
                <h2>Registrations</h2>
                <p>Manage registered participants.</p>
            </div>

            <a href="index.html">+ Add Registration</a>
        </div>

        <?php if (isset($_GET["updated"])) { ?>
            <p>Registration updated successfully.</p>
        <?php } ?>

        <?php if (isset($_GET["deleted"])) { ?>
            <p>Registration deleted successfully.</p>
        <?php } ?>

        <div class="table-wrap">
            <table>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Age</th>
                    <th>Sport</th>
                    <th>Actions</th>
                </tr>

                <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                <tr>
                    <td><?php echo $row["id"]; ?></td>
                    <td><?php echo htmlspecialchars($row["name"]); ?></td>
                    <td><?php echo htmlspecialchars($row["email"]); ?></td>
                    <td><?php echo $row["age"]; ?></td>
                    <td><?php echo htmlspecialchars($row["sport"]); ?></td>
                    <td>
                        <div class="actions">
                            <a href="edit.php?id=<?php echo $row['id']; ?>">Edit</a>

                            <form action="delete.php" method="POST"
                                  onsubmit="return confirm('Delete this registration?');">
                                <input type="hidden" name="id"
                                       value="<?php echo $row['id']; ?>">
                                <button type="submit" class="danger">Delete</button>
                            </form>
                        </div>
                    </td>
                </tr>
                <?php } ?>
            </table>
        </div>
    </div>

</div>
</body>
</html>
