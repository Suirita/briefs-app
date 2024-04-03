<?php
session_start();
include('../connection/connection.php');

$DATA = "SELECT FullName FROM trainers where IdTrainer = :IdTrainer";
$DATA = $DATABASE->prepare($DATA);
$DATA->bindParam(':IdTrainer', $_SESSION['IdTrainer']);
$DATA->execute();
$result = $DATA->fetch(PDO::FETCH_ASSOC);
$FullName = $result['FullName'];

if (isset($_POST['edit'])) {
    $idBrief = $_POST['idBrief'];
    $_SESSION['idBrief'] = $idBrief;


    $DATA = $DATABASE->prepare("SELECT * FROM briefs WHERE IdBrief = :idBrief");
    $DATA->bindParam(':idBrief', $idBrief);
    $DATA->execute();
    $result = $DATA->fetch(PDO::FETCH_ASSOC);

    $DATA = $DATABASE->prepare("SELECT * FROM skills");
    $DATA->execute();
    $skills = $DATA->fetchAll(PDO::FETCH_ASSOC);

    $DATA = $DATABASE->prepare("SELECT * FROM brief_skills where IdBrief = :idBrief");
    $DATA->bindParam(':idBrief', $idBrief);
    $DATA->execute();
    $brief_skills = $DATA->fetchAll(PDO::FETCH_ASSOC);
}

if (isset($_POST['submit'])) {
    $Title = $_POST['brief_title'];
    $Start_Date = $_POST['brief_start_date'];
    $End_Date = $_POST['brief_end_date'];
    $URL = $_POST['brief_URL'];
    $idBrief = $_SESSION['idBrief'];

    // Check if any checkbox is selected
    if (isset($_POST['skills']) && is_array($_POST['skills'])) {
        $Skills = $_POST['skills'];
    } else {
        // Handle case where no checkboxes are selected
        $Skills = [];
    }

    if (empty($Title) || empty($Start_Date) || empty($End_Date) || empty($URL) || $Skills == []) {
        $error = "All fields are required";
    } else {
        if ($Start_Date > $End_Date) {
            $error = "the start date cannot be after the end date";
        } else {
            $DATA = "update briefs set Title = :brief_title, StartDate = :brief_start_date, EndDate = :brief_end_date, attachment = :brief_URL where IdBrief = :idBrief";
            $DATA = $DATABASE->prepare($DATA);
            $DATA->bindParam(':brief_title', $Title);
            $DATA->bindParam(':brief_start_date', $Start_Date);
            $DATA->bindParam(':brief_end_date', $End_Date);
            $DATA->bindParam(':brief_URL', $URL);
            $DATA->bindParam(':idBrief', $idBrief);
            $DATA->execute();

            $DATA = "delete from brief_skills where IdBrief = :IdBrief";
            $DATA = $DATABASE->prepare($DATA);
            $DATA->bindParam(':IdBrief', $idBrief);
            $DATA->execute();


            $DATA = "insert into brief_skills values (:IdBrief, :IdSkill)";
            $DATA = $DATABASE->prepare($DATA);
            foreach ($Skills as $skill) {
                $DATA->bindParam(':IdBrief', $idBrief);
                $DATA->bindParam(':IdSkill', $skill);
                $DATA->execute();
            }

            header('Location: edit.php');
            exit();
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
    <title>BriefSolicode | Admin Dashboard</title>
    <!-- ======= Styles ====== -->
    <link rel="stylesheet" href="assets/css/add.css">
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
                    <a href="././add.php">
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
                    <?= $FullName ?>
                </div>
            </section>
            <section>
                <div class="form_container">
                    <form method="post">
                        <div class="adding_brief_title_container">
                            <h1 class="adding_brief_title">Editing a brief</h1>
                        </div>
                        <div class="input-div one">
                            <div class="div">
                                <label for="brief_title">Brief Title</label>
                                <input type="text" class="input" id="brief_title" name="brief_title" value="<?php echo $result['Title']; ?>">
                            </div>
                        </div>
                        <div class="date-form">
                            <div>
                                <label for="brief_start_date" class="date-form-label">Start Date</label><br>
                                <input type="date" id="brief_start_date" name="brief_start_date" value="<?php echo $result['StartDate']; ?>">
                            </div>
                            <div>
                                <label for="brief_end_date" class="date-form-label">End Date</label><br>
                                <input type="date" id="brief_end_date" name="brief_end_date" value="<?php echo $result['EndDate']; ?>">
                            </div>
                        </div>
                        <div class="input-div one">
                            <div class="div">
                                <label for=" brief_URL">Brief URL</label>
                                <input type="file" class="input" id="brief_URL" name="brief_URL" value="<?php echo $result['attachment']; ?>">
                            </div>
                        </div>
                        <div>
                            <?php
                            foreach ($skills as $skill) {
                                $found = false;
                                foreach ($brief_skills as $brief_skill) {
                                    if ($skill['IdSkill'] == $brief_skill['IdSkill']) {
                                        echo '<label class="checkbox">' . $skill['titled'];
                                        echo '<input type="checkbox" value="' . $skill['IdSkill'] . '" name="skills[]" checked>';
                                        echo '<span class="check"></span>';
                                        echo '</label>';
                                        $found = true;
                                        break;
                                    }
                                }
                                if (!$found) {
                                    echo '<label class="checkbox">' . $skill['titled'];
                                    echo '<input type="checkbox" value="' . $skill['IdSkill'] . '" name="skills[]">';
                                    echo '<span class="check"></span>';
                                    echo '</label>';
                                }
                            }
                            ?>
                        </div>
                        <input type="submit" class="btn" value="edit Brief" name="submit">
                    </form>
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