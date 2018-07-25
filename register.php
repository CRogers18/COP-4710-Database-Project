<?php include('server.php') ?>

<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.2/css/bootstrap.min.css" integrity="sha384-Smlep5jCw/wG7hdkwQ/Z5nLIefveQRIY9nfy6xoR1uRYBtpZgI6339F5dgvm/e9B" crossorigin="anonymous">
        <link href="https://fonts.googleapis.com/css?family=Quicksand" rel="stylesheet">
        <link rel="stylesheet" href="./main.css"/>

        <title>Sign Up!</title>
    </head>
    <body>
    <div class="banner">
            <h1 class="bannerHeader">Sign Up!</h1>
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
        <form method="post" action="register.php">
            <p>
			<?php include('user_errors.php'); ?>
			</p>
            <div class="form-row justify-content-center">
                <div class="form-group col-md-4">
                    <label for="usernameInput">Enter a Username</label>
                    <input type="text" id="usernameInput" class="form-control" name="username">
                </div>
            </div>
            <div class="form-row justify-content-center">
                <div class="form-group col-md-4">
                    <label for="passwordInput">Enter a Password</label>
                    <input type="password" id="passwordInput" class="form-control" name="password">
                </div>
            </div>
            <div class="form-row justify-content-center">
                <div class="form-group col-md-4">
                    <label for="universityInput">Select Your University</label>
                    <select id="universityInput" class="custom-select" name="univ_sel">
                        <option value="UCF">UCF</option>
                        <option value="USF">USF</option>
                        <option value="FIU">FIU</option>    
                    </select>
                </div>
            </div>    
    
                <input class="btn-lg btn-dark" type="submit" name="login_new">
        </form>
    </div>

        <script src="https://cdn.datatables.net/1.10.18/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.10.18/js/dataTables.bootstrap4.min.js"></script>
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.2/js/bootstrap.min.js" integrity="sha384-o+RDsa0aLu++PJvFqy8fFScvbHFLtbvScb8AjopnFD+iEQ7wo/CG0xlczd+2O/em" crossorigin="anonymous"></script>
    
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