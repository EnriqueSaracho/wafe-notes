<?php
    require_once "pdo.php";
    if (isset($_POST['name']) && isset($_POST['email']) && isset($_POST['password'])) {
        $sql = "INSERT INTO users (name, email, password) VALUES (:a, :b, :c)";
        echo("<pre>\n".$sql."</pre>");
        $stmt = $pdo->prepare($sql);
        $stmt->execute(array(
            ':a' => $_POST['name'],
            ':b' => $_POST['email'],
            ':c' => $_POST['password']
        ));
    }
?>
<html>
    <head></head>
    <body>
        <table border="1">
            <?php
                $stmt = $pdo->query("SELECT name, email, password FROM users");
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    echo "<tr><td>";
                    echo($row['name']);
                    echo "</td><td>";
                    echo($row['email']);
                    echo "</td><td>";
                    echo($row['password']);
                    echo "</td></tr>\n";
                }
            ?>
        </table>
        <p>Add a new User</p>
        <form method="post">
            <p>Name:<input type="text" name="name" size="40"/></p>
            <p>Email:<input type="text" name="email"/></p>
            <p>Password:<input type="password" name="password"/></p>
            <p><input type="submit" value="Add New"/></p>
        </form>
    </body>
</html>