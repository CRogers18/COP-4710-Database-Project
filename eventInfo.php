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
		<li><a href="mainPage.html">Home</a></li>
		<li><a href="rsoRequestForm.html">Create a New RSO</a></li>
		<li><a href="newEvent.html">Make an Event</a></li>
		<!-- Visible to Super Admins ONLY -->
		<li><a href="requests.html">Event and RSO Requests</a></li>
	</ul>

	<h2>Test Event</h2><br>

	Time: 7:30PM<br>
	Date: July 25th<br>
	Location: UCF<br><br>
	This is an example of a test event description.<br><br><br>
	<strong>Comments:</strong><br><br>
	<strong>User A:</strong> Looking forward to it!<br><br>
	<strong>User B:</strong> How many friends can I bring along?<br><br>
	<div id="comment"></div><br>
	<textarea id="commentBox" rows = "5" cols = "50">Add a comment here</textarea><br><br>
	<button type="button" onclick="addComment()">Submit</button><br><br>

	</body>

	<script>
		function addComment()
		{
			alert("test");
			var x = document.getElementByID("head2").value;
			alert(x);
		}
	</script>

</html>