<?php
session_start();
require_once '../connection/connection.php';

if (isset($_GET['brief_id'])) {
    $briefId = $_GET['brief_id'];

    $query = "SELECT attachment, Title FROM briefs WHERE IdBrief = :briefId";
    $stmt = $DATABASE->prepare($query);
    $stmt->bindParam(':briefId', $briefId);
    $stmt->execute();

    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($row) {
        header("Content-Type: application/octet-stream");
        header("Content-Disposition: attachment; filename=" . $row['Title'] . ".pdf"); 

        echo $row['attachment'];
        exit;
    } else {
        echo "Brief not found in the database.";
    }
} else {
    echo "Brief ID parameter not provided.";
}