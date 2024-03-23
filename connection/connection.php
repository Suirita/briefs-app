<?php

//connect to database
$dsn = 'mysql:host=localhost;dbname=briefs-app';
$user = 'root';
$pass = '';

try {
    $DATABASE = new PDO($dsn, $user, $pass);
    $DATABASE->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $DATA = $DATABASE->prepare("SELECT * FROM trainers");
    $DATA->execute();
} catch (PDOException $e) {
    echo 'failed ' . $e->getMessage();
}