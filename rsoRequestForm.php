<?php include('server.php') ?>

<!DOCTYPE html>
<html>
	
	<header>
		<h1>Events@UCF</h1>
	</header>

	<!-- Displaying this will require a permission level check, will not display options for users below the requisite level -->
	<ul>
		<!-- Visible to all users -->
		<li><a href="mainPage.html">Home</a></li>
		<li><a href="rsoRequestForm.html">Create a New RSO</a></li>
		<li><a href="newEvent.html">Make an Event</a></li>
		<!-- Visible to Super Admins ONLY -->
		<li><a href="requests.html">Event and RSO Requests</a></li>
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
			<strong>RSO Name</strong><br>
			<input type="text" name="rsoName"><br><br>

			<strong>University of New RSO</strong><br>
			<select name="uni_select">
				<option value="UCF">UCF</option>
				<option value="FSU">FSU</option>
				<option value="FIU">FIU</option>
			</select><br><br>

			<strong>RSO Description</strong><br>
			<textarea name="desc" rows = "15" cols = "50">Enter a description of your RSO here</textarea><br><br>

			<h3>NOTE: To request a new RSO the emails of 5 other students who wish to join are needed!</h3><br>
			<strong>Member 1</strong><br>
			<input type="text" name="mem1"><br><br>

			<strong>Member 2</strong><br>
			<input type="text" name="mem2"><br><br>

			<strong>Member 3</strong><br>
			<input type="text" name="mem3"><br><br>

			<strong>Member 4</strong><br>
			<input type="text" name="mem4"><br><br>

			<strong>Member 5</strong><br>
			<input type="text" name="mem5"><br><br>

			<input type="submit" name="rso_request"><br><br>
		</form>

	</body>

</html>