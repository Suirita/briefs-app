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
if (isset($_SESSION['IdTrainer'])){
    $IdTrainer = $_SESSION['IdTrainer'];

    $DATA = $DATABASE -> prepare("SELECT * FROM Trainers WHERE IdTrainer = :IdTrainer");
    $DATA -> bindParam(':IdTrainer', $IdTrainer);
    $DATA -> execute();
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
    <link rel="stylesheet" href="assets/css/TableUserStyle.css">
    <title>AdminHub</title>
</head>

<body>
    <!-- CONTENT -->
    <section id="content">
        <!-- MAIN -->
        <main>
            <div class="table-data">
                <div class="order">
                    <div class="head">
                        <h3>Recent Orders</h3>

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
                                    <td><?php echo $result['URL'] ?></td>

                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
                <div class="todo">

                    <div class="profile-card">
                        <div class="image">
                            <img src="" alt="" class="profile-img">
                        </div>
                        <div class="text-data">
                            <span class="name"><?php echo $Trainer['FullName'] ?></span>
                            <span class="rule">Trainer in SOLICODE</span>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </section>

    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
    <script src="script.js"></script>
</body>

</html>