<?php include('server.php') ?>

<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.2/css/bootstrap.min.css" integrity="sha384-Smlep5jCw/wG7hdkwQ/Z5nLIefveQRIY9nfy6xoR1uRYBtpZgI6339F5dgvm/e9B" crossorigin="anonymous">
        <link href="https://fonts.googleapis.com/css?family=Quicksand" rel="stylesheet">
        <link rel="stylesheet" href="./main.css"/>

        <title>Welcome!</title>

        <script src="https://code.jquery.com/jquery-3.3.1.js" integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60=" crossorigin="anonymous"></script>
        <script src="https://cdn.datatables.net/1.10.18/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.10.18/js/dataTables.bootstrap4.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.2/js/bootstrap.min.js" integrity="sha384-o+RDsa0aLu++PJvFqy8fFScvbHFLtbvScb8AjopnFD+iEQ7wo/CG0xlczd+2O/em" crossorigin="anonymous"></script>
    </head>
    <body>
        <div class="banner">
            <h1 class="bannerHeader">Request Info</h1>
            <ul class="nav menu">
                <!-- Visible to all users -->
                <li class="nav-item"><a class="nav-link" href="mainPage.php">Home</a></li>
                <li class="nav-item"><a class="nav-link" href="rsoRequestForm.php">Create a New RSO</a></li>
                <li class="nav-item"><a class="nav-link" href="newEvent.php">Make an Event</a></li>
                <!-- Visible to Super Admins ONLY -->
                <li class="nav-item superAdminNavItem"><a class="nav-link" href="requests.php">Event and RSO Requests</a></li>
            </ul>
        </div>

        <form class="formContainer" method="post" action="requestInfo.php?request_id=<?php echo $_GET['request_id'];?> &request_type=<?php echo $r_type;?>">

            <?php
                if($r_type == "New Event Request")
                {
                    $get_request_query = "SELECT * FROM admin_event_requests WHERE request_id='$r_id' LIMIT 1";
                    $request_return = mysqli_query($db, $get_request_query);
                    if(mysqli_num_rows($request_return) == 0)
                        echo "ERROR";
                    $request_data = mysqli_fetch_assoc($request_return);
                    $req_ev_name = $request_data['event_name'];
                    $req_ev_cat = $request_data['event_category'];
                    $req_ev_access = $request_data['event_privacy'];
                    $req_ev_desc = $request_data['event_description'];
                    $req_ev_time = $request_data['event_time'];
                    $req_ev_phone = $request_data['event_contact_phone'];
                    $req_ev_email = $request_data['event_contact_email'];
                    $req_ev_owner = $request_data['owner_name'];
                    $req_ev_uni = $request_data['university'];
                    $req_ev_rso = $request_data['rso_id'];
                ?>
                
                    <h2>Event Request: <?php echo $req_ev_name; ?></h2>
                    <p>
                       <strong>Hosted By:     </strong><?php echo $req_ev_owner; ?> <br>
                       <strong>Category:     </strong><?php echo $req_ev_cat; ?> <br>
                       <strong>Access:     </strong><?php echo $req_ev_access; ?> <br>
                       <strong>Time:     </strong><?php echo $req_ev_time; ?> <br>
                       <strong>Location: </strong><?php echo $req_ev_uni; ?> <br><br>
                       <?php echo $req_ev_desc; ?> <br><br>
                       <strong>Contact Phone Number: </strong> <?php echo $req_ev_phone; ?> <br>
                       <strong>Contact Email: </strong> <?php echo $req_ev_email; ?> <br><br>
                    </p>
        
                <?php }
                else if($r_type == "Create RSO Request")
                {
                    $get_request_query = "SELECT * FROM admin_rso_requests WHERE request_id='$r_id' LIMIT 1";
                    $request_return = mysqli_query($db, $get_request_query);
                    $request_data = mysqli_fetch_assoc($request_return);
                    $req_rso_name = $request_data['rso_name'];
                    $req_rso_desc = $request_data['Description'];
                    $req_rso_owner_id = $request_data['requested_by'];
                    $req_rso_uni = $request_data['University'];
                    $req_rso_m1 = $request_data['Member1'];
                    $req_rso_m2 = $request_data['Member2'];
                    $req_rso_m3 = $request_data['Member3'];
                    $req_rso_m4 = $request_data['Member4'];
                    $req_rso_m5 = $request_data['Member5'];
                    $get_owner_query = "SELECT user_name FROM users WHERE userid='$req_rso_owner_id'";
                    $owner_return = mysqli_query($db, $get_owner_query);
                    $owner_name = mysqli_fetch_assoc($owner_return);
                ?>
                 
                    <h2>New RSO Request: <?php echo $req_rso_name; ?></h2>
                    <p>
                       <strong>Leader:     </strong><?php echo $owner_name['user_name']; ?> <br>
                       <strong>Description: </strong><?php echo $req_rso_desc; ?> <br>
                       <strong>University:     </strong><?php echo $req_rso_uni; ?> <br>
                       <strong>Members: </strong><?php echo $req_rso_m1 . ", "; echo $req_rso_m2 . ", "; echo $req_rso_m3 . ", "; echo $req_rso_m4 . ", "; echo $req_rso_m5; ?> <br><br>
                    </p>
        
                <?php } ?>
        
            <select class="col-md-3 custom-select" name="request_status_sel">
                <option value="Under Review">Under Review</option>
                <option value="Accepted">Accepted</option>
                <option value="Denied">Denied</option>
            </select><br><br>
        
            <input class="btn-lg btn-dark" type="submit" name="update_request"><br><br>
        

        <div align="center">
                <br><br>Logged in as: <?php echo $_SESSION['username'] ?> <br /><br />
                <button class="btn btn-dark"><a href="index.php" id="eventInfoLogout">LOGOUT</a></button><br>
        </div>
        <br />
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