<?php
session_start();
include('../connection/connection.php');

// Check if user is logged in
if (!isset($_SESSION['IdTrainer'])) {
    // Redirect to login page or handle unauthorized access
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['IdTrainer'];

// Fetch user information from the database
$DATA = $DATABASE->prepare("SELECT * FROM trainers WHERE IdTrainer = :user_id");
$DATA->bindParam(":user_id", $user_id);
$DATA->execute();
$user = $DATA->fetch(PDO::FETCH_ASSOC);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['full_name']) && isset($_POST['email'])) {
        $full_name = $_POST['full_name'];
        $email = $_POST['email'];

        // Update user information in the database
        $UPDATE = $DATABASE->prepare("UPDATE trainers SET FullName = :full_name, Email = :email WHERE IdTrainer = :user_id");
        $UPDATE->bindParam(":full_name", $full_name);
        $UPDATE->bindParam(":email", $email);
        $UPDATE->bindParam(":user_id", $user_id);
        $UPDATE->execute();

        // Redirect to profile page or show success message
        header("Location: trainer.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CodingDung | Profile Template</title>
    <link rel="stylesheet" href="assets/css/TrainerStyle.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container light-style flex-grow-1 container-p-y">
        <h4 class="font-weight-bold py-3 mb-4">
            Account settings
        </h4>
        <div class="card overflow-hidden">
            <div class="row no-gutters row-bordered row-border-light">
                <div class="col-md-3 pt-0">
                    <div class="list-group list-group-flush account-settings-links">
                        <a class="list-group-item list-group-item-action active" data-toggle="list" href="#account-general">General</a>
                        <a class="list-group-item list-group-item-action" data-toggle="list" href="#account-change-password">Change information</a>

                    </div>
                </div>
                <div class="col-md-9">
                    <div class="tab-content">
                        <div class="tab-pane fade active show" id="account-general">
                           
                            <hr class="border-light m-0">
                            <div class="card-body">
                                <div class="form-group">
                                    <p><strong>Full name : </strong><?php echo $user['FullName']; ?></p>
                                </div>
                                <div class="form-group">
                                    <p><strong>Email : </strong><?php echo $user['Email']; ?></p>
                                </div>


                            </div>

                        </div>
                        <div class="tab-pane fade" id="account-change-password">
                            <form method="POST" action="">
                                <div class="card-body pb-2">
                                    <div class="form-group">
                                        <label class="form-label">Change Full name</label>
                                        <input type="text" name="full_name" class="form-control" value="<?php echo $user['FullName']; ?>">
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">Change Email</label>
                                        <input type="email" name="email" class="form-control" value="<?php echo $user['Email']; ?>">
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">New password</label>
                                        <input type="password" class="form-control">
                                    </div>
                                    <div class="text-right mt-3">
                                        <button type="submit" class="btn btn-primary">Save changes</button>&nbsp;
                                        <button type="button" class="btn btn-default"><a href="index.php">Cancel</a></button>
                                    </div>
                                </div>
                            </form>
                        </div>


                    </div>
                </div>
            </div>

        </div>
        <script data-cfasync="false" src="/cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script>
        <script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.0/dist/js/bootstrap.bundle.min.js"></script>
        <script type="text/javascript">

        </script>
</body>

</html>