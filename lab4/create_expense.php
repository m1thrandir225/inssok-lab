<?php
require_once  'db_connect.php';

$instance = Database::getInstance();

$db = $instance->getSQLite();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $amount = $_POST["amount"];
    $date = $_POST["date"];
    $paymentMethod = $_POST["paymentMethod"];

    $db = new SQLite3(__DIR__ . '/database/db.sqlite');

    $query = "INSERT INTO expenses (name, amount, date, paymentMethod) VALUES ('$name', '$amount', '$date', '$paymentMethod')";
    $stmt = $db->prepare($query);
    $stmt->bindValue(':name', $name, SQLITE3_TEXT);
    $stmt->bindValue(':amount', $amount, SQLITE3_INTEGER);
    $stmt->bindValue(':date', $date, SQLITE3_TEXT);
    $stmt->bindValue(':paymentMethod', $paymentMethod, SQLITE3_TEXT);
    $stmt->execute();
    $db->close();

    header("Location: /index.php");
    exit();
} else {
    echo "Something went wrong";
}

