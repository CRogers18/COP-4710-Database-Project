<?php include('server.php') ?>

<!DOCTYPE html>
<html>

	<head>
		<title>Events@UCF Requests</title>
		<link href="main.css" rel="stylesheet" type="text/css"/>
	</head>

	<body>

		<header>
			<h1>Events@UCF</h1>
		</header>

		<!-- Displaying this will require a permission level check, will not display options for users below the requisite level -->
		<ul align="center">
			<!-- Visible to all users -->
			<li><a href="mainPage.html">Home</a></li>
			<li><a href="rsoRequestForm.html">Create a New RSO</a></li>
			<li><a href="newEvent.html">Make an Event</a></li>
			<!-- Visible to Super Admins ONLY -->
			<li><a href="">Event and RSO Requests</a></li>
		</ul>

		<header>
			<h2>Requests List</h2>
		</header>

		<div style="overflow-x:auto;">
			<table>
				<tr>
					<th>Type</th>
					<th>Requested By</th>
					<th>Details</th>
					<th>Status</th>
					<th></th>
				</tr>
				
				<?php

				$query_events = mysqli_query($db, "SELECT * FROM admin_event_requests");

				while($events = mysqli_fetch_assoc($query_events))
				{
					echo '<tr>
						<td>'.$events['event_name'].'</td>
						<td>'.$events['owner_name'].'</td>
						<td>'.$events['event_description'].'</td>
						<td>'.$events['request_status'].'</td>
					</tr>';
				}?>
				
				<?php
				
					$query_rso = mysqli_query($db,"SELECT * FROM admin_rso_requests");
				
				while($rsoData = mysqli_fetch_assoc($query_rso))
				{
					echo '<tr>
						<td>'.$rsoData['rso_name'].'</td>
						<td>'.$rsoData['requested_by'].'</td>
						<td>'.$rsoData['Description'].'</td>
						<td>'.$rsoData['request_status'].'</td>
					</tr>';
				}?>
				
			</table>
		</div><br><br>

	</body>

</html>