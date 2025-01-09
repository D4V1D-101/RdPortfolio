<?php

define('DB_HOST', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'testport');

try {
    $pdo = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME, DB_USERNAME, DB_PASSWORD);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $rate = trim($_POST['rate']);

    if (!empty($name) && !empty($email) && !empty($rate)) {
        try {
            $stmt = $pdo->prepare("SELECT email FROM usersrate WHERE email = :email LIMIT 1");
            $stmt->execute(['email' => $email]);
            $rnum = $stmt->rowCount();

            if ($rnum == 0) {
                $stmt = $pdo->prepare("INSERT INTO usersrate (name, email, rate) VALUES (:name, :email, :rate)");
                $stmt->execute(['name' => $name, 'email' => $email, 'rate' => $rate]);
                echo "New record inserted successfully.";
            } else {
                echo "Someone is already using this email.";
            }
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    } else {
        echo "All fields are required.";
    }
} else {
    echo "Invalid request method.";
}
?>