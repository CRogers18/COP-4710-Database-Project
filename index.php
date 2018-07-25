<!DOCTYPE hmtl>
<html>
    <head>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.2/css/bootstrap.min.css" integrity="sha384-Smlep5jCw/wG7hdkwQ/Z5nLIefveQRIY9nfy6xoR1uRYBtpZgI6339F5dgvm/e9B" crossorigin="anonymous">
        <link href="https://fonts.googleapis.com/css?family=Quicksand" rel="stylesheet">
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
                        <form class="loginForm">
                               Username:   <input type="text" name="username">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                               Password:   <input type="password" name="password"><br /><br />
                                <input class="btn btn-dark" type="submit" value="Log In">
                                <button type="button" class="btn btn-dark"><a href="./newRegister.html">New Here? Sign Up!</a></button>
                        </form>
                    </div>
                </div>
            </div>

        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.2/js/bootstrap.min.js" integrity="sha384-o+RDsa0aLu++PJvFqy8fFScvbHFLtbvScb8AjopnFD+iEQ7wo/CG0xlczd+2O/em" crossorigin="anonymous"></script>
    </body>
</html>