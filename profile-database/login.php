<?php
require_once "pdo.php";
session_start();
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