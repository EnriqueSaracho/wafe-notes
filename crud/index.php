<?php
require_once "pdo.php";
session_start();
?>
<html>

<head>
    <meta charset="utf-8" />
    <title>PHP CRUD App</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="./styles.css" />
</head>

<body>
    <div class="wrapper">
        <?php
        if (isset($_SESSION['error'])) {
            echo ('<p style="color: red">' . $_SESSION['error'] . "</p>\n");
            unset($_SESSION['error']);
        }
        if (isset($_SESSION['success'])) {
            echo ('<p style="color: green">' . $_SESSION['success'] . "</p>\n");
            unset($_SESSION['success']);
        }
        echo ('<table><thead><tr><th>User</th><th>Email Address</th><th>Password</th><th></th></tr></thead><tbody>');
        $stmt = $pdo->query("SELECT name, email, password, user_id FROM users");
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            echo "<tr><td>";
            echo (htmlentities($row['name']));
            echo "</td><td>";
            echo (htmlentities($row['email']));
            echo "</td><td>";
            echo (htmlentities($row['password']));
            echo "</td><td>";
            echo ('<a href="edit.php?user_id=' . $row['user_id'] . '">Edit</a> / ');
            echo ('<a href="delete.php?user_id=' . $row['user_id'] . '">Delete</a>');
            echo ("</td></tr>\n");
        }
        ?>
        </tbody>
        </table>
        <a href="add.php">Add New</a>
    </div>
</body>

</html>