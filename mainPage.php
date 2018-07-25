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

		<form method="post" action="mainPage.php">

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
			<option value="Near Me">Near Me</option>
			<option value="Following">Following</option>
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
				<!--	<th></th> -->
				</tr>

				<?php

				if($_SESSION['access_level'] == 0 || $_SESSION['access_level'] == 1)
				{
					$user_uni = $_SESSION['universityID'];
					$query_events = mysqli_query($db, "SELECT * FROM events WHERE university='$user_uni' ORDER BY event_time ASC");
				}

				else if($_SESSION['access_level'] == 2)
					$query_events = mysqli_query($db, "SELECT * FROM events ORDER BY event_time ASC");

				while($events = mysqli_fetch_assoc($query_events)) { ?>
					<tr>
						<td><?php 
							
							$rid = $events['rso_id'];
							$get_rso_name = "SELECT rso_name FROM rsos WHERE rso_id='$rid'";
							
							$rname_return = mysqli_query($db, $get_rso_name);

							$rname_val = mysqli_fetch_assoc($rname_return);

							if(mysqli_num_rows($rname_return) == 0)
								$rname = "N/A";
							else
								$rname = $rname_val['rso_name'];

							echo $rname;

						?></td>
						<td><?php echo $events['university']; ?></td>
						<td><?php echo $events['event_name']; ?></td>
						<td><?php echo $events['event_time']; ?></td>
						<td><a href="eventInfo.php?event_id=<?php echo $events['event_id']?>">More Info</a></td>
						<!--<td><a href="">Follow</a></td> -->
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

				if($_SESSION['access_level'] == 0 || $_SESSION['access_level'] == 1)
				{
					$user_uni = $_SESSION['universityID'];

					$get_uni_id = "SELECT university_id FROM universities WHERE university_name='$user_uni'";
					$r_uni_id = mysqli_query($db, $get_uni_id);
					$uni_id_val = mysqli_fetch_assoc($r_uni_id);
					$uni_id = $uni_id_val['university_id'];

					$query_rsos = mysqli_query($db, "SELECT * FROM rsos WHERE university_id='$uni_id'");
				}

				else if($_SESSION['access_level'] == 2)
					$query_rsos = mysqli_query($db, "SELECT * FROM rsos");

				while($rsos = mysqli_fetch_assoc($query_rsos)) { ?>
					<tr>
						<td name="r_name"><?php echo $rsos['rso_name']; ?></td>
						<td><?php echo $rsos['rso_description']; ?></td>
						<td name="r_leader"><?php echo $rsos['rso_leader']; ?></td>
						<td>
							<input type="submit" name="join_rso" value="Join">
						</td>
					</tr>
				<?php } ?>

			</table>
		</div>

		<div align="center">
		<br><br>Logged in as: <?php echo $_SESSION['username'] ?> <a href="index.php"><strong><br>LOGOUT</strong></a><br></div>

	</body>
	 
</html>