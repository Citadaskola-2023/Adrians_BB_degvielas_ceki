<?php

require __DIR__ . '/../src/FuelReceiptDTO.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $receipt = new \App\FuelReceiptDTO(
        licencePlate: $_POST['license_plate'],
        dateTime: $_POST['date_time'],
        odometer: $_POST['odometer'],
        petrolStation: $_POST['petrol_station'],
        fuelType: $_POST['fuel_type'],
        fuelPrice: $_POST['fuel_price'],
        refueled: $_POST['refueled'],
        total: $_POST['total'],
        currency: $_POST['currency'],
    );

    try {
        $pdo = new PDO("mysql:host=mysql;dbname=fuel;charset=utf8mb4", 'root', 'root', [
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        ]);
    } catch (PDOException $e) {
        throw new PDOException($e->getMessage(), (int)$e->getCode());
    }

    $sql = <<<MySQL
        INSERT INTO fuel_receipts (license_plate, date_time, odometer, petrol_station, fuel_type, refueled, total, currency, fuel_price)
        VALUES (:licencePlate, :dateTime, :odometer, :petrolStation, :fuelType, :fuelPrice :refueled, :total, :currency)
        MySQL;


    $stmt = $pdo->prepare($sql);
    $stmt->execute($receipt->toArray());

}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fuel Receipt Form</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f0f0f0;
        }

        h1 {
            background-color: #333;
            color: #fff;
            padding: 1rem;
            margin: 0;
        }

        form {
            width: 30rem;
            margin: 2rem auto;
            padding: 2rem;
            background-color: #fff;
            border: 1px solid #ddd;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: bold;
        }

        input[type="text"],
        input[type="number"],
        input[type="datetime-local"],
        select {
            width: 100%;
            padding: 0.5rem;
            margin-bottom: 1rem;
            border: 1px solid #ddd;
            border-radius: 4px;
            box-sizing: border-box;
        }

        input[type="submit"] {
            width: 100%;
            padding: 0.5rem;
            background-color: #4CAF50;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }
    </style>
</head>

<body>
<h1>Fuel Receipt Form</h1>
<form action="process.php" method="post">
    <label for="license_plate">License Plate:</label>
    <input type="text" name="license_plate" id="license_plate">

    <label for="date_time">Date and Time:</label>
    <input type="datetime-local" name="date_time" id="date_time">

    <label for="petrol_station">Petrol Station:</label>
    <input type="text" name="petrol_station" id="petrol_station">

    <label for="fuel_type">Fuel Type:</label>
    <input type="text" name="fuel_type" id="fuel_type">

    <label for="fuel_price">Fuel Price:</label>
    <input type="number" step="0.01" name="fuel_price" id="fuel_price">

    <label for="refueled">Refueled (liters):</label>
    <input type="number" name="refueled" id="refueled">

    <label for="total">Total (currency):</label>
    <input type="number" name="total" id="total">

    <label for="odometer">Odometer (km):</label>
    <input type="number" name="odometer" id="odometer">

    <label for="currency">Currency:</label>
    <select name="currency" id="currency">
        <option value="USD">US Dollar</option>
        <option value="EUR">Euro</option>
        <option value="GBP">British Pound</option>
        <option value="JPY">Japanese Yen</option>
        <option value="CNY">Chinese Yuan</option>
        <option value="CAD">Canadian Dollar</option>
        <option value="AUD">Australian Dollar</option>
        <option value="CHF">Swiss Franc</option>
        <option value="SEK">Swedish Krona</option>
        <option value="NZD">New Zealand Dollar</option>
        <option value="KRW">South Korean Won</option>
        <option value="INR">Indian Rupee</option>
        <option value="BGN">Bulgarian Lev</option>
        <option value="HRK">Croatian Kuna</option>
        <option value="DKK">Danish Krone</option>
        <option value="HUF">Hungarian Forint</option>
        <option value="PLN">Polish Zloty</option>
        <option value="RON">Romanian Leu</option>
        <option value="RUB">Russian Ruble</option>
        <option value="TRY">Turkish Lira</option>

    </select>


    <input type="submit" value="Submit">
</form>
</body>

</html>