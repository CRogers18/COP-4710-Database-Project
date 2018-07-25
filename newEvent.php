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
	<ul class="nav menu">
			<!-- Visible to all users -->
			<li class="nav-item"><a href="mainPage.html">Home</a></li>
			<li class="nav-item"><a href="rsoRequestForm.html">Create a New RSO</a></li>
			<li class="nav-item"><a href="newEvent.html">Make an Event</a></li>
			<!-- Visible to Super Admins ONLY -->
			<li class="nav-item"><a href="requests.html">Event and RSO Requests</a></li>
	</ul>

		<div class="banner"></div>
		<h1 class="bannerHeader">Make a New Event</h1>
		

	<div class="formContainer">

		<form>
			<strong>Event Name</strong><br>
			<input type="text"><br><br>

			<strong>Category</strong><br>
			<select name="category">
				<option value="General Meeting">General Meeting</option>
				<option value="fundr">Fundraising</option>
				<option value="social">Social</option>
				<option value="tech_t">Tech Talks</option>
			</select><br><br>

			<!-- Access level should only be set-able by admins, do not show for students applying to make their own event -->
			<strong>Access Level</strong><br>
			<select name="access_lvl">
				<option value="Public">Public</option>
				<option value="Private">Private</option>
				<option value="RSO">RSO</option>
			</select><br><br>

			<strong>Description</strong><br>
			<textarea name="desc" rows = "15" cols = "50">Enter an event description here
			</textarea><br><br>

			<strong>Event Time</strong><br>
			<input type="time" name="time"><br><br>

			<strong>Event Date</strong><br>
			<input type="date" id="event_time"
					value="2018-07-09"
					min = "2018-07-09" max = "2019-12-31"><br><br>

			<strong>Contact Phone Number</strong><br>
			<input type="text"><br><br>

			<strong>Contact Email Address</strong><br>
			<input type="email" name="email"><br><br>

			<input class="btn btn-dark" type="submit" name="submit"><br><br>
			
		</form>

	</div>
	</body>

</html>