<?php
include "../connection/connection.php";

if (isset($_POST["submit"])) {

	$Email = $_POST["email"];
	$Password = $_POST["password"];

	if ($Email == "" || $Password == "") {
		$error =  "Please enter all fields";
	} else {
		session_start();
		$DATA = $DATABASE->prepare("SELECT * FROM trainers WHERE Email = :email AND Password = :password");
		$DATA->bindParam(":email", $Email);
		$DATA->bindParam(":password", $Password);
		$DATA->execute();
		if ($DATA->rowCount() > 0) {
			$row = $DATA->fetch(PDO::FETCH_ASSOC);
			$_SESSION["id"] = $row['IdTrainer'];
			header("Location: ../Admin Dashboard/index.php");
			exit();
		} else {
			$DATA = $DATABASE->prepare("SELECT * FROM learners WHERE Email = :email AND Password = :password");
			$DATA->bindParam(":email", $Email);
			$DATA->bindParam(":password", $Password);
			$DATA->execute();
			if ($DATA->rowCount() > 0) {
				$row = $DATA->fetch(PDO::FETCH_ASSOC);
				$_SESSION["id"] = $row['IdLearner'];
				header("Location: ../Learner Dashboard/index.php");
				exit();
			} else {
				$error = "Invalid email or password";
			}
		}
	}
}

?>

<!DOCTYPE html>
<html>

<head>
	<title>Animated Login Form</title>
	<link rel="stylesheet" type="text/css" href="assets/css/style.css">
	<link href="https://fonts.googleapis.com/css?family=Poppins:600&display=swap" rel="stylesheet">
	<script src="https://kit.fontawesome.com/a81368914c.js"></script>
	<meta name="viewport" content="width=device-width, initial-scale=1">
</head>

<body>
	<img class="wave" src="./assets/img/wave.png">
	<div class="container">
		<div class="img">
			<img src="./assets/img/bg.png" alt="logo">
		</div>
		<div class="login-content">
			<form method="post">
				<img src="./assets/img/avatar.svg" alt="avatar">
				<h2 class="title">Welcome</h2>
				<div class="input-div one">
					<div class="i">
						<i class="fas fa-user"></i>
					</div>
					<div class="div">
						<h5>Email</h5>
						<input type="email" name="email" class="input">
					</div>
				</div>
				<div class="input-div pass">
					<div class="i">
						<i class="fas fa-lock"></i>
					</div>
					<div class="div">
						<h5>Password</h5>
						<input type="password" name="password" class="input">

					</div>
				</div>
				<?php
				if (isset($error)) {
					echo "<p class='error'>" . $error . "</p>";
				}
				?>
				<input type="submit" name="submit" class="btn" value="Login">
			</form>
		</div>
	</div>
	<script type="text/javascript" src="assets/js/main.js"></script>
</body>

</html>