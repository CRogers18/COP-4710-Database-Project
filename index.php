<?php include('server.php') ?>

<!DOCTYPE hmtl>
<html>
    <head>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.2/css/bootstrap.min.css" integrity="sha384-Smlep5jCw/wG7hdkwQ/Z5nLIefveQRIY9nfy6xoR1uRYBtpZgI6339F5dgvm/e9B" crossorigin="anonymous">
        <link href="https://fonts.googleapis.com/css?family=Quicksand" rel="stylesheet">
        <link href="https://cdn.datatables.net/1.10.18/css/dataTables.bootstrap4.min.css" rel="stylesheet">
        <link rel="stylesheet" href="./main.css"/>

        <title>Welcome!</title>
    </head>
    <body>
            <div class="row no-gutters">
                <div class="col">
                    <img id="welcomeImage" src="./img/chalkboard.jpg"/>
                </div>
                <div class="col">
                    <div class="welcomeContainer" style="text-align: center; position: relative; top: 40%">
                        <p id="welcomeText">Welcome!</p>
                    <form class="loginForm" method="post" action="index.php">
                        <p><?php include('user_errors.php'); ?></p>
                        <div class="form-row justify-content-center">                            <div class="form-group col-md-6">
                                <label for="unsername">Username</label>
                                <input type="text" id="unsername" class="form-control" name="username">
                            </div>
                        </div>
                        <div class="form-row justify-content-center"> 
                            <div class="form-group col-md-6">
                                <label for="password">Password</label>
                                <input type="password" id="password" class="form-control" name="password"><br /><br />
                            </div>
                        </div>
                                <input class="btn btn-dark" type="submit" value="login_existing">
                    </form>
                    <button type="button" class="btn btn-dark"><a href="./newRegister.html">New Here? Sign Up!</a></button>
                    </div>
                </div>
            </div>

        <script src="https://cdn.datatables.net/1.10.18/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.10.18/js/dataTables.bootstrap4.min.js"></script>
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.2/js/bootstrap.min.js" integrity="sha384-o+RDsa0aLu++PJvFqy8fFScvbHFLtbvScb8AjopnFD+iEQ7wo/CG0xlczd+2O/em" crossorigin="anonymous"></script>
    </body>
</html>