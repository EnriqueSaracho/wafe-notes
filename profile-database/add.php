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

<head>
    <title>Enrique Saracho</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>

<body>
    <div class="container col-6 my-5">
        <form method="post">
            <h1>Adding profile for <?= htmlentities($_SESSION['name'])  ?></h1>
            <p class="form-label">First Name: <input type="text" name="first_name" class="form-control"></p>
            <p class="form-label">Last Name: <input type="text" name="last_name" class="form-control"></p>
            <p class="form-label">Email: <input type="text" name="email" class="form-control"></p>
            <p class="form-label">Headline:<br><input type="text" name="headline" class="form-control"></p>
            <p class="form-label">Summary:<br><textarea name="summary" class="form-control"></textarea></p>
            <input type="submit" value="Add" class="btn btn-primary">
            <input type="submit" value="Cancel" name="cancel" class="btn btn-secondary">
        </form>
    </div>
</body>

</html>