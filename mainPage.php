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
            <h1 class="bannerHeader">Welcome!</h1>
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
                <table id="mainEventTable" class="dataTable table col table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>RSO</th>
                            <th>Event Name</th>
                            <th>Event Time</th>
                            <th>Contact</th>
                            <th>Follow</th>
                        </tr>
                    </thead>
                    <tbody>
                            <?php
                            $query_events = mysqli_query($db, "SELECT * FROM events");
                            while($events = mysqli_fetch_assoc($query_events)) { ?>
                                <tr>
                                    <td><?php 
                                        
                                        $rid = $events['rso_id'];
                                        $get_rso_name = "SELECT rso_name FROM rsos WHERE rso_id='$rid'";
                                        
                                        $rname_return = mysqli_query($db, $get_rso_name);
                                        $rname_val = mysqli_fetch_assoc($rname_return);
                                        $rname = $rname_val['rso_name'];
                                        echo $rname;
                                    ?></td>
                                    <td><?php echo $events['event_name']; ?></td>
                                    <td><?php echo $events['event_time']; ?></td>
                                    <td><a href=""><?php echo $events['owner_name']; ?></a></td>
                                    <td><a href="">Follow</a></td>
                                </tr>
                            <?php } ?>
                    </tbody>
                </table>
        </div>
        <br />
        <div class="formContainer">
                <h2>RSO List</h2>
                <table id="requestsEventTable" class="dataTable table col table-striped table-bordered">              
                    <thead>
                        <tr>
                            <th>RSO</th>
                            <th>Description</th>
                            <th>Leader</th>
                            <th>Join</th>
                        </tr>
                    </thead>
                    <tbody>
                            <?php
                            $query_rsos = mysqli_query($db, "SELECT * FROM rsos");
                            while($rsos = mysqli_fetch_assoc($query_rsos)) { ?>
                                <tr>
                                    <td><?php echo $rsos['rso_name']; ?></td>
                                    <td><?php echo $rsos['rso_description']; ?></td>
                                    <td><?php echo $rsos['rso_leader']; ?></td>
                                    <td><a href="">Join</a></td>
                                </tr>
                            <?php } ?>
                    </tbody>
                </table>
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