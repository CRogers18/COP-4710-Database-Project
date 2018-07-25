<?php include('server.php') ?>

<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.2/css/bootstrap.min.css" integrity="sha384-Smlep5jCw/wG7hdkwQ/Z5nLIefveQRIY9nfy6xoR1uRYBtpZgI6339F5dgvm/e9B" crossorigin="anonymous">
        <link href="https://fonts.googleapis.com/css?family=Quicksand" rel="stylesheet">
        <link rel="stylesheet" href="./main.css"/>

        <title>Sign Up!</title>

        <script src="https://code.jquery.com/jquery-3.3.1.js" integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60=" crossorigin="anonymous"></script>
        <script src="https://cdn.datatables.net/1.10.18/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.10.18/js/dataTables.bootstrap4.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.2/js/bootstrap.min.js" integrity="sha384-o+RDsa0aLu++PJvFqy8fFScvbHFLtbvScb8AjopnFD+iEQ7wo/CG0xlczd+2O/em" crossorigin="anonymous"></script>
    </head>
    <body>
    <div class="banner">
            <h1 class="bannerHeader">Requests</h1>
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
            <h2>Event Table</h2>
            <table id="requestsEventTable" class="dataTable table col table-striped table-bordered">
                <thead>
                    <tr>
                        <th>Type</th>
                        <th>Requested By</th>
                        <th>Name</th>
                        <th>Time</th>
                        <th>University</th>
                        <th>Details</th>
                    </tr>
                </thead>
                <tbody>
                <?php
				$query_event_req = mysqli_query($db, "SELECT * FROM admin_event_requests WHERE request_status='Under Review'");
				while($event_req = mysqli_fetch_assoc($query_event_req)) { ?>
					<tr>
						<td><?php $r_str = "New Event Request"; echo $r_str; ?></td>
						<td><?php echo $event_req['owner_name']; ?></td>
						<td><?php echo $event_req['event_name']; ?></td>
						<td><?php echo $event_req['event_time']; ?></td>
						<td><?php echo $event_req['university']; ?></td>
						<td><a href="requestInfo.php?request_id=<?php echo $event_req['request_id']; ?>&request_type=<?php echo $r_str; ?>">Details</a></td>
					</tr>
				<?php } ?>

				<?php
				$query_rso_req = mysqli_query($db, "SELECT * FROM admin_rso_requests WHERE request_status='Under Review'");
				while($rso_req = mysqli_fetch_assoc($query_rso_req)) { ?>
					<tr>
						<td><?php $r_str = "Create RSO Request"; echo $r_str; ?></td>
						<td><?php 
							$req_id = $rso_req['requested_by'];
							$query_owner = mysqli_query($db, "SELECT user_name FROM users WHERE userid='$req_id'");
							$uid_val = mysqli_fetch_assoc($query_owner);
							$user = $uid_val['user_name'];
							echo $user; 
						?></td>
						<td><?php echo $rso_req['rso_name']; ?></td>
						<td>N/A</td>
						<td><?php echo $rso_req['University']; ?></td>
						<td><a href="requestInfo.php?request_id=<?php echo $rso_req['request_id']; ?>&request_type=<?php echo $r_str; ?>">Details</a></td>
					</tr>
				<?php } ?>
                </tbody>
            </table>
            <div align="center">
                <br><br>Logged in as: <?php echo $_SESSION['username'] ?> <br /><br />
                <button class="btn btn-dark"><a href="index.php" id="eventInfoLogout">LOGOUT</a></button><br>
            </div>
        </div>
        <script>
        var accessLevel = "<?php echo $_SESSION['access_level']?>"
        
        $(document).ready(
            function(){
                $('#requestsEventTable').DataTable();
            }

            function(){
                if(accessLevel=="2"){
                    $(".superAdminNavItem").css("visibility", "visible");
                }
            }
        );
            
        </script>
    </body>
</html>