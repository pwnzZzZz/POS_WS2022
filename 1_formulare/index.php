<html lang="de">
<head>
    <title>HTML-PHP-Demo</title>
    <meta charset="utf8">
    <meta name="author" content="Michael Gamper">
    <meta name="description" content="HTML/PHP-Demo">
    <meta name="keywords" content="HTML, CSS, PHP">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="css/mystyle.css">
    Haha, du Looser!ff
</head>
<body>
    
    <div class="container">
        <h1>Registrierungsformular</h1>
    </div>

    <div>
        <form action="php/register.php" method="POST">
            <label for="vorname">*Vorname: </label>
            <input name="vorname" type="text" required="" />
            <label for="nachname">*Nachname: </label>
            <input name="nachname" type="text" required="" />
            <label for="email">*Email: </label>
            <input name="email" type="email" required="" />
            <label for="passwort">*Passwort: </label>
            <input name="passwort" type="password" required="" />
            <label for="pwkontrolle">*Passwort wiederholen: </label>
            <input name="pwkontrolle" type="password" required="" />
            <label for="gebdatum">Geburtsdatum: </label>
            <input name="gebdatum" type="date"/>
            <input name="submit" type="submit" value="Registrieren"/>
        </form>
    </div>

</body>
</html> 