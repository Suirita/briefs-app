<?php
require_once '../connection/connection.php';
session_start();

$DATA = "select FullName from trainers where IdTrainer = :IdTrainer";
$DATA = $DATABASE->prepare($DATA);
$DATA->bindParam(":IdTrainer", $_SESSION['IdTrainer']);
$DATA->execute();
$result = $DATA->fetch(PDO::FETCH_ASSOC);
$FullName = $result['FullName'];

$DATA = $DATABASE->prepare("SELECT count(*) AS CountTrainers FROM trainers");
$DATA->execute();
$result = $DATA->fetch(PDO::FETCH_ASSOC);
$countTrainers = $result['CountTrainers'];

$DATA = $DATABASE->prepare("SELECT count(*) AS CountLearners FROM learners");
$DATA->execute();
$result = $DATA->fetch(PDO::FETCH_ASSOC);
$countLearners = $result['CountLearners'];

$DATA = $DATABASE->prepare("SELECT count(*) AS CountBriefs FROM briefs");
$DATA->execute();
$result = $DATA->fetch(PDO::FETCH_ASSOC);
$countBriefs = $result['CountBriefs'];

$DATA = $DATABASE->prepare("SELECT * FROM learners inner join learner_brief on learners.IdLearner = learner_brief.IdLearner inner join briefs on learner_brief.IdBrief = briefs.IdBrief");
$DATA->execute();
$results = $DATA->fetchAll(PDO::FETCH_ASSOC);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BriefSolicode | Admin Dashboard</title>
    <!-- ======= Styles ====== -->
    <link rel="stylesheet" href="assets/css/style.css">
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

        <!-- ========================= Main ==================== -->
        <main class="main" id="main">
            <section class="topbar">
                <div class="toggle">
                    <ion-icon name="menu-outline"></ion-icon>
                </div>
                <div class="user">
                    <?=$FullName?>
                </div>
            </section>

            <!-- ======================= Cards ================== -->
            <section class="cardBox">

                <div class="card">
                    <div>
                        <!-- PHP NUMBER -->
                        <div class="numbers"><?php echo $countTrainers ?></div>
                        <div class="cardName">Trainers</div>
                    </div>

                    <div class="iconBx">
                        <ion-icon name="person-outline"></ion-icon>
                    </div>
                </div>

                <div class="card">
                    <div>
                        <!-- PHP NUMBER -->
                        <div class="numbers"><?php echo $countLearners ?></div>
                        <div class="cardName">Learners</div>
                    </div>

                    <div class="iconBx">
                        <ion-icon name="people-outline"></ion-icon>
                    </div>
                </div>
                <div class="card">
                    <div>
                        <!-- PHP NUMBER -->
                        <div class="numbers"><?php echo $countBriefs ?></div>
                        <div class="cardName">Briefs</div>
                    </div>

                    <div class="iconBx">
                        <ion-icon name="book-outline"></ion-icon>
                    </div>
                </div>


            </section>

            <!-- ================ brief state List ================= -->
            <section class="state">
                <div class="recentOrders">
                    <div class="cardHeader">
                        <h2>Brief State</h2>
                    </div>

                    <table>
                        <thead>
                            <tr>
                                <td>Name</td>
                                <td>Groupe</td>
                                <td>Brief</td>
                                <td>Status</td>
                                <td>URL</td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($results as $result) : ?>
                                <tr>
                                    <td><?php echo $result['FullName'] ?></td>
                                    <td><?php echo $result['Groupe'] ?></td>
                                    <td><?php echo $result['Title'] ?></td>
                                    <?php $state = str_replace(' ', '_', $result['State']); ?>
                                    <td>
                                        <span class="status <?php echo $state; ?>">
                                            <?php echo $result['State'] ?>
                                        </span>
                                    </td>
                                    <td><a href=""><?php echo $result['URL'] ?></a></td>
                                </tr>
                            <?php endforeach; ?>

                        </tbody>
                    </table>
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