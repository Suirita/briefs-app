<?php

//connect to database
$dsn = 'mysql:host=localhost;dbname=briefs_app';
$user = 'root';
$pass = 'fahd26092004';

try {
    $DATABASE = new PDO($dsn, $user, $pass);
    $DATABASE->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $DATA = $DATABASE->prepare("SELECT * FROM trainers");
    $DATA->execute();
    while ($row = $DATA->fetch(PDO::FETCH_ASSOC)) {
        echo $row['FullName'] . '<br>';
    }
} catch (PDOException $e) {
    echo 'failed ' . $e->getMessage();
}