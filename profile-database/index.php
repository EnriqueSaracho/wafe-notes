<?php
require_once "pdo.php";
session_start();
?>

<html>

<head>
    <title>Enrique Saracho</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>

<body>
    <div class="container col-8 mt-5">
        <h1 class="my-3">Enrique Saracho's Resume Registry</h1>
        <?php
        if (isset($_SESSION['success'])) {
            echo ('<p style="color: green" class="alert alert-success">' . $_SESSION['success'] . '</p>');
            unset($_SESSION['success']);
        }
        if (isset($_SESSION['error'])) {
            echo ('<p style="color: red" class="alert alert-danger">' . $_SESSION['error'] . '</p>');
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
    
        <table class="table mt-3">
            <?php
            $stmt = $pdo->query("SELECT first_name, last_name, headline, profile_id FROM profile");
            if ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                echo '<tr><th>Name</th><th>Headline</th><th>Action</th></tr>';
            }
    
            $stmt = $pdo->query("SELECT first_name, last_name, headline, profile_id FROM profile");
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                echo "<tr><td>";
                echo (htmlentities($row['first_name']) . ' ' . htmlentities($row['last_name']));
                echo "</td><td>";
                echo ('<a href="view.php?profile_id='.$row['profile_id'].'">'.htmlentities($row['headline']).'</a>');
                echo "</td><td>";
                echo ('<a href="edit.php?profile_id=' . $row['profile_id'] . '">Edit </a>');
                echo ('<a href="delete.php?profile_id=' . $row['profile_id'] . '">Delete</a>');
                echo "</td></tr>";
            }
            ?>
        </table>
    </div>
</body>

</html>