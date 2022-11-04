<?php
require_once 'pdo.php';
session_start();

if(isset($_POST['cancel'])) {
    header('Location: index.php');
    return;
}

if (isset($_POST['first_name']) && isset($_POST['last_name']) && isset($_POST['email']) && isset($_POST['headline']) && isset($_POST['summary'])) {

    // PHP data validation
    if (strlen($_POST['first_name']) < 1 || strlen($_POST['last_name']) < 1 || strlen($_POST['email']) < 1 || strlen($_POST['headline']) < 1 || strlen($_POST['summary']) < 1) {
        $_SESSION['error'] = 'All fields are required';
        header('Location: add.php');
        return;
    }
    if (!strpos($_POST['email'], '@')) {
        $_SESSION['error'] = 'Email address must contain @';
        header('Location: add.php');
        return;
    }

    // Inserting POST data to database
    $stmt = $pdo->prepare("INSERT INTO profile (user_id, first_name, last_name, email, headline, summary) VALUES (:user_id, :first_name, :last_name, :email, :headline, :summary)");
    $stmt->execute(array(
        ':user_id' => $_SESSION['user_id'],
        ':first_name' => $_POST['first_name'],
        ':last_name' => $_POST['last_name'],
        ':email' => $_POST['email'],
        ':headline' => $_POST['headline'],
        ':summary' => $_POST['summary']
    ));
    $_SESSION['success'] = 'Profile added';
    header(('Location: index.php'));
    return;
}
?>
<html>

<head></head>

<body>
    <form method="post">
        <h1>Adding profile for <?= htmlentities($_SESSION['name'])  ?></h1>
        <p>First Name: <input type="text" name="first_name"></p>
        <p>Last Name: <input type="text" name="last_name"></p>
        <p>Email: <input type="text" name="email"></p>
        <p>Headline:<br><input type="text" name="headline"></p>
        <p>Summary:<br><textarea name="summary"></textarea></p>
        <input type="submit" value="Add">
        <input type="submit" value="Cancel" name="cancel">
    </form>
</body>

</html>