<?php

try {
    $host = '127.0.0.1';
    $db   = 'animals';
    $root = 'animals_user';
    $pass = '123456';
    $charset = 'utf8mb4';

    $dsn = "mysql:host=$host;dbname=$db;charset=$charset";
    $options = [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES   => false,
    ];
    $pdo = new PDO($dsn, $root, $pass, $options);
} catch (PDOException $e) {
    echo 'Connection failed: ' . $e->getMessage();
    exit;
} catch (Exception $e) {
    echo 'An error occurred: ' . $e->getMessage();
    exit;
}
