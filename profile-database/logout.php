<?php
session_start();
unset($_SESSION['name']);
unset($_SESSION['user_id']);
$_SESSION['success'] = 'logged out';
header('Location: index.php');
return;