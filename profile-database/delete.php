<?php
require_once 'pdo.php';
session_start();

// profile_id validation
if (!isset($_GET['profile_id'])) {
    $_SESSION['error'] = 'Missing profile_id';
    header('Location: index.php');
    return;
}

// Check if the corresponding user is logged in
$stmt = $pdo->prepare("SELECT profile_id, user_id, first_name FROM profile WHERE profile_id = :xyz");
$stmt->execute(array(':xyz' => $_GET['profile_id']));
$row = $stmt->fetch(PDO::FETCH_ASSOC);
if ($row !== false) {
    if ($row['user_id'] !== $_SESSION['user_id']) {
        $_SESSION['error'] = 'Not logged in';
        header('Location: index.php');
        return;
    }
}

// Cancel button
if (isset($_POST['cancel'])) {
    header('Location: index.php');
    return;
}

if (isset($_POST['delete'])) {
    $sql = "DELETE FROM profile WHERE profile_id = :zip";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(array(':zip' => $_POST['profile_id']));
    $_SESSION['success'] = "Profile deleted";
    header('Location: index.php');
    return;
}

?>
<html>

<head>
    <title>Enrique Saracho</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>

<body>
    <div class="container col-4 my-5">
        <form method="post">
            <p>Are you sure you want to delete <?= $row['first_name'] ?>'s profile</p>
            <input type="hidden" name="profile_id" value="<?= $row['profile_id'] ?>" />
            <input type="submit" value="Delete" name="delete" class="btn btn-danger">
            <input type="submit" value="Cancel" name="cancel" class="btn btn-secondary">
        </form>
    </div>
</body>

</html>