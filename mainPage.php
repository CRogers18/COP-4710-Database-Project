<?php include('server.php') ?>

<!DOCTYPE html>
<html>
 
	<head>
		<title>Events@UCF</title>
		<link href="main.css" rel="stylesheet" type="text/css"/>
	</head>
	
	<body>

		<header>
			<h1>Welcome to Events@UCF</h1>
		</header>

		<!-- Displaying this will require a permission level check, will not display options for users below the requisite level -->
		<ul align="center">
			<!-- Visible to all users -->
			<li><a href="mainPage.php">Home</a></li>
			<li><a href="rsoRequestForm.php">Create a New RSO</a></li>
			<li><a href="newEvent.php">Make an Event</a></li>
			<!-- Visible to Super Admins ONLY -->
			<li><a href="requests.php" name="viewRequests">Event and RSO Requests</a></li>
		</ul>

		<header>
			<h2>Events List</h2>
		</header>

		Show Events:
		<select>
			<option value="0">Near Me</option>
			<option value="1">UCF</option>
			<option value="2">FSU</option>
			<option value="3">FIU</option>
			<option value="4">Following</option>
		</select><br><br>

		<!-- Table will be dynamically filled via events list from the database and then filtered based on index selected from the user drop-down menu, default option will be set to 'near me' -->
		<div style="overflow-x:auto;">
			<table>
				<tr>
					<th>RSO</th>
					<th>Event Name</th>
					<th>Event Time</th>
					<th>Contact</th>
					<th></th>
				</tr>

				<?php

				$query_events = mysqli_query($db, "SELECT * FROM admin_event_requests");

				while($events = mysqli_fetch_assoc($query_events))
				{
					echo '<tr>
						<td>'.$events['rso_id'].'</td>
						<td>'.$events['event_name'].'</td>
						<td>'.$events['event_time'].'</td>
						<td>'.$events['event_contact_email'].'</td>
					</tr>';
				}?>
			</table>

		</div><br><br>

		<header>
			<h2>RSO List</h2>
		</header>

		Show RSOs:
		<select>
			<option value="0">Near Me</option>
			<option value="4">Following</option>
		</select><br><br>

		<div style="overflow-x:auto;">
			<table>
				<tr>
					<th>RSO</th>
					<th>Description</th>
					<th>University</th>
					<th></th>
				</tr>
				
				<?php

				$query_rsoList = mysqli_query($db, "SELECT * FROM rsos");

				while($events = mysqli_fetch_assoc($query_events))
				{
					echo '<tr>
						<td>'.$events['rso_id'].'</td>
						<td>'.$events['rso_description'].'</td>
						<td>'.$events['university_id'].'</td>
					</tr>';
				}?>
				
			</table>
		</div>		

	</body>
	 
</html>