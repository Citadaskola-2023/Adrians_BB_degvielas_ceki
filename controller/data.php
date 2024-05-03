<?php

// chheck if session has logged in user

require '../controller/header.php';

$pdo = new PDO("mysql:host=mysql;dbname=myapp;charset=utf8mb4", 'root', 'root', [
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
]);

    // todo: filtering
    $stmt = $pdo->prepare('SELECT * FROM ceks');
    $stmt->execute();
    $results = $stmt->fetchAll();
    // DTO[]

$dto->gmt->setTimezone('Europe/Riga')->format('Y.m.d H:i');
if (!empty($results)) {
    echo '<table>';
    foreach ($results as $row) {
        echo '<tr>';
        foreach ($row as $value) {
            echo '<td>' . htmlspecialchars($value) . '</td>';
        }
        echo '</tr>';
    }
    echo '</table>';
} else {
    echo 'No results found.';
}
?>
<style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f0f0f0;
    }

    table {
        border-collapse: collapse;
        width: 100%;
    }

    th, td {
        border: 1px solid #ddd;
        padding: 8px;
        text-align: left;
    }

    th {
        background-color: #f0f0f0;
    }
</style>
