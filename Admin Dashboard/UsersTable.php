<?php
require_once '../connection/connection.php';
session_start();
if (isset($_POST['search'])) {
    // Get the search input
    $search_input = $_POST['search_input'];

    // Prepare the SQL query with a WHERE clause to filter by titre
    $query = "SELECT * FROM learners 
              INNER JOIN learner_brief ON learners.IdLearner = learner_brief.IdLearner 
              INNER JOIN briefs ON learner_brief.IdBrief = briefs.IdBrief 
              WHERE title LIKE :search_input
              ORDER BY Title ASC";

    // Prepare and execute the query
    $DATA = $DATABASE->prepare($query);
    $DATA->execute(array(':search_input' => '%' . $search_input . '%')); // Use LIKE to perform a partial match

    // Fetch the results
    $results = $DATA->fetchAll(PDO::FETCH_ASSOC);
} else {
    // If search form is not submitted, fetch all records
    $DATA = $DATABASE->prepare("SELECT * FROM learners 
                                 INNER JOIN learner_brief ON learners.IdLearner = learner_brief.IdLearner 
                                 INNER JOIN briefs ON learner_brief.IdBrief = briefs.IdBrief
                                 ORDER BY Title ASC");
    $DATA->execute();
    $results = $DATA->fetchAll(PDO::FETCH_ASSOC);
}
if (isset($_SESSION['IdTrainer'])) {
    $IdTrainer = $_SESSION['IdTrainer'];

    $DATA = $DATABASE->prepare("SELECT * FROM Trainers WHERE IdTrainer = :IdTrainer");
    $DATA->bindParam(':IdTrainer', $IdTrainer);
    $DATA->execute();
    $Trainer = $DATA->fetch(PDO::FETCH_ASSOC);
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Boxicons -->
    <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
    <!-- My CSS -->
    <link rel="stylesheet" href="assets/css/TableUserStyle.css">

    <title>Users</title>
</head>

<body>


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

        <!-- CONTENT -->
        <section id="content">


            <!-- MAIN -->
            <main>





                <div class="table-data">
                    <div class="order">
                        <button class="Back-button"><a href="index.php">Back</a></button>
                        <div class="head">


                            <h3>Briefs historique</h3>

                            <div class="search">
                                <label>
                                    <form method="post">
                                        <input type="text" name="search_input" placeholder="Search here">
                                        <button type="submit" name="search"><i class='bx bx-search'></i></button>
                                    </form>
                                </label>
                            </div>


                        </div>
                        <table>
                            <thead>
                                <tr>
                                    <th>Full name</th>
                                    <th>Group</th>
                                    <th>Brief</th>
                                    <th>State</th>
                                    <th>URL</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($results as $result) : ?>
                                    <tr>
                                        <td>
                                            <p><?php echo $result['FullName'] ?></p>
                                        </td>
                                        <td><?php echo $result['Groupe'] ?></td>
                                        <td><?php echo $result['Title'] ?></td>
                                        <?php $state = str_replace(' ', '_', $result['State']) ?>
                                        <td><span class="status <?php echo $state ?>"><?php echo $result['State'] ?></span></td>
                                        <td><?php
                                            // Assuming $result['state'] contains the state of the brief
                                            if ($result['State'] == 'Finished') {
                                                // If brief is completed, display the link
                                                echo '<td><a href="' . htmlspecialchars($result['URL']) . '">Show url</a></td>';
                                            } elseif ($result['State'] == 'In Progress') {
                                                // If brief is in progress, display a message or nothing
                                                echo '<td>Brief in progress</td>';
                                            } else {
                                                // If brief is in any other state, display a message or nothing
                                                echo '<td>Brief not started</td>';
                                            }
                                            ?>
                                        </td>

                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="todo">

                        <div class="profile-card">
                            <div class="image">
                                <img src="../Images/<?php echo $Trainer['images'] ?>" alt="" class="profile-img">
                            </div>
                            <div class="text-data">
                                <span class="name"><?php echo $Trainer['FullName'] ?></span>
                                <span class="rule">Trainer in SOLICODE</span>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
            <!-- MAIN -->
        </section>
        <!-- CONTENT -->

        <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
        <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
        <script src="assets/js/main.js"></script>
</body>

</html>