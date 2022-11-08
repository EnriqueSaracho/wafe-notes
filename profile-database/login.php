<?php
require_once "pdo.php";
session_start();

if(isset($_POST['cancel'])) {
    header('Location: index.php');
    return;
}

if (isset($_POST['email']) && isset($_POST['password'])) {

    // PHP data validation
    if (strlen($_POST['email'] < 1) || strlen($_POST['password']) < 1) {
        $_SESSION['error'] = 'Missing data';
        header('Location: index.php');
        return;
    }
    if (!strpos($_POST['email'], '@')) {
        $_SESSION['error'] = 'Bad data';
        header('Location: index.php');
        return;
    }

    $sql = "SELECT user_id, name FROM users WHERE email = :email AND password = :password";
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
        $_SESSION['name'] = $row['name'];
        $_SESSION['user_id'] = $row['user_id'];
        $_SESSION['success'] = 'Logged in.';
        header("Location: index.php");
        return;
    }
}

?>
<html>

<head>
    <script type="text/javascript" src="script.js"></script>
    <title>Enrique Saracho</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>

<body>
    <div class="container col-4 my-5">
        <form method="post">
            <h2>Please Log In</h2>
            <p class="form-label">Email: <input type="text" name="email" id="email" class="form-control"></p>
            <p class="form-label">Password: <input type="password" name="password" id="password" class="form-control"></p>
            <input type="submit" value="Log In" onclick="return doValidate();" class="btn btn-primary">
            <input type="submit" name="cancel" value="Cancel" class="btn btn-secondary">
        </form>
    </div>
</body>

</html>