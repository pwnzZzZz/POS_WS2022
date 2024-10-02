<?php
session_start();

require_once('./benutzer.php');



$benutzer = new Benutzer("", "");

if (isset($_POST['submit'])) {

    $benutzer->setEmail(isset($_POST['email']) ? $_POST['email'] : "");
    $benutzer->setPassword(isset($_POST['passwort']) ? $_POST['passwort'] : "");
    echo "Loginversuch";

    $benutzerCheck = Benutzer::get($benutzer->getEmail(), $benutzer->getPassword());

    if ($benutzerCheck === null) {
        //Benutzername oder pw falsch
        echo '<ul>';
        foreach ($benutzer->getFehler() as &$value) {
            echo '<li>' . $value . '</li>';
        }
        echo '</ul>';
    } else {
        //Mit Benutzer weiterarbeiten
        $benutzer->login();
        echo 'Erfolgreich!';
    }
}

if (isset($_POST['logout'])){
    session_destroy();
    $benutzer->logout();
}




?>



<!DOCTYPE html>
<html lang="de">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <script src="js/bootstrap.min.js"></script>
    <title>Wochenkarte</title>
</head>

<body>

    <nav class="navbar navbar-expand-lg bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Mensa HTL Imst</a>
            <?php
            if (!(Benutzer::isLoggedIn())) {
                echo '
                    <form class="d-flex" role="login" method="POST">
                <input class="form-control me-2 m-2" type="email" placeholder="Email" aria-label="Email" name="email">
                <input class="form-control me-2 m-2" type="password" placeholder="***" aria-label="Password" name="passwort">
                <button class="btn btn-primary m-2" type="submit" name="submit">Login</button>
            </form>
                    ';
            } else {
                echo '
                <form class="d-flex" role="logout" method="POST">
                <button class="btn btn-primary m-2" type="submit" name="logout">Logout</button>
            </form>
                ';
            }


            ?>

        </div>
    </nav>


    <div class="container text-center">


        <?php
        if (Benutzer::isLoggedIn()) {
            //echo HTML für Wochenkarte
            echo '
        
        <h1>Wochenkarte</h1>
        <div class="row">
            <div class="col-sm-4">
                <h2>Montag</h2>
                <img src="img/montag.png" class="img-thumbnail" alt="Montag">
            </div>  
            <div class="col-sm-4">
            <h2>Dienstag</h2>
                <img src="img/dienstag.png" class="img-thumbnail" alt="Dienstag">
            </div>
            <div class="col-sm-4">
                <h2>Mittwoch</h2>
                <img src="img/mittwoch.png" class="img-thumbnail" alt="Mittwoch">
            </div>
        </div>
        <div class="row">
            <div class="col-sm-4">
                <h2>Donnerstag</h2>
                <img src="img/donnerstag.png" class="img-thumbnail" alt="Donnerstag">
            </div>
            <div class="col-sm-4">
                <h2>Freitag</h2>
                <img src="img/montag.png" class="img-thumbnail" alt="Freitag">
            </div>
        </div>
    </div>
   

        ';
        } else {
            echo 'Bitte einloggen!';
        }
        ?>





        <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="staticBackdropLabel">Datenschutz ist uns wichtig!</h1>
                    </div>
                    <div class="modal-body">
                        Diese Seite verwendet Cookies, aus Gründen!
                        <p>Stimmen Sie der Verwendung zu?</p>
                        <p>Wenn nein, können Sie unsere Dienste leider nicht nutzen.</p>
                    </div>
                    <div class="modal-footer">
                        <form method="POST">
                            <button type="submit" name="cookies" value="yesplease" class="btn btn-secondary" data-bs-dismiss="modal">Ja</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <?php

        require_once('cookiehelper.php');
        if (!CookieHelper::isCookieSet()) {
            if (isset($_POST['cookies'])) {
                Cookiehelper::setcookie();
            } else {
                echo '<script>
            const myModal = new bootstrap.Modal("#staticBackdrop", {
                keyboard: false
            });
            myModal.show();
            
        </script>';
            }
        }
        ?>




</body>

</html>