<?php
    session_start();

    $_SESSION['session']='active';
    $_SESSION['user']='marcel';
    $_SESSION['id']='3';

    session_destroy();
?>

<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css">

    <?php
        $gueltigbis = time()+3600*24*365;
        if(isset($_GET['theme']) && $_GET['theme']=='dark'){
            setcookie('thema', 'dark', $gueltigbis, '/', '', false, true);
            $linkHTML = '<link rel="stylesheet" href="css/darktheme.css">';
            echo $linkHTML;
        }elseif(isset($_GET['theme']) && $_GET['theme']=='light'){
            setcookie('thema', 'light', $gueltigbis, '/', '', false, true);
        }else{
            if(isset($_COOKIE['thema']) && $_COOKIE['thema']=='dark'){
                $linkHTML = '<link rel="stylesheet" href="css/darktheme.css">';
                echo $linkHTML;
            }
        }
        
    ?>


    <title>Cookies and Sessions</title>

</head>

<body>

    <nav class="navbar bg-primary">
        <div class="container-fluid">
            <h1><a class="text-light">Cookies!!!.at</a></h1>
            <?php
            if(isset($_SESSION['eingeloggt']) && $_SESSION['eingeloggt']==true){
            echo '<a class="btn btn-secondary" href="php/logout.php">Logout</a>';
            }else{
                if(isset($_SESSION['fehler']) && $_SESSION['fehler']==true){
                    $uname = isset($_SESSION['username'])?$_SESSION['username']:"";
                    $formHTML = '  <form class="d-flex" role="login" method="POST" action="php/login.php">
                    <input class="form-control mr-sm-2 is-invalid" type="text" name="username" placeholder="Benutzername" aria-label="username" value="'. $uname .'">
                    <input class="form-control mr-sm-2 is-invalid" type="password" name="password" placeholder="************" aria-label="password">
                    <button class="btn btn-secondary my-2 my-sm-0" type="submit">Login</button>
                    </form>';
                    echo $formHTML;
                }else{
                    echo '  <form class="d-flex" role="login" method="POST" action="php/login.php">
                    <input class="form-control mr-sm-2" type="text" name="username" placeholder="Benutzername" aria-label="username">
                    <input class="form-control mr-sm-2" type="password" name="password" placeholder="************" aria-label="password">
                    <button class="btn btn-secondary my-2 my-sm-0" type="submit">Login</button>
                    </form>';
                }
                
            }

            ?>

          



        </div>
    </nav>

    <div>
        <div class="card mb-3">
            <img class="card-img-top" src="img/pexels-lisa-fotios-230325.jpg" alt="Card image cap">
            <div class="card-body">
                <h3 class="card-title">Super Geheimes Yummi Cookie Rezept</h3>

                <?php
                    if(isset($_SESSION['eingeloggt']) && $_SESSION['eingeloggt']==true){
                        $htmlcode = '<p class="card-text">250g weiche Butter<br>100g Zucker<br>150g brauner Zucker<br>
                        1 TL Vanilleextrakt<br>2 Eier (Gr. M)<br>280g Weizenmehl (Type 405)<br>
                        1 TL Backpulver<br>1 Prise Salz<br>200g Chocolate Chunks<br><br>
                        Weiche Butter mit den beiden Zuckersorten mehrere Minuten cremig schlagen. Vanilleextrakt und Eier zugeben und kurz verrühren. Mehl, Backpulver und Salz mischen, zur Eier-Butter-Mischung geben und zu einem Teig verrühren (nach Belieben mit den Knethaken des Rührgeräts).<br><br>
                        Ca. 180 g der Schokochunks mithilfe eines Kochlöffels oder Teigspatels unter den Teig heben. Den Ofen auf 180 Grad Ober-/Unterhitze (Umluft: 160 Grad) vorheizen. Zwei Backbleche mit Backpapier auslegen.<br><br>
                        Aus dem Teig mithilfe eines Eisportionierers ca. 12 Kugeln abstechen, mit den Händen rund formen und mit viel Abstand auf dem Blech platzieren. Leicht platt drücken. Da die Kekse verlaufen, empfehlen wir ca. 6 Kekse auf einem Blech zu backen.<br><br>
                        Die restlichen Schokochunks auf den Teigkugeln verteilen und leicht andrücken. Die Kekse im vorgeheizten Ofen ca. 10-12 Min. backen. Der Rand sollte dabei nicht zu dunkel werden, die Mitte des Kekses darf noch etwas feucht aussehen.<br><br>
                        Die Kekse herausnehmen (ggf. bei Ober-/ Unterhitze das zweite Blech hineinschieben) und ca. 10 Minuten auf dem Blech abkühlen lassen. Dann mit einem Pfannenwender vorsichtig auf ein Kuchengitter setzen. Beim Abkühlen werden die Kekse nochmal etwas fester. Der Teig ergibt ca. 12 Cookies.</p>';

                        echo $htmlcode;
                    }
                
                    
                ?>

                <p class="card-text"><small class="text-muted">Last updated 3 mins ago<br></small></p>


            </div>
        </div>
    </div>

    <footer class="navbar bg-primary fixed-bottom text-light bottom-0">
        <div class="text-right">&copy; Marcel Schranz 2022 | <a class="link-secondary" href="?theme=light">Light Theme</a> | <a class="link-secondary" href="?theme=dark">Dark Theme</a></div>
    </footer>
</body>

</html>