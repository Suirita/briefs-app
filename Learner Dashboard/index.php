<?php
session_start();
require_once '../connection/connection.php';

if (isset($_SESSION['IdLearner'])) {
    $IdLearner = $_SESSION['IdLearner'];

    $DATA = $DATABASE->prepare("SELECT 
                                    SUM(State = 'Finished') AS Finished,
                                    SUM(State = 'To Do') AS ToDo,
                                    SUM(State = 'In Progress') AS InProgress,
                                    SUM(State = 'Not Completed') AS NotCompleted
                                    FROM learner_brief 
                                    WHERE IdLearner = :IdLearner");
    $DATA->bindParam(':IdLearner', $IdLearner);
    $DATA->execute();
    $counts = $DATA->fetch(PDO::FETCH_ASSOC);

    $result = $DATABASE->prepare("SELECT * FROM learners 
                                            inner join learner_brief on learners.IdLearner = learner_brief.IdLearner 
                                            inner join briefs on learner_brief.IdBrief = briefs.IdBrief 
                                            WHERE learners.IdLearner = :IdLearner ");
    $result->bindParam(':IdLearner', $IdLearner);
    $result->execute();
    $results = $result->fetchAll(PDO::FETCH_ASSOC);



    $currentDate = date("Y-m-d");
    $result = $DATABASE->prepare("SELECT * FROM briefs  where StartDate >= :currentDate ORDER BY StartDate ASC");
    $result->bindParam(':currentDate', $currentDate);
    $result->execute();
    $recent_brief = $result->fetch(PDO::FETCH_ASSOC);
} else {
    echo "IdLearner session variable not set.";
}

if (isset($_POST['done'])) {
    $status = $_POST['status'];

    $DATA = $DATABASE->prepare("select * from learner_brief WHERE IdLearner = :IdLearner and IdBrief = :IdBrief");
    $DATA->bindParam(':IdLearner', $IdLearner);
    $DATA->bindParam(':IdBrief', $recent_brief['IdBrief']);
    $DATA->execute();

    if ($DATA->rowCount() == 1) {
        if ($status != '$status') {
            $DATA = $DATABASE->prepare("UPDATE learner_brief SET State = :status WHERE IdLearner = :IdLearner and IdBrief = :IdBrief");
            $DATA->bindParam(':status', $status);
            $DATA->bindParam(':IdLearner', $IdLearner);
            $DATA->bindParam(':IdBrief', $recent_brief['IdBrief']);
            $DATA->execute();

            if ($status == 'Finished') {
                $URl = $_POST['URL'];
                $DATA = $DATABASE->prepare("UPDATE learner_brief SET URL = :URL WHERE IdLearner = :IdLearner and IdBrief = :IdBrief");
                $DATA->bindParam(':URL', $URL);
                $DATA->bindParam(':IdLearner', $IdLearner);
                $DATA->bindParam(':IdBrief', $recent_brief['IdBrief']);
                $DATA->execute();
            }
        }
    } else {
        if ($status != '$status') {
            echo $recent_brief['IdBrief'];
            echo $IdLearner;
            echo $status;

            $DATA = $DATABASE->prepare("insert into learner_brief(IdLearner,IdBrief,State) values (:IdLearner, :IdBrief, :status)");
            $DATA->bindParam(':status', $status);
            $DATA->bindParam(':IdLearner', $IdLearner);
            $DATA->bindParam(':IdBrief', $recent_brief['IdBrief']);
            $DATA->execute();

            if ($status == 'Finished') {
                $DATA = $DATABASE->prepare("insert into learner_brief (:IdLearner, :IdBrief, :status, :URL) values (:IdLearner, :IdBrief, :status, :URL)");
                $DATA->bindParam(':URL', $URL);
                $DATA->bindParam(':status', $status);
                $DATA->bindParam(':IdLearner', $IdLearner);
                $DATA->bindParam(':IdBrief', $recent_brief['IdBrief']);
                $DATA->execute();
            }
        }
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Responsive Admin Dashboard | Korsat X Parmaga</title>
    <!-- ======= Styles ====== -->
    <link rel="stylesheet" href="assets/css/style.css">
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
                    <a href="#">
                        <span class="icon">
                            <ion-icon name="home-outline"></ion-icon>
                        </span>
                        <span class="title">Dashboard</span>
                    </a>
                </li>

                <li>
                    <a href="briefs.php">
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
                        <input type="text" placeholder="Search here">
                        <ion-icon name="search-outline"></ion-icon>
                    </label>
                </div>

                <div class="user">
                    <img src="assets/imgs/customer01.jpg" alt="">
                </div>
            </div>

            <!-- ======================= Cards ================== -->
            <div class="cardBox">
                <div class="card" style="background-color: #A8E363;">

                    <div>
                        <div class="numbers"><?php echo $counts['Finished']  ?></div>
                        <div class="cardName">Finished</div>
                    </div>

                    <div class="iconBx">
                        <ion-icon name="book-outline"></ion-icon>
                    </div>
                </div>

                <div class="card" style="background-color: #EBC85E;">
                    <div>
                        <div class="numbers"><?php echo $counts['ToDo']  ?></div>
                        <div class="cardName">To Do</div>
                    </div>

                    <div class="iconBx">
                        <ion-icon name="book-outline"></ion-icon>
                    </div>
                </div>

                <div class="card" style="background-color: #51BBEA;">
                    <div>
                        <div class="numbers"><?php echo $counts['InProgress']  ?></div>
                        <div class="cardName">In Progress</div>
                    </div>

                    <div class="iconBx">
                        <ion-icon name="book-outline"></ion-icon>
                    </div>
                </div>

                <div class="card" style="background-color: #F97373;">
                    <div>
                        <div class="numbers"><?php echo $counts['NotCompleted']  ?></div>
                        <div class="cardName">Passed</div>
                    </div>

                    <div class="iconBx">
                        <ion-icon name="book-outline"></ion-icon>
                    </div>
                </div>
            </div>

            <!-- ================ briefs history List ================= -->
            <div class="details">
                <div class="recentOrders">
                    <div class="cardHeader">
                        <h2>History</h2>
                    </div>
                    <table>
                        <thead>
                            <tr>
                                <td>Brief</td>
                                <td>Date start:</td>
                                <td>Date end:</td>
                                <td>Status</td>
                            </tr>
                        </thead>

                        <tbody>
                            <?php foreach ($results as $result) : ?>
                            <tr>
                                <td><?php echo $result['Title'] ?></td>
                                <td><?php echo $result['StartDate'] ?></td>
                                <td><?php echo $result['EndDate'] ?></td>
                                <?php $state = str_replace(' ', '_', $result['State']); ?>
                                <td><span class="status <?php echo $state ?>"><?php echo $result['State'] ?></span></td>
                            </tr>

                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>

                <!-- ================= New Customers ================ -->
                <div class="recentCustomers">
                    <div class="cardHeader">
                        <h2>Today's briefs</h2>
                    </div>
                    <div class="custom-card">
                        <div class="card-header">
                            <h2><?php echo $recent_brief['Title'] ?></h2>
                        </div>
                        <div class="countdown">
                            <p class="countdown-label">It will end in :</p>
                            <ul class="countdown-list">
                                <li>
                                    <div class="countdown-item">
                                        <div class="countdown-number">02 </div>
                                        <span class="countdown-unit">Days</span>
                                    </div>
                                </li>
                                <li>
                                    <div class="countdown-item">
                                        <div class="countdown-number">05</div>
                                        <span class="countdown-unit">Hours</span>
                                    </div>
                                </li>
                                <li>
                                    <div class="countdown-item">
                                        <div class="countdown-number">56</div>
                                        <span class="countdown-unit">Min</span>
                                    </div>
                                </li>
                                <li>
                                    <div class="countdown-item">
                                        <div class="countdown-number">26</div>
                                        <span class="countdown-unit">Sec</span>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <div class="card-footer">
                            <div class="attachment-btn">
                                <a href="FileDownload.php?brief_id=<?php echo $recent_brief['IdBrief']; ?>" download>
                                    <p>attachment </p>
                                    <ion-icon name="arrow-down-outline"></ion-icon>
                                    <<<<<<< HEAD </a>
                            </div>
                            <form method="post">
                                <div>
                                    <select name="status" id="status" class="delete-btn">
                                        <option value="status" hidden selected>status</option>
                                        <option value="todo">To Do</option>
                                        <option value="inprogress">In Progress</option>
                                        <option value="finished">Finished</option>
                                    </select>
                                </div>
                                <div class="input-div one" id="urlInputContainer">
                                    <div class="div">
                                        <label for="brief_title"></label>
                                        <input type="text" class="input" id="brief_title" name="URL"
                                            placeholder="Enter the URL">
                                    </div>
                                </div>
                                <button name="done" class="DoneButton">DONE</button>
                            </form>
                            =======

                            </a>
                        </div>
                        <div class="">
                            <select name="" id="status" class="delete-btn">
                                <option value="status" hidden selected>status</option>
                                <option value="todo">To Do</option>
                                <option value="inprogress">In Progress</option>
                                <option value="finished">Finished</option>
                            </select>
                        </div>

                        >>>>>>> e5a5e4615ba1d919e992af775e7c733fac9a9871
                    </div>

                </div>
            </div>
        </div>
    </div>

    <!-- =========== Scripts =========  -->
    <script src="assets/js/main.js"></script>
    <script>
    document.getElementById('status').addEventListener('change', function() {
        var selectElement = this;
        var selectedOption = selectElement.options[selectElement.selectedIndex].value;
        var color;

        switch (selectedOption) {
            case 'finished':
                color = '#A8E363';
                break;
            case 'todo':
                color = '#EBC85E';
                break;
            case 'inprogress':
                color = '#51BBEA';
                break;
            case 'notcompleted':
                color = 'red';
                break;
            default:
                color = '';
        }

        selectElement.style.backgroundColor = color;

        if (selectedOption == 'finished') {
            document.getElementById('urlInputContainer').style.display = 'block'
        } else {
            document.getElementById('urlInputContainer').style.display = 'none'
        }

    });
    </script>

    <!-- ====== ionicons ======= -->
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>

</html>