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
			<li><a href="mainPage.php">Home</a></li>
			<li><a href="rsoRequestForm.php">Create a New RSO</a></li>
			<li><a href="newEvent.php">Make an Event</a></li>
			<!-- Visible to Super Admins ONLY -->
			<li><a href="">Event and RSO Requests</a></li>
		</ul>

		<header>
			<h2>Requests List</h2>
		</header>

		<div style="overflow-x:auto;">

			<table>

				<tr>
					<th>Request ID</th>
					<th>Type</th>
					<th>Requested By</th>
					<th>Name</th>
					<th>Time</th>
					<th>University</th>
					<th></th>
				</tr>

				<?php

				$query_event_req = mysqli_query($db, "SELECT * FROM admin_event_requests WHERE request_status='Under Review'");

				while($event_req = mysqli_fetch_assoc($query_event_req)) { ?>
					<tr>
						<td><?php echo "ev_" . $event_req['request_id']; ?></td>
						<td><?php $r_str = "Create Event Request"; echo $r_str; ?></td>
						<td><?php echo $event_req['owner_name']; ?></td>
						<td><?php echo $event_req['event_name']; ?></td>
						<td><?php echo $event_req['event_time']; ?></td>
						<td><?php echo $event_req['university']; ?></td>
						<td><a href="requestInfo.php?request_id=<?php echo $event_req['requested_by']; ?>&request_type=<?php echo $r_str; ?>">Details</a></td>
					</tr>
				<?php } ?>

				<?php

				$query_rso_req = mysqli_query($db, "SELECT * FROM admin_rso_requests WHERE request_status='Under Review'");

				while($rso_req = mysqli_fetch_assoc($query_rso_req)) { ?>
					<tr>
						<td><?php echo "rso_" . $rso_req['request_id']; ?></td>
						<td><?php $r_str = "Create RSO Request"; echo $r_str; ?></td>
						<td><?php 
							$req_id = $rso_req['requested_by'];
							$query_owner = mysqli_query($db, "SELECT user_name FROM users WHERE userid='$req_id'");

							$uid_val = mysqli_fetch_assoc($query_owner);
							$user = $uid_val['user_name'];
							echo $user; 
						?></td>
						<td><?php echo $rso_req['rso_name']; ?></td>
						<td>N/A</td>
						<td><?php echo $rso_req['University']; ?></td>
						<td><a href="requestInfo.php?request_id=<?php echo $rso_req['requested_by']; ?>&request_type=<?php echo $r_str; ?>">Details</a></td>
					</tr>
				<?php } ?>

			</table>

		</div>

		<div align="center">
		<br><br>Logged in as: <?php echo $_SESSION['username'] ?> <a href="index.php"><strong><br>LOGOUT</strong></a><br></div>

	</body>

</html>