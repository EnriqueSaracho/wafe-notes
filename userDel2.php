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
    if(isset($_POST['user_id'])) {
        $sql = "DELETE FROM users WHERE user_id = :zip";
        echo("<pre>\n".$sql."</pre>");
        $stmt = $pdo->prepare($sql);
        $stmt->execute(array(
            ':zip'=>$_POST['user_id']
        ));
    }
?>
<html>
    <head></head>
    <body>
        <table border="1">
            <?php
                $stmt = $pdo->query("SELECT name, email, password, user_id FROM users");
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    echo "<tr><td>";
                    echo($row['name']);
                    echo "</td><td>";
                    echo($row['email']);
                    echo "</td><td>";
                    echo($row['password']);
                    echo "</td><td>";
                    echo('<form method="post"><input type="hidden" ');
                    echo('name="user_id" value="'.$row['user_id'].'"/>'."\n");
                    echo('<input type="submit" value="Del" name="delete"/>');
                    echo("\n</form>\n");
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