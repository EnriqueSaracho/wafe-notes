<?php
require_once "pdo.php";
session_start();
if (isset($_POST['delete']) && isset($_POST['user_id'])) {
    $sql = "DELETE FROM users WHERE user_id = :zip";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(array(':zip' => $_POST['user_id']));
    $_SESSION['success'] = "Record deleted";
    header('Location: index.php');
    return;
}

if (!isset($_GET['user_id'])) {
    $_SESSION['error'] = "Missing user_id";
    header('Location: index.php');
    return;
}

$stmt = $pdo->prepare("SELECT name, user_id FROM users WHERE user_id = :xyz");
$stmt->execute(array(':xyz' => $_GET['user_id']));
$row = $stmt->fetch(PDO::FETCH_ASSOC);
if ($row === false) {
    $_SESSION['error'] = 'Bad value for user_id';
    header('Location: index.php');
    return;
}
?>
<html>

<head>
    <meta charset="utf-8">
    <title>PHP CRUD Delete User</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="./styles.css" />
</head>

<body>
    <div class="wrapper">
        <p>Confirm: Deleting <?= htmlentities($row['name']) ?></p>
        <form method="post">
            <input type="hidden" name="user_id" value="<?= $row['user_id'] ?>" />
            <input type="submit" name="delete" value="Delete" class="btn-input" />
            <a href="index.php">Cancel</a>
        </form>
    </div>
</body>

</html>