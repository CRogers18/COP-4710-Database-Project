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

				<tr>
					<td>Event</td>
					<td>Student A</td>
					<td><a href="">More Info</a></td>
					<td>
						<select>
							<option value="0">Under Review</option>
							<option value="1">Accepted</option>
							<option value="2">Denied</option>
						</select><br><br>
					</td>
					<td><a href="">Update</a></td>
				</tr>

				<tr>
					<td>New RSO</td>
					<td>Student B</td>
					<td><a href="">More Info</a></td>
					<td>
						<select>
							<option value="0">Under Review</option>
							<option value="1">Accepted</option>
							<option value="2">Denied</option>
						</select><br><br>
					</td>
					<td><a href="">Update</a></td>
				</tr>

				<tr>
					<td>Event</td>
					<td>Student C</td>
					<td><a href="">More Info</a></td>
					<td>
						<select>
							<option value="0">Under Review</option>
							<option value="1">Accepted</option>
							<option value="2">Denied</option>
						</select><br><br>
					</td>
					<td><a href="">Update</a></td>
				</tr>

			</table>
		</div><br><br>

	</body>

</html>