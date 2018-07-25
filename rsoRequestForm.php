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
            <h1 class="bannerHeader">New RSO</h1>
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
        <form method="POST" action="rsoRequestForm.php">
                <p>
                        <?php include('user_errors.php'); ?>
                </p>
            <div class="form-row justify-content-center">
                <div class="form-group col-md-4">
                    <label for="rsoNameInput">RSO Name</label>
                    <input type="text" class="form-control" id="rsoNameInput" placeholder="Enter your RSO name here" name="rso_name">
                </div>
                <div class="form-group col-md-4">
                    <label for="universityInput">University of New RSO</label>
                    <select id="universityInput" class="custom-select" name="uni_select">
                        <option value="UCF">UCF</option>
                        <option value="USF">USF</option>
                        <option value="FIU">FIU</option>
                    </select>
                </div>
            </div>
            <div class="form-row justify-content-center">
                <div class="form-group col-md-8">
                    <label for="descriptionInput">Description</label>
                    <textarea name="rso_desc" class="form-control" id="descriptionInput" rows="3"></textarea>
                </div>
            </div>
            <div class="form-row justify-content-center">
                <div class="form-group col-md-4">
                    <label for="member1">Member 1</label>
                    <input name="m1" type="text" class="form-control" id="member1">
                </div>
                <div class="form-group col-md-4">
                    <label for="member2">Member 2</label>
                    <input name="m2" type="text" class="form-control" id="member2">
                </div>
            </div>
            <div class="form-row justify-content-center">
                <div class="form-group col-md-4">
                    <label for="member3">Member 3</label>
                    <input name="m3" type="text" class="form-control" id="member3">
                </div>
                <div class="form-group col-md-4">
                    <label for="member4">Member 4</label>
                    <input name="m4" type="text" class="form-control" id="member4">
                </div>
            </div>
            <div class="form-row justify-content-center">
                <div class="form-group col-md-4">
                    <label for="member5">Member 5</label>
                    <input name="m5" type="text" class="form-control" id="member5">
                </div>
            </div>
            <input class="btn-lg btn-dark" type="submit" name="submit_rso_req">
        </form>
        <br />
        <h2>PLEASE NOTE: You must have 5 users to create an RSO!</h2>
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