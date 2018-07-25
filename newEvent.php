<?php include('server.php') ?>

<!DOCTYPE html>
<html>
	<head>
		<title>Make a New Event</title>
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.2/css/bootstrap.min.css" integrity="sha384-Smlep5jCw/wG7hdkwQ/Z5nLIefveQRIY9nfy6xoR1uRYBtpZgI6339F5dgvm/e9B" crossorigin="anonymous">
        <link href="https://fonts.googleapis.com/css?family=Quicksand" rel="stylesheet">
        <link rel="stylesheet" href="./main.css"/>
	</head>
	
	<body>

			<!-- Displaying this will require a permission level check, will not display options for users below the requisite level -->
	

		<div class="banner">
            <h1 class="bannerHeader">Make a New Event</h1>
            <ul class="nav menu">
                <!-- Visible to all users -->
                <li class="nav-item"><a class="nav-link" href="mainPage.php">Home</a></li>
                <li class="nav-item"><a class="nav-link" href="rsoRequestForm.php">Create a New RSO</a></li>
                <li class="nav-item"><a class="nav-link" href="newEvent.php">Make an Event</a></li>
                <!-- Visible to Super Admins ONLY -->
                <li class="nav-item superAdminNavItem"><a class="nav-link" href="requests.php">Event and RSO Requests</a></li>
            </ul>
        </div>
		

	<div class="formContainer">

		<form method="post" action="newEvent.php">
			<p><?php include('user_errors.php'); ?></p>
			<div class="form-row justify-content-center">
				<div class="form-group col-md-8">
					<label for="eventNameInput">Event Name</label>
					<input type="text" class="form-control" id="eventNameInput" placeholder="Enter your event name here">
				</div>
			</div>
			<div class="form-row justify-content-center">
				<div class="form-group col-md-4">
					<label for="categoryInput">Category</label>
					<select id="categoryInput" class="custom-select" name="ev_category">
						<option value="generalMeeting">General Meeting</option>
						<option value="fundraising">Fundraising</option>
						<option value="social">Social</option>
						<option value="techTalk">Tech Talk</option>
					</select>
				</div>
				<div class="form-group col-md-4">
					<label for="accessInput">Access Level</label>
					<select id="accessInput" class="custom-select" name="ev_access_lvl">
						<option value="Public">Public</option>
						<option value="Private">Private</option>
						<option value="RSO">RSO</option>
					</select>
				</div>
			</div>
			<div class="form-row justify-content-center">
				<div class="form-group col-md-8">
					<label for="descriptionInput">Description</label>
					<textarea name="ev_desc" class="form-control" id="descriptionInput" rows="3"></textarea>
				</div>
			</div>
			<div class="form-row justify-content-center">
					<div class="form-group col-md-4">
					<label for="eventTimeInput">Event Time</label>
					<input type="time" name="ev_time" id="eventTimeInput" class="form-control">
				</div>
				<div class="form-group col-md-4">
					<label for="eventDateInput">Event Date</label>
					<input  name="ev_date" type="date" id="eventDateInput" class="form-control">
				</div>
			</div>
			<div class="form-row justify-content-center">
				<div class="form-group col-md-4">
					<label for="phoneNumberInput">Contact Phone Number</label>
					<input name="ev_phone" type="text" id="phoneNumberInput" class="form-control">
				</div>
				<div class="form-group col-md-4">
					<label for="emailInput">Contact Email Address</label>
					<input name="ev_email" type="email" id="emailInput" class="form-control">
				</div>
			</div>
			<br />
			<input class="btn-lg btn-dark" type="submit" name="event_submit">
		</form>

	</div>

	 	<script src="https://cdn.datatables.net/1.10.18/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.10.18/js/dataTables.bootstrap4.min.js"></script>
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.2/js/bootstrap.min.js" integrity="sha384-o+RDsa0aLu++PJvFqy8fFScvbHFLtbvScb8AjopnFD+iEQ7wo/CG0xlczd+2O/em" crossorigin="anonymous"></script>
	
		<script>

		var accessLevel = "<?php echo $_SESSION['access_level']?>"

		$(document).ready(
			function(){
				if(accessLevel=="2"){
				$(".superAdminNavItem").css("visibility", "visible");
				}
			}
		);

</script>
	
	</body>

</html>