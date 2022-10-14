<?php
require_once "pdo.php";

if ( isset($_POST['email']) && isset($_POST['password'])) {
    echo("<p>Handling POST data...</p>\n");

    $sql = "SELECT name FROM users
        WHERE email = :em
        AND password = :pw";
    
    echo("<p>$sql</p>\n");

    $stmt = $pdo->prepare($sql);
    $stmt->execute(array(
        ':em' => $_POST['email'],
        ':pw' => $_POST['password']
    ));
    $row=$stmt->fetch(PDO::FETCH_ASSOC);

    var_dump($row);
    echo "-->\n";
    if ($row === FALSE ) {
        echo "<h1>Login incorrect.</h1>";
    } else {
        echo "<p>Login success.</p>";
    }
}
?>
<p>Please Login</p>
<form method="post">
    <p>Email:
        <input type="text" name="email" size="40"/>
    </p>
    <p>Password:
        <input type="password" name="password" size="40"/>
    </p>
    <p>
        <input type="submit" value="Login"/>
        <a href="<?php echo($_SERVER['PHP_SELF']);?>">Refresh</a>
    </p>
</form>

