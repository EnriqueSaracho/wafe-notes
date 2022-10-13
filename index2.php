<?php
require_once "pdo.php";
$stmt = $pdo->query("SELECT * FROM users");
echo "<pre>\n";
while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    print_r($row);
}
echo "<pre>\n";

if (isset($_POST['name']) && isset($_POST['email']) && isset($_POST['password'])) {
    $stmt = $pdo->prepare("INSERT INTO users (name, email, password) VALUES (:name, :email, :password)");
    $stmt->execute(array(
        ':name' => $_POST['name'],
        ':email' => $_POST['email'],
        'password' => $_POST['password']
    ));
}

if (isset($_POST['user_id'])) {
    $stmt = $pdo->prepare("DELETE FROM users WHERE user_id = :x");
    $stmt->execute(array(':x' => $_POST['user_id']));
}

?>
<html>
    <head></head>
    <body>
        <form method="post">
            <p>New User</p>
            <label for="name">Name</label>
            <input type="text" name="name"/>
            <label for="email">email</label>
            <input type="text" name="email"/>
            <label for="password">Password</label>
            <input type="password" name="password"/>
            <input type="submit"/>
        </form>
        <form method="post">
            <p>Delete user</p>
            <label for="user_id">User id</label>
            <input type="text" name="user_id"/>
            <input type="submit"/>
        </form>
    </body>
</html>