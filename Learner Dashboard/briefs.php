<?php
session_start();
include('../connection/connection.php');

$CURDATE = date('Y-m-d');

$DATA = $DATABASE->prepare("SELECT idBrief, Title, StartDate, EndDate, attachment FROM briefs WHERE StartDate < :CURDATE OR EndDate < :CURDATE ORDER BY StartDate ASC");
$DATA->bindParam(':CURDATE', $CURDATE);
$DATA->execute();
$result = $DATA->fetchAll(PDO::FETCH_ASSOC);


if (isset($_POST['search'])) {
    $search_input = '%' . $_POST['search_input'] . '%';
    $DATA = $DATABASE->prepare("SELECT idBrief, Title, StartDate, EndDate, attachment FROM briefs WHERE startDate <= :CURDATE AND Title LIKE :search_input ORDER BY StartDate ASC");
    $DATA->bindParam(':search_input', $search_input);
    $DATA->bindParam(':CURDATE', $CURDATE);
    $DATA->execute();
    $result = $DATA->fetchAll(PDO::FETCH_ASSOC);
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./assets/css/briefs.css">
    <title>Document</title>
</head>

<body>
    <div class="container">
        <!-- =============== Navigation ================ -->
        <div class="navigation">
            <ul>
                <li>
                    <a href="#main">
                        <span class="icon">
                            <ion-icon name="code-slash-outline"></ion-icon>
                        </span>
                        <span class="title">BriefSolicode</span>
                    </a>
                </li>

                <li>
                    <a href="index.php">
                        <span class="icon">
                            <ion-icon name="home-outline"></ion-icon>
                        </span>
                        <span class="title">Dashboard</span>
                    </a>
                </li>

                <li>
                    <a href="#main">
                        <span class="icon">
                            <ion-icon name="book-outline"></ion-icon>
                        </span>
                        <span class="title">All Briefs</span>
                    </a>
                </li>

                <li>
                    <a href="../login/">
                        <span class="icon">
                            <ion-icon name="log-out-outline"></ion-icon>
                        </span>
                        <span class="title">Sign Out</span>
                    </a>
                </li>
            </ul>
        </div>

        <!-- ========================= Main ==================== -->
        <div class="main">
            <div class="topbar">
                <div class="toggle">
                    <ion-icon name="menu-outline"></ion-icon>
                </div>

                <div class="search">
                    <label>
                        <form method="post">
                            <input type="text" name="search_input" placeholder="Search here">
                            <button type="submit" name="search"><i class='bx bx-search'></i></button>
                        </form>
                    </label>
                </div>

                <div class="user">
                    <img src="assets/imgs/customer01.jpg" alt="">
                </div>
            </div>
            <div>
                <div class="briefs-container ">
                    <h1>All Briefs</h1>
                    <div class="cards-container">
                        <?php foreach ($result as $row) { ?>
                            <div class="card">
                                <div>
                                    <h3><?= $row['Title'] ?></h3>
                                    <span>Start Date:<?= $row['StartDate'] ?></span><br>
                                    <span>End Date: <?= $row['EndDate'] ?></span><br>
                                    <span><?= $row['attachment'] ?></span><br>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
        <script src="assets/js/main.js"></script>

        <!-- ====== ionicons ======= -->
        <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
        <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>

</html>