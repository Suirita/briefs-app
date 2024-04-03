<?php
session_start();
include('../connection/connection.php');


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve the hidden ID from the POST data
    if (isset($_POST['IdBrief'])) {
        $idBrief = $_POST['IdBrief'];
        $DATA = $DATABASE->prepare("SELECT briefs.*, trainers.*
    FROM briefs
    INNER JOIN trainers ON briefs.IdTrainer = trainers.IdTrainer
    WHERE briefs.IdBrief = :idBrief
");
        $DATA->bindParam(":idBrief", $idBrief);
        $DATA->execute();
        $result = $DATA->fetch(PDO::FETCH_ASSOC);


        $DATA = $DATABASE->prepare("SELECT *
    FROM brief_skills
    INNER JOIN skills ON brief_skills.IdSkill = skills.IdSkill
    WHERE brief_skills.IdBrief = :idBrief
");
        $DATA->bindParam(":idBrief", $idBrief);
        $DATA->execute();
        $results = $DATA->fetchAll(PDO::FETCH_ASSOC);



        // Now you can use $result as needed, such as displaying it or processing it further

    }
}







?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/briefDetails.css">
    <title>Document</title>
</head>

<body>
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
                    <a href="#main">
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
                    <a href="./edit.php">
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
        <main class="main" id="main">
            <section class="topbar">
                <div class="toggle">
                    <ion-icon name="menu-outline"></ion-icon>
                </div>


            </section>
            <section>
                <div class="form_container">
                    <form method="post">

                        <div class="top">
                            <div class="title">
                                <h2><?php echo $result['Title'] ?></h2>
                            </div>
                            <div class="genre"><span>Trainer: </span><?php echo $result['FullName'] ?></div>
                        </div>
                        <div class="brief">

                            <div class="movie-description">
                                <div></div>
                                <h2>About the Brief</h2>
                                <p><?php echo $result['Description'] ?></p>
                                <div class="competences">
                                    <h3>Competences</h3>
                                    <ul><?php
                                        foreach ($results as $row) {
                                            echo "<li>{$row['titled']}</li>";
                                        } ?>
                                    </ul>
                                </div>
                                <div class="actions">
                                    <a class="download" href="FileDownload.php?brief_id=<?php echo $recent_brief['IdBrief']; ?>" download>
                                        <p>attachment </p>
                                        <ion-icon name="arrow-down-outline"></ion-icon>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>

            </section>
        </main>








        <!-- =========== Scripts =========  -->
        <script src="assets/js/main.js"></script>

        <!-- ====== ionicons ======= -->
        <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
        <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>

</html>