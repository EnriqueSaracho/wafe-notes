<?php
require_once 'pdo.php';
session_start();
?>
<html>

<head></head>

<body>
    <form method="post">
        <h1>Editing profile for <?= htmlentities($_SESSION['name'])  ?></h1>
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