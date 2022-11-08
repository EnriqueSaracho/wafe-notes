<?php
require_once 'pdo.php';
session_start();

$stmt = $pdo->prepare("SELECT profile_id, user_id FROM profile WHERE profile_id = :xyz");
$stmt->execute(array(':xyz' => $_GET['profile_id']));
$row = $stmt->fetch(PDO::FETCH_ASSOC);
if ($row !== false) {
    if ($row['user_id'] !== $_SESSION['user_id']) {
        $_SESSION['error'] = 'Not logged in';
        header('Location: index.php');
        return;
    }
}

if (isset($_POST['cancel'])) {
    header('Location: index.php');
    return;
}

if (isset($_POST['first_name']) && isset($_POST['last_name']) && isset($_POST['email']) && isset($_POST['headline']) && isset($_POST['summary']) && isset($_POST['profile_id'])) {

    // PHP data validation
    if (strlen($_POST['first_name']) < 1 || strlen($_POST['last_name']) < 1 || strlen($_POST['email']) < 1 || strlen($_POST['headline']) < 1 || strlen($_POST['summary']) < 1) {
        $_SESSION['error'] = 'All fields are required';
        header('Location: edit.php?profile_id=' . $_POST["profile_id"]);
        return;
    }
    if (!strpos($_POST['email'], '@')) {
        $_SESSION['error'] = 'Email address must contain @';
        header('Location: edit.php?profile_id=' . $_POST["profile_id"]);
        return;
    }

    // Update Database Table
    $stmt = $pdo->prepare("UPDATE profile SET first_name = :first_name, last_name = :last_name, email = :email, headline = :headline, summary = :summary WHERE profile_id = :profile_id;");
    $stmt->execute(array(
        ':first_name' => $_POST['first_name'],
        ':last_name' => $_POST['last_name'],
        ':email' => $_POST['email'],
        ':headline' => $_POST['headline'],
        ':summary' => $_POST['summary'],
        ':profile_id' => $_POST['profile_id'],
    ));
    $_SESSION['success'] = 'Profile updated';
    header('Location: index.php');
    return;
}

// user_id validation
if (!isset($_GET['profile_id'])) {
    $_SESSION['error'] = 'Missing profile_id';
    header('Location: index.php');
    return;
}

// SELECT values from database
$stmt = $pdo->prepare("SELECT * FROM profile WHERE profile_id = :x");
$stmt->execute(array(':x' => $_GET['profile_id']));
$row = $stmt->fetch(PDO::FETCH_ASSOC);
if ($row === false) {
    $_SESSION['error'] = 'Bad value for profile_id';
    header('Location: index.php');
    return;
}
$first_name = htmlentities($row['first_name']);
$last_name = htmlentities($row['last_name']);
$email = htmlentities($row['email']);
$headline = htmlentities($row['headline']);
$summary = htmlentities($row['summary']);
$profile_id = $row['profile_id'];

?>
<html>

<head>
    <title>Enrique Saracho</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>

<body>
    <div class="container col-6 my-5">
        <form method="post">
            <h1>Editing profile for <?= htmlentities($_SESSION['name'])  ?></h1>
            <p class="form-label">First Name: <input type="text" name="first_name" value="<?= $first_name ?>" class="form-control"></p>
            <p class="form-label">Last Name: <input type="text" name="last_name" value="<?= $last_name ?>" class="form-control"></p>
            <p class="form-label">Email: <input type="text" name="email" value="<?= $email ?>" class="form-control"></p>
            <p class="form-label">Headline:<br><input type="text" name="headline" value="<?= $headline ?>" class="form-control"></p>
            <p class="form-label">Summary:<br><textarea name="summary" class="form-control"><?= $summary ?></textarea></p>
            <input type="hidden" name="profile_id" value="<?= $profile_id ?>" />
            <input type="submit" value="Update" class="btn btn-primary">
            <input type="submit" value="Cancel" name="cancel" class="btn btn-secondary">
        </form>
    </div>
</body>

</html>