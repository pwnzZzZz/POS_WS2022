<?php
    //Eindeutige Session ID über das Session Cookie
    session_start();

    //var_dump($_POST);
    //Prüfe, ob der User berechtigt zum Login ist


    $username_secret = 'admin';
    $pw_secret = 'Testitest4!';


    if(isset($_POST['username']) && isset($_POST['password'])){
        //echo "Daten sind vorhanden!";
        if($_POST['username'] == $username_secret && $_POST['password'] == $pw_secret){
            //echo "Eingeloggt";
            $_SESSION['eingeloggt'] = true;
        }else{
            $_SESSION['fehler'] = true;
            //Todo: Vor Ausgabe username validieren
            $_SESSION['username'] = htmlspecialchars($_POST['username']);
            //echo "Nicht eingeloggt";
        }
        header('Location: ../index.php');
    }else{
            //echo "Keine Formulardaten vorhanden!";
    }


    ?>