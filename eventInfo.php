<?php include('server.php') ?>

<!DOCTYPE html>
<html align="center">
	
	<head>
		<title>Event Info</title>
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

	<form method="post" action="eventInfo.php?event_id=<?php echo $_GET['event_id'] ?>">

	<?php

		$this_event_id  = $_GET['event_id'];

		$get_event_info = "SELECT * FROM events WHERE event_id='$this_event_id'";
		
		$event_return = mysqli_query($db, $get_event_info);
		$event_data = mysqli_fetch_assoc($event_return);
		
		$event_name = $event_data['event_name'];
		$event_time = $event_data['event_time'];
		$event_loc = $event_data['university'];
		$event_desc = $event_data['event_description'];
		$event_phone = $event_data['event_contact_phone'];
		$event_email = $event_data['event_contact_email'];

		$rid = $event_data['rso_id'];
		$get_rso_name = "SELECT rso_name FROM rsos WHERE rso_id='$rid'";
		
		$rname_return = mysqli_query($db, $get_rso_name);

		if(mysqli_num_rows($rname_return) == 0)
			$event_rso = $event_data['owner_name'];
		else
		{
			$rname_val = mysqli_fetch_assoc($rname_return);
			$event_rso = $rname_val['rso_name'];
		}

	?>

	<h2><?php echo $event_name; ?></h2>

	<p>
	   <strong>Hosted By:     </strong><?php echo $event_rso; ?> <br>
	   <strong>Time:     </strong><?php echo $event_time; ?> <br>
	   <strong>Location: </strong><?php echo $event_loc; ?> <br><br>
	   <?php echo $event_desc; ?> <br><br>
	   <strong>Contact Phone Number: </strong> <?php echo $event_phone; ?> <br>
	   <strong>Contact Email: </strong> <?php echo $event_email; ?> <br><br>
	</p>

	<strong>Comments:</strong><br><br>
	<?php

		$get_event_comments = "SELECT * FROM comments WHERE event_id='$this_event_id'";
		$comments_return = mysqli_query($db, $get_event_comments);

		if(mysqli_num_rows($comments_return) == 0)
		{ ?>
			<p>There doesn't seem to be any comments yet...</p>
	<?php }

		else
		{
			while($comments_data = mysqli_fetch_assoc($comments_return))
			{ 
				$commenter = $comments_data['user_name'];
				$user_comment = $comments_data['comment'];
			?>

				<p>
					<strong><?php echo $commenter; ?>: </strong>
					<?php echo $user_comment ?>
				</p>
			
	  		<?php } ?>
	<?php	} ?>

	<div id="comment"></div><br>
	<textarea name="commentBox" rows = "5" cols = "50">Add a comment here</textarea><br><br>
	<input type="submit" name="comment_submit"><br><br>

	<div align="center">
	<br><br>Logged in as: <?php echo $_SESSION['username'] ?> <a href="index.php"><strong><br>LOGOUT</strong></a><br></div>

	</body>

</html>