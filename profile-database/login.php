<?php
require_once "pdo.php";
session_start();

if (isset($_POST['email']) && isset($_POST['password'])) {

    $sql = "SELECT name FROM users WHERE email = :email AND password = :password";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(array(
        ':email' => $_POST['email'],
        ':password' => $_POST['password']
    ));
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($row === false) {
        $_SESSION['error'] = 'Incorrect password or email.';
        header('Location: index.php');
        return;
    } else {
        $_SESSION['email'] = $_POST['email'];
        $_SESSION['success'] = 'Logged in.';
        header("Location: index.php");
        return;
    }
}

?>
<html>

<head>
    <title>Enrique Saracho</title>
</head>

<body>
    <form method="post">
        <h2>Please Log In</h2>
        <p>Email<input type="text" name="email" /></p>
        <p>Password<input type="password" name="password" /></p>
        <input type="submit" value="Log In">
        <input type="button" name="cancel" value="Cancel">
    </form>
</body>

</html>