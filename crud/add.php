<?php
require_once "pdo.php";
session_start();

if (isset($_POST['name']) && isset($_POST['email']) && isset($_POST['password'])) {
    if (strlen($_POST['name']) < 1 || strlen($_POST['password']) < 1) {
        $_SESSION['error'] = 'Missing data';
        header('Location: add.php');
        return;
    }
    if (!strpos($_POST['email'], '@')) {
        $_SESSION['error'] = 'Bad data';
        header('Location: add.php');
        return;
    }

    $sql = "INSERT INTO users (name, email, password) VALUES (:name, :email, :password)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(array(
        ':name' => $_POST['name'],
        ':email' => $_POST['email'],
        ':password' => $_POST['password']
    ));
    $_SESSION['success'] = 'Record Added';
    header('Location: index.php');
    return;
}
?>
<html>

<head>
    <meta charset="utf-8">
    <title>PHP CRUD Add User</title>
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
        ?>

        <h2>Add A New User</h2>
        <form method="post">
            <label for="name">Name:</label>
            <input type="text" name="name" id="name" class="input" /><br>
            <label for="email">Email:</label>
            <input type="text" name="email" id="email" class="input" /><br>
            <label for="password">Password:</label>
            <input type="password" name="password" id="password" class="input" /><br>
            <div class="container">
                <input type="submit" value="Submit" class="btn-input" />
                <a href="index.php">Cancel</a>
            </div>
        </form>
    </div>
</body>

</html>