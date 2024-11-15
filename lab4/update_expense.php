<?php
require_once  'db_connect.php';

$instance = Database::getInstance();

$db = $instance->getSQLite();

if ($_SERVER["REQUEST_METHOD"] === "POST"  && isset($_POST["id"])) {
    $id = intval($_POST["id"]);
    $name = $_POST["name"];
    $amount = $_POST["amount"];
    $date = $_POST["date"];
    $paymentMethod = $_POST["paymentMethod"];

    $query = "UPDATE 'expenses' SET name = :name, amount = :amount, date = :date, paymentMethod = :paymentMethod WHERE id = :id";
    $stmt = $db->prepare($query);
    $stmt->bindValue(':id', $id, SQLITE3_INTEGER);
    $stmt->bindValue(':name', $name, SQLITE3_TEXT);
    $stmt->bindValue(':amount', $amount, SQLITE3_INTEGER);
    $stmt->bindValue(':date', $date, SQLITE3_TEXT);
    $stmt->bindValue(':paymentMethod', $paymentMethod, SQLITE3_TEXT);
    $stmt->execute();
    $db->close();

    header("Location: /index.php");
    exit();
} else {
    echo "Error message :)";
}

