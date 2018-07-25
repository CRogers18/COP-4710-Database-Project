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
	$ev_rso_host = mysqli_real_escape_string($db, $_POST['rso_select']);
	$ev_category = mysqli_real_escape_string($db, $_POST['ev_category']);
//	$ev_access_lvl = mysqli_real_escape_string($db, $_POST['ev_access_lvl']);
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
	if(empty($ev_name) || empty($ev_category) || empty($ev_rso_host) || empty($ev_desc)|| empty($ev_time) || empty($ev_date) || empty($ev_phone) || empty($ev_email))
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
		if($_SESSION['access_level'] == 1 || $_SESSION['access_level'] == 2)
		{
			$get_rso_id = "SELECT rso_id FROM rsos WHERE rso_name='$ev_rso_host'";
			$rid_return = mysqli_query($db, $get_rso_id);
			$rid_val = mysqli_fetch_assoc($rid_return);
			$rid = $rid_val['rso_id'];

			// TODO: replace temp_rsoID with actual RSO ID
			// adds a new event to the database
			$new_event_query = "INSERT INTO events (event_name, event_category, event_privacy, event_description, event_time, event_contact_phone, event_contact_email, owner_name, rso_id, university) VALUES ('$ev_name', '$ev_category', '$ev_rso_host', '$ev_desc', '$ev_date_time', '$ev_phone', '$ev_email', '$ev_owner_name', '$rid', '$uni')";
			mysqli_query($db, $new_event_query);
			echo mysqli_error($db);

		//	header('location: mainPage.php');

			echo '<script language="javascript">';
			echo 'alert("Event submitted successfully!")';
			echo '</script>';
		}
	}
}

if(isset(($_POST['submit_rso_req'])))
{
	$r_name = mysqli_real_escape_string($db, $_POST['rso_name']);
	$r_uni = mysqli_real_escape_string($db, $_POST['uni_select']);
	$r_desc = mysqli_real_escape_string($db, $_POST['rso_desc']);
	$mem1 = mysqli_real_escape_string($db, $_POST['m1']);
	$mem2 = mysqli_real_escape_string($db, $_POST['m2']);
	$mem3 = mysqli_real_escape_string($db, $_POST['m3']);
	$mem4 = mysqli_real_escape_string($db, $_POST['m4']);
	$mem5 = mysqli_real_escape_string($db, $_POST['m5']);

	$members = array($mem1, $mem2, $mem3, $mem4, $mem5);

	// user session variables
	$rso_owner_name = $_SESSION['username'];
	$uni = -1;
	$u_id = $_SESSION['userID'];

	// defaults for students requesting events
	$req_status = "Under Review";
	$temp_rsoID = -1;
	$valid_user = 1;

	switch ($r_uni) 
	{
		case "UCF":
			$uni = 1;
			break;

		case "FSU":
			$uni = 2;
			break;

		case "FIU":
			$uni = 3;
			break;	
	}

	// checking for lack of input on new event form
	if(empty($r_name) || empty($r_uni) || empty($r_desc) || empty($mem1) || empty($mem2) || empty($mem3) || empty($mem4) || empty($mem5))
	{
		array_push($user_errors, "No fields can be left blank!");
	}

	// checks for invalid members
	for($i = 0; $i < 5; $i++)
	{
		$user = $members[$i];

		$uid_query = "SELECT userid FROM users WHERE user_name='$user'";
		$uid_return = mysqli_query($db, $uid_query);

		if(mysqli_num_rows($uid_return) == 0)
		{
			array_push($user_errors, "Username: '" . $user . "' was not found!\n");
			$valid_user = 0;
			break;
		}
	}

	if($valid_user == 1)
	{
		// admin and super admin access levels
		if($_SESSION['access_level'] == 1 || $_SESSION['access_level'] == 2)
		{
			// adds a new request to the admin request queue table for rsos
		 	$new_rso_query = "INSERT INTO rsos (rso_name, rso_leader, rso_description, university_id) VALUES ('$r_name', '$rso_owner_name', '$r_desc', '$uni')";

			mysqli_query($db, $new_rso_query);
			echo mysqli_error($db);

			$get_rso_id = "SELECT rso_id FROM rsos WHERE rso_name='$r_name'";
			$rid_return = mysqli_query($db, $get_rso_id);
			$rid_val = mysqli_fetch_assoc($rid_return);
			$rid = $rid_val['rso_id'];
			echo mysqli_error($db);

			for($i = 0; $i < 5; $i++)
			{
				$user = $members[$i];

				$uid_query = "SELECT userid FROM users WHERE user_name='$user'";
				$uid_return = mysqli_query($db, $uid_query);
				$uid_val = mysqli_fetch_assoc($uid_return);
				$new_uid = $uid_val['userid'];
				echo mysqli_error($db);

				$new_rso_member = "INSERT INTO rso_member_lists (rso_id, userid, rso_owner) VALUES ('$rid', '$new_uid', '$rso_owner_name')";

				mysqli_query($db, $new_rso_member);
				echo mysqli_error($db);
			}
			
			header('location: mainPage.php');
		}

		// student access level
		if($_SESSION['access_level'] == 0)
		{
			$new_rso_request_query = "INSERT INTO admin_rso_requests (requested_by, request_status, rso_name, University, description, Member1, Member2, Member3, Member4, Member5) VALUES ('$u_id', '$req_status', '$r_name', '$r_uni', '$r_desc', '$mem1', '$mem2', '$mem3', '$mem4', '$mem5')";
			mysqli_query($db, $new_rso_request_query);
			echo mysqli_error($db);

			header('location: mainPage.php');
		}
	}
}

if(isset(($_POST['comment_submit'])))
{
	$user_name = $_SESSION['username'];
	$comment = mysqli_real_escape_string($db, $_POST['commentBox']);

	$uid_query = "SELECT userid FROM users WHERE user_name='$user_name'";
	$uid_return = mysqli_query($db, $uid_query);
	$uid_val = mysqli_fetch_assoc($uid_return);
	$commenter_uid = $uid_val['userid'];

	$ev_id  = $_GET['event_id'];

	$new_comment_query = "INSERT INTO comments (user_id, user_name, event_id, comment) VALUES ('$commenter_uid', '$user_name', '$ev_id', '$comment')";
	mysqli_query($db, $new_comment_query);
	echo mysqli_error($db);
}

if(isset(($_POST['update_request'])))
{
	$new_req_status = mysqli_real_escape_string($db, $_POST['request_status_sel']);

	$r_type  = $_GET['request_type'];
	$r_id = $_GET['request_id'];

	switch ($new_req_status) {

		case "Accepted":
			
			if($r_type == "New Event Request")
			{
				$get_event_data = "SELECT * FROM admin_event_requests WHERE request_id='$r_id'";
				$new_event_res = mysqli_query($db, $get_event_data);
				$new_event_return = mysqli_fetch_assoc($new_event_res);

				$ev_name = $new_event_return['event_name'];
				$ev_category = $new_event_return['event_category'];
			//	$ev_access_lvl = mysqli_real_escape_string($db, $_POST['ev_access_lvl']);
				$ev_privacy = $new_event_return['event_privacy'];
				$ev_desc = $new_event_return['event_description'];
				$ev_time = $new_event_return['event_time'];
				$ev_phone = $new_event_return['event_contact_phone'];
				$ev_email = $new_event_return['event_contact_email'];
				$ev_rso_host = $new_event_return['owner_name'];
				$rid = -1;
				$uni = $new_event_return['university'];

				$new_event_query = "INSERT INTO events (event_name, event_category, event_privacy, event_description, event_time, event_contact_phone, event_contact_email, owner_name, rso_id, university) VALUES ('$ev_name', '$ev_category', '$ev_privacy', '$ev_desc', '$ev_time', '$ev_phone', '$ev_email', '$ev_rso_host', '$rid', '$uni')";
				mysqli_query($db, $new_event_query);

				$update_requests = "UPDATE admin_event_requests SET request_status='$new_req_status' WHERE request_id='$r_id'";
				mysqli_query($db, $update_requests);
			}

			else if($r_type == "Create RSO Request")
			{
				$get_rso_data = "SELECT * FROM admin_rso_requests WHERE request_id='$r_id'";
				$new_rso_res = mysqli_query($db, $get_rso_data);
				$new_rso_return = mysqli_fetch_assoc($new_rso_res);

				$r_name = $new_rso_return['rso_name'];
				$r_uni = $new_rso_return['University'];
				$r_desc = $new_rso_return['Description'];
				$mem1 = $new_rso_return['Member1'];
				$mem2 = $new_rso_return['Member2'];
				$mem3 = $new_rso_return['Member3'];
				$mem4 = $new_rso_return['Member4'];
				$mem5 = $new_rso_return['Member5'];

				$get_uni_id = "SELECT university_id FROM universities WHERE university_name='$r_uni'";
				$r_uni_id = mysqli_query($db, $get_uni_id);
				$uni_id_val = mysqli_fetch_assoc($r_uni_id);
				$uni_id = $uni_id_val['university_id'];

				$req_id = $new_rso_return['requested_by'];
				$query_owner = mysqli_query($db, "SELECT user_name FROM users WHERE userid='$req_id'");

				$uid_val = mysqli_fetch_assoc($query_owner);
				$rso_owner_name = $uid_val['user_name'];

				$members = array($mem1, $mem2, $mem3, $mem4, $mem5);

				$new_rso_query = "INSERT INTO rsos (rso_name, rso_leader, rso_description, university_id) VALUES ('$r_name', '$rso_owner_name', '$r_desc', '$uni_id')";

				mysqli_query($db, $new_rso_query);
				echo mysqli_error($db);

				$get_rso_id = "SELECT rso_id FROM rsos WHERE rso_name='$r_name'";
				$rid_return = mysqli_query($db, $get_rso_id);
				$rid_val = mysqli_fetch_assoc($rid_return);
				$rid = $rid_val['rso_id'];
				echo mysqli_error($db);

				for($i = 0; $i < 5; $i++)
				{
					$user = $members[$i];

					$uid_query = "SELECT userid FROM users WHERE user_name='$user'";
					$uid_return = mysqli_query($db, $uid_query);
					$uid_val = mysqli_fetch_assoc($uid_return);
					$new_uid = $uid_val['userid'];
					echo mysqli_error($db);

					$new_rso_member = "INSERT INTO rso_member_lists (rso_id, userid, rso_owner) VALUES ('$rid', '$new_uid', '$rso_owner_name')";

					mysqli_query($db, $new_rso_member);
					echo mysqli_error($db);
				}

				$update_requests = "UPDATE admin_rso_requests SET request_status='$new_req_status' WHERE request_id='$r_id'";
				mysqli_query($db, $update_requests);
			}

			header('location: requests.php');

			break;

		case "Denied":

				if($r_type == "New Event Request")
				{
					$update_requests = "UPDATE admin_event_requests SET request_status='$new_req_status' WHERE request_id='$r_id'";
					mysqli_query($db, $update_requests);					
				}

				else if($r_type == "Create RSO Request")
				{
					$update_requests = "UPDATE admin_rso_requests SET request_status='$new_req_status' WHERE request_id='$r_id'";
					mysqli_query($db, $update_requests);
				}

				header('location: requests.php');

			break;

		case "Under Review":
				header('location: requests.php');
			break;	
	}
}

if(isset(($_POST['join_rso'])))
{
	$r_name = mysqli_real_escape_string($db, $_POST['r_name']);
	$r_leader = mysqli_real_escape_string($db, $_POST['r_leader']);
	$u_id = $_SESSION['userID'];

	$get_rso_id = "SELECT rso_id FROM rsos WHERE rso_name='$r_name'";
	$rid_return = mysqli_query($db, $get_rso_id);
	$rid_val = mysqli_fetch_assoc($rid_return);
	$rid = $rid_val['rso_id'];

	$join_rso_query = "INSERT INTO rso_member_lists (rso_id, userid, rso_owner) VALUES ('$rid', '$u_id', '$r_leader')";
	mysqli_query($join_rso_query);
}

?>