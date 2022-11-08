<?php
require_once 'pdo.php';

// Back button
if (isset($_POST['back'])) {
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
        <h1><?= $headline ?></h1>
        <p>First name: <?= $first_name ?></p>
        <p>Last name: <?= $last_name ?></p>
        <p>Email: <?= $email ?></p>
        <p>Summary: <?= $summary ?></p>
        <form method="post">
            <input type="submit" name="back" value="Back" class="btn btn-secondary">
        </form>
    </div>
</body>

</html>