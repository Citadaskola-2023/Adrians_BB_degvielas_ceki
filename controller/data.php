<?php

// chheck if session has logged in user

require '../controller/header.php';

$pdo = new PDO("mysql:host=mysql;dbname=myapp;charset=utf8mb4", 'root', 'root', [
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
]);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
$filters = array_filter($_POST);

$params = [];
$sql[] = <<<MySQL
        SELECT * FROM Form
        WHERE 1 = 1
    MySQL;

if (isset($filters['idInputMin'])) {
    $sql[] = <<<MySQL
            AND id >= :id_min
    MySQL;
    $params['id_min'] = $filters['idInputMin'];
}
if (isset($filters['idInputMax'])) {
    $sql[] = <<<MySQL
            AND id <= :id_max
    MySQL;
    $params['id_max'] = $filters['idInputMax'];
}
if (isset($filters['licencePlateInput'])) {
    $sql[] = <<<MySQL
            AND licence_plate = :licence_plate
    MySQL;
    $params['licence_plate'] = $filters['licencePlateInput'];
}
if (isset($filters['dateTimeInputMin'])) {
    $sql[] = <<<MySQL
            AND date_time >= :dateTime_min
    MySQL;
    $params['dateTime_min'] = $filters['dateTimeInputMin'];
}
if (isset($filters['dateTimeInputMax'])) {
    $sql[] = <<<MySQL
            AND date_time <= :dateTime_max
    MySQL;
    $params['dateTime_max'] = $filters['dateTimeInputMax'];
}
if (isset($filters['petrolStationInput'])) {
    $sql[] = <<<MySQL
            AND petrol_station = :petrol_station
    MySQL;
    $params['petrol_station'] = $filters['petrolStationInput'];
}
if (isset($filters['fuelTypeInput'])) {
    $sql[] = <<<MySQL
            AND fuel_type = :fuel_type
    MySQL;
    $params['fuel_type'] = $filters['fuelTypeInput'];
}
if (isset($filters['refueledInputMin'])) {
    $sql[] = <<<MySQL
            AND refueled >= :refueled_min
    MySQL;
    $params['refueled_min'] = $filters['refueledInputMin'];
}
if (isset($filters['refueledInputMax'])) {
    $sql[] = <<<MySQL
            AND refueled <= :refueled_max
    MySQL;
    $params['refueled_max'] = $filters['refueledInputMax'];
}
if (isset($filters['currencyInput'])) {
    $sql[] = <<<MySQL
            AND currency = :currency
    MySQL;
    $params['currency'] = $filters['currencyInput'];
}
if (isset($filters['fuelPriceInputMin'])) {
    $sql[] = <<<MySQL
            AND fuel_price >= :fuel_price_min
    MySQL;
    $params['fuel_price_min'] = $filters['fuelPriceInputMin'];
}
if (isset($filters['fuelPriceInputMax'])) {
    $sql[] = <<<MySQL
            AND fuel_price <= :fuel_price_max
    MySQL;
    $params['fuel_price_max'] = $filters['fuelPriceInputMax'];
}
if (isset($filters['odometerInputMin'])) {
    $sql[] = <<<MySQL
            AND odometer >= :odometer_min
    MySQL;
    $params['odometer_min'] = $filters['odometerInputMin'];
}
if (isset($filters['odometerInputMax'])) {
    $sql[] = <<<MySQL
            AND odometer <= :odometer_max
    MySQL;
    $params['odometer_max'] = $filters['odometerInputMax'];
}
if (isset($filters['totalInputMin'])) {
    $sql[] = <<<MySQL
            AND total >= :total_min
    MySQL;
    $params['total_min'] = $filters['totalInputMin'];
}
if (isset($filters['totalInputMax'])) {
    $sql[] = <<<MySQL
            AND total <= :total_max
    MySQL;
    $params['total_max'] = $filters['totalInputMax'];
}
    $stmt = $pdo->prepare('SELECT * FROM Form');
    $stmt->execute();
    $results = $stmt->fetchAll();
    // DTO[]

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
}}
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

<form method="POST" action="/filter">
    <table>
        <tbody>
        <tr>
            <th>
                ID<br>
                <input type="number" step="0.01" id="idInputMin" name="idInputMin"><br>
                <input type="number" step="0.01" id="idInputMax" name="idInputMax">
            </th>
            <th>
                Licence Plate<br>
                <input type="text" id="licencePlateInput" name="licencePlateInput">
            </th>
            <th>
                Date and Time<br>
                <input type="date" id="dateTimeInputMin" name="dateTimeInputMin"><br>
                <input type="date" id="dateTimeInputMax" name="dateTimeInputMax">
            </th>
            <th>
                Petrol Station<br>
                <input type="text" id="petrolStationInput" name="petrolStationInput">
            </th>
            <th>
                Fuel Type<br>
                <input type="text" id="fuelTypeInput" name="fuelTypeInput">
            </th>
            <th>
                Refueled<br>
                <input type="number" step="0.01" id="refueledInputMin" name="refueledInputMin"><br>
                <input type="number" step="0.01" id="refueledInputMax" name="refueledInputMax">
            </th>
            <th>
                Currency<br>
                <input type="text" id="currencyInput" name="currencyInput">
            </th>
            <th>
                Fuel Price<br>
                <input type="number" step="0.01" id="fuelPriceInputMin" name="fuelPriceInputMin"><br>
                <input type="number" step="0.01" id="fuelPriceInputMax" name="fuelPriceInputMax">
            </th>
            <th>
                Odometer<br>
                <input type="number" id="odometerInputMin" name="odometerInputMin"><br>
                <input type="number" id="odometerInputMax" name="odometerInputMax">
            </th>
            <th>
                Total<br>
                <input type="number" step="0.01" id="totalInputMin" name="totalInputMin"><br>
                <input type="number" step="0.01" id="totalInputMax" name="totalInputMax">
            </th>
        </tr>
        </tbody>
    </table>
    <input type="submit" value="Submit">
</form>