<?php

//connect to database
$dsn = 'mysql:host=localhost;dbname=briefs_app';
$user = 'root';
$pass = 'fahd26092004';

try {
    $DB = new PDO($dsn, $user, $pass);
    $DB->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $DATA = $DB->prepare("SELECT * FROM trainers");
    $DATA->execute();
    while ($row = $DATA->fetch(PDO::FETCH_ASSOC)) {
        echo $row['FullName'] . '<br>';
    }
} catch (PDOException $e) {
    echo 'failed ' . $e->getMessage();
}
