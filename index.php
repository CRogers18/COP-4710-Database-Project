<?php include('server.php') ?>

<!doctype html>
<html>
		 
	<div align="center">

		<head>
			<title>COP 4710 Project</title>
			<link href="main.css" rel="stylesheet" type="text/css" />
		</head>

		<script>
			function newUser()
			{

			}
		</script>

		<body>

			<header>
				<h1>Events@UCF</h1>
			</header>

			<img src="https://static1.squarespace.com/static/5644bd3fe4b0d7ba4d786321/t/5644be04e4b0c2d5ac269bdf/1447345671883/UCF_Knighthead_logo.png?format=1000w"><br>

			<form method="post" action="index.php">

				<p>
				<?php include('user_errors.php'); ?>
				</p>

				<strong>User ID</strong><br>
				<input type="text" name="username"><br><br>
				<strong>Password</strong><br>
				<input type="password" name="password"><br><br>
				<input type="submit" name="login_existing"><br><br>
			</form>

			<p>
				New? <a href="register.php">Register for an Account</a>
			</p>

		</body>

	</div>

</html>