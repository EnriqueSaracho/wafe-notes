<?php
    require_once "pdo.php";
    session_start();

    if(isset($_POST['name']) && isset($_POST['email']) && isset($_POST['password'])) {
        if(strlen($_POST['name']) < 1 || strlen($_POST['password']) < 1) {
            $_SESSION['error'] = 'Missing data';
            header('Location: add.php');
            return;
        }
        if(!strpos($_POST['email'],'@')) {
            $_SESSION['error'] = 'Bad data';
            header('Location: add.php');
            return;
        }

        $sql = "INSERT INTO users (name, email, password) VALUES (:name, :email, :password)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(array(
            ':name' => $_POST['name'],
            ':email' => $_POST['email'],
            ':password' => $_POST['password']
        ));
        $_SESSION['success'] = 'Record Added';
        header('Location: index.php');
        return;
    }
?>
<hmtl>
    <head></head>
    <body>
        <?php
            if(isset($_SESSION['error'])) {
                echo('<p style="color: red">'.$_SESSION['error']."</p>\n");
                unset($_SESSION['error']);
            }
        ?>

        <p>Add A New User</p>
        <form method="post">
            <p>Name: <input type="text" name="name"/></p>
            <p>Email: <input type="text" name="email"/></p>
            <p>Password: <input type="password" name="password"/></p>
            <input type="submit" value="Submit"/>
            <a href="index.php">Cancel</a>
        </form>
    </body>
</html>