<?php

$servername = "localhost";
$dbname = "langdetection";
$username = "root";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Соединение не установлено: " . $e->getMessage();
}