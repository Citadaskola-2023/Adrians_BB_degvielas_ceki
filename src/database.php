<?php


namespace App;

use PDO;
use PDOException;

class database
{
    public function connectdatabase(): PDO
    {
        try {
            $pdo = new PDO('mysql:host=mysql;dbname=myapp;',
                'root',
                'root',
                [PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC]);
            $this->tableCheck($pdo);
            return $pdo;
        } catch (PDOException $e) {
            echo $e->getCode() . " " . $e->getMessage() . '<br>';
            die("kkas nav");
        }
    }

    public function login(string $username, string $password): void
    {
        if ($username === 'kachow' && $password === '1500') {
            // set session with successfully logged-in user
            // promt: show me simple auth methods with bcrypted passwords
            header("Location: /receipt");
            exit;
        } else {
            echo "<h3> WRONG USERNAME OR PASSWORD";
        }
    }

    private function tableCheck(PDO $pdo): void
    {
        $tableCheckSQL = 'SHOW TABLES LIKE "Form"';
        $tableCheckResult = $pdo->query($tableCheckSQL);

        if ($tableCheckResult->rowCount() == 0) {
            $pdo->exec("CREATE TABLE Form (
            id INT AUTO_INCREMENT PRIMARY KEY,
            licence_plate VARCHAR(20) NOT NULL,
            date_time DATETIME NOT NULL,
            petrol_station VARCHAR(100) NOT NULL,
            fuel_type VARCHAR(32) NOT NULL,
            refueled DECIMAL(10,2) NOT NULL,
            currency CHAR(3) NOT NULL,
            fuel_price DECIMAL(10,4) NOT NULL,
            odometer INT NOT NULL,
            total DECIMAL(10,2) NOT NULL
        )");
        }
    }
}
