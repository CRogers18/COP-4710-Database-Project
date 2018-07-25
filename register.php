<?php include('server.php') ?>

<!DOCTYPE html>
<html>

	<head>
		<title>Register for Access</title>
		<link href="main.css" rel="stylesheet" type="text/css"/>
	</head>
	
	<body align="center">

		<header>
			<h1>Events@UCF New User Registration</h1>
		</header>

		<form method="post" action="register.php">
			
			<p>
			<?php include('user_errors.php'); ?>
			</p>

			<strong>Enter a Username</strong><br>
			<input type="text" name="username"><br><br>
			<strong>Enter a Password</strong><br>
			<input type="password" name="password"><br><br>

			<strong>Select Your University</strong><br>
			<select name="univ_sel">
				<option value="UCF">UCF</option>
				<option value="FSU">FSU</option>
				<option value="FIU">FIU</option>
			</select><br><br>

			<input type="submit" name="login_new"><br><br>
		</form>

	</body>

</html>