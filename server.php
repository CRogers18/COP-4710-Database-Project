<?php
session_start();

// session variables
$username = "";
$access_level = 0;
$userID = -1;
$universityID = "";
$user_errors = array();

$db = mysqli_connect('localhost','root','','project');

// login existing users
if(isset($_POST['login_existing']))
{
	// fetches data from fields on web page
	$username = mysqli_real_escape_string($db, $_POST['username']);
	$password = mysqli_real_escape_string($db, $_POST['password']);

	if(empty($username))
	{
		array_push($user_errors, "Username missing!");
	}

	if(empty($password))
	{
		array_push($user_errors, "Password missing!");	
	}

	if(count($user_errors) == 0)
	{
		$hash_pw = md5($password);
		$query = "SELECT * FROM users WHERE user_name='$username' AND user_password='$hash_pw'";
		$query_return = mysqli_query($db, $query);

		if(mysqli_num_rows($query_return) == 1)
		{
			$_SESSION['username'] = $username;

			// fetches user access level from the database
			$access_lvl_query = "SELECT access_level FROM users WHERE user_name='$username' AND user_password='$hash_pw'";
			$access_lvl_return = mysqli_query($db, $access_lvl_query);
			$user_access_lvl = mysqli_fetch_assoc($access_lvl_return);
			$_SESSION['access_level'] = $user_access_lvl['access_level'];

			// fetches user university from the database
			$uni_query = "SELECT user_univ FROM users WHERE user_name='$username' AND user_password='$hash_pw'";
			$uni_return = mysqli_query($db, $uni_query);
			$user_uni = mysqli_fetch_assoc($uni_return);
			$_SESSION['universityID'] = $user_uni['user_univ'];

			// fetches user id from the database
			$uid_query = "SELECT userid FROM users WHERE user_name='$username' AND user_password='$hash_pw'";
			$uid_return = mysqli_query($db, $uid_query);
			$uid_val = mysqli_fetch_assoc($uid_return);
			$_SESSION['userID'] = $uid_val['userid'];	

			header('location: mainPage.php');
		}

		else
		{
			array_push($user_errors, "Username and/or password is incorrect!");
		}
	}		
}

// login a new user
if(isset($_POST['login_new']))
{
	$username = mysqli_real_escape_string($db, $_POST['username']);
	$password = mysqli_real_escape_string($db, $_POST['password']);
	$univ = mysqli_real_escape_string($db, $_POST['univ_sel']);

	// new users default to lowest access level
	$access_lvl = 0;

	// checks that no duplicate users exist in the database
	$no_dupe_query = "SELECT * FROM users WHERE user_name='$username' LIMIT 1";
	$query_return = mysqli_query($db, $no_dupe_query);
	$user_exists = mysqli_fetch_assoc($query_return);

	if($user_exists)
	{
		if($user_exists['user_name'] === $username) 
		{
			array_push($user_errors, "Username already exists!");
		}
	}

	if(count($user_errors) == 0)
	{
		// adds a new user to the database
		$hash_pw = md5($password);
		$new_user_query = "INSERT INTO users (user_name, user_password, user_univ, access_level) VALUES ('$username', '$hash_pw', '$univ', $access_lvl)";
		mysqli_query($db, $new_user_query);

		// sets session variables to user defined values
		$_SESSION['username'] = $username;
		$_SESSION['access_level'] = $access_lvl;
		$_SESSION['universityID'] = $univ;

		// returns user ID
		$uid_query = "SELECT userid FROM users WHERE user_name='$username' AND user_password='$hash_pw'";
		$uid_return = mysqli_query($db, $uid_query);
		$uid_val = mysqli_fetch_assoc($uid_return);
		$_SESSION['userID'] = $uid_val['userid'];

		header('location: mainPage.php');
	}
}

if(isset(($_POST['event_submit'])))
{
	// event form field data extraction
	$ev_name = mysqli_real_escape_string($db, $_POST['ev_name']);
	$ev_category = mysqli_real_escape_string($db, $_POST['ev_category']);
	$ev_access_lvl = mysqli_real_escape_string($db, $_POST['ev_access_lvl']);
	$ev_desc = mysqli_real_escape_string($db, $_POST['ev_desc']);
	$ev_time = mysqli_real_escape_string($db, $_POST['ev_time']);
	$ev_date = mysqli_real_escape_string($db, $_POST['ev_date']);
	$ev_phone = mysqli_real_escape_string($db, $_POST['ev_phone']);
	$ev_email = mysqli_real_escape_string($db, $_POST['ev_email']);

	// user session variables
	$ev_owner_name = $_SESSION['username'];
	$uni = $_SESSION['universityID'];
	$u_id = $_SESSION['userID'];

	// defaults for students requesting events
	$req_status = "Under Review";
	$event_visibility = "Public";
	$temp_rsoID = -1;

	// combining input from event date and time fields into 1 datetime attribute
	$ev_date_time = date('Y-m-d H:i:s', strtotime("$ev_date $ev_time"));

	// checking for lack of input on new event form
	if(empty($ev_name) || empty($ev_category) || empty($ev_access_lvl) || empty($ev_desc)|| empty($ev_time) || empty($ev_date) || empty($ev_phone) || empty($ev_email))
	{
		array_push($user_errors, "No fields can be left blank!");
	}

	else
	{
		// student access level
		if($_SESSION['access_level'] == 0)
		{
			// adds a new request to the admin request queue table for events
		 	$new_event_request_query = "INSERT INTO admin_event_requests (requested_by, event_name, event_category, event_privacy, event_description, event_time, event_contact_phone, event_contact_email, owner_name, rso_id, university, request_status) VALUES ('$u_id', '$ev_name', '$ev_category', '$event_visibility', '$ev_desc', '$ev_date_time', '$ev_phone', '$ev_email', '$ev_owner_name', '$temp_rsoID', '$uni', '$req_status')";
			mysqli_query($db, $new_event_request_query);
			echo mysqli_error($db);

			header('location: mainPage.php');

			echo '<script language="javascript">';
			echo 'alert("Event request submitted successfully!")';
			echo '</script>';
		}

		// admin and super admin access levels
		if($_SESSION['access_level'] == 1)
		{
			// TODO: replace temp_rsoID with actual RSO ID
			// adds a new event to the database
			$new_event_query = "INSERT INTO events (event_name, event_category, event_privacy, event_description, event_time, event_contact_phone, event_contact_email, owner_name, rso_id, university) VALUES ('$ev_name', '$ev_category', '$ev_access_lvl', '$ev_desc', '$ev_date_time', '$ev_phone', '$ev_email', '$ev_owner_name', '$temp_rsoID', '$uni')";
			mysqli_query($db, $new_event_query);
			echo mysqli_error($db);

		//	header('location: mainPage.php');

			echo '<script language="javascript">';
			echo 'alert("Event submitted successfully!")';
			echo '</script>';
		}
	}
}

?>