<?php include('server.php') ?>

<!DOCTYPE html>
<html>
	
	<header>
		<h1>Events@UCF</h1>
	</header>

	<!-- Displaying this will require a permission level check, will not display options for users below the requisite level -->
	<ul>
		<!-- Visible to all users -->
		<li><a href="mainPage.php">Home</a></li>
		<li><a href="rsoRequestForm.php">Create a New RSO</a></li>
		<li><a href="newEvent.php">Make an Event</a></li>
		<!-- Visible to Super Admins ONLY -->
		<li><a href="requests.php">Event and RSO Requests</a></li>
	</ul>

	<head>
		<title>RSO Request Form</title>
		<link href="main.css" rel="stylesheet" type="text/css"/>
	</head>

	<body align="center">

		<header>
			<h1>Request to Form a New RSO</h1>
		</header>

		<form method="post" action="rsoRequestForm.php">

			<p>
			<?php include('user_errors.php'); ?>
			</p>

			<strong>RSO Name</strong><br>
			<input type="text" name="rso_name"><br><br>

			<strong>University of New RSO</strong><br>
			<select name="uni_select">
				<option value="UCF">UCF</option>
				<option value="FSU">FSU</option>
				<option value="FIU">FIU</option>
			</select><br><br>

			<strong>RSO Description</strong><br>
			<textarea name="rso_desc" rows = "15" cols = "50">Enter a description of your RSO here</textarea><br><br>

			<h3>NOTE: To request a new RSO the usernames of 5 other students who wish to join are needed!</h3><br>
			<strong>Member 1</strong><br>
			<input type="text" name="m1"><br><br>

			<strong>Member 2</strong><br>
			<input type="text" name="m2"><br><br>

			<strong>Member 3</strong><br>
			<input type="text" name="m3"><br><br>

			<strong>Member 4</strong><br>
			<input type="text" name="m4"><br><br>

			<strong>Member 5</strong><br>
			<input type="text" name="m5"><br><br>

			<input type="submit" name="submit_rso_req"><br><br>
		</form>

	</body>

</html>