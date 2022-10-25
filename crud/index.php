<?php
    require_once "pdo.php";
    session_start();
?>
<html>
    <head></head>
    <body>
        <?php
            if(isset($_SESSION['error'])) {
                echo('<p style="color: red">'.$_SESSION['error']."</p>\n");
                unset($_SESSION['error']);
            }
            if(isset($_SESSION['success'])) {
                echo('<p style="color: green">'.$_SESSION['green']."</p>\n");
                unset($_SESSION['success']);
            }
            echo('<table border="1">'."\n");
            $stmt = $pdo->query("SELECT name, email, password FROM users");
            while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                echo "<tr><td>";
                echo(htmlentities($row['name']));
                echo "</td><td>";
                echo(htmletities($row['email']));
                echo "</td><td>";
                echo(htmlentities($row['password']));
                echo "</td></td>";
                
            }
        ?>
    </body>
</html>