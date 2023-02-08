<?php
require_once "pdo.php";
session_start();

if (isset($_POST['name']) && isset($_POST['email']) && isset($_POST['password']) && isset($_POST['user_id'])) {

    // Data validation
    if (strlen($_POST['name']) < 1 || strlen($_POST['password']) < 1) {
        $_SESSION['error'] = 'Missing data';
        header('Location: edit.php?user_id=' . $_POST['user_id']);
        return;
    }

    if (strpos($_POST['email'], '@') === false) {
        $_SESSION['error'] = 'Bad data';
        header('Location: edit.php?user_id=' . $_POST['user_id']);
        return;
    }

    // Update Database Table
    $sql = "UPDATE users SET name = :name, email = :email, password = :password WHERE user_id = :user_id;";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(array(
        ':name' => $_POST['name'],
        ':email' => $_POST['email'],
        ':password' => $_POST['password'],
        ':user_id' => $_POST['user_id']
    ));
    $_SESSION['success'] = 'Record updated';
    header('Location: index.php');
    return;
}

// user_id validation
if (!isset($_GET['user_id'])) {
    $_SESSION['error'] = 'Missing user_id';
    header('Location: index.php');
    return;
}

// Bring data from Database Table using $_GET['user_id']
$stmt = $pdo->prepare("SELECT * FROM users WHERE user_id = :xyz");
$stmt->execute(array(':xyz' => $_GET['user_id']));
$row = $stmt->fetch(PDO::FETCH_ASSOC);
if ($row === false) {
    $_SESSION['error'] = 'Bad value for user_id';
    header('Location: index.php');
    return;
}

// Flash pattern
if (isset($_SESSION['error'])) {
    echo ('<p style="color: red;">' . $_SESSION['error'] . '</p>' . "\n");
    unset($_SESSION['error']);
}

$n = htmlentities($row['name']);
$e = htmlentities($row['email']);
$p = htmlentities($row['password']);
$user_id = $row['user_id'];
?>
<html>

<head>
    <meta charset="utf-8">
    <title>PHP CRUD Edit User</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="./styles.css" />
</head>

<body>
    <div class="wrapper">
        <h2>Edit User</h2>
        <form method="post">
            <label for="name">Name:</label>
            <input type="text" name="name" value="<?= $n ?>" id="name" class="input" /><br>
            <label for="email">Email:</label>
            <input type="text" name="email" value="<?= $e ?>" id="email" class="input" /><br>
            <label for="password">Password:</label>
            <input type="password" name="password" value="<?= $p ?>" id="password" class="input" /><br>
            <input type="hidden" name="user_id" value="<?= $user_id ?>" />
            <div class="container">
                <input type="submit" value="Update" class="btn-input" />
                <a href="index.php">Cancel</a>
            </div>
        </form>
    </div>
</body>

</html>