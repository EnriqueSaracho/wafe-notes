<?php
require_once "pdo.php";
session_start();
?>

<html>

<head>
    <title>Enrique Saracho</title>
</head>

<body>
    <h1>Enrique Saracho's Resume Registry</h1>
    <?php
    if (isset($_SESSION['success'])) {
        echo ('<p style="color: green">' . $_SESSION['success'] . '</p>');
        unset($_SESSION['success']);
    }
    if (isset($_SESSION['error'])) {
        echo ('<p style="color: red">' . $_SESSION['error'] . '</p>');
        unset($_SESSION['error']);
    }

    if (isset($_SESSION['user_id']) && isset($_SESSION['name'])) {
    ?>
        <a href="logout.php">Logout</a><br>
        <a href="add.php">Add new Entry</a>
    <?php
    } else {
    ?>
        <a href="login.php">Please log in</a>
    <?php
    }
    ?>

    <table border="1">
        <!-- <tr>
            <th>Name</th>
            <th>Headline</th>
        </tr> -->
        <?php
        $stmt = $pdo->query("SELECT first_name, last_name, headline, profile_id FROM profile");
        if ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            echo "<tr><th>Name</th><th>Headline</th></tr>";
        }

        $stmt = $pdo->query("SELECT first_name, last_name, headline, profile_id FROM profile");
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            echo "<tr><td>";
            echo (htmlentities($row['first_name']) . ' ' . htmlentities($row['last_name']));
            echo "</td><td>";
            echo (htmlentities($row['headline']));
            echo "</td><td>";
            echo ('<a href="edit.php?profile_id=' . $row['profile_id'] . '">Edit </a>');
            echo ('<a href="delete.php?profile_id=' . $row['profile_id'] . '">Delete</a>');
            echo "</td></tr>";
        }
        ?>
    </table>
</body>

</html>