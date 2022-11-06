<?php
require_once 'pdo.php';
session_start();
?>
<html>
    <head></head>
    <body>
        <form method="post">
            <p>Are you sure you want to delete profile?</p>
            <input type="submit" value="Delete">
            <input type="submit" value="Cancel" name="cancel">
        </form>
    </body>
</html>