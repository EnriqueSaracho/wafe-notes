<?php
// This is the wrong way to code POST.
// guess2.php is the right way.
    $guess = '';
    $message = false;
    if (isset($_POST['guess'])) {
        // Trick for integer / numeric parameters
        $guess = $_POST['guess'] + 0;
        if($guess == 42) {
            $message = "Great Job!";
        } elseif ($guess < 42) {
            $message = "Too low";
        } else {
            $message = "Too high...";
        }
    }
?>
<html>
    <head>
        <title>A Guessing Game</title>
    </head>
    <body style="font-family: sans-serif;">
        <p>Gessing game...</p>
        <?php
            if ( $message !== false) {
                echo("<p>$message</p>\n");
            }
        ?>
        <form method="post">
            <p><label for="guess">Input Guess</label>
            <input type="text" name="guess" id="guess" size="40" 
            <?php echo 'value="'.htmlentities($guess).'"';?>
            /></p>
            <input type="submit"/>
        </form>
    </body>
</html>