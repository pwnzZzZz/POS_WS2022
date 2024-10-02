<html>
<head>
    <title>HTML-PHP-Demo</title>
    <meta charset="utf8">
    <meta lang="de">
    <meta name="author" content="Michael Gamper">
    <meta name="description" content="HTML/PHP-Demo">
    <meta name="keywords" content="HTML, CSS, PHP">
    <link rel="stylesheet" href="css/meinstil.css">
</head>
<body>
    <h1>Hallo PHP</h1>
    <div></div>
    <form action="php/register.php" method="POST">
        <label for="studiname">Name Studierende/r*</label>
        <input name="studiname" type="text" required="" placeholder="Maxine Musterfrau" />
        
        <label for="email">Email</label>
        <input name="email" type="email" placeholder="maxine@tsn.at" />
        
        <label for="fach">Fach*</label>
        <select name="fach" required="">
            <option value="POS">POS</option>
            <option value="DBI">DBI</option>
            <option value="NVS">NVS</option>
            <option value="FSE">FSE</option>
        </select> 

        <label for="note">Note*</label>
        <input name="note" type="number" min="1" max="5"/>

        <label for="datum">Prüfungsdatum*</label>
        <input name="datum" type="date" required="" />
        <!--TODO: Client-seitige Datenvalidierung mit JS umsetzen -->

        <input type="submit" value="Validieren"/>
        
    </form>

</body>
</html> 