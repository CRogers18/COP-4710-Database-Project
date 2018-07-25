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
		<title>Make a New Event</title>
		<link href="main.css" rel="stylesheet" type="text/css" />
	</head>
	
	<body align="center">

		<header>
			<h1>Make a New Event</h1>
		</header>

		<form method="post" action="newEvent.php">

			<p>
			<?php include('user_errors.php'); ?>
			</p>

			<strong>Event Name</strong><br>
			<input type="text" name="ev_name"><br><br>

			<strong>RSO Hosting</strong><br>
			<select name="rso_select">
				
				<option value="Public">Public</option>
				<option value="Private">Private</option>
				<?php
				
				$user_owner = $_SESSION['username'];

				$query_admin_rsos = mysqli_query($db, "SELECT rso_name FROM rsos WHERE rso_leader='$user_owner'");

				while($rsos = mysqli_fetch_assoc($query_admin_rsos)) 
				{ 
						$name = $rsos['rso_name']; ?>

						<option value="<?php echo $name; ?>">
							<?php echo $name; ?>
						</option>

				<?php } ?>

			</select><br><br>

			<strong>Category</strong><br>
			<select name="ev_category">
				<option value="General Meeting">General Meeting</option>
				<option value="fundr">Fundraising</option>
				<option value="social">Social</option>
				<option value="tech_t">Tech Talks</option>
			</select><br><br>

			<!-- Access level should only be set-able by admins, do not show for students applying to make their own event 
			<strong>Access Level</strong><br>
			<select name="ev_access_lvl">
				<option value="Public">Public</option>
				<option value="Private">Private</option>
				<option value="RSO">RSO</option>
			</select><br><br> -->

			<strong>Description</strong><br>
			<textarea name="ev_desc" rows = "15" cols = "50">Enter an event description here</textarea><br><br>

			<strong>Event Time</strong><br>
			<input type="time" name="ev_time"><br><br>

			<strong>Event Date</strong><br>
			<input type="date" id="event_time" name="ev_date"
					min = "2018-07-09" max = "2019-12-31"><br><br>

			<strong>Contact Phone Number</strong><br>
			<input type="text" name="ev_phone"><br><br>

			<strong>Contact Email Address</strong><br>
			<input type="email" name="ev_email"><br><br>

			<input type="submit" name="event_submit"><br><br>
			
		</form>


	</body>

</html>