<?php
require_once 'pdo.php';
session_start();

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
$profile_id = htmlentities($row['profile_id']);

?>
<html>

<head></head>

<body>
    <form method="post">
        <h1>Editing profile for <?= htmlentities($_SESSION['name'])  ?></h1>
        <p>First Name: <input type="text" name="first_name" value="<?= $first_name ?>"></p>
        <p>Last Name: <input type="text" name="last_name" value="<?= $last_name ?>"></p>
        <p>Email: <input type="text" name="email" value="<?= $email ?>"></p>
        <p>Headline:<br><input type="text" name="headline" value="<?= $headline ?>"></p>
        <p>Summary:<br><textarea name="summary"><?= $summary ?></textarea></p>
        <input type="hidden" name="profile_id" value="<?= $profile_id ?>" />
        <input type="submit" value="Add">
        <input type="submit" value="Cancel" name="cancel">
    </form>
</body>

</html>