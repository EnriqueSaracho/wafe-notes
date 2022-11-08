<?php
require_once 'pdo.php';

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

<head></head>

<body>
    <h1><?= $headline ?></h1>
    <p>First name: <?= $first_name ?></p>
    <p>Last name: <?= $last_name ?></p>
    <p>Email: <?= $email ?></p>
    <p>Summary: <?= $summary ?></p>
</body>

</html>