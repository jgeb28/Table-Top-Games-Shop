<?php
$host = 'table-top-games-shop-db-1';
$dbname = 'ttg_store_database';
$dbusername = 'root';
$bpassword = 'root';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $dbusername, $bpassword);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Connection Failed: " . $e->getMessage());
}
