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
			<li><a href="requests.php">Event and RSO Requests</a></li>
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
					<th>University</th>
					<th>Event Name</th>
					<th>Event Time</th>
					<th></th>
					<th></th>
				</tr>

				<?php

				$query_events = mysqli_query($db, "SELECT * FROM events");

				while($events = mysqli_fetch_assoc($query_events)) { ?>
					<tr>
						<td><?php 
							
							$rid = $events['rso_id'];
							$get_rso_name = "SELECT rso_name FROM rsos WHERE rso_id='$rid'";
							
							$rname_return = mysqli_query($db, $get_rso_name);

							$rname_val = mysqli_fetch_assoc($rname_return);
							$rname = $rname_val['rso_name'];

							echo $rname;

						?></td>
						<td><?php echo $events['university']; ?></td>
						<td><?php echo $events['event_name']; ?></td>
						<td><?php echo $events['event_time']; ?></td>
						<td><a href="eventInfo.php?event_id=<?php echo $events['event_id']?>">More Info</a></td>
						<td><a href="">Follow</a></td>
					</tr>
				<?php } ?>
			</table>

		</div><br><br>

		<header>
			<h2>RSO List</h2>
		</header>

		Show RSOs:
		<select>
			<option value="0">Near Me</option>
			<option value="1">Following</option>
		</select><br><br>

		<div style="overflow-x:auto;">
			<table>
				<tr>
					<th>RSO</th>
					<th>Description</th>
					<th>Leader</th>
					<th></th>
				</tr>

				<?php

				$query_rsos = mysqli_query($db, "SELECT * FROM rsos");

				while($rsos = mysqli_fetch_assoc($query_rsos)) { ?>
					<tr>
						<td><?php echo $rsos['rso_name']; ?></td>
						<td><?php echo $rsos['rso_description']; ?></td>
						<td><?php echo $rsos['rso_leader']; ?></td>
						<td><a href="">Join</a></td>
					</tr>
				<?php } ?>

			</table>
		</div>

		<div align="center">
		<br><br>Logged in as: <?php echo $_SESSION['username'] ?> <a href="index.php"><strong><br>LOGOUT</strong></a><br></div>

	</body>
	 
</html>