<?php
session_start();
?>

<html>

<head>
    <title>Enrique Saracho</title>
</head>

<body>
    <h1>Enrique Saracho's Resume Registry</h1>
    <?php
    if (isset($_SESSION['success'])) {
        echo ('<p style="color: green">' . $_SESSION['success'] . '</p>');
        unset($_SESSION['success']);
    }
    if (isset($_SESSION['error'])) {
        echo ('<p style="color: red">' . $_SESSION['error'] . '</p>');
        unset($_SESSION['error']);
    }
    ?>
    <a href="login.php">Please log in</a>
    <!-- <table border="1">
            <tr><th>Name</th><th>Headline</th></tr>
        </table> -->
</body>

</html>