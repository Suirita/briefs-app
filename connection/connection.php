<?php

//connect to database
$dsn = 'mysql:host=localhost;dbname=briefs-app';
$user = 'root';
$pass = '';

try {
    $DB = new PDO($dsn, $user, $pass);
    $DB->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $DATA = $DB->prepare("SELECT * FROM trainers");
    $DATA->execute();
} catch (PDOException $e) {
    echo 'failed ' . $e->getMessage();
}
