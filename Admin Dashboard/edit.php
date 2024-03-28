<?php
session_start();
include('../connection/connection.php');

$DATA = "SELECT FullName FROM trainers where IdTrainer = :IdTrainer";
$DATA = $DATABASE->prepare($DATA);
$DATA->bindParam(':IdTrainer', $_SESSION['IdTrainer']);
$DATA->execute();
$result = $DATA->fetch(PDO::FETCH_ASSOC);
$FullName = $result['FullName'];

if (isset($_POST['trash'])) {
    $idBrief = $_POST['idBrief'];

    $DATA = $DATABASE->prepare("DELETE FROM brief_skills WHERE idBrief = :idBrief");
    $DATA->bindParam(':idBrief', $idBrief);
    $DATA->execute();

    $DATA = $DATABASE->prepare("DELETE FROM briefs WHERE idBrief = :idBrief");
    $DATA->bindParam(':idBrief', $idBrief);
    $DATA->execute();
}

$CURDATE = date('Y-m-d');

$DATA = $DATABASE->prepare("SELECT idBrief, Title,StartDate, EndDate, attachment FROM briefs where startDate >= :CURDATE ORDER BY StartDate ASC");
$DATA->bindParam(':CURDATE', $CURDATE);
$DATA->execute();
$result = $DATA->fetchAll(PDO::FETCH_ASSOC);

if (isset($_POST['search'])) {
    $search_input = '%' . $_POST['search_input'] . '%';
    $DATA = $DATABASE->prepare("SELECT idBrief, Title, StartDate, EndDate, attachment FROM briefs WHERE startDate >= :CURDATE AND Title LIKE :search_input ORDER BY StartDate ASC");
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
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BriefSolicode | Admin Dashboard</title>
    <!-- ======= Styles ====== -->
    <link rel="stylesheet" href="assets/css/edit.css">
</head>

<body>
    <!-- =============== Navigation ================ -->
    <div class="container">
        <nav class="navigation">
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
                    <a href="././index.php">
                        <span class="icon">
                            <ion-icon name="home-outline"></ion-icon>
                        </span>
                        <span class="title">Dashboard</span>
                    </a>
                </li>

                <li>
                    <a href="./add.php">
                        <span class="icon">
                            <ion-icon name="add-circle-outline"></ion-icon>
                        </span>
                        <span class="title">Add</span>
                    </a>
                </li>

                <li>
                    <a href="#main">
                        <span class="icon">
                            <ion-icon name="create-outline"></ion-icon>
                        </span>
                        <span class="title">Edit</span>
                    </a>
                </li>

                <li>
                    <a href="../login/index.php">
                        <span class="icon">
                            <ion-icon name="log-out-outline"></ion-icon>
                        </span>
                        <span class="title">Sign Out</span>
                    </a>
                </li>
            </ul>
        </nav>

        <!-- ========================= Main ==================== -->
        <main class="main" id="main">
            <section class="topbar">
                <div class="toggle">
                    <ion-icon name="menu-outline"></ion-icon>
                </div>

                <div class="search">
                    <label>
                        <form method="post">
                            <input type="text" name="search_input" placeholder="Search here">
                            <button type="submit" name="search"><ion-icon name="search-outline"></ion-icon></button>
                        </form>
                    </label>
                </div>

                <div class="user">
                    <?= $FullName ?>
                </div>
            </section>
            <section>
                <div class="briefs-container ">
                    <h1>Upcoming Briefs</h1>
                    <div class="cards-container">
                        <?php foreach ($result as $row) { ?>
                            <div class="card">
                                <h3><?= $row['Title'] ?></h3>
                                <span>Start Date:<?= $row['StartDate'] ?></span><br>
                                <span>End Date: <?= $row['EndDate'] ?></span><br>
                                <span><?= $row['attachment'] ?></span><br>
                                <form action="edit-card.php" method="post">
                                    <input type="text" name="idBrief" value="<?= $row['idBrief'] ?>" hidden>
                                    <button type="submit" name="edit" class="edit-icon-button"><ion-icon class="edit-icon" name="create-outline"></ion-icon></button>
                                </form>
                                </form>
                                <form method="post">
                                    <input type="text" name="idBrief" value="<?= $row['idBrief'] ?>" hidden>
                                    <button type="submit" name="trash" class="trash-icon-button"><ion-icon class="trash-icon" name="trash-outline"></ion-icon></button>
                                </form>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </section>
        </main>
    </div>

    <!-- =========== Scripts =========  -->
    <script src="assets/js/main.js"></script>

    <!-- ====== ionicons ======= -->
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>

</html>