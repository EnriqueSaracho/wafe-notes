<?php
    // Tell PHP we won't be using cookies for the session
    init_set('session.use_cookies', 0);
    init_set('session.use_only-cookies', 0);
    init_set('session.use_trans-sid', 1);
    
    session_start();

// Start the view
?>
<p><b>No Cookies for You!</b></p>
<?php
    if (!isset($_SESSION['value'])) {
        echo("<p>Sessions is empty</p>\n");
        $_SESSION['value'] = 0;
    } else if ($_SESSION['value'] < 3) {
        $_SESSION['value'] = $_SESSION['value'] + 1;
        echo("<p>Added one \$_SESSION['value']=".$_SESSION['value']."</p>\n");
    } else {
        session_destroy();
        session_start();
        echo("<p>Session Restarted</p>\n");
    }
?>
<p><a href="nocookie.php">Click This Anchor Tag!</a></p> 