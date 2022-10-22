<html>
    <head></head>
    <body style="font-family: sans-serif;">
        <h1>Please Log In</h1>
        <?php
            if(isset($_SESSION["error"])) {
                echo('<p style="color: red;">'.$_SESSION["error"]."</p>\n");
                unset($_SESSION["error"]);
            }
            if(isset($_SESSION["success"])) {
                echo('<p style="color: green;">'.$_SESSION["success"]."</p>\n");
                unset($_SESSION["success"]);
            }
        ?>
        <form method="post">
            <p>Account: <input type="text" name="account" value=""/></p>
            <p>Password: <input type="text" name="pw" value=""/></p>
            <!-- password is umsi -->
            <p><input type="submit" value="Log In"/>
            <a href="app.php">Cancel</a></p>
        </form>
    </body>
</html>