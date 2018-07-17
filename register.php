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

			<?php include('user_errors.php'); ?>

			<strong>Enter a Username</strong><br>
			<input type="text" name="username"><br><br>
			<strong>Enter a Password</strong><br>
			<input type="password" name="password"><br><br>

			<strong>Select Your University</strong><br>
			<select name="univ_sel" onchange="getText(this)">
				<option value="0"> </option>
				<option value="1">UCF</option>
				<option value="2">FSU</option>
				<option value="3">FIU</option>
			</select><br><br>

			<input type="submit" name="login_new"><br><br>
		</form>

		<input type="hidden" name="univ_select" id="txt_holder">

		<script>
		  function getText(element) 
		  {
			  var textHolder = element.options[element.selectedIndex].text
			  document.getElementById("txt_holder").value = textHolder;
		  }
		</script>

	</body>

</html>