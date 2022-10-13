<?php
require_once "pdo.php";
// $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); Already in pdo.php

try {
    $stmt = $pdo->prepare("SELECT * FROM users where user_id = :xyz");
    $stmt->execute(array(":pizza" => $_GET['user_id']));
} catch (Exception $ex ) {
    echo("Eception message: ".$ex->getMessage());
    return;
}

$row = $stmt->fetch(PDO::FETCH_ASSOC);
echo "it worked";