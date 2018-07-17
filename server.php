<?php
session_start();

$username = "";
$user_errors = array();

$db = mysqli_connect('localhost','root','COP4710DB','project');

// login existing users
if(isset($_POST['login_existing']))
{
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
		$query = "SELECT * FROM users WHERE username='$username' AND password='$hash_pw'";

		$query_return = mysqli_query($db, $query);

		if(mysqli_num_rows($results) == 1)
		{
			$_SESSION['username'] = $username;
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
	
}

?>