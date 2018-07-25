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
            <h1 class="bannerHeader">Event Info</h1>
            <ul class="nav menu">
                <!-- Visible to all users -->
                <li class="nav-item"><a class="nav-link" href="mainPage.php">Home</a></li>
                <li class="nav-item"><a class="nav-link" href="rsoRequestForm.php">Create a New RSO</a></li>
                <li class="nav-item"><a class="nav-link" href="newEvent.php">Make an Event</a></li>
                <!-- Visible to Super Admins ONLY -->
                <li class="nav-item superAdminNavItem"><a class="nav-link" href="requests.php">Event and RSO Requests</a></li>
            </ul>
        </div>

        <form class="formContainer" method="post" action="eventInfo.php?event_id=<?php echo $_GET['event_id'] ?>">

                <?php
                    $this_event_id  = $_GET['event_id'];
                    $get_event_info = "SELECT * FROM events WHERE event_id='$this_event_id'";
                    
                    $event_return = mysqli_query($db, $get_event_info);
                    $event_data = mysqli_fetch_assoc($event_return);
                    
                    $event_name = $event_data['event_name'];
                    $event_time = $event_data['event_time'];
                    $event_loc = $event_data['university'];
                    $event_desc = $event_data['event_description'];
                    $event_phone = $event_data['event_contact_phone'];
                    $event_email = $event_data['event_contact_email'];
                    $rid = $event_data['rso_id'];
                    $get_rso_name = "SELECT rso_name FROM rsos WHERE rso_id='$rid'";
                    
                    $rname_return = mysqli_query($db, $get_rso_name);
                    if(mysqli_num_rows($rname_return) == 0)
                        $event_rso = $event_data['owner_name'];
                    else
                    {
                        $rname_val = mysqli_fetch_assoc($rname_return);
                        $event_rso = $rname_val['rso_name'];
                    }
                ?>
            
                <h2><?php echo $event_name; ?></h2>
                
                <p>
                   <strong>Hosted By:     </strong><?php echo $event_rso; ?> <br>
                   <strong>Time:     </strong><?php echo $event_time; ?> <br>
                   <strong>Location: </strong><?php echo $event_loc; ?> <br><br>
                   <?php echo $event_desc; ?> <br><br>
                   <strong>Contact Phone Number: </strong> <?php echo $event_phone; ?> <br>
                   <strong>Contact Email: </strong> <?php echo $event_email; ?> <br><br>
                </p>
            
                <strong>Comments:</strong><br><br>
                <?php
                    $get_event_comments = "SELECT * FROM comments WHERE event_id='$this_event_id'";
                    $comments_return = mysqli_query($db, $get_event_comments);
                    if(mysqli_num_rows($comments_return) == 0)
                    { ?>
                        <p>There doesn't seem to be any comments yet...</p>
                <?php }
                    else
                    {
                        while($comments_data = mysqli_fetch_assoc($comments_return))
                        { 
                            $commenter = $comments_data['user_name'];
                            $user_comment = $comments_data['comment'];
                        ?>
            
                            <p>
                                <strong><?php echo $commenter; ?>: </strong>
                                <?php echo $user_comment ?>
                            </p>
                        
                          <?php } ?>
                <?php	} ?>
            
                        -->

                <div id="comment"></div><br>
                <textarea name="commentBox" rows = "5" cols = "50">Add a comment here</textarea><br><br>
                <input class="btn-lg btn-dark" type="submit" name="comment_submit"><br><br>
            
                <div align="center">
                <br><br>Logged in as: <?php echo $_SESSION['username'] ?> <br /><br />
                <button class="btn btn-dark"><a href="index.php" id="eventInfoLogout">LOGOUT</a></button><br>
                </div>
            

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