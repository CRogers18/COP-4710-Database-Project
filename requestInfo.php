<?php include('server.php') ?>

<!DOCTYPE html>
<html align="center">
	
	<head>
		<title>Request Info</title>
		<link href="main.css" rel="stylesheet" type="text/css"/>
	</head>

	<body>

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

	<?php 
		$r_type  = $_GET['request_type'];
		$r_id = $_GET['request_id'];
	?>

	<form method="post" action="eventInfo.php?request_id=<?php echo $_GET['request_id'];?> &request_type=<?php echo $r_type;?>">

	<?php

		if($r_type == "Create Event Request")
		{
			$get_request_query = "SELECT * FROM admin_event_requests WHERE request_id='$r_id' LIMIT 1";
			$request_return = mysqli_query($db, $get_request_query);
			echo mysqli_error($db);

			$request_data = mysqli_fetch_assoc($request_return);

			$req_ev_name = $request_data['event_name'];
			$req_ev_cat = $request_data['event_category'];
			$req_ev_access = $request_data['event_privacy'];
			$req_ev_desc = $request_data['event_description'];
			$req_ev_time = $request_data['event_time'];
			$req_ev_phone = $request_data['event_contact_phone'];
			$req_ev_email = $request_data['event_contact_email'];
			$req_ev_owner = $request_data['owner_name'];
			$req_ev_uni = $request_data['university'];
			$req_ev_rso = $request_data['rso_id'];

		?>

			<h2>Event Request: <?php echo $req_ev_name; ?></h2>
			<p>
			   <strong>Hosted By:     </strong><?php echo $req_ev_owner; ?> <br>
			   <strong>Category:     </strong><?php echo $req_ev_cat; ?> <br>
			   <strong>Access:     </strong><?php echo $req_ev_access; ?> <br>
			   <strong>Time:     </strong><?php echo $req_ev_time; ?> <br>
			   <strong>Location: </strong><?php echo $req_ev_uni; ?> <br><br>
			   <?php echo $req_ev_desc; ?> <br><br>
			   <strong>Contact Phone Number: </strong> <?php echo $req_ev_phone; ?> <br>
			   <strong>Contact Email: </strong> <?php echo $req_ev_email; ?> <br><br>
			</p>

		<?php }

		else if($r_type == "Create RSO Request")
		{
			$get_request_query = "SELECT * FROM admin_rso_requests WHERE request_id='$r_id' LIMIT 1";
			$request_return = mysqli_query($db, $get_request_query);
			$request_data = mysqli_fetch_assoc($request_return);

			$req_rso_name = $request_data['rso_name'];
			$req_rso_desc = $request_data['Description'];
			$req_rso_owner_id = $request_data['requested_by'];
			$req_rso_uni = $request_data['University'];
			$req_rso_m1 = $request_data['Member1'];
			$req_rso_m2 = $request_data['Member2'];
			$req_rso_m3 = $request_data['Member3'];
			$req_rso_m4 = $request_data['Member4'];
			$req_rso_m5 = $request_data['Member5'];
		} ?>

	<select name="request_status_sel">
		<option value="Under Review">Under Review</option>
		<option value="Accepted">Accepted</option>
		<option value="Denied">Denied</option>
	</select><br><br>

	<input type="submit" name="update_request"><br><br>

	<div align="center">
	<br><br>Logged in as: <?php echo $_SESSION['username'] ?> <a href="index.php"><strong><br>LOGOUT</strong></a><br></div>

	</body>

</html>