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
					<th>Event Name</th>
					<th>Event Date</th>
					<th>Event Time</th>
					<th>Contact</th>
					<th></th>
				</tr>

				<tr>
					<td>Test RSO</td>
					<td><a href="eventInfo.html">Test Event</a></td>
					<td>07/12/2018</td>
					<td>6:30 PM</td>
					<td><a href="">Admin1</a></td>
					<td><a href="">Follow</a></td>
				</tr>

				<tr>
					<td>Test2 RSO</td>
					<td>Test2 Event</td>
					<td>07/13/2018</td>
					<td>6:30 PM</td>
					<td><a href="">Admin2</a></td>
					<td><a href="">Follow</a></td>
				</tr>

				<tr>
					<td>Test3 RSO</td>
					<td>Test3 Event</td>
					<td>07/14/2018</td>
					<td>6:30 PM</td>
					<td><a href="">Admin3</a></td>
					<td><a href="">Follow</a></td>
				</tr>

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
					<th>Dues</th>
					<th></th>
				</tr>

				<tr>
					<td>ACM@UCF</td>
					<td>Association for Computing Machinery</td>
					<td>$30</td>
					<td><a href="">Follow</a></td>
				</tr>

				<tr>
					<td>Cookie Club</td>
					<td>Yes, we are a thing.</td>
					<td>No Dues</td>
					<td><a href="">Follow</a></td>
				</tr>

				<tr>
					<td>Fight Club</td>
					<td>Don't talk about us...</td>
					<td>No Dues</td>
					<td><a href="">Follow</a></td>
				</tr>

			</table>
		</div>		

	</body>
	 
</html>