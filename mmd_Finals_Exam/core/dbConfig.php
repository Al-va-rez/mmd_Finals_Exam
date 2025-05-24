<?php
    session_start();

    $user = 'root';
    $password = '';

    $host = 'localhost';
    $dbname = 'mmd_Finals_Exam';

    $dsn = "mysql:host={$host};dbname={$dbname}";

    $pdo = new PDO($dsn, $user, $password);
    $pdo->exec("SET time_zone = '+08:00';");
?>